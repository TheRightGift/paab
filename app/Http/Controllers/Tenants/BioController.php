<?php

namespace App\Http\Controllers\Tenants;

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
        $bio = Bio::get();
        $achievements = Achievement::get();
        $services = Service::get();
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
            'about' => 'required',
            'history' => 'nullable',
            'CV' => 'nullable|file|mimes:doc,pdf,docx,zip|max:5000',
            'photo' => 'nullable|image|mimes:jpg,png|max:1000',
            // Achievement
            'title' => 'required',
            'percentage' => 'required',
            // Services
            'serv_title' => 'required',
            'description' => 'required',
            'icon_filename' => 'nullable|image|mimes:jpg,png|max:100',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $inputs->validated();
            if($request->hasFile('photo')){
                $image = $request->file('photo');
                $name = $image->getClientOriginalName();
                $image->file(storage_path('/media/img/' . $name));
                // $image->move(public_path('/media/img/'), $name);
                $input['photo'] = '/media/img/'.$name;
            } 
            // \Image::make($request->file('image'))->resize(500, 590)->save(public_path('/books/images/').$input['image']);
            if($request->hasFile('CV')){
                $image = $request->file('CV');
                $name = $image->getClientOriginalName();
                $image->file(storage_path('/media/docs/' . $name));
                // $image->move(public_path('/media/docs/'), $name);
                $input['CV'] = '/media/docs/'.$name;
            } 
            $bio = Bio::create($input);
            // $achivementData =$input
            $this->cr8_achievement($input);
            $this->cr8_service($request);

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
    public function update(Request $request, Bio $bio)
    {
        $inputs = Validator::make($request->all(), [
            'about' => 'nullable',
            'history' => 'nullable',
            'CV' => 'nullable|file|mimes:doc,pdf,docx,zip|max:5000',
            'photo' => 'nullable|image|mimes:jpg,png|max:1000',
            // Achievement
            'title' => 'nullable',
            'percentage' => 'nullable',
            'achieve_id' => 'nullable',
            // Services
            'serv_title' => 'nullable',
            'serv_id' => 'nullable',
            'description' => 'nullable',
            'icon_filename' => 'nullable|image|mimes:jpg,png|max:100',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $inputs->validated();
            if($request->hasFile('photo')){
                $image = $request->file('photo');
                $name = $image->getClientOriginalName();
                $image->file(storage_path('/media/img/' . $name));
                // $image->move(public_path('/media/img/'), $name);
                $input['photo'] = '/media/img/'.$name;
            } 
            // \Image::make($request->file('image'))->resize(500, 590)->save(public_path('/books/images/').$input['image']);
            if($request->hasFile('CV')){
                $image = $request->file('CV');
                $name = $image->getClientOriginalName();                
                $image->file(storage_path('/media/img/' . $name));
                // $image->move(public_path('/media/docs/'), $name);
                $input['CV'] = '/media/docs/'.$name;
            } 
            $bio = Bio::update($input);
            $this->upd_achievement($input);
            $this->upd_service($input);
            return response(['bio' => $bio, 'message' => 'Update Success'], 201);
        }    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bio  $bio
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bio $bio)
    {
        $bio->delete();
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
