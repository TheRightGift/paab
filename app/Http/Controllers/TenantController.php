<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Stancl\Tenancy\Exceptions\DomainsOccupiedByOtherTenantException;

use App\Models\Tenant;
use App\Models\Tenants\Bio;
use App\Models\Tenants\General;
use App\Models\Template;
use App\Models\Tenants\TenantUser as TenantUser;
use App\Models\AdminClientOrder;
use App\Models\User;
use DB;
use App\Notifications\Tenants\LoginNotifier;
use Stevebauman\Location\Facades\Location;
use Validator;
use Carbon\Carbon;

class TenantController extends Controller
{
    public function create(Request $request) {
        $inputs = Validator::make($request->all(), [
            'name' => 'required',
            'template_id' => ['nullable'],
            'user_id' => ['required'],
            'description' => ['required'],
            'email' => 'nullable|unique:admin_client_orders',
        ]);
        if ($inputs->fails()) {
            return response()->json(['errors' => $inputs->errors()->all()], 501);
        }
        try {
            $tenants = Tenant::find($request->name);
            $domains = DB::table('domains')->where('domain', $request->name)->first();
            if (empty($tenants) && empty($domains)) {
                $tenant = Tenant::create([
                    'name' => $inputs->validated()['name'],
                    'description' => $inputs->validated()['description'],
                    'template_id' => $inputs->validated()['template_id'],
                    'id' => strtolower($inputs->validated()['name']),
                    'user_id' => $inputs->validated()['user_id'],
                ]);
                if ($tenant) {
                    $domain = $tenant->domains()->create(['domain' => $request->name]); //Determine how to handle domain
                    if ($request->has('email')) {
                        $order = AdminClientOrder::create([
                            'tenant_id' => $tenant->id,
                            'user_id' => $inputs->validated()['user_id'],
                            'email' => $inputs->validated()['email'],
                        ]);
                    }
                    return response()->json(['message' => 'Your Website is created successfuly', 'tenant' => $tenant, 'domain' => $domain, 'status' => 200], 200);
                }
                else {
                    return response()->json(['message' => 'Problem creating your website, Please Try again', 'status' => 502], 502);
                }
            }
            else {
                return response()->json(['status' => 500, 'message' => 'The name has already been taken!'], 500);
            }
        } catch (DomainsOccupiedByOtherTenantException $th) {
            return response()->json(["Domain already in use."]);
        }
    }

    public function update(Request $request, $tenantID) {
        $inputs = Validator::make($request->all(), [
            'template' => ['nullable'],
            'domain' => ['nullable'],
            'domain_id' => ['nullable'],
        ]);

        if ($inputs->fails()) {
            return response()->json(['errors' => $inputs->errors()->all()], 501);
        }
        $sessionTenant = \Session::get('tenant');
        $tenantID = !empty($sessionTenant) ? $sessionTenant : $tenantID;
        $tenant = Tenant::find($tenantID);
        if ($tenant !== null) {
            if ($request->has('template')) {
                $tenant->template_id = $inputs->validated()['template'];
                $tenant->save();
            }
            if ($request->has('domain')) {
                try {
                    $domain = !empty($sessionTenant) ? $tenant->domains->first() : $tenant->domains->find($inputs->validated()['domain_id']);
                    $domain->domain = str_replace('.com', '', $inputs->validated()['domain']);
                    $domain->save();
                } catch (DomainsOccupiedByOtherTenantException $e) {
                    return response()->json(["Domain already in use."]);
                }
            }
            if ($domain == true || $tenant == true) {
                return response()->json(['message' => 'Success', 'domain' => $domain, 'status' => 200], 200);
            }
        }
        else {
            return response()->json(['message' => 'Website not found!', 'status' => 404], 404);
        }
    }

    // Renders / of template
    public function template() {
        // Get the template_id and get its details
        $tenancies = new Tenant();
        $tenant = $tenancies->find(tenant('id'));
        $profession = $tenant->template->profession->name;
        $professionId =$tenant->template->profession_id;
        $template = $tenant->template->title;
        $templateCSS = $tenant->template->styleFile;
        $bioTB = Bio::first();
        $pageTitles = General::first();
        $pageTitle = !empty($pageTitles) ? $pageTitles->title : null;
        $title = $tenant->user->role === 'Admin' || $tenant->user->role === 'Admin' ? null : $tenant->user->title->name;
        $tenantID = strtolower(tenant('id')); // For getting the file location;
        $user = !empty($bioTB) ? $title.' '.$bioTB->firstname.' '.$bioTB->lastname : null;

        if($profession === 'Physician'){
            return view('websites.physician', compact('template', 'user', 'templateCSS', 'title', 'pageTitle', 'tenantID'));
        } else {
            dd($profession);
        }
    }

    public function setting(Request $request) {
        $user = tenant()->user;
        $tenantID = strtolower(tenant('id')); // For getting the file location;
        return view('websites.setting', compact('user', 'tenantID'));
    }

    public function publicfeature(Request $request) {
        $user = tenant()->user;
        $tenantID = strtolower(tenant('id')); // For getting the file location;
        return view('tempSettings.publicfeature', compact('user', 'tenantID'));
    }

    public function milestone(Request $request) {
        $user = tenant()->user;
        $tenantID = strtolower(tenant('id')); // For getting the file location;
        return view('tempSettings.milestones', compact('user', 'tenantID'));
    }

    public function social(Request $request) {
        $user = tenant()->user;
        $tenantID = strtolower(tenant('id')); // For getting the file location;
        return view('tempSettings.socialmedia', compact('user', 'tenantID'));
    }

    public function tenancies() {
        // Get the authenticaed user
        // When coming from mobile request for user->id
        $user = auth()->user()->id;
        $tenancies = Tenant::where('user_id', $user)->with('domains', 'template', 'template.profession', 'order')->latest()->paginate(10);
        // Sort by alphabetical order for domain only and email

        // Filter by assigned order
        return response()->json(['message' => 'Tenants fetched', 'tenants' => $tenancies, 'status' => 200], 200);
    }

    public function delete ($id) {
        $tenant = Tenant::find($id);
        if ($tenant !== null) {
            $tenant->delete();
            if ($tenant == true) {
                return response()->json(['message' => 'Deleted', 'status' => 200], 404);
            }
        }
        else {
            return response()->json(['message' => 'Not found', 'status' => 404], 404);
        }
    }

    public function verifyToken(Request $request) {
        $users = new TenantUser();
        $access = $users->first();
        if ($access != null) {
            if($request->accessToken == $users->first()->accessToken) {
                return response()->json(['message' => 'Token In use', 'status' => 200], 200);
            }
            else {
                return response()->json(['message' => 'Token Expired', 'status' => 401], 200);
            }
        }
        else {
            return response()->json(['message' => 'Token Expired', 'status' => 401], 200);
        }
    }

    public function saveAccessToken(Request $request) {
        $inputs = Validator::make($request->all(), [
            'user_id' => ['required'],
            'accessToken' => 'required',
            'email' => 'required'
        ]);
        if ($inputs->fails()) {
            return response()->json(['errors' => $inputs->errors()->all()], 501);
        } else {
            $input = $inputs->validated();
            $tenantUser = new TenantUser();
            $tenant = $tenantUser->where('user_id', $input['user_id'])->latest()->first();
            $locator = $this->locator();
            $hostname = gethostbyaddr($_SERVER['REMOTE_ADDR']);
            if ($tenant != null) {
                $tenant->user_id = $input['user_id'];
                $tenant->accessToken = $input['accessToken'];
                $tenant->save();
                (new User)->forceFill([
                    'email' => $input['email'],
                ])->notify(new LoginNotifier($this->locator(), $hostname));
                if ($tenant == true) {
                    return response()->json(['message' => 'Saved Success', 'status' => 201], 200);
                }
            }
            elseif ($tenant == null) {
                $tenantUser->user_id = $input['user_id'];
                $tenantUser->accessToken = $input['accessToken'];
                $tenantUser->save();

                (new User)->forceFill([
                    'email' => $input['email'],
                ])->notify(new LoginNotifier($this->locator(), $hostname));
                if ($tenantUser == true) {
                    return response()->json(['message' => 'Saved Success', 'status' => 201], 200);
                }
            }
        }
    }

    private function locator() {
        if ($position = Location::get()) {
            // Successfully retrieved position.
            return $position;
        } else {
            // Failed retrieving position.
            return null;
        }
    }

    public function checkEmail(Request $request) {
        // Check if user->visits != null
        $orders = AdminClientOrder::where([['email', $request->email], ['claimed', null]])->first();
        $authUser = auth()->user();
        if ($authUser->visits != null) {
            if (!empty($orders)) {
                $tenant = Tenant::find($orders->tenant_id);
                $tenant->user_id = $authUser->id;
                $orders->claimed = 1;
                $tenant->save();
                $orders->save();
                return response()->json(['account' => $tenant, 'status' => 200], 200);
            }
            elseif(empty($orders)) {
                // Inefficient when the APP grows larger
                $tenants = Tenant::all();
                foreach($tenants as $tenant) {
                    \Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

                    DB::connection('mysql')->reconnect();
                    DB::setDatabaseName($tenant->tenancy_db_name);
                    $user = DB::table('contacts')->where('email', $request->email)->first();
                    if($user) {
                        $tenant = Tenant::find($orders->tenant_id);
                        $tenant->user_id = $authUser->id;
                        $tenant->save();
                        return response()->json(['account' => $tenant, 'status' => 200], 200);
                    } else {
                        return response()->json(['status' => 404, 'message' => 'No Account']);
                    }
                }
            }

            // Check in Orders where claimed is null if email exists
                // If exists then update tenantTB with userID
                // Update AdminClientOrderTB with claimed = 1
            // Else Check all the tenant DB
            //  Check ContactTB->email to see if any is there
            // If true get the tenantID and update userID
            // Else do nothing.
        }
        else {
            return response()->json(['message' => 'Your website might have been claimed']);
        }
    }

    public function claim(Request $request) {
        $value = $request->session()->pull('tenant', 'default');
        $valueOfMail = $request->session()->pull('email', 'default');
        if (!empty($value) && $value !== 'default') {
            $orders = AdminClientOrder::where([['tenant_id', $value], ['claimed', null], ['email', $valueOfMail]])->first();
            if (!empty($orders)) {
                $authUser = auth()->user();
                $tenant = Tenant::find($value);
                $tenant->user_id = $authUser->id;
                $orders->claimed = 1;
                $tenantSave = $tenant->save();
                $orderSave = $orders->save();
                \Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenant->tenancy_db_name);
                $tenantUser = DB::table('tenant_users')->get();
                if ($tenantUser != null) {
                    DB::table('tenant_users')->where('user_id', '!=' , null )->update(['user_id' => $authUser->id]);
                }
                if ($tenantSave === true && $orderSave) {
                    return view('client.dashboard');
                }
            }
            else {
                return response()->json(['message' => "Invalid Email/Your website has been claimed!"]);
                return view('client.dashboard');
            }
        }
        else {
            return view('client.dashboard');
        }
    }

    /**
     * This function gets the users details stored in its DB eg. tenantdrowere
     */
    public function checkTenantNGetDets (Request $request) {
        $tenantToCheck = $request->session()->get('tenant');
        $tenant = Tenant::find($tenantToCheck);
        if (!empty($tenant)) {
            $domain = $tenant->domains->first()->domain;
            $tenantID = $tenant->id;

            return response()->json(['message' => "Tenant Data fetched onSuccess", 'domain' => $domain, 'tenantID' => $tenantID, 'status' => 200]);
        }
        else {
            return response()->json(['message' => 'Please Signup']);
        }
    }
}
