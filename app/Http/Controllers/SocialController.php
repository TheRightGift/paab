<?php
 namespace App\Http\Controllers;
//  use Illuminate\Http\Request;
//  use Validator,Redirect,Response,File;
//  use Illuminate\Foundation\Auth\AuthenticatesUsers;
//  use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class SocialController extends Controller{

    // public function fbRedirect()
    // {
    //     return Socialite::driver('facebook')->stateless()->redirect();
    // }

    // public function fbCallback(){
    //     $userSocial = Socialite::driver('facebook')->stateless()->user(); 
    //     $this->socialAuth($userSocial);      
    // }

    // public function twRedirect()
    // {
    //     return Socialite::driver('twitter')->stateless()->redirect();
    // }

    // public function twCallback()
    // {
    //     $userSocial = Socialite::driver('twitter')->stateless()->user(); 
    //     $this->socialAuth($userSocial);
    // }

    // public function liRedirect()
    // {
    //     return Socialite::driver('linkedin')->stateless()->redirect();
    // }

    // public function liCallback()
    // {
    //     $userSocial = Socialite::driver('linkedin')->stateless()->user(); 

    //     $this->socialAuth($userSocial);
    // }

    public function redirect($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function callback($provider)
    {
        $userSocial = Socialite::driver($provider)->stateless()->user();
        $this->socialAuth($userSocial, $provider);
    }

    private function socialAuth($userSocial, $provider)
    {
        // dd($provider, $userSocial);
        $findUser = User::where([['provider', $provider], ['provider_id', $userSocial->id]], ['email', $userSocial->email])->first();
        
        if($findUser){
            $userToken = $findUser->createToken('accessToken')->accessToken;
            $findUser->accessToken = $userToken;
            // $findUser->fb_token = $userSocial->token;
            //If user has no nickname
            if($findUser->username === null || $findUser->username === ''){
                //genrate one and update
                $nName = substr($findUser->firstname, 0, 1).$findUser->lastname;

                // is this nickname exist?
                $nicknameExists = User::where('username', $nName)->first();
                if($nicknameExists){
                    $nName = $nName.$findUser->id;
                }

                $findUser->username = $nName;
            }                
            
            $findUser->save();
            auth()->login($findUser, true);
            dd($findUser);
            return redirect('/');
            // return response()->json(['token' => $userToken]);
        } else {
            $pass = bcrypt(7007007);
            $name = $userSocial->name;
            $name = explode(" ",$name);
            $nameLen = count($name);
            
            if($nameLen == 2){
                $fName = $name[0];
                $lName = $name[1];
                $oName = "";
            } else {
                $fName = $name[0];
                $lName = $name[2];
                $oName = $name[1];
            }     

            // $this->generateUsername($userSocial);
               
            
            $user = User::create([
                'fb_id' => $userSocial->id,
                'firstname'     => $fName,
                'lastname'     => $lName,
                'othername'     => $oName,
                'username' => $userSocial->nickname,
                'email'    => $userSocial->email,
                'provider_id' => $userSocial->id,
                'provider' => $provider,
                'avatar' => $userSocial->getAvatar(),
                'password' => $pass,
            ]);

            if($user){
                $userToken = $user->createToken('accessToken')->accessToken;
                $user->accessToken = $userToken;

                //If user has no nickname
                // if($user->nickname === null || $user->nickname === ''){
                //     //genrate one and update
                //     $nName = substr($user->firstname, 0, 1).$user->lastname;

                //     // is this nickname exist?
                //     $nicknameExists = User::where('nickname', $nName)->first();
                //     if($nicknameExists){
                //         $nName = $nName.$user->id;
                //     }

                //     $user->nickname = $nName;
                // }   

                $user->save();
                dd($user);
                // auth()->login($user, true);

                return redirect('/');
                // return response()->json(['token' => $userToken]);
                   
            }
        }
    }

    public function generateUsername($userSocDetails){
        if($userSocDetails->nickname === null){
            //genrate one and update
            $nName = substr($userSocDetails->firstname, 0, 1).$findUser->lastname;

            // is this nickname exist?
            $nicknameExists = User::where('nickname', $nName)->first();
            if($nicknameExists){
                $nName = $nName.$findUser->id;
            }

            $findUser->nickname = $nName;
        }   
    }
}