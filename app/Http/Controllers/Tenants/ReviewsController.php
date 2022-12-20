<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Reviews;
use Illuminate\Http\Request;
use Validator;

class ReviewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Reviews::orderBy('created_at', 'DESC')->paginate(10);
        return response()->json(['message' => 'Success', 'reviews' => $reviews]);
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
            'firstname' => 'required',
            'lastname' => 'required',
            'comment' => 'required',
            'imageURL' => 'nullable|image|mimes:jpg,png|max:100',
        ]);

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            if($request->hasFile('imageURL')){
                $imageURL = $request->file('imageURL');
                $ext = $request->file('imageURL')->getClientOriginalExtension();
                $stored = \Storage::disk('public')->putFileAs('img/reviews', $imageURL, $input['firstname'].$input['lastname'].'.'.$ext);
                
                $input['imageURL'] = $stored;
            } 
            $review = Reviews::create($input);
            if ($review == true) {
                return response()->json(['message' => 'Success', 'review' => $review], 201);
            }
            else {
                return response()->json(['message' => 'Failed', 'review' => $review], 501);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Reviews  $review
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $review)
    {
        $inputs = Validator::make($request->all(), [
            'twitter' => 'nullable',
            'linkedin' => 'nullable',
            'facebook' => 'nullable',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $request->validated();
            if($request->hasFile('imageURL')){
                $image = $request->file('imageURL');
                $name = $image->getClientOriginalName();
                $image->file(storage_path('/media/img/' . $name));
                // $image->move(public_path('/media/img/'), $name);
                $input['imageURL'] = '/media/img/'.$name;
            } 
            $reviews = new Reviews();
            $reviews->find($review);
            $reviews->update($input);
            if ($reviews == true) {
                return response()->json(['message' => 'Success', 'review' => $reviews], 200);
            }
            else {
                return response()->json(['message' => 'Failed', 'review' => $reviews], 501);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reviews  $reviews
     * @return \Illuminate\Http\Response
     */
    public function destroy(Reviews $reviews)
    {
        $reviews->delete();
        return response()->json([], 204);
    }
}
