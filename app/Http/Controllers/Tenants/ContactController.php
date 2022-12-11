<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Tenants\Contact;
use Illuminate\Http\Request;
use Validator;
class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contact = Contact::get();
        return response()->json(['message' => 'Success', 'contact' => $contact]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = Validator::make($request->all(), [
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $request->validated();
            $contact = Contact::create($input);
            if ($contact == true) {
                return response()->json(['message' => 'Success', 'contact' => $contact], 200);
            }
            else {
                return response()->json(['message' => 'Failed', 'contact' => $contact], 501);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        $inputs = Validator::make($request->all(), [
            'phone' => 'nullable',
            'email' => 'nullable',
            'address' => 'nullable',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $request->validated();
            $contacts = new Contact();
            $contacts->find($contact);
            $contacts->update($input);
            if ($contacts == true) {
                return response()->json(['message' => 'Success', 'contact' => $contacts], 200);
            }
            else {
                return response()->json(['message' => 'Failed', 'contact' => $contacts], 501);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();
        return response()->json([], 204);
    }
}
