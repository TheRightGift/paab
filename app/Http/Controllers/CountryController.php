<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Validator;
use Illuminate\Http\Request;
use App\Jobs\PopulateCitiesTable;

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

    /**
     * Returns the country a user selected
     * From the country id get the states and get the selected state:frontend
     *
     * @param [type] $city_id
     * @return void
     */
    public function getCountryStateFromCity($city_id) {
        $city = City::find($city_id);
        $state = State::find($city->state_id);
        return response()->json(['city' => $city, 'state' => $state], 200);
    }
    // public function getCities($startRow) {
    //     $startRow = (int)$startRow;
    //     $cities = City::where('id', '>', $startRow)->limit(80000)->get();
    //     return response(['cities' => $cities,  'message' => 'Retrieved Success'], 200);
    //     // return gettype($startRow);
    // }
    // public function insertCity(Request $request){
    //     $inputs = Validator::make($request->all(), [
    //         'name' => 'required',
    //         'state_id' => 'required',
    //         'state_code' => 'required',
    //         'country_id' => 'required',            
    //         'country_code' => 'required',
    //         'latitude' => 'required',
    //         'longitude' => 'required',
    //         'flag' => 'required',
    //     ]); 
    //     if ($inputs->fails()) {
    //         return response()->json(['errors' => $inputs->errors()->all()], 501);
    //     } else {
    //         PopulateCitiesTable::dispatch(
    //             $request->input('id'), 
    //             $request->input('name'), 
    //             $request->input('state_id'),
    //             $request->input('state_code'), 
    //             $request->input('country_id'), 
    //             $request->input('country_code'),
    //             $request->input('latitude'), 
    //             $request->input('longitude'), 
    //             $request->input('flag'),
    //             $request->input('wikiDataId')
    //         );

    //         // $id = $request->input('id');
    //         // $name = $request->input('name'); 
    //         // $state_id = $request->input('state_id');
    //         // $state_code = $request->input('state_code'); 
    //         // $country_id = $request->input('country_id'); 
    //         // $country_code = $request->input('country_code');
    //         // $latitude = $request->input('latitude'); 
    //         // $longitude = $request->input('longitude'); 
    //         // $flag = $request->input('flag');
    //         // $wikiDataId = $request->input('wikiDataId');

    //         // $cityExist = City::where('id', $id)->first();
    //         // if($cityExist == null || $cityExist->count() < 1){
    //         //     $reqArr = [];
    //         //     $reqArr['id'] = $id;
    //         //     $reqArr['name'] = $name;
    //         //     $reqArr['state_id'] = $state_id;
    //         //     $reqArr['state_code'] = $state_code;
    //         //     $reqArr['country_id'] = $country_id;
    //         //     $reqArr['country_code'] = $country_code;
    //         //     $reqArr['latitude'] = $latitude;
    //         //     $reqArr['longitude'] = $longitude;
    //         //     $reqArr['flag'] = $flag;
    //         //     $reqArr['wikiDataId'] = $wikiDataId;
        
    //         //     $city = City::create($reqArr);

    //         //     return response(['cities' => $city,  'message' => 'Retrieved Success', 'status' => 200], 200);
    //         // } 
            
    //     }        
    // }
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
