<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenants\Promotion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Validator;
use App\Trait\ServiceNotifier;
use Carbon\Carbon;

class PromotionController extends Controller
{
    use ServiceNotifier;
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $promotion = Promotion::latest()->get();
        return response()->json(['message' => 'Success', 'promotions' => $promotion]);
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
            'banner' => 'required|image|mimes:png,jpg,gif|max:500|dimensions:min_width=1294,min_height=743',
            'promo' => 'nullable',
            'expiry' => 'required',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            if($request->hasFile('banner')){
                $banner = $request->file('banner');
                $ext = $request->file('banner')->getClientOriginalExtension();
                $stored = \Storage::disk('public')->putFileAs('img/promo', $banner, $this->UUID().'.'.$ext);
                
                $input['banner'] = $stored;
            } 
            $input['expiry'] = new Carbon($input['expiry']);
            $promotion = Promotion::create($input);
            if ($promotion == true) {
                return response()->json(['message' => 'Success', 'promotion' => $promotion], 201);
            }
            else {
                return response()->json(['message' => 'Failed', 'promotion' => $promotion], 501);
            }
        }
    }
    private function UUID() {
        return (string) Str::uuid();
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $promotion)
    {
        $inputs = Validator::make($request->all(), [
            'banner' => 'nullable|image|mimes:png,jpg,gif|max:500|dimensions:min_width=1294,min_height=743',
            'promo' => 'required',
            'expiry' => 'required',
        ]); 

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            if($request->hasFile('banner')){
                $banner = $request->file('banner');
                $ext = $request->file('banner')->getClientOriginalExtension();
                $stored = \Storage::disk('public')->putFileAs('img/promo', $banner, $this->UUID().'.'.$ext);
                
                $input['banner'] = $stored;
            } 
            $input['expiry'] = new Carbon($input['expiry']);
            $promotions = new Promotion();
            $promotion2Update = $promotions->find($promotion);
            $promotion2Update->update($input);
            if ($promotion2Update == true) {
                $this->settingschangeNotify();
                return response()->json(['message' => 'Success', 'promotion' => $promotion2Update, 'status' => 200], 200);
            }
            else {
                return response()->json(['message' => 'Failed', 'promotion' => $promotion2Update], 501);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Promotion  $promotion
     * @return \Illuminate\Http\Response
     */
    public function destroy($promotion)
    {
        $promotion2Delete = promotion::find($promotion);
        $promotion2Delete->delete();
        return response()->json([], 204);
    }

    public function getLatestInTime(){
        $promo = Promotion::where('expiry', '>', Carbon::now())->latest()->take(1)->first();
        if ($promo) {
            return response()->json(['promo' => $promo, 'message' => 'Success']);
        }
    }

    
}
