<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Social;
use Illuminate\Http\Request;
use Validator;
use App\Trait\ServiceNotifier;

class SocialController extends Controller
{
    use ServiceNotifier;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $social = Social::latest()->first();
        return response()->json(['message' => 'Success', 'social' => $social]);
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
            'twitter' => 'nullable|string',
            'linkedin' => 'nullable|string',
            'facebook' => 'nullable|string',
        ]);

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            $social = Social::create($input);
            if ($social == true) {
                return response()->json(['message' => 'Success', 'social' => $social], 201);
            }
            else {
                return response()->json(['message' => 'Failed', 'social' => $social], 501);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Social  $social
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $social)
    {
        $inputs = Validator::make($request->all(), [
            'twitter' => 'required',
            'linkedin' => 'required',
            'facebook' => 'required',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            $socials = new Social();
            $social2Update = $socials->find($social);
            $social2Update->update($input);
            if ($social2Update == true) {
                $this->settingschangeNotify();
                return response()->json(['message' => 'Success', 'social' => $social2Update, 'status' => 200], 200);
            }
            else {
                return response()->json(['message' => 'Failed', 'social' => $social2Update], 501);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Social  $service
     * @return \Illuminate\Http\social
     */
    public function destroy($social)
    {
        $social2Delete = Social::find($social);
        $social2Delete->delete();
        return response()->json([], 204);
    }
}
