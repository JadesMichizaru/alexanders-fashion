<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google and handle login/registration.
     */
    public function callback()
    {
        try {
            // Retrieve user info from Google
            $googleUser = Socialite::driver('google')->user();
        } catch (\Exception $e) {
            Log::error('Google OAuth failed: ' . $e->getMessage());
            return redirect()->route('login')->withErrors(['google' => 'Unable to login using Google. Please try again.']);
        }

        if (!$googleUser || !isset($googleUser->email)) {
            return redirect()->route('login')->withErrors(['google' => 'Email information not provided by Google.']);
        }

        // Find existing user by email or create a new one
        $user = User::where('email', $googleUser->email)->first();

        if ($user) {
            // Update google_id if it has changed
            if ($user->google_id !== $googleUser->id) {
                $user->google_id = $googleUser->id;
                $user->save();
            }
        } else {
            // Create user with a strong random password
            $user = User::create([
                'name' => $googleUser->name ?? $googleUser->nickname ?? 'No Name',
                'email' => $googleUser->email,
                'google_id' => $googleUser->id,
                'password' => bcrypt(Str::random(40)),
            ]);
        }

        // Log in the user
        Auth::login($user, true);

        return redirect()->intended(route('dashboard'));
    }
}
