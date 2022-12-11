<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Messages;
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
       
        \Mail::send('contact.contactus',
           array(
               'lastname' => $request->get('lastname'),
               'firstname' => $request->get('firstname'),
               'email' => $request->get('email'),
               'phone' => $request->get('phone'),
               'message' => $request->get('message')
           ), function($message) use ($request) {
                $message->from($request->get('email'));
                $message->to('amaizupeter@yahoo.com', 'Admin')->subject('Appointment');
            });
     
        return response()->json(['Thanks for contacting us!, We\'ll get back to you soon']); 
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
