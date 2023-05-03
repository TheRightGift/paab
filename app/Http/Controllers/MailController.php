<?php

namespace App\Http\Controllers;

use App\Mail\AdminSendMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Symfony\Component\Mime\Exception\RfcComplianceException;

class MailController extends Controller
{
    public function adminSendToClients (Request $request) {
        $data = $request->all();
        $recipients = $data['recipients'];
        if (strpos($recipients, ',') !== false) {
            $recipients = explode(",", $recipients);
            foreach ($recipients as $recipient) {
                try {
                    Mail::to($recipient)->send(new AdminSendMail($data));
                } catch (RfcComplianceException $rfc) {
                    throw $rfc;
                }
            }
            return response()->json(['status' => 200, 'message' => 'Message sent to recipients']);
        } else {
            try {
                Mail::to($recipients)->send(new AdminSendMail($data));
            } catch (RfcComplianceException $rfc) {
                throw $rfc;
            }
            return response()->json(['status' => 200, 'message' => 'Message sent to recipient']);
        }
    }
    private function sendMail($recipient, $data) {
        try {
            Mail::to($recipient)->send(new AdminSendMail($data));
        } catch (RfcComplianceException $rfc) {
            return response()->json(['status' => 500, 'message' => $rfc]);
        }
    }
}
