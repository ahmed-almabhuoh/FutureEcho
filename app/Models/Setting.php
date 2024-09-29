<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
