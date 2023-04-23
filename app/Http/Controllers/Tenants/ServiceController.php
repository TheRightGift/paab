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
        $services = Service::latest()->take(3)->get();
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
        // dd($request->input('data'));
        $data = json_decode($request->input('data'));
        $inputs = Validator::make($request->all(), [
            // 'data' => 'nullable',
            'data.*.title' => 'nullable',
            'data.*.description' => 'nullable',
            'data.*.icon' => 'nullable|image|mimes:jpg,png|max:10',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            // if($request->hasFile('icon')){
            //     $photo = $request->file('icon');
            //     $stored = \Storage::disk('public')->put("img", $photo);
            //     // $url = tenant_asset($stored);
            //     // dd($url, $stored);
            //     $input['icon'] = $stored;
            // } 
            // dump($input, $data);
            foreach ($data as $row) {
                $service = new Service();
                $service->interest_id = $row->id;
                $service->save();
            }
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
        $data = json_decode($request->input('data'));
        $removed = json_decode($request->input('removed'));
        $inputs = Validator::make($request->all(), [
            // 'data' => 'nullable',
            'data.*.title' => 'nullable',
            'data.*.description' => 'nullable',
            'data.*.icon' => 'nullable|image|mimes:jpg,png|max:10',
        ]); 
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $inputs->validated();
            // if($request->hasFile('icon_filename')){
            //     $image = $request->file('icon_filename');
            //     $name = $image->getClientOriginalName();
            //     $image->file(storage_path('/media/img/' . $name));
            //     // $image->move(public_path('/media/img/'), $name);
            //     $input['icon_filename'] = '/media/img/'.$name;
            // } 
            #TODO: Run a check to make sure if this is an array
            $service2Update = false;
            if ($request->has('removed')) {
                foreach ($removed as $row) {
                    dd($row->id);
                    $services = new Service();
                    $service2Update = $services->find($row->id);
                    $service2Update->delete();
                }
            }
            $services = new Service();
            foreach ($data as $row) {
                $services = new Service();
                $checkIfAlreadyInserted = $services->where('interest_id', $row->id)->first();
                if ($checkIfAlreadyInserted == null) {
                    $services->interest_id = $row->id;
                    $services->save();
                }
                
            }
            if ($service2Update == true) {
                $this->settingschangeNotify();
                return response()->json(['message' => 'Updated', 'services' => $service2Update, 'status' => 200], 200);
            }
            else {
                return response()->json(['message' => 'Error Updating', 'services' => $service2Update, 'status' => 501], 501);
            }
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
