<?php

namespace App\Http\Controllers\Tenants;

use Image;
use Illuminate\Http\Request;
use App\Trait\ServiceNotifier;
use App\Models\Tenants\Achievement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AchievementController extends Controller
{
    use ServiceNotifier;
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
            'banner' => 'nullable',
            'feats' => 'nullable',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            if($request->has('banner')){
                // $banner = $request->file('banner');
                // $ext = $request->file('banner')->getClientOriginalExtension();
                // $stored = \Storage::disk('public')->putFileAs('img', $banner, 'banner'.'.'.$ext);
                // $name = 'banner'.'.'.$ext;
                // $path = $banner->move(public_path('/media/tenants/'.strtolower(tenant('id')).'/img'), $name);
                $safeName = 'banner'.'.'.'png';
                $file = public_path().'/media/tenants/'.strtolower(tenant('id')).'/img/'.$safeName;
                $success = Image::make(file_get_contents($request['banner']))->resize(1294, 743, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($file);
                $input['banner'] = $safeName;
            } 
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
            'banner' => 'nullable',
            'feats' => 'nullable',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            if($request->has('banner')){
                // $banner = $request->file('banner');
                // $ext = $request->file('banner')->getClientOriginalExtension();
                // $stored = \Storage::disk('public')->putFileAs('img', $banner, 'banner'.'.'.$ext);
                
                // $name = 'banner'.'.'.$ext;
                // $path = $banner->move(public_path('/media/tenants/'.strtolower(tenant('id')).'/img'), $name);
                $safeName = 'banner'.'.'.'png';
                $file = public_path().'/media/tenants/'.strtolower(tenant('id')).'/img/'.$safeName;
                $success = Image::make(file_get_contents($request['banner']))->resize(1294, 743, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($file);
                $input['banner'] = $safeName;
            } 
            $achievements = new Achievement();
            $achievement2Update = $achievements->find($achievement);
            $achievement2Update->update($input);
            if ($achievement2Update == true) {
                #TODO: Put back when mail manager is available
                // $this->settingschangeNotify();
                return response()->json(['message' => 'Success', 'achievement' => $achievement2Update, 'status' => 200], 200);
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
