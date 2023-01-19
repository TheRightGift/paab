<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenants\CV_Reference;
use Illuminate\Http\Request;

use Validator;

class CVReferenceController extends Controller
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
            'data' => 'required',
            'data.*.name' => 'required',
            'data.*.location' => 'required',
            'data.*.position' => 'required',
            'data.*.phone' => 'required',
            'data.*.title' => 'required',
        ]); 
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            foreach ($data as $row) {
                $referees = new CV_Reference();
                $referees->name = $row->name;
                $referees->location = $row->location;
                $referees->phone = $row->phone;
                $referees->position = $row->position;
                $referees->title = $row->title;
                $referees->save();
            }
            return response(['referees' => $referees, 'message' => 'Created Success'], 201);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CV_Reference  $cV_Reference
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $cV_Reference)
    {
        $data = json_decode($request->input('data'));
        $removed = json_decode($request->input('removed'));
        $inputs = Validator::make($request->all(), [
            // 'data' => 'required',
            'data.*.name' => 'required',
            'data.*.location' => 'required',
            'data.*.position' => 'required',
            'data.*.phone' => 'required',
            'data.*.title' => 'required',

        ]); 
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $inputs->validated();

            if ($request->has('removed')) {
                foreach ($removed as $row) {
                    $referees = new CV_Reference();
                    $referee2Update = $referees->find($row->id);
                    
                    $referee2Update->delete();
                }
            }
            foreach ($data as $row) {
                $referees = new CV_Experience();
                if (!empty($row->id)) {
                    $referee2Update = $referees->find($row->id);
                    $referee2Update->institution = $row->institution;
                    $referee2Update->position = $row->position;
                    $referee2Update->yearStart = $row->yearStart;
                    $referee2Update->title = $row->title;
                    $referee2Update->save();
                }
                else {
                    $referees->name = $row->name;
                    $referees->location = $row->location;
                    $referees->phone = $row->phone;
                    $referees->position = $row->position;
                    $referees->title = $row->title;
                    $referees->save();
                }
                
            }
            if ($referee2Update == true) {
                return response()->json(['message' => 'Updated', 'referees' => $referee2Update, 'status' => 200], 200);
            }
            else {
                return response()->json(['message' => 'Error Updating', 'referees' => $referee2Update, 'status' => 501], 501);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CV_Reference  $cV_Reference
     * @return \Illuminate\Http\Response
     */
    public function destroy(CV_Reference $cV_Reference)
    {
        //
    }
}
