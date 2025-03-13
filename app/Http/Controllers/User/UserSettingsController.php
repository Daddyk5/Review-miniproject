<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User; // ✅ Make sure to import User model

class UserSettingsController extends Controller
{
    /**
     * Show user settings page.
     */
    public function index()
    {
        return view('user.settings.index');
    }

    /**
     * Update user profile and password.
     */
    public function update(Request $request)
    {
        /** @var User $user */ // ✅ Helps Intelephense recognize $user as User model
        $user = Auth::user();

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'nullable|min:6|confirmed',
        ]);

        // Update fields manually (without update() to avoid IDE errors if needed)
        $user->name = $request->name;

        // Only hash and set password if user typed a new one
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save(); // ✅ Save changes to database

        return redirect()->back()->with('success', 'Settings updated successfully!');
    }
}
