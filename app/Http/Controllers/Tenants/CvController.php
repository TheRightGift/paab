<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Tenants\Cv;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Validator;

class CvController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cvSummary = CV::latest()->first();
        return response()->json(['message' => 'Success', 'cvSummary' => $cvSummary]);
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
            'summary' => 'nullable',
            'skills' => 'nullable',
            'title' => 'nullable',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            $cv = CV::create($input);
            if ($cv == true) {
                return response()->json(['message' => 'Success', 'cv' => $cv], 201);
            }
            else {
                return response()->json(['message' => 'Failed', 'cv' => $cv], 501);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cv)
    {
        $inputs = Validator::make($request->all(), [
            'summary' => 'nullable',
            'skills' => 'nullable',
            'title' => 'nullable',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            $cv = CV::find($cv)->update($input);
            if ($cv == true) {
                return response()->json(['message' => 'Success', 'cv' => $cv, 'status' => 200]);
            }
            else {
                return response()->json(['message' => 'Failed', 'cv' => $cv], 501);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cv  $cv
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cv $cv)
    {
        //
    }

    public function upload(Request $request)
    {
        if ($request->hasFile('cvfile')) {
            $file = $request->file('cvfile');
            $tenantID = strtolower(tenant('id'));
            $fileName = $file->getClientOriginalName();
            $path = public_path();
            $url = "/media/tenants/$tenantID/cv/";
            $name = $path.$url;
            $file->move($name, $fileName); // Store the file in the "uploads" directory
        }
        $cv = new Cv();
        $first = $cv->where('id', 1)->first();
        if (!empty($first)) {
            $first->cvfile = $url.$fileName;
            $cv->save();
        } else {
            $cv->cvfile = $url.$fileName;
            $cv->summary = 'Summary in file';
            $cv->title = 'User Title';
            $cv->save();
        }
        return response()->json(['msg' => 'File Uploaded'], 201); // Redirect back to the previous page
    }
}
