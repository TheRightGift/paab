<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Specialty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;

class SpecialtyController extends Controller
{
    public function index()
    {
        $specialties = Specialty::with('templates')->get();
        return response(['specialties' => $specialties,  'message' => 'Retrieved Success', 'status' => 200], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->input('data');
        if ($data === null) {
            return response('Invalid JSON data', 400);
        }
        foreach ($data as $row) {
            if (Specialty::where('title', $row['title'])->exists()) {
                continue;
            }
            $specialty = new Specialty();
            $specialty->title = $row['title'];
            // $specialty->description = $row['description'];
            $specialty->save();
        }

        $latestInterests = Specialty::latest()->take(3)->get();

        return response(['specialties' => $latestInterests, 'message' => 'Created Success'], 201);
    }
}
