<?php

namespace App\Listeners;

use GuzzleHttp\Middleware;
use App\Events\StripeEvent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Handler\CurlHandler;
use Illuminate\Support\Facades\Log;
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
            
            $this->registerDomain($data, $dataForMail);
        }
    }

    public function registerDomain($data, $dataForMail) {
        $domainName = $data['lines']['data'][0]['metadata']['domainName'];
        $mail = $data['lines']['data'][0]['metadata']['email'];
        $years = 1;
        $key = env('NAMESILO_API_KEY');
        $api = env('NAMESILO_API_URL');
        if ($domainName !== null && $mail !== null) {
            try {
                $URL = "{$api}/registerDomain?version=1&type=xml&key={$key}&domain={$domainName}&years={$years}&private=1&auto_renew=1";
                $client = new \GuzzleHttp\Client();
               
                $response = $client->request('GET', $URL);
                $body = $response->getBody(); 
                $xml = simplexml_load_string($body);
                if (htmlentities((string)$xml->reply->detail) === 'success' && htmlentities((string)$xml->reply->code) === 300) {
                    // Create a function for mail forward
                    $email = 'consultancy';
                    $this->configureEmail($domainName, $key, $email, $mail);
                    $this->runAWSUtility($domainName, $dataForMail);
                    echo 'Domain Purchase is successful';
                }
                else {
                    echo response()->json(['message' => htmlentities((string)$xml->reply->detail), 'status' => htmlentities((string) $xml->reply->code)]);
                }
            } catch (\Throwable $th) {
                //throw $th;
                echo $th->getMessage();
                exit;
            }
        }
        else {
            return response()->json(['message' => 'Failure', 'status' => 422], 422);
        }
    }

    public function configureEmail($domainName, $key, $email, $forward1) {
        $api = env('NAMESILO_API_URL');
        try {
            $URL = "{$api}/configureEmailForward?version=1&type=xml&key={$key}&domain={$domainName}&email={$email}&forward1={$forward1}";
            $handler = new CurlHandler();
            $client = new \GuzzleHttp\Client();
            $tapMiddleware = Middleware::tap(function ($request) {});
            $response = $client->request('GET', $URL, [
                'handler' => $tapMiddleware($handler)
            ]);
            $body = $response->getBody(); 
            $xml = simplexml_load_string($body);
            if (htmlentities((string)$xml->reply->detail) === 'success' && htmlentities((string)$xml->reply->code) === 300) {
                // Request AWS Facility
                // return 
                echo response()->json(["message" => htmlentities((string)$xml->reply->detail), "status" =>  htmlentities((string)$xml->reply->code)]);
            }
            else {
                echo response()->json(['message' => htmlentities((string)$xml->reply->detail), 'status' => htmlentities((string) $xml->reply->code)]);
                exit;
            }
        } catch (\Throwable $th) {
            echo $th->getMessage();
            exit;
        }
    }

    public function runAWSUtility($domainName, $dataForMail){
        $data = [
            "DomainName" => $domainName,
        ];
        try {
            $handler = new CurlHandler();
            $client = new \GuzzleHttp\Client();
            $tapMiddleware = Middleware::tap(function ($request) {});
            $response = $client->request('POST', env('AWS_UTILITY_URL'), [
                'json'    => $data,
                'handler' => $tapMiddleware($handler)
            ]);
            $body = $response->getBody(); 
            Mail::to($data['customer_email'])->send(new MailInvoiceOnSuccesfulPayment($dataForMail));
            echo $body;
        } catch (\Throwable $th) {
            echo $th->getMessage();
            exit;
        }
    }
}
