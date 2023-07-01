<?php

namespace App\Listeners;

use App\Models\User;
use GuzzleHttp\Client;
use App\Mail\WebsiteLive;
use GuzzleHttp\Middleware;
use App\Events\StripeEvent;
use App\Models\Webcreation;
use Illuminate\Http\Request;
use App\Models\AdminClientOrder;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Handler\CurlHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Validator;
use App\Mail\MailInvoiceOnSuccesfulPayment;
use Illuminate\Contracts\Queue\ShouldQueue;
use Laravel\Cashier\Events\WebhookReceived;

class StripeEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  \App\Events\StripeEvent  $event
     * @return void
     */
    public function handle(WebhookReceived $event): void
    {
        if ($event->payload['type'] === 'invoice.payment_succeeded') {
            // Handle the incoming event...  || $event->payload['type'] === 'customer.subscription.updated' || $event->payload['type'] === 'customer.subscription.created'
            $data = $event->payload['data']['object'];
            $amountPaid = number_format($data['amount_paid']/100, 2, '.', '');
            $discount = $data['discount'] === null ? json_encode(['value' => null]) : json_encode(['id' => $data['discount']['coupon']['id'], 'percentage' => $data['discount']['coupon']['percent_off'], 'amount_off' => $data['discount']['coupon']['amount_off']]) ;
            DB::table('payments')->insert([
                'customer_id' => $data['customer'],
                'collection_method' => $data['collection_method'],
                'amount_paid' => $amountPaid,
                'currency' => $data['currency'],
                'created' => $data['created'],
                'billing_reason' => $data['billing_reason'],
                'amount_remaining' => $data['amount_remaining'],
                'account_country' => $data['account_country'],
                'discount' => $discount,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $metadata = $data['lines']['data'][0]['metadata'];
            // $orders = AdminClientOrder::where([['tenant_id', $metadata['tenant_id']], ['email', $metadata['email']]])->first();
            // $orders->claimed = 1;
            // $orders->save();
            // $userToUpdate = User::where('stripe_id', $data['customer'])->first();
            // $userToUpdate->registration_completed = 'Active';
            // $userToUpdate->save();
            // Send a message to user about payment succeeded
            $dataForMail = [
                'names' => $metadata['firstname'].' '.$metadata['lastname'],
                'hosted_invoice_url' => $data['hosted_invoice_url'],
            ];
            Mail::to($metadata['email'])->send(new MailInvoiceOnSuccesfulPayment($dataForMail));
        } elseif ($event->payload['type'] === 'customer.subscription.created') {
            $data = $event->payload['data']['object'];
            $metadata = $data['metadata'];
            $tenantPassTB = DB::table('tenant_password_tables')->where('tenant_id', $metadata['tenant_id'])->first();
            $detail = [
                'email' => $metadata['email'],
                'password' => $tenantPassTB->password,
                'domain' => $metadata['domainName'],
                'name' => $metadata['firstname'].' '.$metadata['lastname'],
            ];
            // Creates workerTable for checking website creation
            // customer_id, domainName, firstname, lastname, email
            Mail::to($metadata['email'])->send(new WebsiteLive($detail));
            $customersDet = new Webcreation();
            $customersDet->create([
                'customer_id' => $data['customer'],
                'domainName' => $metadata['domainName'],
                'firstname' => $metadata['firstname'],
                'lastname' => $metadata['lastname'],
                'tenant_id' => $metadata['tenant_id'],
                'email' => $metadata['email'],
                'web_creation' => 'pending',
            ]);
        }
    }


}
