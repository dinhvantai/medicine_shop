<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helpers\Helper;
use Socialite;

class SocialAuthController extends Controller
{
    public function redirect($providerName)
    {
        return Socialite::driver($providerName)->redirect();   
    }   

    public function callback($providerName)
    {
        $user = Helper::createOrGetUserSocial(Socialite::driver($providerName)->user(), $providerName);

        auth()->login($user);

        return redirect()->route('welcome');
    }
}
