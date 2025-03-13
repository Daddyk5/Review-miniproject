<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SocialAuthController extends Controller
{
    // Redirect user to provider (Google, Facebook, GitHub)
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    // Handle callback from provider
    public function callback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            $user = User::updateOrCreate([
                'email' => $socialUser->getEmail(),
            ], [
                'name' => $socialUser->getName(),
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'email_verified_at' => now(),
                'password' => bcrypt('password') // Assign a default password
            ]);

            Auth::login($user);
            return redirect('/dashboard')->with('success', 'Logged in successfully!');
        } catch (\Exception $e) {
            return redirect('/login')->with('error', 'Something went wrong, please try again.');
        }
    }
}

