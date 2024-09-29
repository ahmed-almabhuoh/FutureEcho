<?php

use App\Models\TwoFA;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

if (! function_exists('generate2FA')) {
    function generate2FA($user)
    {
        $code = rand(111111, 9999999);

        $twoFaCode = new TwoFA();
        $twoFaCode->code = Hash::make($code);
        $twoFaCode->user_id = $user->id;
        $isSaved = $twoFaCode->save();

        return $isSaved ? Crypt::encrypt($code) : false;
    }
}
