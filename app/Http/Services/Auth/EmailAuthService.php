<?php
namespace App\Http\Services\Auth;

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Tenant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
            'phon' => 'nullable',
            'email' => 'nullable',
            'profilePicUrl' => 'nullable',
            'gender' => 'nullable',
            'plan' => 'nullable',
            'DOB' => 'nullable|date'  
		]);
        return $validator;
    }

    public function login(Request $request){
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);        

        if (!auth()->attempt($loginData)) {
            return ['status' => 501, 'message' => 'Invalid Credentials'];
        }
        
        $accessToken = auth()->user()->createToken('accessToken')->accessToken;

        return ['status' => 200, 'user' => auth()->user(), 'access_token' => $accessToken];
    }

    public function register(Request $request){
        $validatedData = $request->validate([
            'firstname' => 'required|max:55',
            'lastname' => 'required|max:55',
            'email' => 'email|required|unique:users',
            'phone' => 'required|unique:users',
            'password' => 'required'
        ]);


        $findUser = User::where('email', $request->email)->first();

        if(!$findUser){
            $validatedData['password'] = bcrypt($request->password);

            $user = User::create($validatedData);

            $accessToken = $user->createToken('accessToken')->accessToken;

            return [ 'user' => $user, 'access_token' => $accessToken];
        } else {
            return ['message' => 'An account with this detail exists.'];
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
        }
        else return ['status' => 404, 'error'=>'Not Found'];
    }

    public function verifyUserEmail($request){
        $data = $this->dataToValidate($request);
        if ($data->fails()){
            return response()->json(['errors' => $data->errors()->all()]);
        } else {
            $input = $data->validated();
            $userVerified = $this->confirmEmail($input['email']);

            if($userVerified == 200){//verified
                $otp = $this->genOTP();

                // TODO: mail OTP to $input['email']
            } else {//!verified
                return ['status' => 404, 'error' => 'User with this email not found.'];
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
                    return ['status' => 200, 'Password successfully reset.'];
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

}