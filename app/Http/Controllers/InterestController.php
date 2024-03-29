<?php

namespace App\Http\Controllers;

use App\Models\Interest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class InterestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $interests = Interest::get();
        return response(['interests' => $interests,  'message' => 'Retrieved Success', 'status' => 200], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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
        $data = $request->input('data');
        if ($data === null) {
            return response('Invalid JSON data', 400);
        }
        foreach ($data as $row) {
            if (Interest::where('title', $row['title'])->exists()) {
                continue; // Skip adding interest with duplicate title
            }
            $interest = new Interest();
            $interest->title = $row['title'];
            $interest->description = $row['description'];
            $interest->icon = $row['icon'] ?? null;
            $interest->save();
        }

        $latestInterests = Interest::latest()->take(3)->get();

        return response(['interests' => $latestInterests, 'message' => 'Created Success'], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function saveInterestForUser(Request $request)
    {
        $data = $request->get('specialty');
        $tenantDB = $request->get('tenant_db');
        if (!empty($data)) {
            $interest = Interest::where('title', $data)->first();
            if (!empty($interest)) {
                Config::set('database.connections.mysql.database', $tenantDB);

                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenantDB);
                DB::table('services')->insert(['interest_id' => $interest->id]);
                return response()->json(['msg' => 'success'], 201);
            } else {
                return response()->json(['msg' => 'No interest matches'], 200);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function edit(Interest $interest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Interest $interest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Interest  $interest
     * @return \Illuminate\Http\Response
     */
    public function destroy(Interest $interest)
    {
        //
    }
}
