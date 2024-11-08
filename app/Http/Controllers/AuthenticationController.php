<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthenticationController extends Controller
{
    //
    public function logout(Request $request)
    {
        $request->session()->forget('web');
        Auth::logout();

        return redirect()->route('login');
    }
}
