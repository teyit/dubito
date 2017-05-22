<?php

namespace App\Http\Controllers\Auth;


use App\Model\Social;
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Input;
use App\Http\Controllers\Controller;
use App\User;

class SocialController extends Controller
{


    public function getSocialRedirect( $provider )
    {

        $providerKey = Config::get('services.' . $provider);


        if (empty($providerKey)) {

            return view('pages.status')
                ->with('error','No such provider');
        }



        return Socialite::driver( $provider )->scopes(['https://www.googleapis.com/auth/drive'])
            ->with(["access_type" => "offline", "prompt" => "consent select_account"])
            ->redirect();

    }

    public function getSocialHandle($provider)
    {

        if (Input::get('denied') != '') {

            return redirect()->to('login')
                ->with('status', 'danger')
                ->with('message', 'You did not share your profile data with our social app.');
        }


        $user = Socialite::driver( $provider)->scopes(['https://www.googleapis.com/auth/drive'])
            ->scopes(['https://www.googleapis.com/auth/drive'])
            ->with(["access_type" => "offline", "prompt" => "consent select_account"])
            ->user();
        
        if(isset($user->token)){
           Session::put('google_oauth_token',$user->token);
        }
        

        $socialUser = null;

        //Check is this email present
        $userCheck = User::where('email', '=', $user->email)->first();

        $email = $user->email;

        if (!$user->email) {
            $email = 'missing' . str_random(10);
        }

        if (!empty($userCheck)) {

            $socialUser = $userCheck;

        }
        else {

            $sameSocialId = Social::where('social_id', '=', $user->id)
                ->where('provider', '=', $provider )
                ->first();

            if (empty($sameSocialId)) {

                //There is no combination of this social id and provider, so create new one
                $newSocialUser = new User;
                $newSocialUser->email = $email;
                $newSocialUser->name =$user->name;
                $newSocialUser->password = bcrypt(str_random(16));
                $newSocialUser->token = $user->token;
                $newSocialUser->save();

                $socialData = new Social;
                $socialData->social_id = $user->id;
                $socialData->provider= $provider;
                $newSocialUser->social()->save($socialData);

            }
            else {

                //Load this existing social user
                $socialUser = $sameSocialId->user;

            }

        }




        $authUser = isset($socialUser) ? $socialUser : $newSocialUser;

        auth()->login($authUser, true);
        return redirect('/');





    }
}