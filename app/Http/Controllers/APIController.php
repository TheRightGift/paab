<?php

namespace App\Http\Controllers;

use App\Mail\ErrorCreatingSite;
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
    public function getPendingSites() {
        $DB = DB::table('payments');
        $data = $DB->where('web_creation', 'pending')->get();
        $client = new \GuzzleHttp\Client();
        foreach ($data as $key => $value) {
            $url = route('api.domain.register', ['stripe_id' => $value->customer_id]);
            $response = $client->request('GET', $url);
            $body = $response->getBody();
            $data = json_decode($body, true);
            if ($data['status'] === 200) {
                // Update DB web_creation to success
                $column = $DB->find($value->id);
                $column->web_creation = 'success';
                $column->save();
            }
            else {
                // Send email to admin
                Mail::to('goziechukwu@gmail.com')->send(new ErrorCreatingSite($value));
            }
        }
        return response()->json(['status' => 'Success'], 200);
    }
    // Makes request to other APIs
    
    public function registerDomain($stripeId) {
        $user = User::where('stripe_id', $stripeId)->first();
        $tenant = Tenant::where('user_id', $user->id)->first();
        $tenantPassTB = DB::table('tenant_password_tables')->where('tenant_id', $tenant->id)->first();
        if (!empty($tenant)) {
            $domain = $tenant['domains'][0]['domain'];
            $detail = [
                'email' => $user->email,
                'password' => $tenantPassTB->password,
                'domain' => $domain,
                'name' => $user->firstname.' '.$user->lastname,
            ];
            $domainDotCom = $domain.'.com';
            $years = 1;
            $key = env('NAMESILO_API_KEY');
            $api = env('NAMESILO_API_URL');
            // try {
            //     $URL = "{$api}/registerDomain?version=1&type=xml&key={$key}&domain={$domainDotCom}&years={$years}&private=1&auto_renew=1";
            //     $client = new \GuzzleHttp\Client();
            
            //     $response = $client->request('GET', $URL);
            //     $body = $response->getBody(); 
            //     $xml = simplexml_load_string($body);
            //     if (htmlentities((string)$xml->reply->code) == 300) { // && htmlentities((string)$xml->reply->detail) == 'success'
                    return $this->runAWSUtility($domainDotCom, $detail);
            //     }
            //     else {
            //         return response()->json(['message' => htmlentities((string)$xml->reply->detail), 'status' => htmlentities((string) $xml->reply->code)]);
            //     }
            // } catch (\Throwable $th) {
            //     echo $th->getMessage();
            //     exit;
            // }
        }
        else{
            return response()->json(['status' => 404, 'message' => 'Payment made against a physician that does not exist']);
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

    public function runAWSUtility($domain, $detail){
        try {
            $handler = new CurlHandler();
            $client = new \GuzzleHttp\Client();
            $tapMiddleware = Middleware::tap(function ($request) {});
            $data = ["DomainName" => $domain];
            $response = $client->request('POST', env('AWS_UTILITY_URL'), [
                'json' => $data,
                'handler' => $tapMiddleware($handler)
            ]);
            
            $body = $response->getBody();
            $data = json_decode($body, true);
            if ($data['status'] === 200) {
                // Send mail and run the aws sendcommand api
                $this->sendMail($detail);
                return $this->runAWSUtilityCommand($domain);
            }
            else {
                echo 'Not available:'. $response->getStatusCode();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function runAWSUtilityCommand($domain){
        try {
            $handler = new CurlHandler();
            $client = new \GuzzleHttp\Client();
            $tapMiddleware = Middleware::tap(function ($request) {});
            $data = ["DomainName" => $domain];

            $response = $client->request('POST', env('AWS_UTILITY_URL_SENDCOMMAND'), [
                'json' => $data,
                'handler' => $tapMiddleware($handler)
            ]);

            $body = $response->getBody();
            $data = json_decode($body, true);
            if ($data['status'] === 200) {
                // return response()->json(['message' => 'Success', 'status' => $data['status']]);
                return response()->json(['message' => 'Success', 'status' => $data['status'], 'commandID' => $data['commandID'] ]);
            }
            else {
                echo 'Not available:'. $response->getStatusCode();
            }
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    private function sendMail($detail) {
        Mail::to($detail['email'])->send(new WebsiteLive($detail));
        echo 200;
    }
}
