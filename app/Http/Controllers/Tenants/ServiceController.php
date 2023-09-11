<?php

namespace App\Http\Controllers\Tenants;

use Illuminate\Http\Request;
use App\Trait\ServiceNotifier;
use App\Models\Tenants\Service;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
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

    public function saveImageOrIcon(Request $request)
    {
        $inputs = Validator::make($request->all(), [
            'image_or_icon' => 'required|file|max:512',
            'index' => 'required',
        ]);
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            if ($request->hasFile('image_or_icon')) {
                $safeName = strtolower(tenant('id')).'icon'.$request->index.'.'.'png';
                if ($request->has('tenancy_db_name')) {
                    $save_path = public_path().'/media/tenants/'.strtolower($request->get('filePath')).'/img/';
                } else $save_path = public_path().'/media/tenants/'.strtolower(tenant('id')).'/img/';
                if (!file_exists($save_path)) {
                    mkdir($save_path, 0755, true);
                }
                $file = $save_path.$safeName;
                Image::make(file_get_contents($request['image_or_icon']))->resize(194, 130, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($file);
                
                $input['image_or_icon'] = $safeName;
            }
            $service = new Service();
            $serviceToUpdate = $service->where('index', $input['index'])->first();
            // dd($serviceToUpdate);
            if ($serviceToUpdate) {
                $serviceToUpdate->image_or_icon = $input['image_or_icon'];
                $serviceToUpdate->save();
            } else {
                $service->title = $request->title;
                $service->description = $request->description;
                $service->interest_id = 1;
                $service->index = $request->index;
                $service->image_or_icon = $input['image_or_icon'];
                $service->save();
            }
            return response()->json(['status' => 200], 200);
        }
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
            'image_or_icon' => 'nullable', // image|mimes:jpg,png|max:10
        ]);
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $data = $request->input('data');
            if ($data === null) {
                $input = $inputs->validated();
                $service = new Service();
                $service->title = $input['title'];
                $service->description = $input['description'];
                $service->interest_id = 1;
                $service->index = $input['index'];
                $service->save();
            } elseif ($data !== null) {
                foreach ($data as $row) {
                    if (Service::where('title', $row['title'])->exists()) {
                        continue; // Skip adding interest with duplicate title
                    }
                    $service = new Service();
                    $service->title = $row['title'];
                    $service->description = $row['description'];
                    $service->icon = $row['icon'] ?? null;
                    $service->save();
                }
            }
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
            'index' => 'nullable',
            'image_or_icon' => 'nullable', // image|mimes:jpg,png|max:10
        ]);
        // dd($request);
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $data = $request->input('data');
            if ($data === null) {
                $input = $inputs->validated();
                $service = new Service();
                $service->title = $input['title'];
                $service->description = $input['description'];
                $service->interest_id = 1;
                $service->index = $input['index'];
                $service->save();
            } elseif ($data !== null) {
                foreach ($data as $row) {
                    if (Service::where('title', $row['title'])->exists()) {
                        continue; // Skip adding interest with duplicate title
                    }
                    $service = new Service();
                    $service->title = $row['title'];
                    $service->description = $row['description'];
                    $service->icon = $row['image_or_icon'] ?? null;
                    $service->save();
                }
            }
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
