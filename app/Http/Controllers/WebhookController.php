<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function handle(Request $request)
    {
        // print_r($request);
        // Handle the webhook request
        $event = $request->input('event');
        $domainName = $request->input('domainName');
        
        if ($event === 'dns-insync') {
            // Make an api call back to AWS utility for the send command
            $client = new Client();
            $url = route('api.aws.sendcommand', ['domainName' => $domainName]);
            $response = $client->request('GET', $url);
            echo $response->getBody();
        }
    }
}
