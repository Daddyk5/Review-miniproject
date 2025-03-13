<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information, including profile photo.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'profile_photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048', // Optional profile photo
        ]);

        /** @var User $user */
        $user = Auth::user(); // Make sure it's a User instance

        // Handle profile picture upload if provided
        if ($request->hasFile('profile_photo')) {
            // Delete old profile photo if exists
            if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
                Storage::disk('public')->delete($user->profile_photo_path);
            }

            // Store new profile photo
            $path = $request->file('profile_photo')->store('profile_photos', 'public');
            $user->profile_photo_path = $path;
        }

        // Update user's name
        $user->name = $request->input('name');
        $user->save(); // Save user information

        return Redirect::route('profile.edit')->with('success', 'Profile updated successfully.');
    }

    /**
     * Delete the user's account and related data.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'], // Confirm password before deleting
        ]);

        /** @var User $user */
        $user = $request->user();

        // Delete profile photo if exists
        if ($user->profile_photo_path && Storage::disk('public')->exists($user->profile_photo_path)) {
            Storage::disk('public')->delete($user->profile_photo_path);
        }

        // Logout and delete user
        Auth::logout();
        $user->delete();

        // Invalidate session and regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/')->with('success', 'Your account has been deleted successfully.');
    }
}
