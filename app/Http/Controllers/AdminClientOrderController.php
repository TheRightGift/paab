<?php

namespace App\Http\Controllers;

use App\Models\AdminClientOrder;
use Illuminate\Http\Request;
use Validator;

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
            'email' => ['required'],
        ]); 
        
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $inputs->validated();
            $order = AdminClientOrder::create($input);
            return response(['order' => $order, 'message' => 'Created Success'], 201);
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ClientOrder  $clientOrder
     * @return \Illuminate\Http\Response
     */
    public function show(ClientOrder $clientOrder)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ClientOrder  $clientOrder
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $clientOrder)
    {
        $order = AdminClientOrder::findOrFail($titleId);
        $order->update($request->only('email'));
        return response(['order' => $order, 'message' => 'Updated Success'], 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ClientOrder  $clientOrder
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientOrder $clientOrder)
    {
        //
    }
}
