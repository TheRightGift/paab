<?php

namespace App\Http\Controllers;

use App\Mail\MailSupport;
use App\Models\Support;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class SupportController extends Controller
{
    public function supportSaveData(Request $request)
    {
        $this->validate($request, [
            'names' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'message' => 'required',
            'subject' => 'nullable'
        ]);
        $data = array(
            'names' => $request->get('names'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'message' => $request->get('message'),
            'subject' => $request->get('subject')
        );
        Support::create($request->all());
        Mail::to('techsupport@whitecoatdomain.com')->send(new MailSupport($data));

        return response()->json(['Thanks for contacting us!, We\'ll get back to you soon'], 201);
    }
    public function sendEmailForCallBack(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
        ]);
        Mail::send('mail.supportmail',
            array(
                'email' => $request->get('email'),
            ),
            function ($message) use ($request) {
                $message->from($request->get('email'));
                $message->to('techsupport@whitecoatdomain.com', 'manager@whitecoatdomain.com')->subject('Support');
            }
        );
        return response()->json(['Thanks for contacting us!, We\'ll get back to you soon'], 201);
    }

}
