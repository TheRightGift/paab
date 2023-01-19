<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenants\CV_Experience;
use Illuminate\Http\Request;

use Validator;

class CVExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $experience = CV_Experience::latest()->all();

        return response()->json(['message' => 'Fetched OnSuccess', 'experience' => $experience]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = json_decode($request->input('data'));
        $inputs = Validator::make($request->all(), [
            // 'data' => 'required',
            'data.*.institution' => 'required',
            'data.*.yearStart' => 'required',
            'data.*.monthStart' => 'required',
            'data.*.yearEnd' => 'nullable',
            'data.*.monthEnd' => 'nullable',
            'data.*.position' => 'required',
            'data.*.location' => 'required',
            'data.*.activities' => 'required',
        ]); 
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            foreach ($data as $row) {
                $experience = new CV_Experience();
                $experience->institution = $row->institution;
                $experience->position = $row->position;
                $experience->yearStart = $row->yearStart;
                $experience->monthStart = $row->monthStart;
                $experience->monthEnd = $row->monthEnd;
                $experience->yearEnd = $row->yearEnd;
                $experience->monthEnd = $row->monthEnd;
                $experience->location = $row->location;
                $experience->activities = $row->activities;
                $experience->save();
            }
            return response(['experience' => $experience, 'message' => 'Created Success'], 201);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CV_Experience  $cV_Experience
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cV_Experience)
    {
        $data = json_decode($request->input('data'));
        $removed = json_decode($request->input('removed'));
        $inputs = Validator::make($request->all(), [
            // 'data' => 'required',
            'data.*.institution' => 'required',
            'data.*.yearStart' => 'required',
            'data.*.monthStart' => 'required',
            'data.*.yearEnd' => 'nullable',
            'data.*.monthEnd' => 'nullable',
            'data.*.position' => 'required',
            'data.*.location' => 'required',
            'data.*.activities' => 'required',
        ]); 
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $inputs->validated();

            if ($request->has('removed')) {
                foreach ($removed as $row) {
                    $experiences = new CV_Experience();
                    $experience2Update = $experiences->find($row->id);
                    
                    $experience2Update->delete();
                }
            }
            foreach ($data as $row) {
                $experiences = new CV_Experience();
                if (!empty($row->id)) {
                    $experience2Update = $experiences->find($row->id);
                    $experience2Update->institution = $row->institution;
                    $experience2Update->position = $row->position;
                    $experience2Update->yearStart = $row->yearStart;
                    $experience2Update->monthEnd = $row->monthEnd;
                    $experience2Update->yearEnd = $row->yearEnd;
                    $experience2Update->monthEnd = $row->monthEnd;
                    $experience2Update->location = $row->location;
                    $experience2Update->activities = $row->activities;
                    $experience2Update->save();
                }
                else {
                    $experiences->institution = $row->institution;
                    $experiences->position = $row->position;
                    $experiences->yearStart = $row->yearStart;
                    $experiences->monthEnd = $row->monthEnd;
                    $experiences->yearEnd = $row->yearEnd;
                    $experiences->monthEnd = $row->monthEnd;
                    $experiences->location = $row->location;
                    $experiences->activities = $row->activities;
                    $experiences->save();
                }
                
            }
            if ($experience2Update == true) {
                return response()->json(['message' => 'Updated', 'experiences' => $experience2Update, 'status' => 200], 200);
            }
            else {
                return response()->json(['message' => 'Error Updating', 'experiences' => $experience2Update, 'status' => 501], 501);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CV_Experience  $cV_Experience
     * @return \Illuminate\Http\Response
     */
    public function destroy(CV_Experience $cV_Experience)
    {
        //
    }
}
