<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Contributor extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'capsule_id',
    ];

    const Permissions = ['r', 'w'];
    const UPDATED_AT = null;

    // Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function capsule(): BelongsTo
    {
        return $this->belongsTo(Capsule::class, 'capsule_id', 'id');
    }
}
