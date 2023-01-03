<?php

namespace App\Http\Controllers;

use App\Models\Title;
use App\Models\User;
use Illuminate\Http\Request;
use Validator;

class TitleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = Title::orderBy('name')->get();
        return response(['titles' => $title, 'message' => 'Retrieved Success'], 200);
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
            $title = Title::create($input);
            return response(['title' => $title, 'message' => 'Created Success'], 201);
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function show(Title $title)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $titleId)
    {
        $title = Title::findOrFail($titleId);
        $title->update($request->only('name'));
        return response(['title' => $title, 'message' => 'Updated Success'], 204);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Title  $title
     * @return \Illuminate\Http\Response
     */
    public function destroy($titleId)
    {
        $title = Title::where('id', $titleId)->first();
        $title->delete();
        return response(['message' => 'Archived successfuly'], 204);
    }

    public function getUserProfession($id) {
        $user = User::find($id);
        if ($user !== null) {
            $data['title'] = $user->title;
            $data['profession'] = $user->title->profession;
            return response()->json(['message' => 'Success', 'data' => $data]);
        }
    }
}
