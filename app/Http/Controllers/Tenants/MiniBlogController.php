<?php

namespace App\Http\Controllers\Tenants;

use Illuminate\Http\Request;
use Intervention\Image\Image;
use App\Models\Tenants\MiniBlog;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class MiniBlogController extends Controller
{
    protected function dataToValidate(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'body' => 'required',
            'title' => 'required|max:300|unique:mini_blogs',
            'imageUrl' => 'nullable',      
		]);
        return $validator;
    }

    public function index()
    {
        $blogs = MiniBlog::latest()->take(5);
        return response()->json(['message' => 'Mini Blog fetched successfuly', 'miniBlog' => $blogs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $this->dataToValidate($request);
        if ($data->fails()){
            return response()->json(['errors' => $data->errors()->all()]);
        }
        else {
            $input = $data->validated();
            $name = $input['title'].'.'.'png';
            $save_path = public_path().'/media/tenants/'.strtolower(tenant('id')).'/img/miniblog';
            if (!file_exists($save_path)) {
                mkdir($save_path, 0755, true);
            }
            $file = $save_path.$name;
            $image = new Image();
            $image->make(file_get_contents($request['banner']))->save($file);
            $blog = MiniBlog::create([
                'body' => $input['body'],
                'title' => $input['title'],
                'imageUrl' => $name
            ]);
            return response()->json(['blog' => $blog, 'message' => 'Insert is successful', 'status' => 1], 200);
        } 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MiniBlog  $blog
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->has('newImage')) {
            $name = $request->title.'.'.'png';
            $save_path = public_path().'/media/tenants/'.strtolower(tenant('id')).'/img/miniblog';
            if (!file_exists($save_path)) {
                mkdir($save_path, 0755, true);
            }
            $file = $save_path.$name;
            $image = new Image();
            $image->make(file_get_contents($request['banner']))->save($file);
        }
        $blog = MiniBlog::find($id)->update($request->only([
            'body',
            'title',
            'imageUrl' => $name,
        ]));
        return response()->json(['blogpost' => $blog, 'message' => 'Update is successful', 'status' => 1], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MiniBlog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = MiniBlog::where('id', $id)->first();
        $blog->delete();
        return response()->json(['message' => 'Archived successfuly'], 204);
    }
}
