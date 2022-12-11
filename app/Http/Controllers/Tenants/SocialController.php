<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Tenants\Social;
use Illuminate\Http\Request;
use Validator;

class SocialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $social = Social::get();
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
            'twitter' => 'nullable',
            'linkedin' => 'nullable',
            'facebook' => 'nullable',
        ]);

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $request->validated();
            $social = Social::create($input);
            if ($social == true) {
                return response()->json(['message' => 'Success', 'social' => $social], 200);
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
            'twitter' => 'nullable',
            'linkedin' => 'nullable',
            'facebook' => 'nullable',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $request->validated();
            $socials = new Social();
            $socials->find($social);
            $socials->update($input);
            if ($socials == true) {
                return response()->json(['message' => 'Success', 'social' => $social], 200);
            }
            else {
                return response()->json(['message' => 'Failed', 'social' => $social], 501);
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
        $social->delete();
        return response()->json([], 204);
    }
}
