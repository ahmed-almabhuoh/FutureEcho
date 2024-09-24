<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class IdentityVerification extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS = ['pending', 'verified', 'rejected'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', id);
    }
}
