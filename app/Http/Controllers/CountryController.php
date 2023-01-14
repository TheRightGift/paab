<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use App\Models\City;

use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $countries = Country::get();
        return response(['countries' => $countries,  'message' => 'Retrieved Success', 'status' => 200], 200);
    }

    public function states($country) {
        $states = State::where('country_id', $country)->get();
        return response(['states' => $states,  'message' => 'Retrieved Success', 'status' => 200], 200);
    }
    public function cities($state) {
        $cities = City::where('state_id', $state)->get();
        return response(['cities' => $cities,  'message' => 'Retrieved Success', 'status' => 200], 200);
    }
    // Get the states and cities for settings 
    public function getRelation($cityID) {
        $city = City::find($cityID);
        $cities = City::where('state_id', $city->state_id)->get();
        $country = Country::find($city->country_id)['id'];
        $state = State::find($city->state_id)['id'];
        $states = State::where('country_id', $city->country_id)->get();
        return response()->json(['message' => 'Success', 'cities' => $cities, 'state_id' => $state, 'country_id' => $country]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function show(Country $country)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function edit(Country $country)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Country $country)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Country  $country
     * @return \Illuminate\Http\Response
     */
    public function destroy(Country $country)
    {
        //
    }
}
