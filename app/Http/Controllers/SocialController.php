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
use Illuminate\Support\Facades\Cookie;

class SocialController extends Controller{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->stateless()->redirect();
    }

    public function callback($provider)
    {
        $userSocial = Socialite::driver($provider)->stateless()->user();
        return $this->socialAuth($userSocial, $provider);
    }

    private function socialAuth($userSocial, $provider)
    {
        $findUser = User::where([['provider', $provider], ['provider_id', $userSocial->id]], ['email', $userSocial->email])->first();
        
        print_r($userSocial);
        // if($findUser){
        //     $userToken = $findUser->createToken('accessToken')->accessToken;
        //     Auth::login($findUser);
        //     // $cookie = $this->getCookieDetails($userToken);
        //     // Cookie::queue($cookie['name'], $cookie['value'], ); //$cookie['minutes'], $cookie['path'], $cookie['domain'], $cookie['secure'], $cookie['httponly'], $cookie['samesite']
        //     return redirect('/client/dashboard')->with('token', $userToken);
        // } else {
        //     $pass = bcrypt(7007007);
        //     $name = $userSocial->name;
        //     $name = explode(" ",$name);
        //     $nameLen = count($name);
            
        //     if($nameLen == 2){
        //         $fName = $name[0];
        //         $lName = $name[1];
        //         $oName = "";
        //     } else {
        //         $fName = $name[0];
        //         $lName = $name[2];
        //         $oName = $name[1];
        //     }     

        //     // $this->generateUsername($userSocial);
               
        //     $user = User::create([
        //         'fb_id' => $userSocial->id,
        //         'firstname'     => $fName,
        //         'lastname'     => $lName,
        //         'othername'     => $oName,
        //         'username' => $userSocial->nickname,
        //         'email'    => $userSocial->email,
        //         'provider_id' => $userSocial->id,
        //         'provider' => $provider,
        //         'avatar' => $userSocial->getAvatar(),
        //         'password' => $pass,
        //         'access_token' => $userSocial->token,
        //     ]);

        //     if($user){
        //         Auth::login($user);
        //         // $userToken = auth()->user()->createToken('accessToken')->accessToken;
        //         // return redirect('/client/dashboard')->with('token', $userToken);
        //         // return response()->json(['token' => $userToken]);
        //     }
        // }
    }

    private function getCookieDetails($token)
    {
        return [
            'name' => '_token',
            'value' => $token,
            'minutes' => 1440,
            'path' => '/',
            'domain' => null,
            // 'secure' => true, // for production
            'secure' => null, // for localhost
            'httponly' => false,
            'samesite' => true,
        ];
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