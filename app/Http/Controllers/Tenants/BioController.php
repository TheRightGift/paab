<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Bio;
use App\Models\Tenants\Achievement;
use App\Models\Tenants\Service;
use Illuminate\Http\Request;
use Validator;

class BioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bio = Bio::first();
        // $achievements = Achievement::get();
        // $services = Service::get();
        #TODO: Merge into one array and return
        return response()->json(['message' => 'Fetched Success', 'bio' => $bio]);
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
            'about' => 'required|size:614',
            'lastname' => 'nullable',
            'firstname' => 'nullable',
            'CV' => 'required|file|mimes:doc,pdf,docx,zip|max:2000',
            'photo' => 'nullable|image|mimes:jpg,png|max:500',
            // Achievement
            // 'percentage' => 'required',
            // Services
            // 'serv_title' => 'required',
            // 'description' => 'required',
            // 'icon_filename' => 'nullable|image|mimes:jpg,png|max:100',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            if($request->hasFile('photo')){
                $photo = $request->file('photo');
                $ext = $request->file('photo')->getClientOriginalExtension();
                $stored = \Storage::disk('public')->putFileAs('img', $photo, strtolower(tenant('id')).'biophoto'.'.'.$ext);
                
                $input['photo'] = $stored;
            } 
            if($request->hasFile('CV')){
                $cv = $request->file('CV');
                $ext = $request->file('CV')->getClientOriginalExtension();
                $stored = \Storage::disk('public')->putFileAs('doc', $cv, strtolower(tenant('id')).'CV'.'.'.$ext);

                $input['CV'] = $stored;
            } 
            $bio = Bio::create($input);
            // $achivementData =$input
            // $this->cr8_achievement($input);
            // $this->cr8_service($request);

            return response(['bio' => $bio, 'message' => 'Created Success'], 201);
        }    
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bio  $bio
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $bio)
    {
        $inputs = Validator::make($request->all(), [
            'about' => 'nullable',
            'history' => 'nullable',
            'CV' => 'nullable|file|mimes:doc,pdf,docx,zip|max:5000',
            'photo' => 'nullable|image|mimes:jpg,png|max:1000',
            // Achievement
            // 'title' => 'nullable',
            // 'percentage' => 'nullable',
            // 'achieve_id' => 'nullable',
            // Services
            // 'serv_title' => 'nullable',
            // 'serv_id' => 'nullable',
            // 'description' => 'nullable',
            // 'icon_filename' => 'nullable|image|mimes:jpg,png|max:100',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $inputs->validated();
            $bios = new Bio();
            $bio2Update = $bios->find($bio);
            if ($bio2Update != null) {
                if($request->hasFile('photo')){
                    $photo = $request->file('photo');
                    $stored = \Storage::disk('public')->put("img", $photo);
                    $input['photo'] = $stored;
                } 
                if($request->hasFile('CV')){
                    $cv = $request->file('CV');
                    $name = $cv->getClientOriginalName();
                    $stored = \Storage::disk('public')->put("docs", $cv);
                    $input['CV'] = $stored;
                } 
                $bio2Update->update($input);
                // $this->upd_achievement($input);
                // $this->upd_service($input);
                return response(['bio' => $bio2Update, 'message' => 'Update Success'], 201);
            }
        }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bio  $bio
     * @return \Illuminate\Http\Response
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
