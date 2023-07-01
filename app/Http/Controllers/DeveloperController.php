<?php

namespace App\Http\Controllers;

use App\Models\Developer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DeveloperController extends Controller
{
    public function showSignupForm()
    {
        return view('developers.signup');
    }

    public function index()
    {
        $users = new User();
        $developers = $users->where('role', 'Developer')->latest()->paginate(10);
        return response()->json(['devs' => $developers]);
    }

    public function verifyDev($userId)
    {
        $users = new User();
        $developer = $users->find($userId);
        $response = "";
        $status = "";
        if (!empty($developer)) {
            if ($developer->registration_completed === 'Active') {
                $developer->registration_completed = 'Pending';
                $response = 'Developer has been removed from verified status';
            } else {
                $developer->registration_completed = 'Active';
                $response = 'Developer has been verified';
            }
            $developer->save();
            $status = 200;
        } else {
            $response = 'No Developer found';
            $status = 404;
        }
        return response()->json(['msg' => $response, 'dev' => $developer], $status);
    }

    public function show($id)
    {
        $users = new User();
        $developer = $users->where('id', $id);
        if (!empty($developer)) {
            $user = $developer->with('developer', 'developer.projects')->first();
            return response()->json(['data' => $user], 200);
        } else {
            return response()->json(['data' => 'Invalid Details'], 404);
        }
    }

    public function store (Request $request) {
        $validator = Validator::make($request->all(), [
            'NUBAN' => 'required|unique:developers',
            'user_id' => 'required',
            'bank' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        } else {
            $input = $validator->validated();
            $developers = new Developer();
            $developer = $developers->create($input);
            return response()->json(['data' => $developer], 201);
        }
    }
}
