<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\v1\RegisterValidation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //

    public function registration(RegisterValidation $request)
    {
        $password = Str::random(8);

        $user = User::create([
            'name' => $request->get('fname') . $request->get('lname'),
            'email' => $request->get('email'),
            'phone' => $request->get('phone'),
            'is_admin' => false,
            'password' => Hash::make($password)
        ]);

        info($password);

        if ($user)
            Auth::login($user);

        session()->flash('status', $user ? 200 : 500);
        session()->flash('message', $user ? __('Registration completed') : __('Failed to complete register!'));

        return $user ? redirect()->route('v1.dashboard') : redirect()->route('v1.registration');
    }
}
