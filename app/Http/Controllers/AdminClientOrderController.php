<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminClientOrder;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Validator;

class AdminClientOrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user()->id;
        $orders = AdminClientOrder::where('user_id', $user)->with('tenant')->latest()->get();
        return response()->json(['message' => 'OK', 'status' => 200, 'orders' => $orders]);
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
            'tenant_id' => ['required'],
            'user_id' => ['required'],
            'email' => 'required|unique:admin_client_orders',
        ]); 
        return response()->json('Unauthorized Request');
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            $order = AdminClientOrder::create($input);
            return response(['order' => $order, 'message' => 'Created Success'], 201);
        }    
    }

    /**
     * Update the specified resource in storage.
     * For verifiersof doximity
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientOrder  $clientOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tenant_id)
    {
        $order = AdminClientOrder::where('tenant_id', $tenant_id)->first();
        $order->email = $request->email;
        $order->save();
        $response = Http::get(env('WCDSERVICE_URL')."api/v1/track/$order->email?action=VERIFIEDMAIL&clickedPrev=1"); // Make a GET request

        if ($response->successful()) {
            $data = $response->json(); // Retrieve the response data
            // Process the data as needed
        } else {
            $statusCode = $response->status();
            // Handle the error based on the status code
        }
        return response()->json(['order' => $order, 'message' => 'Updated Success'], 200);
    }

}
