<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use Exception;
use Stripe\Stripe;
use App\Models\User;
use Stripe\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SubscriptionController extends Controller
{
    private function user($request)
    {
        $user = $request->get('GUID');
        return empty($user) ? $request->user() : User::where('id', $user)->first();
    }
    /**
     * Updates a subscription for the user
     *
     * @param Request $request The request containing subscription update info.
     */
    public function updateSubscription(Request $request)
    {
        $user = $this->user($request);
        $planID = $request->get('plan');
        $paymentID = $request->get('payment');
        $mail = $request->get('email');
        $tenantID = $request->get('tenant_id');
        $domainName = Tenant::find($tenantID)->domainName;
        $firstname = $request->get('firstname');
        $lastname = $request->get('lastname');

        if(!$user->subscribed('premium')) {
            if($coupon = $request->get('coupon')) {
                $user->newSubscription('premium', $planID)->withCoupon($coupon)
                ->create($paymentID, [
                    'email' => $mail,
                ], [
                    'metadata' => ['domainName' => $domainName, 'email' => $mail, 'firstname' => $firstname, 'lastname' => $lastname, 'plan' => $planID, 'tenant_id' => $tenantID,],
                ]);
            } else {
                $user->newSubscription('premium', $planID)->create($paymentID, [
                    'email' => $mail,
                ], [
                    // 'metadata' => ['domainName' => $domainName, 'tenant_id' => $tenantID, 'plan' => $plan],
                    'metadata' => ['domainName' => $domainName, 'email' => $mail, 'firstname' => $firstname, 'lastname' => $lastname, 'plan' => $planID, 'tenant_id' => $tenantID,],
                ]);
            }
        }

        return response()->json([
            'subscription_updated' => true
        ]);
    }
    /**
     * Returns the payment methods the user has saved
     *
     * @param Request $request The request data from the user.
     */
    public function getPaymentMethods(Request $request)
    {
        $user = $this->user($request);

        $methods = array();

        if($user->hasPaymentMethod()) {
            foreach($user->paymentMethods() as $method) {
                array_push($methods, [
                    'id' => $method->id,
                    'brand' => $method->card->brand,
                    'last_four' => $method->card->last4,
                    'exp_month' => $method->card->exp_month,
                    'exp_year' => $method->card->exp_year,
                ]);
            }
        }

        return response()->json($methods);
    }
    /**
     * Creates an intent for payment so we can capture the payment
     * method for the user.
     *
     * @param Request $request The request data from the user.
     */
    public function getSetupIntent(Request $request)
    {
        return $this->user($request)->createSetupIntent();
    }
    /**
     * Adds a payment method to the current user.
     *
     * @param Request $request The request data from the user.
     */
    public function postPaymentMethods(Request $request)
    {

        $paymentMethodID = $request->get('payment_method');

        $user = $this->user($request, $request->get('GUID'));
        if($user->stripe_id == null) {
            $user->createAsStripeCustomer();
        }

        $user->addPaymentMethod($paymentMethodID);
        $user->updateDefaultPaymentMethod($paymentMethodID);

        return response()->json(null, 204);
    }
    public function subscribe(Request $request)
    {
        $user = empty($request->user) ? auth()->user() : User::where('id', $request->user)->first(); //Get the user id from request

        $input = $request->all();
        $token =  $request->token;
        $paymentMethod = $request->paymentMethod;
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            if (is_null($user->stripe_id)) {
                $stripeCustomer = $user->createAsStripeCustomer();
            }

            Customer::createSource(
                $user->stripe_id,
                ['source' => $token]
            );

            if($coupon = $request->get('coupon')) {
                $user->newSubscription('test', $input['plane'])
                    ->withCoupon($coupon)
                    ->create($paymentMethod, [
                        'email' => $user->email,
                        'name' => $user->firstname.$user->lastname,
                    ]);
            } else {
                $user->newSubscription('test', $input['plane'])
                    ->create($paymentMethod, [
                        'email' => $user->email,
                    ]);
            }

            return response()->json(['message' => 'Subscription completed', 'status' => 'ok'], 200);
        } catch (Exception $e) {
            // dd($e);
            return response()->json(['message' => 'success', 'error' =>$e->getMessage()]);
        }

    }
    /**
     * Removes a payment method for the current user.
     *
     * @param Request $request The request data from the user.
     * NOTE::Do not allow user to remove active payment subscription
     */
    public function removePaymentMethod(Request $request)
    {
        $user = $request->user();
        $paymentMethodID = $request->get('id');

        $paymentMethods = $user->paymentMethods();

        foreach($paymentMethods as $method) {
            if($method->id == $paymentMethodID) {
                $method->delete();
                break;
            }
        }

        return response()->json(null, 204);
    }

    public function getSubscribers()
    {
        $users = User::whereHas('subscriptions')->get();

        return response()->json(['users' => $users], 200);
    }

    public function returnDayEnd()
    {
        $currentTimestamp = time();
        $user = auth()->user();
        if ($user !== null) {
            if ($user->stripe_id !== null) {
                $data = auth()->user()->subscription('premium')->asStripeSubscription()->current_period_end;
                $date = date('Y-m-d H:i:s', $data);
                $remainingSeconds = $data - $currentTimestamp;
                $remainingDays = floor($remainingSeconds / (60 * 60 * 24));

                return response()->json($remainingDays);
            }
        } else {
            return 'OK';
        }
    }

    public function getInvoices()
    {
        $user = auth()->user();
        if ($user !== null) {
            if ($user->stripe_id !== null) {
                $invoices = auth()->user()->invoices();
                if ($invoices) {
                    $invoiceData = [];

                    foreach ($invoices as $invoice) {
                        $id = $invoice->id;
                        $created = date('Y-m-d H:i:s', $invoice->created);
                        $invoice_pdf = $invoice->invoice_pdf;

                        // Store the extracted attributes in an array
                        $invoiceData[] = [
                            'id' => $id,
                            'created' => $created,
                            'invoice_pdf' => $invoice_pdf,
                        ];
                    }

                    return response()->json($invoiceData);
                } else {
                    return response()->json('No invoices attached to user');
                }
            }
        } else {
            return 'Invoices OK';
        }
    }
}
