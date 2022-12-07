<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stancl\Tenancy\Exceptions\DomainsOccupiedByOtherTenantException;
use App\Models\Tenant;
use App\Models\Template;
use Validator;
class TestTenantController extends Controller
{
    public function create(Request $request) {
        // The ID might be the combination of firstnameLastname of user or a custom name
        $inputs = Validator::make($request->all(), [
            'name' => 'required',
            'template_id' => ['nullable'],
            'user_id' => ['required'],
            'description' => ['required'],
        ]); 
        if ($inputs->fails()) {
            return response()->json(['errors' => $inputs->errors()->all()], 501);
        }
        try {
            //code...
            $tenant = Tenant::find($request->name);
            if (empty($tenant)) {
                $tenant = Tenant::create([
                    'name' => $inputs->validated()['name'],
                    'description' => $inputs->validated()['description'],
                    // 'template_id' => $inputs->validated()['template_id'],
                    'id' => $inputs->validated()['name'],
                    'user_id' => $inputs->validated()['user_id'],
                ]);
                if ($tenant) {
                    $domain = $tenant->domains()->create(['domain' => $request->name .'.localhost']); //Determine how to handle domain
                    return response()->json(['message' => 'Your Website is created successfuly', 'tenant' => $tenant, 'domain' => $domain, 'status' => 200], 200);
                }
                else {
                    return response()->json(['message' => 'Problem creating your website, Please Try again', 'status' => 502], 502);
                }
            }
            else {
                return response()->json(['status' => 500, 'message' => 'The name has already been taken!'], 500);
            }
        } catch (\Throwable $th) {
            echo $th;
        }
    }

    public function update(Request $request) {
        $inputs = Validator::make($request->all(), [
            'template_id' => ['required'],
            'tenant_id' => ['required'],
        ]); 
        
        if ($inputs->fails()) {
            return response()->json(['errors' => $inputs->errors()->all()], 501);
        }
        $tenant = Tenant::find($inputs->validated()['tenant_id'])->first();
        $tenant->template_id = $inputs->validated()['template_id'];
        $tenant->save();

        if ($tenant->wasChanged()  == true) {
            return response()->json(['message' => 'You have successfully changed your Template', 'status' => 200], 200);
        }
        else {
            return response()->json(['message' => 'Some error has occured!', 'status' => 501], 501);
        }
    }

    // Renders / of template
    public function template() {
        // Get the template_id and get its details
        return view('templater');
        // $template = Tenant::find(tenant('id'))->template;
        dd($template);
        // $templateTitle = $template['name'];

    }

    public function tenancies() {
        // Get the authenticaed user
        // When coming from mobile request for user->id
        $user = auth()->user()->id;
        $tenancies = Tenant::where('user_id', $user)->with('domains')->get();

        return response()->json(['message' => 'Tenants fetched', 'tenants' => $tenancies, 'status' => 200], 200);
    }
}
