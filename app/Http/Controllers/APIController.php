<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tenant;
use App\Mail\WebsiteLive;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use App\Models\AdminClientOrder;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Handler\CurlHandler;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Mail\MailInvoiceOnSuccesfulPayment;

class APIController extends Controller
{
    // Makes request to other APIs
    
    public function registerDomain($tenantID) {
        $user = User::where('stripe_id', $tenantID)->first();
        $tenant = Tenant::where('user_id', $user->id)->first();
        $adminClientOrder = AdminClientOrder::where('tenant_id', $tenant->id)->first();
        $tenantPassTB = DB::table('tenant_password_tables')->where('tenant_id', $tenant->id)->first();
        if (!empty($tenant)) {
            $domain = $tenant['domains'][0]['domain'];
            $dataForMail = [
                'email' => $adminClientOrder->email,
                'password' => $tenantPassTB->password,
                'domain' => $domain,
                'name' => $user->firstname.' '.$user->lastname,
            ];
            $res =  $this->runAWSUtility($domain, $dataForMail);
            echo $res;
            // dd($tenant['domains'][0]['domain']);
        }
        else{
            return response()->json(['status' => 404, 'message' => 'Payment made against a physician that does not exist']);
        }
        // $years = 1;
        // $key = env('NAMESILO_API_KEY');
        // $api = env('NAMESILO_API_URL');
        // if ($domainName !== null && $mail !== null) {
        //     try {
        //         $URL = "{$api}/registerDomain?version=1&type=xml&key={$key}&domain={$domainName}&years={$years}&private=1&auto_renew=1";
        //         $client = new \GuzzleHttp\Client();
               
        //         $response = $client->request('GET', $URL);
        //         $body = $response->getBody(); 
        //         $xml = simplexml_load_string($body);
        //         if (htmlentities((string)$xml->reply->code) == 300) { // && htmlentities((string)$xml->reply->detail) == 'success'
        //             // return $this->runAWSUtility($data, $dataForMail);
        //         }
        //         else {
        //             return response()->json(['message' => htmlentities((string)$xml->reply->detail), 'status' => htmlentities((string) $xml->reply->code)]);
        //         }
        //     } catch (\Throwable $th) {
        //         //throw $th;
        //         echo $th->getMessage();
        //         exit;
        //     }
        // }
        // else {
        //     return response()->json(['message' => 'Failure', 'status' => 422], 422);
        // }
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

    public function runAWSUtility($domain, $dataForMail){
        try {
            $handler = new CurlHandler();
            $client = new \GuzzleHttp\Client();
            $tapMiddleware = Middleware::tap(function ($request) {});
            $data = ["DomainName" => 'drdionneibekiemd.com'];

            $response = $client->request('POST', 'https://wcdawsutility.playmock.com.ng/createzone', [
                'json' => $data,
                'handler' => $tapMiddleware($handler)
            ]);

            $responseCode = $response->getStatusCode();
            // echo $responseCode;
            if ($responseCode == 200) {
               $this->sendMail($dataForMail);
                echo 200;
            }
            else {
                echo 'Not available:'. $response->getStatusCode();
            }
            // echo $responseBody;
            // print_r($responseBody);
            // echo $domainName, $email, $domain, $password, $name;
            // handle the API response
            // if ($responseBody == 'InProgress') {
            //     // do something if the API call succeeded
            
           
               
            // } else {
            //     // do something if the API call failed
            //     echo 501;
            // }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    private function sendMail($dataForMail) {
        Mail::to($dataForMail['email'])->send(new WebsiteLive($dataForMail));
    }
}
