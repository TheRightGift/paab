<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Achievement;
use Illuminate\Http\Request;
use Validator;

class AchievementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $achievement = Achievement::latest()->take(1)->first();
        return response()->json(['message' => 'Success', 'achievement' => $achievement]);
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
            'banner' => 'required|image|mimes:png|max:500',
            'feats' => 'required',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            if($request->hasFile('banner')){
                $banner = $request->file('banner');
                $ext = $request->file('banner')->getClientOriginalExtension();
                $stored = \Storage::disk('public')->putFileAs('img', $banner, 'banner'.'.'.$ext);
                
                $input['banner'] = $stored;
            } 
            // $input['feats'] = json_decode($input['feats']);
            $achievement = Achievement::create($input);
            if ($achievement == true) {
                return response()->json(['message' => 'Success', 'achievement' => $achievement], 201);
            }
            else {
                return response()->json(['message' => 'Failed', 'achievement' => $achievement], 501);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Achievement  $achievement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $achievement)
    {
        $inputs = Validator::make($request->all(), [
            'banner' => 'required|image|mimes:png|max:500',
            'feats' => 'required',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            if($request->hasFile('banner')){
                $banner = $request->file('banner');
                $ext = $request->file('banner')->getClientOriginalExtension();
                $stored = \Storage::disk('public')->putFileAs('img', $banner, 'banner'.'.'.$ext);
                
                $input['banner'] = $stored;
            } 
            $achievements = new Achievement();
            $achievement2Update = $achievements->find($achievement);
            $achievement2Update->update($input);
            if ($achievement2Update == true) {
                return response()->json(['message' => 'Success', 'achievement' => $achievement2Update], 200);
            }
            else {
                return response()->json(['message' => 'Failed', 'achievement' => $achievement2Update], 501);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Achievement  $achievement
     * @return \Illuminate\Http\Response
     */
    public function destroy($achievement)
    {
        $achievement2Delete = Achievement::find($achievement);
        $achievement2Delete->delete();
        return response()->json([], 204);
    }
}
