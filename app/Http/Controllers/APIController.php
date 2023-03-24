<?php

namespace App\Http\Controllers;

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use GuzzleHttp\Handler\CurlHandler;
use Illuminate\Support\Facades\Validator;

class APIController extends Controller
{
    // Makes request to other APIs
    
    public function registerDomain(Request $request) {
        $years = $request->get('years');
        $domainName = $request->get('domainName');
        $mail = $request->get('email');
        $years = $years !== null ? $years : 1;
        $key = env('NAMESILO_API_KEY');
        $api = env('NAMESILO_API_URL');
        // dd($years, $domainName, $mail, $key);
        if ($domainName !== null && $mail !== null) {
            try {
                $URL = "{$api}/registerDomain?version=1&type=xml&key={$key}&domain={$domainName}&years={$years}&private=1&auto_renew=1";
                $handler = new CurlHandler();
                $client = new \GuzzleHttp\Client();
                $tapMiddleware = Middleware::tap(function ($request) {
                    // echo $request->getHeaderLine('Content-Type');
                    // // application/json
                    // echo $request->getBody();
                });
                $response = $client->request('GET', $URL, [
                    'handler' => $tapMiddleware($handler)
                ]);
                $body = $response->getBody(); 
                $xml = simplexml_load_string($body);
                if (htmlentities((string)$xml->reply->detail) === 'success' && htmlentities((string)$xml->reply->code) === 300) {
                    // Create a function for mail forward
                    $email = 'consultancy@'.$domainName;
                    return $this->configureEmail($domainName, $key, $email, $mail);
                }
                else {
                    return response()->json(['message' => htmlentities((string)$xml->reply->detail), 'status' => htmlentities((string) $xml->reply->code)]);
                }
                // dd($xml);
                print_r($xml);//$response->withoutHeader('Transfer-Encoding');
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

    public function changeNameServers(Request $request) {
        $validator = Validator::make($request->all(), [
            'domainName' => 'required',
            'ns1' =>  'required',
            'ns2' => 'required',
        ]);

        if ($validator->fails()) {
            return response($validator->errors()->all(), 400);
        }
        else {
            $key = env('NAMESILO_API_KEy');
            $input = $validator->validated();
            try {
                $URL = "https://www.namesilo.com/api/changeNameServers?version=1&type=xml&key={$key}&domain={$input['domainName']}&ns1={$input['ns1']}.COM&ns2={$input['ns2']}";
                $handler = new CurlHandler();
                $client = new \GuzzleHttp\Client();
                $tapMiddleware = Middleware::tap(function ($request) {
                    // echo $request->getHeaderLine('Content-Type');
                    // application/json
                    // echo $request->getBody();
                    // {"foo":"bar"}
                });
                $response = $client->request('GET', $URL, [
                    'handler' => $tapMiddleware($handler)
                ]);
                $parser = simplexml_load_string($response->getBody()) or die("Error: Cannot create object");
                if ($parser->detail === 'success' && $parser->code === 300) {
                    return response()->json(["message" => $parser->detail, "status" => $parser->code]);
                }
                else {
                    return $response;
                }
            } catch (\Throwable $th) {
                echo $th->getMessage();
                exit;
            }
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
            // $parser = simplexml_load_string($response->getBody()) or die("Error: Cannot create object");
            // dd($parser);
            // if ($parser->detail === 'success' && $parser->code === 300) {
            //     return response()->json(["message" => $parser->detail, "status" => $parser->code]);
            // }
            // else {
                return $response;
            // }
        } catch (\Throwable $th) {
            echo $th->getMessage();
            exit;
        }
    }
}
