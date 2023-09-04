<?php

namespace App\Http\Controllers\Tenants;

use App\Http\Controllers\Controller;
use App\Models\Tenants\PublicFeaturing;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Trait\ServiceNotifier;
use Illuminate\Validation\ValidationException;

class PublicFeaturingController extends Controller
{
    use ServiceNotifier;
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $public_feature = PublicFeaturing::latest()->first();
        return response()->json(['message' => 'Success', 'public_feature' => $public_feature]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function store(Request $request): JsonResponse
    {
        $inputs = Validator::make($request->all(), [
            'title' => 'nullable',
            'url' => 'nullable',
            'broadcaster' => 'nullable',
            'id' => 'nullable'
        ]);

        if ($inputs->fails()) {
            return response()->json(['errors' => $inputs->errors()->all()], 400);
        } else {
            $input = $inputs->validated();
            if ($request->has('id')) {
                $public_feature = PublicFeaturing::where('id', $input['id'])->update($input);
                $lastID = $input['id'];
            }
            else {
                $public_feature = PublicFeaturing::create($input);
                $lastID = DB::getPdo()->lastInsertId();
            }
            if ($public_feature) {
                return response()->json(['message' => 'Success', 'public_feature' => $public_feature, 'id' => $lastID], 201);
            }
            else {
                return response()->json(['message' => 'No data updated', 'public_feature' => $public_feature]);
            }
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param PublicFeaturing $public_feature
     * @return JsonResponse
     * @throws ValidationException
     */
    public function update(Request $request, $public_feature)
    {
        $inputs = Validator::make($request->all(), [
            'title' => 'nullable',
            'url' => 'nullable',
            'broadcaster' => 'nullable',
        ]);

        if ($inputs->fails()) {
            return response()->json(['errors' => $inputs->errors()->all()], 501);
        } else {
            $input = $inputs->validated();
            $public_features = new PublicFeaturing();
            $public_feature2Update = $public_features->find($public_feature);
            $public_feature2Update->update($input);
            if (true) {
                #TODO: Put back when mail manager is available
                // $this->settingschangeNotify();
                return response()->json(['message' => 'Success', 'public_feature' => $public_feature2Update, 'status' => 200]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param PublicFeaturing $public_feature
     * @return JsonResponse
     */
    public function destroy(PublicFeaturing $public_feature): JsonResponse
    {
        $public_feature2Delete = (new PublicFeaturing)->find($public_feature);
        $public_feature2Delete->delete();
        return response()->json([], 204);
    }
}
