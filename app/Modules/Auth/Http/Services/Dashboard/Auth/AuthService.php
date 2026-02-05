<?php

namespace App\Modules\Auth\Http\Services\Dashboard\Auth;

use App\Modules\Auth\Http\Requests\Dashboard\Auth\LoginRequest;
use App\Modules\Auth\Models\Manager;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function login(LoginRequest $request)
    {

        $credentials = $request->validated();

        $rememberMe = $request->remember_me == 'on';

        if (auth('manager')->attempt($credentials, $rememberMe)) {
            return redirect()->route('dashboard.home');
        } else {
            return redirect()->route('auth.login')->with(['error' => __('messages.Incorrect email or password')]);
        }
    }

    public function logout()
    {
        auth('manager')->logout();

        return redirect()->route('auth.login');
    }

    public function updatePassword($request)
    {
        $user = Manager::findorfail($request->id);
        if (! Hash::check($request->old_password, $user->password)) {
            return back()->with('error', __('messages.Old_Password_Wrong'));
        } else {
            $user->update(['password' => $request->new_password]);

            return back()->with('success', __('Updated Successfully'));
        }
    }
}
