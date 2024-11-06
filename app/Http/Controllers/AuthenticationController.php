<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticationController extends Controller
{
    //
    public function logout(Request $request)
    {
        $request->session()->forget('web');
        Auth::logout();

        return redirect(route('home'));
    }

    public function logoutV2()
    {
        request()->session()->forget('web');
        Auth::logout();

        return redirect(route('home'));
    }
}
