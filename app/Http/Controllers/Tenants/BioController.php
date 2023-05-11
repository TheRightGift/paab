<?php

namespace App\Http\Controllers\Tenants;

use App\Models\Tenant;
use App\Models\Tenants\Bio;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Trait\ServiceNotifier;
use App\Models\Tenants\Service;
use Illuminate\Support\Facades\DB;
use App\Models\Tenants\Achievement;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Storage;
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
            'about' => 'nullable',
            'lastname' => 'nullable',
            'firstname' => 'nullable',
            'gender' => 'required',
            'title_id' => 'nullable',
            'othername' => 'nullable'
        ]);

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            if($request->has('photo')){
                try {
                    $safeName = strtolower(tenant('id')).'biophoto'.'.'.'png';
                    if ($request->has('tenancy_db_name')) {
                        $save_path = public_path().'/media/tenants/'.strtolower($request->get('firstname')).'/img/';
                    } else $save_path = public_path().'/media/tenants/'.strtolower(tenant('id')).'/img/';
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
            if ($request->has('tenancy_db_name')) { // When request is coming from services app or others
                $tenancy_db_name = $request->get('tenancy_db_name');
                Config::set('database.connections.mysql.database', $tenancy_db_name);

                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenancy_db_name);
                $input['updated_at'] = now();
                $input['created_at'] = now();
                DB::table('bios')->insert($input);
                $tokenDB = $this->getTokenDBAndInsertToken();
                return response(['token' => $tokenDB, 'message' => 'Created Success'], 201);
            } else {
                $bio = Bio::create($input);
                $this->getTokenDBAndInsertToken();
                return response(['bio' => $bio, 'message' => 'Created Success'], 201);
            }
        }
    }

    private function getTokenDBAndInsertToken() {
        $tokenDB = DB::table('tokens');
        if ($tokenDB->get()->isEmpty()) {
            return $tokenDB->insert([
                'token' => Str::UUID(),
                'can' => 'edit',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
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
            'gender' => 'nullable',
            'title_id' => 'nullable'
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
                    $safeName = strtolower(tenant('id')).'biophoto'.'.'.'png';
                    $file_path = public_path().'/media/tenants/'.strtolower(tenant('id')).'/img/';
                    if (!file_exists($file_path)) {
                        mkdir($file_path, 0755, true);
                    }
                    $file = $file_path.$safeName;
                    Image::make(file_get_contents($request['photo']))->resize(451, 512, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($file);
                    $input['photo'] = $safeName;
                }
                $bio2Update->update($input);
                if (true) {
                    $this->settingschangeNotify();
                    return response(['bio' => $bio2Update, 'message' => 'Update Success', 'status' => 200], 200);
                }
                else {
                    return response()->json(['message' => 'Failed', 'bio' => $bio2Update], 501);
                }
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
