<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Image;
use Illuminate\Http\Request;
use Validator;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image = Image::get();
        return response()->json(['message' => 'Success', 'image' => $image]);
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
            'favicon' => 'required|image|mimes:jpg,png|max:100',
            'mobile_icon' => 'required|image|mimes:jpg,png|max:100',
            'logo' => 'required|image|mimes:jpg,png|max:100',
        ]);

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $inputs->validated();
            if($request->hasFile('favicon')){
                $image = $request->file('favicon');
                $stored = \Storage::disk('public')->put("img", $image);
                $input['favicon'] = $stored;
            } 
            if($request->hasFile('mobile_icon')){
                $image = $request->file('mobile_icon');
                $stored = \Storage::disk('public')->put("img", $image);
                $input['mobile_icon'] = $stored;
            } 
            if($request->hasFile('logo')){
                $image = $request->file('logo');
                $stored = \Storage::disk('public')->put("img", $image);
                $input['logo'] = $stored;
            } 
            $image = Image::create($input);
            if ($image == true) {
                return response()->json(['message' => 'Success', 'image' => $image], 200);
            }
            else {
                return response()->json(['message' => 'Failed', 'image' => $image], 501);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $image)
    {
        $inputs = Validator::make($request->all(), [
            'favicon' => 'nullable|image|mimes:jpg,png|max:100',
            'mobile_icon' => 'nullable|image|mimes:jpg,png|max:100',
            'logo' => 'nullable|image|mimes:jpg,png|max:100',
        ]);

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $inputs->validated();
            if($request->hasFile('favicon')){
                $image = $request->file('favicon');
                $stored = \Storage::disk('public')->put("img", $image);
                $input['favicon'] = $stored;
            } 
            if($request->hasFile('mobile_icon')){
                $image = $request->file('mobile_icon');
                $stored = \Storage::disk('public')->put("img", $image);
                $input['mobile_icon'] = $stored;
            } 
            if($request->hasFile('logo')){
                $image = $request->file('logo');
                $stored = \Storage::disk('public')->put("img", $image);
                $input['logo'] = $stored;
            } 
            $images = new Image();
            dd($input);
            $image2Update = $images->find($image);
            $image2Update->update($input);
            if ($image2Update == true) {
                return response()->json(['message' => 'Success', 'image' => $image2Update], 200);
            }
            else {
                return response()->json(['message' => 'Failed', 'image' => $image2Update], 501);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy($image)
    {
        $image2Delete = Image::find($image);
        $image2Delete->delete();
        return response()->json([], 204);
    }
}
