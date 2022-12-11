<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Tenants\Service;
use Illuminate\Http\Request;
use Validator;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $services = Service::get();
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
            'icon_filename' => 'nullable|image|mimes:jpg,png|max:100',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $inputs->validated();
            if($request->hasFile('icon_filename')){
                $image = $request->file('icon_filename');
                $name = $image->getClientOriginalName();
                $image->file(storage_path('/media/img/' . $name));
                // $image->move(public_path('/media/img/'), $name);
                $input['icon_filename'] = '/media/img/'.$name;
            } 
            $service = Service::create($input);

            return response(['service' => $service, 'message' => 'Created Success'], 201);
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
            'title' => 'nullable',
            'description' => 'nullable',
            'icon_filename' => 'nullable|image|mimes:jpg,png|max:100',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $inputs->validated();
            if($request->hasFile('icon_filename')){
                $image = $request->file('icon_filename');
                $name = $image->getClientOriginalName();
                $image->file(storage_path('/media/img/' . $name));
                // $image->move(public_path('/media/img/'), $name);
                $input['icon_filename'] = '/media/img/'.$name;
            } 
            #TODO: Run a check to make sure if this is an array
            $services = new Service();
            $services->find($service);
            if ($services != null) {
               $services->update($request);
               return response()->json(['message' => 'Updated', 'services' => $services]);
            }else {
                return 404;
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json([], 204);
    }
}
