<?php

namespace App\Http\Controllers;

use App\Mail\ServiceCreated;
use App\Models\User;
use App\Models\Title;
use App\Models\Tenant;
use Illuminate\Http\Request;
use App\Models\AdminClientOrder;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\PostTooLargeException;

class TenantClaimController extends Controller
{
    /**
     * Gets the medical, additional, undergrad, services, experiences, trainings a user has inputted
     * Incase he dismisses along the time of filling the getstartd and comes later on
     *
     * @return JsonResponse
     */
    public function getData() 
    {
        $tenantToFind = Session::get('tenant');
        $tenants = new Tenant();
        $tenant = $tenants->find($tenantToFind);
        Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

        DB::connection('mysql')->reconnect();
        DB::setDatabaseName($tenant->tenancy_db_name);
        $medSchool = DB::table('c_v__medical__schools')->first();
        $otherEdu = DB::table('c_v__additional__schools')->first();
        $undergrad = DB::table('c_v__undergrad__schools')->first();
        $services = DB::table('services')->get();
        $experiences = DB::table('c_v__experiences')->get();
        $training = DB::table('c_v__trainings')->get();
        return response()->json(['medschool' => $medSchool, 'otheredu' => $otherEdu, 'undergrad' => $undergrad, 'services' => $services, 'experiences' => $experiences, 'trainings' => $training]);
    }
    /**
     * @throws ValidationException
     */
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
            if (!empty(Session::get('email')) || !empty(Session::get('code')) || $request->confirmHash === 'hashkeill') {
                $orders = AdminClientOrder::where([['email', Session::get('email')],['tenant_id', Session::get('tenant')]])->orWhere([['code', Session::get('code')], ['tenant_id', Session::get('tenant')]])->first();
                $tenantToFind = Session::get('tenant');
                $input['email'] = !empty($orders) ? $orders->email : $input['email'] ?? Session::get('email');
                $findUser = User::where('email', $input['email'])->first();
                if(!(empty($findUser))){
                    $user = $findUser->update($input);
                    $request->confirmHash === 'hashkeill' ? null: $this->createOrUpdatePassword($tenantToFind, $request->password);
                    return response(['status' => 200, 'user' => $user, 'msg' => 'Updated onSuccess'], 200);
                } else {
                    $user = User::create($input);
                    $request->confirmHash === 'hashkeill' ? null: $this->createOrUpdatePassword($tenantToFind, $request->password);
                    return response(['status' => 201, 'user' => $user, 'msg' => 'Your data has been saved successfully'], 201);
                }
            }
        }
    }

    

    /**
     * Create Or Update password for the tenant
     *
     * @param [type] $data
     * @return void
     */
    public function createOrUpdatePassword($tenantID, $password)
    {
        $instance = DB::table('tenant_password_tables')->where('tenant_id', $tenantID)->first();

        if (!$instance) {
            $instance = DB::table('tenant_password_tables')->insert([
                'tenant_id' => $tenantID,
                'password' => $password,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        } else {
            DB::update('update tenant_password_tables set password = :password where id = :id', ['password' => $password, 'id' => $instance->id]);
        }

        return $instance;
    }
    // Saves User bioData encase of update

    /**
     * @throws ValidationException
     */
    public function updateUserBio(Request $request) {
        $inputs = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'othername' => 'nullable',
            'title_id' => 'required',
        ]);

        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        } else {
            $input = $inputs->validated();
            $tenantToFind = Session::get('tenant');
            $tenant = Tenant::find($tenantToFind);
            if (!empty($tenant)) {
                Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);
                
                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenant->tenancy_db_name);
                if (!empty($request->id)) {
                    // dd($input);
                    $input['updated_at'] = now();
                    $userData = DB::table('bios')->where('id', '!=' , null )->update($input);
                }
                else {
                    $input['updated_at'] = now();
                    $input['created_at'] = now();
                    $userData = DB::table('bios')->insert($input);
                    // dd($input);
                }
                $userBiography = DB::table('bios')->first();
                return response(['status' => 200, 'user' => $userBiography, 'msg' => 'Updated onSuccess'], 200);
            }
        }
    }

    /**
     * Detects the tenantId passed in as query parameter and checks if exist and get the domain
     *
     * @return void
     */
    public function checkIfTenantIDNGetDomain(Request $request){
        $tenantIDCheck = $request->has('physician');
        $tokenCheck = $request->has('token');
        if($tenantIDCheck && $tokenCheck) {
            $tenant = Tenant::findOrFail($request->get('physician'));
            $email = AdminClientOrder::where('tenant_id', $request->get('physician'))->firstOrFail()->email;
            $domain = $tenant->domains[0]['domain'];
            if (!empty($request->get('token'))) {
                $token = $request->get('token');
                
                return redirect("https://$domain.whitecoatdomain.com?token=$token");
            }
            else {
                return redirect('auth/login');
            }
        }else {
            return redirect('auth/login');
        }
    }

    /**
     * @throws ValidationException
     */
    public function updateUserPhoto(Request $request, $bioID) {
        $inputs = Validator::make($request->all(), [
            // 'photo' => 'required|image|mimes:jpg,png|max:1000|dimensions:min_width=451,min_height=512',
        ]);
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        }
        else {
            $input = $inputs->validated();
            $searchTenant = $request->session()->get('tenant');
            $tenant = Tenant::find($searchTenant);
            if (!empty($tenant)) {
                if($request->has('photo')){
                    try {
                        // $photo = $request->file('photo');
                        // $ext = $request->file('photo')->getClientOriginalExtension();

                        // $name = $tenant->id.'biophoto'.'.'.$ext;
                        // $path = $photo->move(public_path('/media/tenants/'.$tenant->id.'/img'), $name);
                        $safeName = $tenant->id.'biophoto'.'.'.'png';
                        $save_path = public_path().'/media/tenants/'.$tenant->id.'/img/';
                        if (!file_exists($save_path)) {
                            mkdir($save_path, 0755, true);
                        }
                        try {
                            $file = $save_path.$safeName;
                            $success = Image::make(file_get_contents($request['photo']))->resize(650, 799, function ($constraint) {
                                $constraint->aspectRatio();
                            })->save($file);
                        } catch (PostTooLargeException $th) {
                            return response()->json(['errors' => $th], 400);
                        }
                        // file_put_contents(public_path().'/media/tenants/'.strtolower(tenant('id')).'/img', $file);
                        $input['photo'] = $safeName;
                        Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

                        DB::connection('mysql')->reconnect();
                        DB::setDatabaseName($tenant->tenancy_db_name);
                        if (!empty($request->id)) {
                            $ID = $request->id;
                            $photoSave = DB::table('bios')->where('id', $ID)->update($input);
                            DB::table('bios')->where('id', $ID)->update(['image_changed' => 1]);
                            $updated = DB::table('bios')->first();
                        }
                        else {
                            $photoSave = DB::table('bios')->insert(['photo' => $input['photo'], 'image_changed' => 1, 'created_at' => now(), 'updated_at' => now()]);
                            $updated = DB::table('bios')->first();
                        }
                        // Check the bio and get the names eg. FNAME, LNAME, ONAME
                        
                        return response(['bio' => $updated, 'message' => 'Update Success', 'status' => 200], 200);
                    } catch (PostTooLargeException $th) {
                        return response()->json(['errors' => $th], 400);
                    }
                    
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
                Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenant->tenancy_db_name);
                // Check the bio and get the names eg. FNAME, LNAME, ONAME
                $cvUnderGrad = DB::table('c_v__undergrad__schools')->first();
                if (!empty($cvUnderGrad)) {
                    $input['updated_at'] = now();
                    $gradSchool = DB::table('c_v__undergrad__schools')->where('id', !null)->update($input);
                }
                else {
                    $input['created_at'] = now();
                    $input['updated_at'] = now();
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
            // 'type' => 'nullable',
        ]);
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        }
        else {
            $input = $inputs->validated();
            $searchTenant = $request->session()->get('tenant');
            $tenant = Tenant::find($searchTenant);
            if (!empty($tenant)) {
                Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenant->tenancy_db_name);
                // Check the bio and get the names eg. FNAME, LNAME, ONAME
                $cvUnderGrad = DB::table('c_v__medical__schools')->first();
                if (!empty($cvUnderGrad)) {
                    $input['updated_at'] = now();
                    $gradSchool = DB::table('c_v__medical__schools')->where('id', !null)->update($input);
                }
                else {
                    $input['created_at'] = now();
                    $input['updated_at'] = now();
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
                Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenant->tenancy_db_name);
                // Check the bio and get the names eg. FNAME, LNAME, ONAME
                $internship = DB::table('c_v__trainings')->where('type', 'internship')->first();
                if (!empty($internship)) {
                    $input['updated_at'] = now();
                    $internship = DB::table('c_v__trainings')->where('type', 'internship')->update($input);
                }
                else {
                    $input['created_at'] = now();
                    $input['updated_at'] = now();
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
                Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenant->tenancy_db_name);
                // Check the bio and get the names eg. FNAME, LNAME, ONAME
                $fellowship = DB::table('c_v__trainings')->where('type', 'fellowship')->first();
                if (!empty($fellowship)) {
                    $input['updated_at'] = now();
                    $fellowship = DB::table('c_v__trainings')->where('type', 'fellowship')->update($input);
                }
                else {
                    $input['created_at'] = now();
                    $input['updated_at'] = now();
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
                Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenant->tenancy_db_name);
                // Check the bio and get the names eg. FNAME, LNAME, ONAME
                $residency = DB::table('c_v__trainings')->where('type', 'residency')->first();
                if (!empty($residency)) {
                    $input['updated_at'] = now();
                    $residency = DB::table('c_v__trainings')->where('type', 'residency')->update($input);
                }
                else {
                    $input['created_at'] = now();
                    $input['updated_at'] = now();
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
            'city_id' => 'nullable',
        ]);
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 400);
        }
        else {
            $input = $inputs->validated();
            $searchTenant = $request->session()->get('tenant');
            $tenant = Tenant::find($searchTenant);
            if (!empty($tenant)) {
                Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenant->tenancy_db_name);
                // Check the bio and get the names eg. FNAME, LNAME, ONAME
                if ($request->has('id')) {
                    $input['updated_at'] = now();
                    $experience = DB::table('c_v__experiences')->where('id', $request->id)->update($input);
                    $lastID = $request->id;
                }
                else {
                    $input['created_at'] = now();
                    $input['updated_at'] = now();
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
                Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenant->tenancy_db_name);
                // Check the bio and get the names eg. FNAME, LNAME, ONAME
                if ($request->has('id')) {
                    $input['updated_at'] = now();
                    $additonalQualication = DB::table('c_v__additional__schools')->where('id', $request->id)->update($input);
                    $lastID = $request->id;
                }
                else {
                    $input['created_at'] = now();
                    $input['updated_at'] = now();
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
        $data = json_decode($request->input('data'));
        $removed = json_decode($request->input('removed'));
        $inputs = Validator::make($request->all(), [
            // 'data' => 'nullable',
            'data.*.title' => 'nullable',
            'data.*.description' => 'nullable',
            'data.*.icon' => 'nullable|image|mimes:jpg,png|max:10',
        ]);
        if ($inputs->fails()) {
            return response($inputs->errors()->all(), 501);
        } else {
            $input = $inputs->validated();
            $searchTenant = $request->session()->get('tenant');
            $tenant = Tenant::find($searchTenant);
            if (!empty($tenant)) {
                Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

                DB::connection('mysql')->reconnect();
                DB::setDatabaseName($tenant->tenancy_db_name);
                // Check the bio and get the names eg. FNAME, LNAME, ONAME
                $services = DB::table('services');
                foreach ($data as $row) {
                    $checkIfAlreadyInserted = $services->where('interest_id', $row->id)->first();
                    if ($checkIfAlreadyInserted == null) {
                        $data = [
                            'interest_id' => $row->id,
                            'created_at' => now(),
                            'updated_at' => now(),
                            'description' => $row->description,
                            'title' => $row->title,
                            'index' => $row->id + 1,
                        ];
                        $services->insert($data);
                    }
                }
            }
            if ($services == true) {
                return response()->json(['message' => 'Success', 'service' => $services, 'status' => 201], 201);
            }
            else {
                return response()->json(['message' => 'No data updated', 'service' => $services], 200);
            }
        }
    }

    public function sendMailForDomainRegistry(Request $request) {
        $value = $request->session()->pull('tenant', 'default'); //
        $valueOfMail = $request->session()->get('email');
        $valueOfCode = $request->session()->get('code');
        $this->validate($request, [
            'password' => 'required',
            'plan' => 'required',
            'domain' => 'required',
        ]);
        if (!empty($value) && $value !== 'default') {
            $orders = AdminClientOrder::where([['tenant_id', $value], ['claimed', null], ['email', $valueOfMail]])->orWhere([['tenant_id', $value], ['claimed', null], ['code', $valueOfCode]])->first();
            $valueOfMail = !empty($orders) ? $orders->email : $valueOfMail;
            $userToUpdate = User::where('email', $valueOfMail)->first();
            // dd($userToUpdate, $valueOfCode, $valueOfMail, $orders);
            $detail = [
                "password" => $request->get('password'),
                "names" => $userToUpdate->firstname.' '.$userToUpdate->lastname,
                "domain" => $request->get('domain'),
                "email" => $valueOfMail,
            ];
            // dd($valueOfMail, $valueOfCode, $detail);
            if (!empty($orders) || $userToUpdate->registration_completed === 'Pending') {
                $authUser = $userToUpdate->id;
                $tenant = Tenant::find($value);
                $tenant->user_id = $authUser;
                !empty($orders) ? $orders->claimed = 1 : null;
                $tenantSave = $tenant->save();
                !empty($orders)  ? $orderSave = $orders->save() : null;
                $orderSave = null;
                Mail::to($valueOfMail)->send(new ServiceCreated($detail));
                if ($tenantSave === true || $orderSave) {
                    $userToUpdate->plan = $request->plan == 'freemium' ? 'F' : 'P';
                    $userToUpdate->registration_completed = 'Active';
                    $userToUpdate->save();
                    $request->get('tenantOnDemand') == 1 ? $this->generateIntro($tenant, $valueOfMail) : null;
                    Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

                    DB::connection('mysql')->reconnect();
                    DB::setDatabaseName($tenant->tenancy_db_name);
                    $tenantUser = DB::table('tenant_users')->get();
                    if ($tenantUser != null) {
                        DB::table('tenant_users')->where('user_id', '!=' , null )->update(['user_id' => $authUser]);
                        $request->session()->pull('email', 'default');
                        return response()->json(['message' => 'Email Sent, Check inbox.', 'user' => $authUser], 201);
                    }
                    // Send Email to user
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

    /**
     ** Generates the CV Intro automatically for a user: This is for starters only
     *
     * $seedWord = `Dr. Dionne Ibekie is an expert in Aestheistiologist with an M.D. from Pittsburgh School of Medicine and an undergraduate degree in Sociology from the University of Michigan- Ann Arbor.
     * She started out as an intern at the UPMC Shadyside hospital, then proceeded to Brigham and Women’s Hospital for her residency.
     * With more than 10 years of experience as an anaesthesiologist, she has dedicated years to patient care throughout every surgical experience.
     * She is currently the Assistant Medical Director/Staff Anesthesiologist.
     * She keeps lending her voice to the audience by making local and international media rounds by featuring on Middays with Perri Small, Channels Tv, and The Ivy Drip podcast.
     * She has been a recipient of numerous awards in and out of her fields such as the University of Pittsburgh School of Medicine Dean’s Merit Scholarship, Carolyn Carter Excellence Award, and many others.'`
     *
     * Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);
     * DB::connection('mysql')->reconnect();
     * DB::setDatabaseName($tenant->tenancy_db_name);
    **/

    public function generateIntro($tenant, $email) {
        // Gets the DBs to make all calls from
        $user = User::where('email', $email)->first();
        Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

        DB::connection('mysql')->reconnect();
        DB::setDatabaseName($tenant->tenancy_db_name);

        $bioDb = DB::table('bios')->first();
        $cvMedDb = DB::table('c_v__medical__schools')->first();
        $cvUndergradDb = DB::table('c_v__undergrad__schools')->first();
        $cvIntern = DB::table('c_v__trainings')->where('type', 'internship')->first();
        $cvFellowship = DB::table('c_v__trainings')->where('type', 'fellowship')->first();
        $cvResidency = DB::table('c_v__trainings')->where('type', 'residency')->first();
        $achievementDb = DB::table('achievements')->first();
        $servicesDb = DB::table('services')->first();
        $cvExperience = DB::table('c_v__experiences')->first();
        $publicFeaturingDb = DB::table('public_featurings')->latest()->get();
        if ($bioDb->gender !== null) {
            $pronoun = "";
            $address = "";
            $pronounCaps = "";
            switch ($bioDb->gender) {
                case 'M':
                    $pronoun = 'he';
                    $address = 'his';
                    $pronounCaps = 'He';
                    break;
                case 'F':
                    $pronoun = 'she';
                    $address = 'her';
                    $pronounCaps = 'She';
                    break;
                case 'O':
                    $pronoun = 'they';
                    $address = 'them';
                    $pronounCaps = 'They';
                    break;
                default:
                    $pronoun = 'he';
                    $address = 'his';
                    $pronounCaps = 'He';
                    break;
            }
        }
        // $pronoun = $bioDb->gender !== null ? ($bioDb->gender === 'M' ? 'he' : 'she' : $bioDb->gender === 'O' ? 'they': ) 'he';
        // $address = $bioDb->gender !== null ? $bioDb->gender === 'M' ? 'his' : 'her' : 'his';
        // $pronounCaps = $bioDb->gender !== null ? $bioDb->gender === 'M' ? 'He' : 'She' : 'He';
        // $addressCaps = $bioDb->gender !== null ? $bioDb->gender === 'M' ? 'His' : 'Her' : 'His';

        $seedBioA = '';
        $seedMedA = '';
        $seedGradA = '';
        $seedInternA = '';
        $seedResidencyA = '';
        $seedExpA = '';
        $seedCurrExpB = '';
        $seedServiceA = '';
        $seedPublicFeaturesA = '';
        $seedAwardsA = '';
        $feat = '';

        Config::set('database.connections.mysql.database', env('DB_DATABASE'));

        DB::connection('mysql')->reconnect();
        DB::setDatabaseName(env('DB_DATABASE'));
        $degree = Title::where('id', $bioDb->title_id)->first()->name;
        if ($bioDb !== null) {
            // dd($bioDb);
            $seedBioA = 'Dr. '.$bioDb->firstname.' '.$bioDb->lastname.' ';
        }
        
        if ($cvMedDb !== null) {
            $seedMedA = 'a physician with a '.$degree.'.'.' from '.$cvMedDb->institution.'. ';
        }
        if ($cvUndergradDb !== null) {
            $seedGradA = 'I have an undergraduate degree of '.$cvUndergradDb->major.' from the '.$cvUndergradDb->institution.'. ';
        }
        if ($cvIntern !== null) {
            $seedInternA = $pronounCaps.' started out as an intern at the '.$cvIntern->institution;
        }
        if ($cvResidency !== null) {
            $seedInternCheckA = $cvIntern !== null ? ' , ' : '';
            $seedResidencyA = $cvIntern !== null ? $seedInternCheckA.' '.$pronoun.' then proceeded to '.$cvResidency->institution.' for '.$address.' residency. ' : $pronounCaps.' did '.$address.' residency at '.$cvResidency->institution.'. ';
        }
        if ($cvExperience !== null) {
            $feat = $achievementDb !== null ? json_decode(json_decode($achievementDb->feats)) : $feat;

            $seedExpA = $feat !== '' ? ' With more than '.$feat->experience.' of experience, ' : ' With years of experience, ';
            $seedCurrExpB = $pronoun.' is currently working at '.$cvExperience->institution.'. ';
        }
        if ($servicesDb !== null) {
            $seedServiceA = 'My dedication as a physician is equal to none, I render services as a physician. '; //'.$servicesDb->title.'
        }
        if ($publicFeaturingDb->count() !== 0){
            $seedPublicFeaturesA = $pronounCaps.' keeps lending '.$address.' voice to the audience by making local and international media rounds by featuring on '.$publicFeaturingDb[0]->title.'. ';
        }
        if ($achievementDb !== null) {
            $seedAwardsA = $pronounCaps.' also is a recipient of numerous awards in and out of '.$address.' fields such as the University of Pittsburgh School of Medicine Dean’s Merit Scholarship, Carolyn Carter Excellence Award, and many others. ';
        }
        Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

        DB::connection('mysql')->reconnect();
        DB::setDatabaseName($tenant->tenancy_db_name);
        $seedWord = $seedMedA . $seedGradA . $seedInternA . $seedResidencyA . $seedExpA . $seedCurrExpB . $seedServiceA. $seedPublicFeaturesA . $seedAwardsA; //$seedBioA . 
        DB::table('bios')->where('id', !null)->update(['about' => $seedWord]);
    }
}
