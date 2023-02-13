<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Stripe\Customer;
use Stripe\Stripe;

class SubscriptionController extends Controller
{
    private function user($request) {
        $user = $request->get('GUID');
        return empty($user) ? $request->user() : User::where('id', $user)->first();
    }
    /**
     * Updates a subscription for the user
     *
     * @param Request $request The request containing subscription update info.
     */
    public function updateSubscription( Request $request ){
        $user = $this->user($request);
        $planID = $request->get('plan');
        $paymentID = $request->get('payment');

        if( !$user->subscribed('premium') ){
            $user->newSubscription( 'premium', $planID )
                ->create( $paymentID );
        }else{
//            $user->subscription('premium')->swap( $planID );
//            return response()->json(['message' => 'We are currently running only one plan and you are subscribed already'], 200);
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
    public function getPaymentMethods( Request $request ){
        $user = $this->user($request);

        $methods = array();

        if( $user->hasPaymentMethod() ){
            foreach( $user->paymentMethods() as $method ){
                array_push( $methods, [
                    'id' => $method->id,
                    'brand' => $method->card->brand,
                    'last_four' => $method->card->last4,
                    'exp_month' => $method->card->exp_month,
                    'exp_year' => $method->card->exp_year,
                ] );
            }
        }

        return response()->json( $methods );
    }
    /**
     * Creates an intent for payment so we can capture the payment
     * method for the user.
     *
     * @param Request $request The request data from the user.
     */
    public function getSetupIntent( Request $request ){
        return $this->user($request)->createSetupIntent();
    }
    /**
     * Adds a payment method to the current user.
     *
     * @param Request $request The request data from the user.
     */
    public function postPaymentMethods( Request $request ){

        $paymentMethodID = $request->get('payment_method');

        $user = $this->user($request, $request->get('GUID'));
        if( $user->stripe_id == null ){
            $user->createAsStripeCustomer();
        }

        $user->addPaymentMethod( $paymentMethodID );
        $user->updateDefaultPaymentMethod( $paymentMethodID );

        return response()->json( null, 204 );
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

            $user->newSubscription('test',$input['plane'])
                ->create($paymentMethod, [
                    'email' => $user->email,
                ]);

            return response()->json(['message' => 'Subscription completed', 'status' => 'ok'], 200);
        } catch (Exception $e) {
            return response()->json(['message' => 'success', 'error' =>$e->getMessage()]);
        }

    }
    /**
     * Removes a payment method for the current user.
     *
     * @param Request $request The request data from the user.
     * NOTE::Do not allow user to remove active payment subscription
     */
    public function removePaymentMethod( Request $request ){
        $user = $request->user();
        $paymentMethodID = $request->get('id');

        $paymentMethods = $user->paymentMethods();

        foreach( $paymentMethods as $method ){
            if( $method->id == $paymentMethodID ){
                $method->delete();
                break;
            }
        }

        return response()->json( null, 204 );
    }
}
