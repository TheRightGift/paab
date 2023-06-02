<?php

namespace App\Http\Controllers;

use App\Models\Template;
use App\Models\Profession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $templates = Template::where([['approved', 'T'], ['toDelete', null]])->orderBy('title')->with('profession')->get();
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
            if($request->hasFile('imageUrl')) {
                $image = $request->file('imageUrl');
                $ext = $request->file('imageUrl')->getClientOriginalExtension();
                $name = strtolower($input['title']).'.'.$ext;
                $image->move(public_path('/media/img/templateThumbnail/'.$profession->name), $name);
                $input['imageUrl'] = $name;
            }
            if($request->hasFile('styleFile')) {
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
            $input = $inputs->validated();
            $profession = Profession::find($input['profession_id']);
            if($request->hasFile('imageUrl')) {
                $image = $request->file('imageUrl');
                $ext = $request->file('imageUrl')->getClientOriginalExtension();
                $name = strtolower($input['title']).'.'.$ext;
                $image->move(public_path('/media/img/templateThumbnail/'.$profession->name), $name);
                $input['imageUrl'] = $name;
            }
            if($request->hasFile('styleFile')) {
                $file = $request->file('styleFile');
                $ext = $request->file('styleFile')->getClientOriginalExtension();
                $stored = $file->move(public_path('css'), strtolower($input['title']).'.'.$ext);
                $input['styleFile'] = strtolower($input['title']).'.'.$ext;
            }
            $templates = new Template();
            $template2Update = $templates->find($templateId);
            $template2Update->update($input);
            if ($template2Update == true) {
                return response()->json(['message' => 'Updated Successfully', 'template' => $template2Update, 'status' => 200], 200);
            } else {
                return response()->json(['message' => 'Failed', 'template' => $template2Update], 501);
            }
        }
    }

     /**
     * Lets an admin to partial delete a template
     */
    public function delete($templateID)
    {
        $template = Template::find($templateID);
        $template->toDelete = 1;
        $template->save();
        return response(['template' => $template, 'message' => 'Moved to Archive', 'status' => 200], 200);
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
        $template->toDelete = null;
        $template->save();
        $template->delete();
        return response(['message' => 'Archived successfuly'], 204);
    }

    public function deletedTemplates()
    {
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

    /**
     * Gets the whole templates for super admin to or view approve
     */
    public function getIndex()
    {
        $templates = Template::orderBy('updated_at')->with('profession')->get();
        return response(['templates' => $templates, 'message' => 'Retrieved Success'], 200);
    }

    /**
     * Gets the template to approve
     */
    public function approve(Request $request, $templateID)
    {
        $template = Template::find($templateID);
        $template->approved = $request->approved;
        $template->save();
        if (!empty($template)) {
            return response(['template' => $template, 'message' => 'Updated Success', 'status' => 200], 200);
        }
    }

    public function renderTemplate($templateID)
    {
        $template = Template::find($templateID);
        $profession = $template->profession->name;
        $templateCSS = $template->styleFile;
        $template_id = $template->id;
        $template = $template->title;
        $tenantID = strtolower(tenant('id')); // For getting the file location;
        $preview = true;
        $can = false;
        $email = '';
        $user_id = 0;
        $meta = [
            'description' => "Experience the future of healthcare at WhiteCoatDomain.com/preview/1. Our cutting-edge platform revolutionizes healthcare delivery, connecting patients and providers seamlessly. Discover intuitive features, personalized care options, and streamlined workflows for enhanced efficiency. Join us on the forefront of healthcare innovation and elevate your practice to new heights. Sign up for a preview today!",
            'image' => "/media/img/templates/$template_id/physicianHeroWhiteMale.jpg",
        ];

        return view('websites.physician', compact('meta', 'preview', 'template', 'templateCSS', 'tenantID', 'can', 'email', 'user_id', 'template_id'));
    }
}
