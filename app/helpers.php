<?php

use App\Models\Memory;
use App\Models\Permission;
use App\Models\Role;
use App\Models\TimeLine;
use App\Models\Token;
use App\Models\TwoFA;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\BinaryOp\BooleanOr;

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

if (! function_exists('generate2FA')) {
    function generate2FA($userId, $length = 8): string
    {
        TwoFA::where('user_id', $userId)->delete();

        $min = str_pad('1', $length, '0');
        $max = str_pad('', $length, '9');
        $code = rand((int) $min, (int) $max);

        TwoFA::create([
            'code' => Hash::make($code),
            'user_id' => $userId
        ]);

        return (string) $code;
    }
}

if (!function_exists('getUserTimezone')) {
    function getUserTimezone($ipAddress = null)
    {
        if (!$ipAddress) {
            $ipAddress = request()->ip();
        }

        try {
            $client = new Client();
            $response = $client->get("http://ipinfo.io/{$ipAddress}/json");

            if ($response->getStatusCode() == 200) {
                $data = json_decode($response->getBody(), true);

                return $data['timezone'] ?? 'UTC';
            }
        } catch (\Exception $e) {
            return 'UTC';
        }

        return 'UTC';
    }
}

if (! function_exists('getFullFilePath')) {
    function getFullFilePath($path): string
    {
        return env('APP_ENV') == 'production' ? env('APP_URL') . $path : 'http://127.0.0.1:8000' . $path;
    }
}

if (! function_exists('getCurrentRouteName')) {
    function getCurrentRouteName(): string
    {
        return Route::getCurrentRoute()->getName();
    }
}

if (! function_exists('getTimeline')) {
    function getTimeline($id): string
    {
        $timeline = TimeLine::findOrFail($id);
        return !is_null($timeline->to) ? (Carbon::parse($timeline->from)->format('M/d/Y') . ' - ' . Carbon::parse($timeline->to)->format('M/d/Y')) : Carbon::parse($timeline->from)->format('M/d/Y');
    }
}

if (! function_exists('unsluging')) {
    function unsluging($str): string
    {
        $array = explode('-', $str);
        $fullStr = '';
        foreach ($array as $key => $value) {
            $fullStr .= ' ' . ucfirst($value);
        }
        return trim($fullStr);
    }
}

if (! function_exists('checkAuthority')) {
    function checkAuthority($permission)
    {
        $permissionObject = Permission::where('name_en', unsluging($permission))->first();

        if (is_null($permissionObject))
            return false;

        $roles = auth()->user()->roles;
        if (count($roles))
            foreach ($roles as $role)
                if (DB::table('role_permissions')->where([
                    ['role_id', '=', $role->id],
                    ['permission_id', '=', $permissionObject->id],
                ])->exists())
                    return 1;
                else
                    return false;
        else
            return false;
    }
}
