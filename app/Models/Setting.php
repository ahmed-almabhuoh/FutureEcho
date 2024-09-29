<?php

namespace App\Models;

use App\Notifications\SettingChangedNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'logo',
        'sign_up',
        'sign_in',
        'maintenance',
    ];
    protected $casts = [
        'sign_up' => 'boolean',
        'sign_in' => 'boolean',

    ];


    protected static function booted()
    {
        $user = User::where('id', auth()->id())->first();

        static::created(function ($setting) use ($user) {
            $user->notify(new SettingChangedNotification($setting));
        });

        static::updated(function ($setting) use ($user) {
            $user->notify(new SettingChangedNotification($setting));
        });
    }
}
