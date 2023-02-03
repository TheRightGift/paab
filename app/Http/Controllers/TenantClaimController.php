<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tenant;
use App\Models\AdminClientOrder;

use Illuminate\Support\Facades\Hash;

use Validator;
use DB;

class TenantClaimController extends Controller
{
    public function saveUserDets(Request $request) {
        $inputs = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'title_id' => 'nullable',
            'email' => 'nullable|unique:users',
            'password' => 'required',
            'othername' => 'nullable',
        ]); 
    
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            $input['password'] = Hash::make($request->password);
            if (!empty(\Session::get('email'))) {
                $input['email'] = \Session::get('email');
                $findUser = User::where('email', $input['email'])->first();
                if(!(empty($findUser))){
                    $user = $findUser->update($input);
                    return response(['status' => 200, 'user' => $user, 'msg' => 'Updated onSuccess'], 200);
                } else {
                    $user = User::create($input);
                    return response(['status' => 201, 'user' => $user, 'msg' => 'Your data has been saved successfully'], 201);
                }
            }
        }
    }
    // Saves User bioData incase of update
    public function updateUserBio(Request $request) {
        $inputs = Validator::make($request->all(), [
            'firstname' => 'nullable',
            'lastname' => 'nullable',
            'othername' => 'nullable',
            'title_id' => 'nullable',
        ]); 
    
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            $tenantToFind = \Session::get('tenant');
            $tenant = Tenant::find($tenantToFind);
            if (!empty($tenant)) {
                \Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);
        
                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenant->tenancy_db_name);
                $userData = DB::table('bios')->where('id', '!=' , null )->update($input);
                $userBiography = DB::table('bios')->first();
                return response(['status' => 200, 'user' => $userBiography, 'msg' => 'Updated onSuccess'], 200);
            }
            dd('hdhhdhd');
        }
    }

    // Update Domain 
    public function updateUserPhoto(Request $request, $bioID) {
        $inputs = Validator::make($request->all(), [
            'photo' => 'required|image|mimes:jpg,png|max:1000|dimensions:min_width=451,min_height=512',
        ]); 
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } 
        else {
            $input = $inputs->validated();
            $searchTenant = $request->session()->get('tenant');
            $tenant = Tenant::find($searchTenant);
            if (!empty($tenant)) {
                if($request->hasFile('photo')){
                    $photo = $request->file('photo');
                    $ext = $request->file('photo')->getClientOriginalExtension();
                    
                    $name = $tenant->id.'biophoto'.'.'.$ext;
                    $path = $photo->move(public_path('/media/tenants/'.$tenant->id.'/img'), $name);

                    $input['photo'] = $name;
                    
                    \Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);
            
                    DB::connection('mysql')->reconnect();
                    DB::setDatabaseName($tenant->tenancy_db_name);
                    // Check the bio and get the names eg. FNAME, LNAME, ONAME
                    $photoSave = DB::table('bios')->where('id', !null)->update($input);
                    $updated = DB::table('bios')->first();
                    return response(['bio' => $updated, 'message' => 'Update Success', 'status' => 200], 200);
                }
            } 
        }

    }

    public function updateUserUndergradSchoolTime(Request $request) {
        $inputs = Validator::make($request->all(), [
            'institution' => 'nullable',
            'yearStart' => 'nullable',
            'monthStart' => 'nullable',
            'yearEnd' => 'nullable',
            'monthEnd' => 'nullable',
            'major' => 'nullable',
            'minor' => 'nullable',
        ]); 
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } 
        else {
            $input = $inputs->validated();
            $searchTenant = $request->session()->get('tenant');
            $tenant = Tenant::find($searchTenant);
            if (!empty($tenant)) {
                \Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);
        
                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenant->tenancy_db_name);
                // Check the bio and get the names eg. FNAME, LNAME, ONAME
                $cvUnderGrad = DB::table('c_v__undergrad__schools')->first();
                if (!empty($cvUnderGrad)) {
                    $gradSchool = DB::table('c_v__undergrad__schools')->where('id', !null)->update($input);
                }
                else {
                    $gradSchool = DB::table('c_v__undergrad__schools')->insert($input);
                }
                if ($gradSchool == true) {
                    return response()->json(['message' => 'Success', 'school' => $gradSchool, 'status' => 201], 201);
                }
                else {
                    return response()->json(['message' => 'Failed', 'school' => $gradSchool], 501);
                }
            } 
        }

    }

    public function saveMedicalSchoolTime(Request $request) {
        $inputs = Validator::make($request->all(), [
            'institution' => 'nullable',
            'yearStart' => 'nullable',
            'monthStart' => 'nullable',
            'yearEnd' => 'nullable',
            'monthEnd' => 'nullable',
            'type' => 'nullable',
        ]); 
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } 
        else {
            $input = $inputs->validated();
            $searchTenant = $request->session()->get('tenant');
            $tenant = Tenant::find($searchTenant);
            if (!empty($tenant)) {
                \Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);
        
                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenant->tenancy_db_name);
                // Check the bio and get the names eg. FNAME, LNAME, ONAME
                $cvUnderGrad = DB::table('c_v__medical__schools')->first();
                if (!empty($cvUnderGrad)) {
                    $gradSchool = DB::table('c_v__medical__schools')->where('id', !null)->update($input);
                }
                else {
                    $gradSchool = DB::table('c_v__medical__schools')->insert($input);
                }
                if ($gradSchool == true) {
                    return response()->json(['message' => 'Success', 'school' => $gradSchool, 'status' => 201], 201);
                }
                else {
                    return response()->json(['message' => 'No data updated', 'school' => $gradSchool], 200);
                }
            } 
        }
    }

    public function saveInternshipTime(Request $request) {
        $inputs = Validator::make($request->all(), [
            'institution' => 'nullable',
            'yearStart' => 'nullable',
            'monthStart' => 'nullable',
            'yearEnd' => 'nullable',
            'monthEnd' => 'nullable',
            'type' => 'nullable',
        ]); 
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } 
        else {
            $input = $inputs->validated();
            $searchTenant = $request->session()->get('tenant');
            $tenant = Tenant::find($searchTenant);
            if (!empty($tenant)) {
                \Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);
        
                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenant->tenancy_db_name);
                // Check the bio and get the names eg. FNAME, LNAME, ONAME
                $internship = DB::table('c_v__trainings')->where('type', 'internship')->first();
                if (!empty($internship)) {
                    $internship = DB::table('c_v__trainings')->where('type', 'internship')->update($input);
                }
                else {
                    $internship = DB::table('c_v__trainings')->insert($input);
                }
                if ($internship == true) {
                    return response()->json(['message' => 'Success', 'trainings' => $internship, 'status' => 201], 201);
                }
                else {
                    return response()->json(['message' => 'No data updated', 'trainings' => $internship], 200);
                }
            } 
        }
    }

    public function saveFellowshipTime(Request $request) {
        $inputs = Validator::make($request->all(), [
            'institution' => 'nullable',
            'yearStart' => 'nullable',
            'monthStart' => 'nullable',
            'yearEnd' => 'nullable',
            'monthEnd' => 'nullable',
            'type' => 'nullable',
        ]); 
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } 
        else {
            $input = $inputs->validated();
            $searchTenant = $request->session()->get('tenant');
            $tenant = Tenant::find($searchTenant);
            if (!empty($tenant)) {
                \Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);
        
                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenant->tenancy_db_name);
                // Check the bio and get the names eg. FNAME, LNAME, ONAME
                $fellowship = DB::table('c_v__trainings')->where('type', 'fellowship')->first();
                if (!empty($fellowship)) {
                    $fellowship = DB::table('c_v__trainings')->where('type', 'fellowship')->update($input);
                }
                else {
                    $fellowship = DB::table('c_v__trainings')->insert($input);
                }
                if ($fellowship == true) {
                    return response()->json(['message' => 'Success', 'trainings' => $fellowship, 'status' => 201], 201);
                }
                else {
                    return response()->json(['message' => 'No data updated', 'trainings' => $fellowship], 200);
                }
            } 
        }
    }

    public function saveResidencyTime(Request $request) {
        $inputs = Validator::make($request->all(), [
            'institution' => 'nullable',
            'yearStart' => 'nullable',
            'monthStart' => 'nullable',
            'yearEnd' => 'nullable',
            'monthEnd' => 'nullable',
            'type' => 'nullable',
        ]); 
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } 
        else {
            $input = $inputs->validated();
            $searchTenant = $request->session()->get('tenant');
            $tenant = Tenant::find($searchTenant);
            if (!empty($tenant)) {
                \Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);
        
                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenant->tenancy_db_name);
                // Check the bio and get the names eg. FNAME, LNAME, ONAME
                $residency = DB::table('c_v__trainings')->where('type', 'residency')->first();
                if (!empty($residency)) {
                    $residency = DB::table('c_v__trainings')->where('type', 'residency')->update($input);
                }
                else {
                    $residency = DB::table('c_v__trainings')->insert($input);
                }
                if ($residency == true) {
                    return response()->json(['message' => 'Success', 'trainings' => $residency, 'status' => 201], 201);
                }
                else {
                    return response()->json(['message' => 'No data updated', 'trainings' => $residency], 200);
                }
            } 
        }
    }

    public function saveExperinceTime(Request $request) {
        $inputs = Validator::make($request->all(), [
            'institution' => 'nullable',
            'yearStart' => 'nullable',
            'monthStart' => 'nullable',
            'yearEnd' => 'nullable',
            'monthEnd' => 'nullable',
            'position' => 'nullable',
            'location' => 'nullable',
        ]); 
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } 
        else {
            $input = $inputs->validated();
            $searchTenant = $request->session()->get('tenant');
            $tenant = Tenant::find($searchTenant);
            if (!empty($tenant)) {
                \Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);
        
                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenant->tenancy_db_name);
                // Check the bio and get the names eg. FNAME, LNAME, ONAME
                if ($request->has('id')) {
                    $experience = DB::table('c_v__experiences')->where('id', $request->id)->update($input);
                    $lastID = $request->id;
                }
                else {
                    $experience = DB::table('c_v__experiences')->insert($input);
                    $lastID = DB::getPdo()->lastInsertId();
                }
                if ($experience == true) {
                    return response()->json(['message' => 'Success', 'experience' => $experience, 'id' => $lastID, 'status' => 201], 201);
                }
                else {
                    return response()->json(['message' => 'No data updated', 'experience' => $experience], 200);
                }
            } 
        }
    }

    public function saveAdditionalSchoolTime(Request $request) {
        $inputs = Validator::make($request->all(), [
            'institution' => 'nullable',
            'yearStart' => 'nullable',
            'monthStart' => 'nullable',
            'yearEnd' => 'nullable',
            'monthEnd' => 'nullable',
            'title' => 'nullable',
            'degree' => 'nullable',
        ]); 
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } 
        else {
            $input = $inputs->validated();
            $searchTenant = $request->session()->get('tenant');
            $tenant = Tenant::find($searchTenant);
            if (!empty($tenant)) {
                \Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);
        
                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenant->tenancy_db_name);
                // Check the bio and get the names eg. FNAME, LNAME, ONAME
                if ($request->has('id')) {
                    $additonalQualication = DB::table('c_v__additional__schools')->where('id', $request->id)->update($input);
                    $lastID = $request->id;
                }
                else {
                    $additonalQualication = DB::table('c_v__additional__schools')->insert($input);
                    $lastID = DB::getPdo()->lastInsertId();
                }
                if ($additonalQualication == true) {
                    return response()->json(['message' => 'Success', 'additonalQualication' => $additonalQualication, 'id' => $lastID, 'status' => 201], 201);
                }
                else {
                    return response()->json(['message' => 'No data updated', 'additonalQualication' => $additonalQualication], 200);
                }
            } 
        }
    }

    public function saveServiceOffered(Request $request) {
        $inputs = Validator::make($request->all(), [
            'title' => 'required',
        ]); 
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } 
        else {
            $input = $inputs->validated();
            $searchTenant = $request->session()->get('tenant');
            $tenant = Tenant::find($searchTenant);
            if (!empty($tenant)) {
                \Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);
        
                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenant->tenancy_db_name);
                // Check the bio and get the names eg. FNAME, LNAME, ONAME
                if ($request->has('id')) {
                    $service = DB::table('services')->where('id', $request->id)->update($input);
                    $lastID = $request->id;
                }
                else {
                    $service = DB::table('services')->insert($input);
                    $lastID = DB::getPdo()->lastInsertId();
                }
                if ($service == true) {
                    return response()->json(['message' => 'Success', 'service' => $service, 'id' => $lastID, 'status' => 201], 201);
                }
                else {
                    return response()->json(['message' => 'No data updated', 'service' => $service], 200);
                }
            } 
        }
    }

    public function sendMailForDomainRegistry(Request $request) {
        $value = $request->session()->pull('tenant', 'default');
        $valueOfMail = $request->session()->get('email');
        $this->validate($request, [
            'password' => 'required',
            'plan' => 'required',
            'domain' => 'required',
        ]);  
        if (!empty($value) && $value !== 'default') {
            $orders = AdminClientOrder::where([['tenant_id', $value], ['claimed', null], ['email', $valueOfMail]])->first();
            if (!empty($orders)) {
                $userToUpdate = User::where('email', $valueOfMail)->first();
                $authUser = $userToUpdate->id;
                $tenant = Tenant::find($value);
                $tenant->user_id = $authUser;
                $orders->claimed = 1;
                $tenantSave = $tenant->save();
                $orderSave = $orders->save();
                if ($tenantSave === true && $orderSave) {
                    $userToUpdate->plan = $request->plan == 'freemium' ? 'F' : 'P';
                    $userToUpdate->save();
                    \Mail::send('websites.domain_claim',
                    array(
                        'email' => $valueOfMail,
                        'plan' => $request->get('plan'),
                        'password' => $request->password,
                        'domain' => $request->domain,
                    ), function($message) use ($request) {
                            $message->from('admin@whitecoatdomain.com');
                            $message->to($request->session()->pull('email'), tenant('id'))->subject('Website is now live!');
                        });
                    \Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);
                    
                    DB::connection('mysql')->reconnect();
                    DB::setDatabaseName($tenant->tenancy_db_name);
                    $tenantUser = DB::table('tenant_users')->get();
                    if ($tenantUser != null) {
                        DB::table('tenant_users')->where('user_id', '!=' , null )->update(['user_id' => $authUser]);
                        $request->session()->pull('email', 'default');
                        return response()->json(['message' => 'You have successfully setup your website'], 201); 
                    }
                }   
            }
            else {
                return response()->json(['message' => "Invalid Email/Your website has been claimed!"]);
                return view('client.dashboard');
            }
        }
        else {
            return redirect('auth/login');
        }
    }
}
