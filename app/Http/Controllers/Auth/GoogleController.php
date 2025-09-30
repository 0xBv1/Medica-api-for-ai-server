<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;

class GoogleController extends Controller
{
    // rediirect to google
    public function redirectToGoogle()
    {
        session()->put('google_auth', true); 
        return Socialite::driver('google')->redirect();
    }
    // callback from google
    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
    
        $existingUser = User::where('google_id', $googleUser->getId())->first();
    
        if ($existingUser) {
            Auth::login($existingUser);
        } else {
            $user = User::create([
                'name' => $googleUser->getName(),
                'email' => $googleUser->getEmail(),
                'google_id' => $googleUser->getId(),
                // 'password' => bcrypt(Str::random(24)), // optional if using password-less login
            ]);
    
            Auth::login($user);
        }
    
        return redirect('/profile'); // أو أي صفحة بعد تسجيل الدخول
    }
}
