<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\Profession;
use Illuminate\Http\Request;
use Validator;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Template::where('approved', 'T')->orderBy('title')->with('profession')->get();
        return response(['templates' => $templates, 'message' => 'Retrieved Success'], 200);
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
            'title' => ['required'],
            'profession_id' => 'required',
            'imageUrl' => 'required',
            'styleFile' => 'required|file|max:200'
        ]); 
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            $profession = Profession::find($input['profession_id']);
            if($request->hasFile('imageUrl')){
                $image = $request->file('imageUrl');
                $name = $image->getClientOriginalName();
                $image->move(public_path('/media/img/templateThumbnail/'.$profession->name), $name);
                $input['imageUrl'] = $name;
            } 
            if($request->hasFile('styleFile')){
                $file = $request->file('styleFile');
                $ext = $request->file('styleFile')->getClientOriginalExtension();
                $stored = $file->move(public_path('css'), strtolower($input['title']).'.'.$ext);
                $input['styleFile'] = strtolower($input['title']).'.'.$ext;
            } 
            $template = Template::create($input);
            return response(['template' => $template, 'message' => 'Created Success'], 201);
        }    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $template = Template::where([['profession_id', $id], ['approved', 'T']])->with('profession')->get();
        return response(['templates' => $template, 'message' => 'Retrieved Success'], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $templateId)
    {
        $inputs = Validator::make($request->all(), [
            'title' => ['required'],
            'profession_id' => 'required',
            'imageUrl' => 'nullable',
            'styleFile' => 'nullable|file|max:200'
        ]); 
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $request->all();
            $profession = Profession::find($input['profession_id']);
            if($request->hasFile('imageUrl')){
                $image = $request->file('imageUrl');
                $name = $image->getClientOriginalName();
                $image->move(public_path('/media/img/templateThumbnail/'.$profession->name), $name);
                $input['imageUrl'] = $name;
            } 
            if($request->hasFile('styleFile')){
                $file = $request->file('styleFile');
                $ext = $request->file('styleFile')->getClientOriginalExtension();
                $stored = $file->move(public_path('css'), strtolower($input['title']).'.'.$ext);
                $input['styleFile'] = strtolower($input['title']).'.'.$ext;
            } 
            $input = $inputs->validated();
            $templates = new Template();
            $template2Update = $templates->find($templateId);
            $template2Update->update($input);
            if ($template2Update == true) {
                return response()->json(['message' => 'Updated Successfully', 'template' => $template2Update, 'status' => 200], 200);
            }
            else {
                return response()->json(['message' => 'Failed', 'template' => $template2Update], 501);
            }
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Template  $template
     * @return \Illuminate\Http\Response
     */
    public function destroy($templateId)
    {
        $template = Template::where('id', $templateId)->first();
        $template->delete();
        return response(['message' => 'Archived successfuly'], 204);
    }

    public function deletedTemplates() {
        // $profession = Profession::onlyTrashed()->paginate(10);
        $templates = Template::onlyTrashed();
        return response(['templates' => $templates, 'message' => 'Retrieved Success'], 200);
    }

    public function restoreDeletedTemplate($templateId) 
    {
        $template = Template::where('id', $templateId)->withTrashed()->first();
        $template->restore();

        return response(['message' => 'Resource Unarchived successfuly'], 204);
    }

    public function approve(Request $request, $templateID) {
        $template = Template::find($templateID);
        $template->update($request->only('approve'));
        return response(['template' => $template, 'message' => 'Updated Success'], 204);
    }

    public function renderTemplate($templateID) {
        $template = Template::find($templateID);
        $profession = $template->profession->name;
        $template = $template->title;
        $preview = true;
        if($profession === 'Physician'){
            return view('websites.physician', compact('preview', 'template'));
        } else if($profession === 'Legal'){
            return view('websites.legal', compact('preview', 'template'));
        }
    }
}
