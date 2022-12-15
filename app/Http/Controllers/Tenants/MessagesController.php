<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Messages;
use App\Models\Tenants\Contact;
use Illuminate\Http\Request;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'lastname' => 'required',
            'firstname' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
     
        Messages::create($request->all());
        $email = Contact::first();
        $email2Use = empty($email) ? tenant()->user->email : $email;
        \Mail::send('websites.contactus',
           array(
               'lastname' => $request->get('lastname'),
               'firstname' => $request->get('firstname'),
               'email' => $request->get('email'),
               'phone' => $request->get('phone'),
               'messages' => $request->get('message')
           ), function($message) use ($request) {
                $message->from($request->get('email'));
                $message->to(tenant()->user->email, tenant('id'))->subject('Appointment');
            });
     
        return response()->json(['message' => 'Thanks for contacting!, We\'ll get back to you soon'], 201); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function show(Messages $messages)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Messages $messages)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Messages  $messages
     * @return \Illuminate\Http\Response
     */
    public function destroy(Messages $messages)
    {
        //
    }
}
