<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenants\CV_Undergrad_School;
use Illuminate\Http\Request;

use Validator;

class CVUndergradSchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $underGradSchool = CV_Undergrad_School::latest()->first();
        return response()->json(['message' => 'Success', 'underGradSchool' => $underGradSchool]);
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
            'institution' => 'nullable',
            'yearStart' => 'nullable',
            'monthStart' => 'nullable',
            'yearEnd' => 'nullable',
            'monthEnd' => 'nullable',
            'major' => 'nullable',
            'minor' => 'nullable',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            $gradSchool = CV_Undergrad_School::create($input);
            if ($gradSchool == true) {
                return response()->json(['message' => 'Success', 'school' => $gradSchool], 201);
            }
            else {
                return response()->json(['message' => 'Failed', 'school' => $gradSchool], 501);
            }
        }
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CV_Undergrad_School  $cV_Undergrad_School
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cV_Undergrad_School)
    {
        $inputs = Validator::make($request->all(), [
            'institution' => 'nullable',
            'yearStart' => 'nullable',
            'monthStart' => 'nullable',
            'yearEnd' => 'nullable',
            'monthEnd' => 'nullable',
            'major' => 'nullable',
            'minor' => 'nullable',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            $schools = new CV_Undergrad_School();
            $school2Update = $schools->find($cV_Undergrad_School);
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
     * @param  \App\Models\CV_Undergrad_School  $cV_Undergrad_School
     * @return \Illuminate\Http\Response
     */
    public function destroy(CV_Undergrad_School $cV_Undergrad_School)
    {
        //
    }
}
