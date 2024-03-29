<?php

namespace App\Http\Controllers\Tenants;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Tenants\CV_Experience;

use Illuminate\Support\Facades\Validator;

class CVExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $experience = CV_Experience::latest()->get();

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
        // $data = json_decode($request->input('data'));
        // $inputs = Validator::make($request->all(), [
        //     // 'data' => 'nullable',
        //     'data.*.institution' => 'nullable',
        //     'data.*.yearStart' => 'nullable',
        //     'data.*.monthStart' => 'nullable',
        //     'data.*.yearEnd' => 'nullable',
        //     'data.*.monthEnd' => 'nullable',
        //     'data.*.position' => 'nullable',
        //     'data.*.location' => 'nullable',
        //     'data.*.activities' => 'nullable',
        // ]); 
        // if ($inputs->fails()) {
        //     return response($inputs->errors()->all(), 400);
        // } else {
        //     $input = $inputs->validated();
        //     foreach ($data as $row) {
        //         $experience = new CV_Experience();
        //         $experience->institution = $row->institution;
        //         $experience->position = $row->position;
        //         $experience->yearStart = $row->yearStart;
        //         $experience->monthStart = $row->monthStart;
        //         $experience->monthEnd = $row->monthEnd;
        //         $experience->yearEnd = $row->yearEnd;
        //         $experience->monthEnd = $row->monthEnd;
        //         $experience->location = $row->location;
        //         $experience->activities = $row->activities;
        //         $experience->save();
        //     }
        //     return response(['experience' => $experience, 'message' => 'Created Success'], 201);
        // }
        $inputs = Validator::make($request->all(), [
            'institution' => 'required',
            'yearStart' => 'required',
            'monthStart' => 'required',
            'yearEnd' => 'nullable',
            'monthEnd' => 'nullable',
            'city_id' => 'required',
        ]);
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        }
        else {
            $input = $inputs->validated();
            $experience = CV_Experience::create($input);
            if ($experience == true) {
                return response(['experience' => $experience, 'message' => 'Created Success'], 201);
            }
            else {
                return response()->json(['message' => 'Error', 'experiences' => $experience, 'status' => 501], 501);
            }
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
        // $data = json_decode($request->input('data'));
        // $removed = json_decode($request->input('removed'));
        // $inputs = Validator::make($request->all(), [
        //     // 'data' => 'nullable',
        //     'data.*.institution' => 'nullable',
        //     'data.*.yearStart' => 'nullable',
        //     'data.*.monthStart' => 'nullable',
        //     'data.*.yearEnd' => 'nullable',
        //     'data.*.monthEnd' => 'nullable',
        //     'data.*.position' => 'nullable',
        //     'data.*.location' => 'nullable',
        //     'data.*.activities' => 'nullable',
        // ]); 
        // if ($inputs->fails()) {
        //     return response($inputs->errors()->all(), 501);
        // } else {
        //     $input = $inputs->validated();

        //     if ($request->has('removed')) {
        //         foreach ($removed as $row) {
        //             $experiences = new CV_Experience();
        //             $experience2Update = $experiences->find($row->id);
                    
        //             $experience2Update->delete();
        //         }
        //     }
        //     foreach ($data as $row) {
        //         $experiences = new CV_Experience();
        //         if (!empty($row->id)) {
        //             $experience2Update = $experiences->find($row->id);
        //             $experience2Update->institution = $row->institution;
        //             $experience2Update->position = $row->position;
        //             $experience2Update->yearStart = $row->yearStart;
        //             $experience2Update->monthEnd = $row->monthEnd;
        //             $experience2Update->yearEnd = $row->yearEnd;
        //             $experience2Update->monthEnd = $row->monthEnd;
        //             $experience2Update->location = $row->location;
        //             $experience2Update->activities = $row->activities;
        //             $experience2Update->save();
        //         }
        //         else {
        //             $experiences->institution = $row->institution;
        //             $experiences->position = $row->position;
        //             $experiences->yearStart = $row->yearStart;
        //             $experiences->monthEnd = $row->monthEnd;
        //             $experiences->yearEnd = $row->yearEnd;
        //             $experiences->monthEnd = $row->monthEnd;
        //             $experiences->location = $row->location;
        //             $experiences->activities = $row->activities;
        //             $experiences->save();
        //         }
                
        //     }
        //     if ($experience2Update == true) {
        //         return response()->json(['message' => 'Updated', 'experiences' => $experience2Update, 'status' => 200], 200);
        //     }
        //     else {
        //         return response()->json(['message' => 'Error Updating', 'experiences' => $experience2Update, 'status' => 501], 501);
        //     }
        // }
        $inputs = Validator::make($request->all(), [
            'institution' => 'required',
            'yearStart' => 'required',
            'monthStart' => 'required',
            'yearEnd' => 'nullable',
            'monthEnd' => 'nullable',
            'city_id' => 'required',
        ]);
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        }
        else {
            $input = $inputs->validated();
            $experience2Update = CV_Experience::where('id', $cV_Experience)->update($input);
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
    public function destroy($cV_Experience)
    {
        $cV_Experience2Delete = CV_Experience::find($cV_Experience);
        $cV_Experience2Delete->delete();
        return response()->json([], 204);
    }
}
