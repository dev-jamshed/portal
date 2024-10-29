<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    // Profile edit form ko show karne ke liye
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    // Profile update karne ke liye
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validation rules
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            // Agar password change karna chahte hain
            'password' => 'sometimes|nullable|string|min:8|confirmed',
        ]);

        // Data update karna
        $user->name = $request->name;
        $user->email = $request->email;

        // Agar password ko update karna ho to
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        // Redirect with success message
        return redirect()->route('profile.edit')->with('success', 'Profile updated successfully.');
    }
}
