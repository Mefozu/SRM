<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        return view('profile.show', compact('user'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'passport' => 'nullable|string',
            'department' => 'nullable|string',
            'position' => 'nullable|string',
            'responsibilities' => 'nullable|string',
        ]);

        $user->update($request->only('passport', 'department', 'position', 'responsibilities'));

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}
