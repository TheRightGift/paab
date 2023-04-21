<?php

namespace App\Http\Controllers\Tenants;


use Illuminate\Http\Request;
use App\Trait\ServiceNotifier;
use App\Models\Tenants\General;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Validator;

class GeneralController extends Controller
{
    use ServiceNotifier;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $general = General::latest()->first();
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
            // 'favicon' => 'nullable|image|mimes:png|max:100',
            'title' => 'nullable',
            'title_id' => 'nullable'
        ]);

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            if($request->has('favicon')){
                $safeName = 'favicon'.'.'.'png';
                $file_path = public_path().'/media/tenants/'.strtolower(tenant('id')).'/img/';
                if (!file_exists($file_path)) {
                    mkdir($file_path, 0755, true);
                }
                $file = $file_path.$safeName;
                Image::make(file_get_contents($request['favicon']))->resize(451, 512, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($file);
                $input['favicon'] = $safeName;
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
            // 'favicon' => 'nullable|image|mimes:png|max:100',
            'title' => 'nullable',
            'oldFav' => 'nullable'
        ]);
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            if($request->has('favicon')){
                $safeName = 'favicon'.'.'.'png';
                $file_path = public_path().'/media/tenants/'.strtolower(tenant('id')).'/img/';
                if (!file_exists($file_path)) {
                    mkdir($file_path, 0755, true);
                }
                $file = $file_path.$safeName;
                Image::make(file_get_contents($request['favicon']))->resize(451, 512, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($file);
                $input['favicon'] = $safeName;
            }
            $generals = new General();
            $general2Update = $generals->find($general);
            $general2Update->update($input);
            if ($general2Update == true) {
                $this->settingschangeNotify();
                return response()->json(['message' => 'Success', 'general' => $general2Update, 'status' => 200], 200);
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

    // public function deleteImage($image_name) {
    //     $fileToDelete = \Storage::disk('public')->exists($image_name);
    //     if ($fileToDelete == true){
    //         // unlink($fileToDelete);
    //         return response()->json(['message' => 'File has been deleted success!', 'status' => 204], 200);
    //     }
    //     else {
    //         return response()->json(['message' => 'File cannot be located on specifeid path!'], 501);
    //     }
    // }
}