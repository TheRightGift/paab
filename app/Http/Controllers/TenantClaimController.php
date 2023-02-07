<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Tenant;
use App\Models\AdminClientOrder;

use Illuminate\Support\Facades\Hash;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;

class TenantClaimController extends Controller
{
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
            if (!empty(Session::get('email'))) {
                $input['email'] = Session::get('email');
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
    // Saves User bioData encase of update

    /**
     * @throws ValidationException
     */
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
            $tenantToFind = Session::get('tenant');
            $tenant = Tenant::find($tenantToFind);
            if (!empty($tenant)) {
                Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

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

    /**
     * @throws ValidationException
     */
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

                    Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

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
                Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

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
                Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

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
                Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

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
                Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

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
                Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

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
                Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

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
                Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

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
                Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

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
                $this->generateIntro($tenant, $valueOfMail);
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
                    Config::set('database.connections.mysql.database', $tenant->tenancy_db_name);

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
        $publicFeaturingDb = DB::table('public_featurings')->get();
//        $awardDb = DB::table('awards')->first();
        $pronoun = $user->gender !== null ? $user->gender === 'M' ? 'he' : 'she' : 'he';
        $address = $user->gender !== null ? $user->gender === 'M' ? 'his' : 'her' : 'his';

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

        if ($bioDb !== null) {
            $seedBioA = 'Dr. '.$bioDb->firstname.' '.$bioDb->lastname.' ';
        }
        if ($cvMedDb !== null) {
            $seedMedA = 'is an expert in '.$cvMedDb->type.' with an M.D. from '.$cvMedDb->institution;
        }
        if ($cvUndergradDb !== null) {
            $seedGradCheckA = $cvMedDb !== null ? 'and ' : '';
            $seedGradA = $seedGradCheckA.'an undergraduate degree'.$cvUndergradDb->major.' from the '.$cvUndergradDb->institution.'.';
        }
        if ($cvIntern !== null) {
            $seedInternA = $pronoun.' started out as an intern at the '.$cvIntern->institution;
        }
        if ($cvResidency !== null) {
            $seedInternCheckA = $cvIntern !== null ? ', ' : '';
            $seedResidencyA = $cvIntern !== null ? $seedInternCheckA.'then proceeded to '.$cvResidency->institution.' for '.$address.' residency.' : $pronoun.' did '.$address.' residency at'.$cvResidency->institution;
        }
        if ($cvExperience !== null) {
            $feat = json_decode(json_decode($achievementDb->feats));

            $seedExpA = ' With more than '.$feat->experience.' years of experience as an '.$cvMedDb->type.', ';
            $seedCurrExpB = ' '.$pronoun.' is currently the '.$cvExperience->position.' at '.$cvExperience->institution;
        }
        if ($servicesDb !== null) {
            $seedServiceA = $pronoun.' has dedicated years to patient care throughout every '.$servicesDb->title.' experience';
        }
        if ($publicFeaturingDb !== null){
            $seedPublicFeaturesA = '. '.$pronoun.' keeps lending '.$address.' voice to the audience by making local and international media rounds by featuring on '.$publicFeaturingDb[0]->title.'.';
        }
        if ($achievementDb !== null) {
            $seedAwardsA = '. '.$pronoun.' has been a recipient of numerous awards in and out of '.$address.' fields such as the University of Pittsburgh School of Medicine Dean’s Merit Scholarship, Carolyn Carter Excellence Award, and many others.';
        }
        $seedWord = $seedBioA . $seedMedA . $seedGradA . $seedInternA . $seedResidencyA . $seedExpA . $seedServiceA . $seedCurrExpB . $seedPublicFeaturesA . $seedAwardsA;
        DB::table('bios')->where('id', !null)->update(['about' => $seedWord]);
    }
}