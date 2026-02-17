<?php
// app/Http/Controllers/ProfileController.php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form (Halaman Utama Profile)
     */
    public function profile(Request $request)
    {
        return view('admin.pages.profile', [
            'user' => $request->user(),
            'tab' => 'profile', // Untuk menentukan tab aktif
        ]);
    }

    /**
     * Show the form for editing the profile (Halaman Edit Profile)
     */
    public function edit(Request $request)
    {
        return view('admin.pages.profile', [
            'user' => $request->user(),
            'tab' => 'edit', // Untuk menampilkan form edit
        ]);
    }

    /**
     * Update the user's profile information
     */
    public function update(ProfileUpdateRequest $request)
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.index')->with(
            'success',
            'Profile updated successfully.',
        );
    }

    /**
     * Show change password form
     */
    public function changePassword(Request $request)
    {
        return view('admin.pages.profile', [
            'user' => $request->user(),
            'tab' => 'change-password',
        ]);
    }

    /**
     * Update user's password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', 'min:8'],
        ]);

        $request->user()->update([
            'password' => Hash::make($request->password),
        ]);

        return Redirect::route('profile.index')->with(
            'success',
            'Password changed successfully.',
        );
    }

    /**
     * Delete the user's account
     */
    public function destroy(Request $request)
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();
        Auth::logout();
        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
