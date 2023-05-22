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
            'message' => 'required'
        ]);
        $data = array(
            'names' => $request->get('names'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'message' => $request->get('message')
        );
        Support::create($request->all());
        Mail::to('goziechukwu@gmail.com')->send(new MailSupport($data));

        return response()->json(['Thanks for contacting us!, We\'ll get back to you soon'], 201);
    }
}
