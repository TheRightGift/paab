<?php
namespace App\Http\Services\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;

use App\Notifications\MailOTP;

use App\Models\User;
use App\Models\Tenant;

use Carbon\Carbon;

class EmailAuthService {

    protected function dataToValidate(Request $request)
	{
		$validator = Validator::make($request->all(), [
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

    protected function dataToValidateForEmailVerification(Request $request)
	{
		$validator = Validator::make($request->all(), [
            'email' => 'email|required',
		]);
        return $validator;
    }

    protected function regDataToValidate(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'firstname' => 'required',
            'lastname' => 'required',
            // 'othername' => 'nullable',
            // 'username' => 'nullable',
            'phone' => 'required|unique:users',
            'email' => 'email|required|unique:users',
            'password' => 'required' 
		]);
        return $validator;
    }

    public function login(Request $request){
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);        

        if (!auth()->attempt($loginData)) {
            return ['status' => 501, 'error' => 'Invalid Credentials'];
        }
        $accessToken = auth()->user()->createToken('accessToken')->accessToken;

        return ['status' => 200, 'user' => auth()->user(), 'access_token' => $accessToken];
    }

    public function register(Request $request){
        $regData = $this->regDataToValidate($request);

        if ($regData->fails()){
            return ['status' => 501, 'error' => $regData->errors()->all()];
        } else {
            $findUser = User::where('email', $request->email)->get();
            
            if(count($findUser) < 1){
                $input = $regData->validated();
                $input['password'] = bcrypt($request->password);
                $user = User::create($input);

                $accessToken = $user->createToken('accessToken')->accessToken;

                return ['status' => 200, 'user' => $user, 'access_token' => $accessToken];
            } else {
                return ['status' => 501, 'error' => 'An account with this detail exists.'];
            }
        }
    }

    public function updateEmailValidation($id){
        $user = new User();
        $userDetails = $user->where('id', $id)->first();

        if (!empty($userDetails)) {
            $now = Carbon::now()->timestamp;
            $updateUser = $userDetails->update(['email_verified_at' => $now]);
            if ($updateUser == true){
                return ['status' => 200, 'user' => $updateUser];
            }
        } else {
            return ['status' => 404, 'error'=>'Not Found'];
        }
    }

    public function verifyUserEmail($request){
        $data = $this->dataToValidateForEmailVerification($request);
        if ($data->fails()){
            return response()->json(['errors' => $data->errors()->all()]);
        } else {
            $input = $data->validated();
            $userVerified = $this->confirmEmail($input['email']);

            if($userVerified == 200){//verified
                $otp = $this->genOTP();
                return ['status' => 200, 'otp' => $otp];
                // TODO: mail OTP to $input['email']
                
                // Create verifier Mode, Migration and save otp against email
            } else {//!verified
                return ['status' => 404, 'error' => 'User with this email not found.'];
            }
        }        
    }

    public function verifyEmailForRegistration($request){
        $data = $this->dataToValidateForEmailVerification($request);
        if ($data->fails()){
            return response()->json(['errors' => $data->errors()->all()]);
        } else {
            $input = $data->validated();
            $userVerified = $this->confirmEmail($input['email']);

            if($userVerified == 404){//verified that email doesnt exist
                $otp = $this->genOTP();
                $crypted = Crypt::encryptString($otp);
                $this->maileOTP($input['email'], $otp);
                
                return ['status' => 200, 'otp' => $crypted];
            } else {//!verified
                return ['status' => 404, 'error' => 'Account with this email exists.'];
            }
        }        
    }

    public function resetPassword($request){
        $data = $this->dataToValidate($request);
        if ($data->fails()){
            return response()->json(['errors' => $data->errors()->all()]);
        } else {
            $input = $data->validated();
            $userVerified = $this->confirmEmail($input['email']);

            if($userVerified == 200){//verified
                $encryptedPass = bcrypt($request->password);
                $updateUser = $userDetails->update(['password' => $encryptedPass]);
                if ($updateUser == true){
                    return ['status' => 200, 'msg' => 'Password successfully reset.'];
                }
            } else {//!verified
                return ['status' => 404, 'error' => 'User with this email not found.'];
            }
        }  
    }

    private function confirmEmail($email){
        $user = new User();
        $userEmail = $user->where('email', $email)->first();

        if (!empty($userEmail)) {
            return 200;
        } else {
            return 404;
        }
    }

    private function update($request, $id){
        $data = $this->dataToValidate($request);
        if ($data->fails()){
            return response()->json(['errors' => $data->errors()->all()]);
        } else {
            $input = $data->validated();
            $user = new User();
            $userDetails = $user->where('id', $id)->first();

            if (!empty($userDetails)) {
                $updateUser = $userDetails->update($input);
                if ($updateUser == true){
                    return ['status' => 200, 'user' => $updateUser];
                }
            }
            else return ['status' => 404, 'error'=>'Not Found'];
        }
    }

    private function genOTP(){
        return sprintf("%06d", mt_rand(1, 999999));
    }

    private function maileOTP($email, $otp) {
        //  Get the $email and $otp generated
        (new User)->forceFill([
            'otp' => $otp,
            'email' => $email,
        ])->notify(new MailOTP($otp));
    }

}