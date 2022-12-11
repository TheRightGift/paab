<?php

namespace App\Http\Controllers\Tenants;

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
        $achievement = Achievement::get();
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
            'title' => 'required',
            'percentage' => 'required',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $request->validated();
            $achievement = Achievement::create($input);
            if ($achievement == true) {
                return response()->json(['message' => 'Success', 'achievement' => $achievement], 200);
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
            'title' => 'required',
            'percentage' => 'required',
        ]);  

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $request->validated();
            $achievements = new Achievement();
            $achievements->find($achievement);
            $achievements->update($input);
            if ($achievements == true) {
                return response()->json(['message' => 'Success', 'achievement' => $achievements], 200);
            }
            else {
                return response()->json(['message' => 'Failed', 'achievement' => $achievements], 501);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Achievement  $achievement
     * @return \Illuminate\Http\Response
     */
    public function destroy(Achievement $achievement)
    {
        $achievement->delete();
        return response()->json([], 204);
    }
}
