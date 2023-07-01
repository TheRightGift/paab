<?php

namespace App\Http\Controllers;

use App\Models\DeveloperProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeveloperProjectController extends Controller
{
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'developer_id' => 'required',
            'zip_url' => 'required|file|mimes:zip|max:3072'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()]);
        } else {
            $input = $validator->validated();
            if ($request->hasFile('zip_url')) {
                $zip = $request->file('zip_url');
                $ext = $request->file('zip_url')->getClientOriginalExtension();
                $currentTimestamp = time();
                $name = strtolower($input['name'] . $currentTimestamp . $request->developer_id) . '.' . $ext;
                $zip->move(public_path('/projects/'), $name);

                $input['zip_url'] = $name;
            }
            $projects = new DeveloperProject();
            $project = $projects->create($input);
            return response()->json(['data' => $project], 201);
        }
    }
}
