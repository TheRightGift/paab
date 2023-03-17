<?php

namespace App\Listeners;

use App\Events\StripeEvent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
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
            $discount = $data['discount'] === null ? json_encode(['value' => null]) : json_encode(['id' => $data['discount']['coupon']['id'], 'percentage' => $data['discount']['coupon']['percent_off'], 'amount_off' => $data['discount']['coupon']['amount_off']]) ;
            DB::table('payments')->insert([
                'customer_id' => $data['customer'],
                'collection_method' => $data['collection_method'],
                'amount_paid' => $data['amount_paid'],
                'currency' => $data['currency'],
                'created' => $data['created'],
                'billing_reason' => $data['billing_reason'],
                'amount_remaining' => $data['amount_remaining'],
                'account_country' => $data['account_country'],
                'discount' => $discount,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
            $user = DB::table('users')->where('stripe_id', $data['customer'])->first();
            if ($user !== null) {
                $names = 'Dr. '.$user->firstname.' '.$user->lastname;
            }
            else $names = "";
            $dataForMail = [
                'hosted_invoice_url' => $data['hosted_invoice_url'],
                'invoice_pdf' => $data['invoice_pdf'],
                'names' => $names,
            ];
            Mail::to($data['customer_email'])->send(new MailInvoiceOnSuccesfulPayment($dataForMail));
        }
    }
}
