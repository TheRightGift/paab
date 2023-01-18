<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenants\CV_Experience;
use Illuminate\Http\Request;

use validator;

class CVExperienceController extends Controller
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
            'data.*.icon' => 'required|image|mimes:jpg,png|max:10',
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
                    $experience2Update->save();
                }
                else {
                    $experiences->intitution = $row->intitution;
                    $experiences->position = $row->position;
                    $experiences->yearStart = $row->yearStart;
                    $experiences->monthEnd = $row->monthEnd;
                    $experiences->yearEnd = $row->yearEnd;
                    $experiences->monthEnd = $row->monthEnd;
                    $experiences->location = $row->location;
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
     * Display the specified resource.
     *
     * @param  \App\Models\CV_Experience  $cV_Experience
     * @return \Illuminate\Http\Response
     */
    public function show(CV_Experience $cV_Experience)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CV_Experience  $cV_Experience
     * @return \Illuminate\Http\Response
     */
    public function edit(CV_Experience $cV_Experience)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CV_Experience  $cV_Experience
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CV_Experience $cV_Experience)
    {
        //
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
