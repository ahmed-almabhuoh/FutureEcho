<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResetVerifiedCredentials extends Model
{
    /** @use HasFactory<\Database\Factories\ResetVerifiedCredentialsFactory> */
    use HasFactory;

    const STATUS =  ['pending', 'accepted', 'rejected'];

    protected $guarded = [];
}
