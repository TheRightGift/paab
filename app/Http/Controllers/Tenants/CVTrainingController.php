<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenants\CV_Training;
use Illuminate\Http\Request;

use Validator;

class CVTrainingController extends Controller
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
        $inputs = Validator::make($request->all(), [
            // 'data' => 'nullable',
            'data.*.institution' => 'nullable',
            'data.*.yearStart' => 'nullable',
            'data.*.monthStart' => 'nullable',
            'data.*.yearEnd' => 'nullable',
            'data.*.monthEnd' => 'nullable',
            'data.*.title' => 'nullable',
            'data.*.location' => 'nullable',
            'data.*.specialty' => 'nullable',
            'data.*.sub_specialty' => 'nullable',
            'data.*.type' => 'nullable',
        ]); 
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            // dd($data);
            foreach ($data as $row) {
                $cV_Training = new CV_Training();
                $cV_Training->institution = $row->institution;
                $cV_Training->title = $row->title;
                $cV_Training->yearStart = $row->yearStart;
                $cV_Training->monthStart = $row->monthStart;
                $cV_Training->monthEnd = $row->monthEnd;
                $cV_Training->yearEnd = $row->yearEnd;
                $cV_Training->monthEnd = $row->monthEnd;
                $cV_Training->location = $row->location;
                $cV_Training->specialty = $row->specialty;
                $cV_Training->sub_specialty = $row->sub_specialty;
                $cV_Training->type = $row->type;

                $cV_Training->save();
            }
            return response(['training' => $cV_Training, 'message' => 'Created Success'], 201);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CV_Training  $cV_Training
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CV_Training $cV_Training)
    {
        $data = json_decode($request->input('data'));
        $removed = json_decode($request->input('removed'));
        $inputs = Validator::make($request->all(), [
            // 'data' => 'nullable',
            'data.*.institution' => 'nullable',
            'data.*.yearStart' => 'nullable',
            'data.*.monthStart' => 'nullable',
            'data.*.yearEnd' => 'nullable',
            'data.*.monthEnd' => 'nullable',
            'data.*.title' => 'nullable',
            'data.*.location' => 'nullable',
            'data.*.specialty' => 'nullable',
            'data.*.sub_specialty' => 'nullable',
            'data.*.type' => 'nullable',
        ]); 
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $inputs->validated();

            if ($request->has('removed')) {
                foreach ($removed as $row) {
                    $cV_Trainings = new CV_Training();
                    $training2Update = $cV_Trainings->find($row->id);
                    
                    $training2Update->delete();
                }
            }
            foreach ($data as $row) {
                $cV_Trainings = new CV_Training();
                if (!empty($row->id)) {
                    $training2Update = $cV_Trainings->find($row->id);
                    $training2Update->institution = $row->institution;
                    $training2Update->title = $row->title;
                    $training2Update->yearStart = $row->yearStart;
                    $training2Update->monthEnd = $row->monthEnd;
                    $training2Update->yearEnd = $row->yearEnd;
                    $training2Update->monthEnd = $row->monthEnd;
                    $training2Update->location = $row->location;
                    $training2Update->specialty = $row->specialty;
                    $training2Update->sub_specialty = $row->sub_specialty;
                    $training2Update->type = $row->type;
                    $training2Update->save();
                }
                else {
                    $cV_Trainings->institution = $row->institution;
                    $cV_Trainings->title = $row->title;
                    $cV_Trainings->yearStart = $row->yearStart;
                    $cV_Trainings->monthEnd = $row->monthEnd;
                    $cV_Trainings->yearEnd = $row->yearEnd;
                    $cV_Trainings->monthEnd = $row->monthEnd;
                    $cV_Trainings->location = $row->location;
                    $cV_Trainings->specialty = $row->specialty;
                    $cV_Trainings->sub_specialty = $row->sub_specialty;
                    $cV_Trainings->type = $row->type;
                    $cV_Trainings->save();
                }
                
            }
            if ($training2Update == true) {
                return response()->json(['message' => 'Updated', 'trainings' => $training2Update, 'status' => 200], 200);
            }
            else {
                return response()->json(['message' => 'Error Updating', 'cv$cV_Trainings' => $training2Update, 'status' => 501], 501);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CV_Training  $cV_Training
     * @return \Illuminate\Http\Response
     */
    public function destroy(CV_Training $cV_Training)
    {
        //
    }
}
