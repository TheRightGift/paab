<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenants\License;
use Illuminate\Http\Request;
use Validator;

class LicenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $license = License::latest()->first();
        return response()->json(['message' => 'Success', 'license' => $license]);
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
            'year' => 'required',
            'location' => 'required',
            'type' => 'nullable',
        ]);

        if ($inputs->fails()) {
            return response()->json(['errors' => $inputs->errors()->all()], 400);
        } else {
            $input = $inputs->validated();
            $license = License::create($input);
            
            if ($license) {
                return response()->json(['message' => 'Success', 'license' => $license], 201);
            }
            else {
                return response()->json(['message' => 'No data updated', 'license' => $license], 200);
            }
        }
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\License  $license
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $license)
    {
        $inputs = Validator::make($request->all(), [
            'year' => 'required',
            'location' => 'required',
            'type' => 'nullable',
        ]);

        if ($inputs->fails()) {
            return response()->json(['errors' => $inputs->errors()->all()], 400);
        } else {
            $input = $inputs->validated();
            $license2Update = License::find($license)->update($input);
            
            if ($license2Update) {
                return response()->json(['message' => 'Success', 'license' => $license2Update], 201);
            }
            else {
                return response()->json(['message' => 'No data updated', 'license' => $license2Update], 200);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\License  $license
     * @return \Illuminate\Http\Response
     */
    public function destroy($license)
    {
        $license2Delete = (new License)->find($license);
        $license2Delete->delete();
        return response()->json([], 204);
    }
}
