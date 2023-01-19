<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenants\CV_Additional_School;
use Illuminate\Http\Request;

use Validator;

class CVAdditionalSchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
            'institution' => 'required',
            'yearStart' => 'required',
            'monthStart' => 'required',
            'yearEnd' => 'nullable',
            'monthEnd' => 'nullable',
            'degree' => 'required',
            'title' => 'required',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            $additionalSchool = CV_Additional_School::create($input);
            if ($additionalSchool == true) {
                return response()->json(['message' => 'Success', 'school' => $additionalSchool], 201);
            }
            else {
                return response()->json(['message' => 'Failed', 'school' => $additionalSchool], 501);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CV_Additional_School  $cV_Additional_School
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cV_Additional_School)
    {
        $inputs = Validator::make($request->all(), [
            'institution' => 'required',
            'yearStart' => 'required',
            'monthStart' => 'required',
            'yearEnd' => 'nullable',
            'monthEnd' => 'nullable',
            'degree' => 'required',
            'title' => 'required',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            $schools = new CV_Additional_School();
            $school2Update = $schools->find($cV_Additional_School);
            $school2Update->update($input);
            if ($school2Update == true) {
                return response()->json(['message' => 'Success', 'school' => $school2Update, 'status' => 200], 200);
            }
            else {
                return response()->json(['message' => 'Failed', 'school' => $school2Update], 501);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CV_Additional_School  $cV_Additional_School
     * @return \Illuminate\Http\Response
     */
    public function destroy($cV_Additional_School)
    {
        //
    }
}
