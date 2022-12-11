<?php

namespace App\Http\Controllers\Tenants;

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
            'fav_icon' => 'required|image|mimes:jpg,png|max:100',
            'mobile_icon' => 'required|image|mimes:jpg,png|max:100',
            'logo' => 'required|image|mimes:jpg,png|max:100',
        ]);

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $request->validated();
            if($request->hasFile('fav_icon')){
                $image = $request->file('fav_icon');
                $name = $image->getClientOriginalName();
                $image->file(storage_path('/media/img/' . $name));
                // $image->move(public_path('/media/img/'), $name);
                $input['fav_icon'] = '/media/img/'.$name;
            } 
            if($request->hasFile('mobile_icon')){
                $image = $request->file('mobile_icon');
                $name = $image->getClientOriginalName();
                $image->file(storage_path('/media/img/' . $name));
                // $image->move(public_path('/media/img/'), $name);
                $input['mobile_icon'] = '/media/img/'.$name;
            } 
            if($request->hasFile('logo')){
                $image = $request->file('logo');
                $name = $image->getClientOriginalName();
                $image->file(storage_path('/media/img/' . $name));
                // $image->move(public_path('/media/img/'), $name);
                $input['logo'] = '/media/img/'.$name;
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
            'fav_icon' => 'nullable|image|mimes:jpg,png|max:100',
            'mobile_icon' => 'nullable|image|mimes:jpg,png|max:100',
            'logo' => 'nullable|image|mimes:jpg,png|max:100',
        ]);

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $request->validated();
            if($request->hasFile('fav_icon')){
                $image = $request->file('fav_icon');
                $name = $image->getClientOriginalName();
                $image->file(storage_path('/media/img/' . $name));
                // $image->move(public_path('/media/img/'), $name);
                $input['fav_icon'] = '/media/img/'.$name;
            } 
            if($request->hasFile('mobile_icon')){
                $image = $request->file('mobile_icon');
                $name = $image->getClientOriginalName();
                $image->file(storage_path('/media/img/' . $name));
                // $image->move(public_path('/media/img/'), $name);
                $input['mobile_icon'] = '/media/img/'.$name;
            } 
            if($request->hasFile('logo')){
                $image = $request->file('logo');
                $name = $image->getClientOriginalName();
                $image->file(storage_path('/media/img/' . $name));
                // $image->move(public_path('/media/img/'), $name);
                $input['logo'] = '/media/img/'.$name;
            } 
            $images = new Image();
            $images->find($image);
            $images->update($input);
            if ($images == true) {
                return response()->json(['message' => 'Success', 'image' => $image], 200);
            }
            else {
                return response()->json(['message' => 'Failed', 'image' => $image], 501);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function destroy(Image $image)
    {
        $image->delete();
        return response()->json([], 204);
    }
}
