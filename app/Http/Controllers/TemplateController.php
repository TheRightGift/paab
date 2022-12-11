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
        $templates = Template::orderBy('title')->with('profession')->get();
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
            'imageUrl' => 'required'
        ]); 

        
        
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $request->all();
            $profession = Profession::find($input['profession_id']);
            if($request->hasFile('imageUrl')){
                $image = $request->file('imageUrl');
                $name = $image->getClientOriginalName();
                $image->move(public_path('/media/img/templateThumbnail/'.$profession->name), $name);
                $input['imageUrl'] = '/media/img/templateThumbnail/'.$profession->name.'/'.$name;
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
        $template = Template::where('profession_id', $id)->with('profession')->get();
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
        $template = Template::findOrFail($templateId);
        $template->update($request->only('title', 'profession_id', 'imageUrl'));
        return response(['template' => $template, 'message' => 'Updated Success'], 204);
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
}
