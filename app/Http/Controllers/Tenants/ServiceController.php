<?php

namespace App\Http\Controllers\Tenants;

use Illuminate\Http\Request;
use App\Trait\ServiceNotifier;
use App\Models\Tenants\Service;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    use ServiceNotifier;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::latest()->get();
        return response()->json(['message' => 'Fetched Success', 'services' => $services]);
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
            'title' => 'required',
            'description' => 'required',
            'index' => 'nullable',
            'icon' => 'nullable', // image|mimes:jpg,png|max:10
        ]); 
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            $service = new Service();
            $service->title = $input['title'];
            $service->description = $input['description'];
            $service->interest_id = 1;
            $service->icon = $input['icon'];
            $service->index = $input['index'];
            $service->save();
            return response(['services' => $service->latest()->get(), 'message' => 'Created Success'], 201);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $service)
    {
        $inputs = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ]); 
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            $service = Service::find($service);
            $service->title = $input['title'];
            $service->description = $input['description'];
            $service->save();
            return response(['services' => $service->latest()->get(), 'message' => 'Created Success'], 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy($service)
    {
        Service::findOrFail($service)->delete();
        return response()->json([], 204);
    }
}
