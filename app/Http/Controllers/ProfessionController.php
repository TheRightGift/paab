<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use Illuminate\Http\Request;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $professionals = Profession::orderBy('name')->get();
        return response(['professionals' => $professionals, 'message' => 'Retrieved Success'], 200);
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
            'name' => ['required'],
        ]); 
        
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $request->all();
            $professional = Profession::create($input);
            // $professional = Profession::where('id', $post->id)->get();
            return response(['professional' => $professional, 'message' => 'Created Success'], 201);
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function show($professionId)
    {
        $profession = Profession::where('id', $professionId)->first();
        return response(['profession' => $profession]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $professionId)
    {
        $profession = Profession::findOrFail($professionId);
        $profession->update($request->only('name'));
        return response(['profession' => $profession, 'message' => 'Updated Success'], 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Profession  $profession
     * @return \Illuminate\Http\Response
     */
    public function destroy($professionId)
    {
        $profession = Profession::where('id', $professionId)->first();
        $profession->delete();
        return response(['message' => 'Archived successfuly'], 204);
    }

    public function deletedProfessions() {
        // $profession = Profession::onlyTrashed()->paginate(10);
        $professions = Profession::onlyTrashed();
        return response(['professionals' => $professionals, 'message' => 'Retrieved Success'], 200);
    }

    public function restoreDeletedProfession($professionId) 
    {
        $profession = Profession::where('id', $professionId)->withTrashed()->first();
        $profession->restore();

        return response(['message' => 'Resource Unarchived successfuly'], 204);
    }
}
