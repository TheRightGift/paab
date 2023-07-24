<?php

namespace App\Http\Services\Auth;

use App\Mail\DeviceChanged;
use App\Models\AdminClientOrder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

use App\Notifications\MailOTP;

use App\Models\User;
use App\Models\Tenant;
use App\Models\Verifier;

use Carbon\Carbon;
use Cookie;

$mail = '';

class EmailAuthService
{
    protected function dataToValidate(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        $validator = $request->validate([
            'firstname' => 'nullable',
            'lastname' => 'nullable',
            'othername' => 'nullable',
            'username' => 'nullable',
            'password' => 'nullable|confirmed',
            'phone' => 'nullable',
            'email' => 'nullable',
            'avatar' => 'nullable',
            'gender' => 'nullable',
            'plan' => 'nullable',
            'DOB' => 'nullable|date'
        ]);
        return $validator;
    }

    protected function emailDataValidation(Request $request)
    {
        $validator = $request->validate([
            'email' => 'email|required|unique:users'
        ]);
        
        return $validator;
    }

    protected function passwordResetDataValidation(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        $validator = $request->validate([
            'email' => 'email|required',
            'password' => 'required',
        ]);
        return $validator;
    }

    protected function regDataToValidate(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        $validator = $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            // 'othername' => 'nullable',
            'zipcode' => 'nullable',
            'phone' => 'required|unique:users',
            'email' => 'email|required|unique:users',
            'password' => 'required',
            // 'city_id' => 'required',
            'role' => 'nullable',
            'gender' => 'required'
        ]);
        return $validator;
    }

    public function login(Request $request): array | Request
    {
        if ($request->has('email')) {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
            ];

            if (Auth::attempt($credentials)) {
                $user = Auth::user();
                if ($user->role === 'Developer' && $user->registration_completed === 'Active') {
                    return ['status' => 200, 'user' => auth()->user(), 'access_token' => $this->saveUserAgent()];
                    $this->saveUserAgent();
                } elseif ($user->role !== 'Developer') {
                    $this->saveUserAgent();
                    return ['status' => 200, 'user' => auth()->user(), 'access_token' => $this->saveUserAgent()];
                } else {
                    Auth::logout();
                    return ["status" => 404, "error" => "Invalid Credentials Or Account Not yet active"];
                }

            } else {
                return ["status" => 404, "error" => "Invalid Credentials"];
            }
        } else {
            return ["status" => 404, "error" => "Invalid Credentials"];
        }



    }
    private function saveUserAgent()
    {
        $accessToken = auth()->user()->createToken('accessToken')->accessToken;
        $user = User::find(auth()->user()->id);
        $user->visits = $user->visits + 1;
        $user->accessToken = $accessToken;
        $user->device_id = $this->getUserAgent();

        $user->save();
        return $accessToken;
    }

    public function pre_login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $users = new User();
        $user = $users->where('email', $credentials['email'])->first();
        if ($user) {
            if (Hash::check($credentials['password'], $user->password)) {
                if ($user->visits !== null) {
                    if ($user->device_id !== $this->getUserAgent()) {
                        $otp = $this->genOTP();
                        $crypted = Crypt::encryptString($otp);
                        $serverAgent = $_SERVER['HTTP_USER_AGENT'];
                        Mail::to($user->email)->send(new DeviceChanged($otp, $serverAgent));
                        return ['status' => 422, 'message' => 'Device changed', 'otp' => $crypted];
                    } else {
                        return $this->login($request);
                    }
                } else {
                    return $this->login($request);
                }
            } else {
                $response = ["status" => 404, "error" => "Invalid Credentials"];
                return $response;
            }
        } else {
            $response = ['status' => 404, "error" => 'Invalid Credentials'];
            return $response;
        }


        // if($user->device_id === $serverDeviceID) {
        //     // Login
        // }
        // else {
        //     // Send an otp to user email
        //     // If
        // }
    }

    private function getUserAgent()
    {
        $serverAgent = $_SERVER['HTTP_USER_AGENT'];
        $firstParenthesis = strpos($serverAgent, '(');
        $secondParenthesis = strpos($serverAgent, ')');
        $string = substr($serverAgent, $firstParenthesis, $secondParenthesis - $firstParenthesis + 1);
        return $string;
    }

    private function confirmEmail($email)
    {
        $user = new User();
        $userEmail = $user->where('email', $email)->first();

        if (!empty($userEmail)) {
            return ['user' => $userEmail, 'status' => 200];
        } else {
            return 404;
        }
    }

    private function genOTP()
    {
        return sprintf("%06d", mt_rand(1, 999999));
    }

    private function maileOTP($email, $otp)
    {
        //  Get the $email and $otp generated
        (new User())->forceFill([
            'otp' => $otp,
            'email' => $email,
        ])->notify(new MailOTP($otp));
    }

    public function register(Request $request)
    {
        $regData = $this->regDataToValidate($request);

        if ($regData->fails()) {
            return ['status' => 501, 'error' => $regData->errors()->all()];
        } else {
            $findUser = User::where('email', $request->email)->get();

            if(count($findUser) < 1) {
                $input = $regData->validated();
                $input['password'] = Hash::make($request->password);
                $user = User::create($input);
                // if ($input['role'] == 'Developer') {
                //     dd('Developer');
                //     // Send a mail later
                // }

                $accessToken = $user->createToken('accessToken')->accessToken;

                return ['status' => 200, 'user' => $user, 'access_token' => $accessToken];
            } else {
                return ['status' => 501, 'error' => 'An account with this detail exists.'];
            }
        }
    }

    public function updateEmailValidation($id)
    {
        $user = new User();
        $userDetails = $user->where('id', $id)->first();

        if (!empty($userDetails)) {
            $now = Carbon::now()->timestamp;
            $updateUser = $userDetails->update(['email_verified_at' => $now]);
            if ($updateUser == true) {
                return ['status' => 200, 'user' => $updateUser];
            }
        } else {
            return ['status' => 404, 'error'=>'Not Found'];
        }
    }

    public function verifyUserEmail($request)
    {
        $data = $this->emailDataValidation($request);
        if ($data->fails()) {
            return response()->json(['errors' => $data->errors()->all()]);
        } else {
            $input = $data->validated();
            $userVerified = $this->confirmEmail($input['email']);

            if($userVerified == 200) {//verified
                $otp = $this->genOTP();
                return ['status' => 200, 'otp' => $otp];
                // TODO: mail OTP to $input['email']

                // Create verifier Mode, Migration and save otp against email
            } else {//!verified
                return ['status' => 404, 'error' => 'User with this email not found.'];
            }
        }
        
    }

    public function verifyEmailForRegistration($request)
    {
        $data = $this->emailDataValidation($request);
        
        if($data['email']){
            $otp = $this->genOTP();
            $crypted = Crypt::encryptString($otp);
            $this->maileOTP($data['email'], $otp);

            return ['status' => 200, 'otp' => $crypted];
        }  
        // return ['status' => 404, 'error' => 'Account with this email exists.'];
    }

    public function verifyEmailForWebsiteEdit($request)
    {
        $data = $this->emailDataValidation($request);
        if ($data->fails()) {
            return response()->json(['errors' => $data->errors()->all()]);
        } else {
            $input = $data->validated();
            $userVerified = $this->confirmEmailOnAdminClientTable($input['email']);
            if($userVerified == 200) {//verified that email does exist
                $otp = $this->genOTP();
                $crypted = Crypt::encryptString($otp);
                $this->maileOTP($input['email'], $otp);

                return ['status' => 200, 'otp' => $crypted];
            } else {//!verified
                return ['status' => 404, 'error' => 'Account with this email exists.'];
            }
        }
    }

    public function resetPassword($request)
    {
        $data = $this->passwordResetDataValidation($request);
        if ($data->fails()) {
            return ['status' => 501, 'error' => $data->errors()->all()];
        } else {
            $input = $data->validated();
            $verifyUserEmail = $this->confirmEmail($input['email']);

            if($verifyUserEmail['status'] == 200) {//verified
                $encryptedPass = bcrypt($request->password);
                $updateUser = $verifyUserEmail['user']->update(['password' => $encryptedPass]);
                if ($updateUser == true) {
                    return ['status' => 200, 'msg' => 'Password successfully reset.'];
                }
            } else {//!verified
                return ['status' => 404, 'error' => 'User with this email not found.'];
            }
        }
    }

    public function sendOtpForUserResetPassword($request)
    {
        $data = $this->emailDataValidation($request);
        if ($data->fails()) {
            return ['status' => 501, 'error' => $data->errors()->all()];
        } else {
            $input = $data->validated();
            $verifyUserEmail = $this->confirmEmail($input['email']);
            if($verifyUserEmail['status'] == 200) {//verified
                $otp = $this->genOTP();
                // TODO: Store  the OTP in a verifier TB
                $verifier = new Verifier();
                $existingUserVerifier = $verifier->where('user_id', $verifyUserEmail['user']->id)->first();
                $this->maileOTP($input['email'], $otp);
                if ($existingUserVerifier == null) {
                    return $this->createVerifier($verifier, $verifyUserEmail['user']->id, $otp);
                } else {
                    return $this->createVerifier($existingUserVerifier, $existingUserVerifier->id, $otp);
                }

                return ['status' => 200, 'message' => 'OTP sent to '.$input['email']];
            } else {//!verified
                return ['status' => 404, 'error' => 'This email does not exist.'];
            }
        }
    }

    private function createVerifier($verifier, $user_id, $otp)
    {
        $verifier->user_id = $user_id;
        $verifier->otp = $otp;
        $verifier->expiry = Carbon::now()->addMinutes(60);
        $verifier->save();

        return ['status' => 200, 'message' => 'OTP Verified'];
    }

    private function confirmEmailOnAdminClientTable($email)
    {
        $GLOBALS['mail'] = $email;
        return tenancy()->central(function ($tenant) {
            $adminClientOrders = new AdminClientOrder();
            $email = $adminClientOrders->where('email', $GLOBALS['mail'])->first();
            if (!empty($email)) {
                return 200;
            } else {
                return 404;
            }
        });
    }

    public function verifyOtPs(Request $request)
    {
        $veriferData = $request->validate([
            'email' => 'email|required',
            'otp' => 'required'
        ]);
        $userIdToVerify = User::where('email', $request->email)->first();
        $verifier = new Verifier();
        $checker = $verifier->where([['otp', $request->otp], ['user_id', $userIdToVerify->id]])->first();
        if (!empty($checker)) {
            return ['message' => 'OTP Verified', 'status' => 200];
        } else {
            return ['message' => 'OTP mismatch', 'status' => 404];
        }
    }

    private function update($request, $id)
    {
        $data = $this->dataToValidate($request);
        if ($data->fails()) {
            return response()->json(['errors' => $data->errors()->all()]);
        } else {
            $input = $data->validated();
            $user = new User();
            $userDetails = $user->where('id', $id)->first();

            if (!empty($userDetails)) {
                $updateUser = $userDetails->update($input);
                if ($updateUser == true) {
                    return ['status' => 200, 'user' => $updateUser];
                }
            } else {
                return ['status' => 404, 'error'=>'Not Found'];
            }
        }
    }


    /**
     * This function request for old password in order to change to new one
     */
    public function changePassword(Request $request)
    {
        $status = 401;
        $response = ['error' => 'Unauthorised'];
        $user = Auth::user();
        if ($user) {
            // dd($request->oldPass, $user->password);
            $password = $user->password;
            $old_pass = $request->oldPass;
            if (Hash::check($old_pass, $password)) {
                // The passwords match...
                $data = $request->password;

                $newPass = $request->user()->fill([
                    'password' => Hash::make($data)
                ])->save();
                return [
                    'user' => $newPass,
                    'message' => 'Password Changed Successfully'
                ];
            } else {
                return ['error' => $status];
            }
        } else {
            return response()->json($response);
        }
    }

    public function check_password()
    {
        $user = Auth::user();
        if ($user) {
            if (Hash::check($user->email, $user->password)) {
                return ['status' => 401, 'message' => 'Update password'];
            } else {
                return ['status' => 200, 'message' => 'Ok'];
            }
        }
    }
}
