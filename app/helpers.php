<?php

use App\Models\Token;
use App\Models\TwoFA;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;

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

if (! function_exists('generateToken')) {
    function generateToken($userId, $length = 80): string
    {
        // Update all user's tokens
        Token::where([
            ['user_id', '=', $userId],
            ['status', '=', 'active']
        ])->update([
            'status' => 'inactive'
        ]);

        // Generate a new one
        $token = Str::random($length);
        $created = Token::create([
            'user_id' => $userId,
            'token' => $token,
            'status' => 'active'
        ]);

        return ($created == true) ? $token : false;
    }
}
