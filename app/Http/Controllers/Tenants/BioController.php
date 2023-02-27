<?php

namespace App\Http\Controllers\Tenants;

use Image;
use App\Models\Tenants\Bio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Trait\ServiceNotifier;
use App\Models\Tenants\Service;
use Illuminate\Support\Facades\DB;
use App\Models\Tenants\Achievement;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class BioController extends Controller
{
    use ServiceNotifier;
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $bio = Bio::first();
        return response()->json(['message' => 'Fetched Success', 'bio' => $bio]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $inputs = Validator::make($request->all(), [
            'about' => 'nullable|max:614|min:600',
            'lastname' => 'nullable',
            'firstname' => 'nullable',
            // 'CV' => 'nullable|file|mimes:doc,pdf,docx,zip|max:2000',
            // 'photo' => 'nullable|image|mimes:jpg,png|max:1000|dimensions:width=451,height=512',
        ]);

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            if($request->has('photo')){
                try {
                    // $photo = $request->file('photo');
                    // $ext = $request->file('photo')->getClientOriginalExtension();
                    // $path = $request->file('photo')->storeAs(
                    //     strtolower(tenant('id')), strtolower(tenant('id')).'biophoto'.'.'.$ext
                    // );
                    // $name = strtolower(tenant('id')).'biophoto'.'.'.$ext;
                    // $path = $photo->move(public_path('/media/tenants/'.strtolower(tenant('id')).'/img'), $name);
                    // $stored = \Storage::disk('public')->putFileAs('img', $photo, strtolower(tenant('id')).'biophoto'.'.'.$ext);
                    $safeName = strtolower(tenant('id')).'biophoto'.'.'.'png';
                    $save_path = public_path().'/media/tenants/'.strtolower(tenant('id')).'/img/';
                    if (!file_exists($save_path)) {
                        mkdir($save_path, 0755, true);
                    }
                    $file = $save_path.$safeName;
                    Image::make(file_get_contents($request['photo']))->resize(451, 512, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($file);
                    $input['photo'] = $safeName;
                } catch (\Throwable $th) {
                    return response($inputs->errors()->all(), 400);
                }
            }
            if($request->hasFile('CV')){
                $cv = $request->file('CV');
                $ext = $request->file('CV')->getClientOriginalExtension();
                $stored = \Storage::disk('public')->putFileAs('doc', $cv, strtolower(tenant('id')).'CV'.'.'.$ext);

                $input['CV'] = $stored;
            }
            $bio = Bio::create($input);
            $tokenDB = DB::table('tokens');
            if ($tokenDB->get()->isEmpty()) {
                $tokenDB->insert([
                    'token' => Str::UUID(),
                    'can' => 'edit',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            return response(['bio' => $bio, 'message' => 'Created Success'], 201);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Bio $bio
     * @return Response
     */
    public function update(Request $request, $bio)
    {
        $inputs = Validator::make($request->all(), [
            'about' => 'nullable',
            'firstname' => 'nullable',
            'lastname' => 'nullable',
            'CV' => 'nullable|file|mimes:doc,pdf,docx,zip|max:2000',
            // 'photo' => 'nullable|image|mimes:jpg,png|max:1000|dimensions:min_width=451,min_height=512,max_width=451,max_height=512',
        ]);

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            $bios = new Bio();
            $bio2Update = $bios->find($bio);
            if ($bio2Update != null) {
                if($request->has('photo')){
                    // $photo = $request->file('photo');
                    // $ext = $request->file('photo')->getClientOriginalExtension();
                    // $stored = \Storage::disk('public')->putFileAs('img', $photo, strtolower(tenant('id')).'biophoto'.'.'.$ext);

                    // $name = strtolower(tenant('id')).'biophoto'.'.'.$ext;
                    // $path = $photo->move(public_path('/media/tenants/'.strtolower(tenant('id')).'/img'), $name);
                    $safeName = strtolower(tenant('id')).'biophoto'.'.'.'png';
                    $file = public_path().'/media/tenants/'.strtolower(tenant('id')).'/img/'.$safeName;
                    $success = Image::make(file_get_contents($request['photo']))->resize(451, 512, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($file);
                    $input['photo'] = $safeName;
                }
                if($request->hasFile('CV')){
                    $cv = $request->file('CV');
                    $ext = $request->file('CV')->getClientOriginalExtension();
                    $stored = \Storage::disk('public')->putFileAs('doc', $cv, strtolower(tenant('id')).'CV'.'.'.$ext);

                    $input['CV'] = $stored;
                }
                $bio2Update->update($input);
                if (true) {
                    $this->settingschangeNotify();
                    return response(['bio' => $bio2Update, 'message' => 'Update Success', 'status' => 200], 200);
                }
                else {
                    return response()->json(['message' => 'Failed', 'bio' => $bio2Update], 501);
                }
                // $this->upd_achievement($input);
                // $this->upd_service($input);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bio  $bio
     * @return Response
     */
    public function destroy($bio)
    {
        $bio2Delete = Bio::find($bio);
        $bio2Delete->delete();
        return response()->json([], 204);
    }

    private function cr8_achievement($request) {
        return Achievement::create($request);
    }

    private function upd_achievement($request) {
        #TODO: Run a check to make sure if this is an array
        $achievement = new Achievement();
        $achievement->find($request['achieve_id']);
        if ($achievement != null) {
            return $achievement->update($request);
        }else {
            return 404;
        }
    }
    private function cr8_service($request) {
        if($request->hasFile('icon_filename')){
            $image = $request->file('icon_filename');
            $name = $image->getClientOriginalName();
            $image->file(storage_path('/media/img/' . $name));
            // $image->move(public_path('/media/img/'), $name);
            $request['icon_filename'] = '/media/img/'.$name;
        }
        return Service::create($request);
    }

    private function upd_service($request) {
        if($request->hasFile('icon_filename')){
            $image = $request->file('icon_filename');
            $name = $image->getClientOriginalName();
            $image->file(storage_path('/media/img/' . $name));
            // $image->move(public_path('/media/img/'), $name);
            $request['icon_filename'] = '/media/img/'.$name;
        }
        #TODO: Run a check to make sure if this is an array
        $service = new Service();
        $service->find($request['serv_id']);
        if ($service != null) {
            return $service->update($request);
        }else {
            return 404;
        }
    }
}
