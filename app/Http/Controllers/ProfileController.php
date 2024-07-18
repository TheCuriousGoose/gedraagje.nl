<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit($profile)
    {
        $user = User::find($profile);

        return view('pages.profiles.edit', [
            'user' => $user
        ]);
    }

    public function update($user, Request $request)
    {
        $user = User::find($user);

        $validated = $request->validate([
            'name' => ['required'],
            'email' => ['required', 'email'],
            'avatar' => ['image', 'nullable', 'max:2048'],
            'password' => ['nullable', function ($attribute, $value, $fail) use ($request) {
                if ($request->filled('new_password')) {
                    if (empty($value)) {
                        $fail('The password field is required when changing the password.');
                    } else {
                        if (!Hash::check($value, $request->user()->password)) {
                            $fail('The current password is incorrect.');
                        }
                    }
                }
            }],
            'new_password' => ['nullable'],
        ]);

        if(isset($validated['avatar'])){
            $user->saveProfilePicture($request->file('avatar'));
		}

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        return redirect()->route('dashboard')->with('success', __('Profile has been successfully saved'));
    }
}
