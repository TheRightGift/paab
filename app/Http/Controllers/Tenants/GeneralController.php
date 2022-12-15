<?php

namespace App\Http\Controllers\Tenants;


use App\Http\Controllers\Controller;
use App\Models\Tenants\General;
use Illuminate\Http\Request;
use Validator;

class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $general = General::get();
        return response()->json(['message' => 'Success', 'general' => $general]);
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
            'favicon' => 'nullable|image|mimes:jpg,png|max:10',
            'title' => 'required',
        ]);

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            if($request->hasFile('favicon')){
                $general = $request->file('favicon');
                $ext = $request->file('favicon')->getClientOriginalExtension();
                $stored = \Storage::disk('public')->putFileAs('img', $general, 'favicon'.'.'.$ext);
                
                $input['favicon'] = $stored;
            } 
            
            $general = General::create($input);
            if ($general == true) {
                return response()->json(['message' => 'Success', 'general' => $general, 'status' => 200], 200);
            }
            else {
                return response()->json(['message' => 'Failed', 'general' => $general], 501);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\General  $general
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $general)
    {
        $inputs = Validator::make($request->all(), [
            'favicon' => 'nullable|image|mimes:png|max:100',
            'title' => 'nullable',
        ]);

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $inputs->validated();
            if($request->hasFile('favicon')){
                $general = $request->file('favicon');
                $ext = $request->file('favicon')->getClientOriginalExtension();
                $stored = \Storage::disk('public')->putFileAs('img', $general, 'favicon'.'.'.$ext);
                
                $input['favicon'] = $stored;
            } 
            $generals = new General();
            $general2Update = $generals->find($general);
            $general2Update->update($input);
            if ($general2Update == true) {
                return response()->json(['message' => 'Success', 'general' => $general2Update], 200);
            }
            else {
                return response()->json(['message' => 'Failed', 'general' => $general2Update], 501);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\General  $general
     * @return \Illuminate\Http\Response
     */
    public function destroy($general)
    {
        $general2Delete = General::find($general);
        $general2Delete->delete();
        return response()->json([], 204);
    }
}