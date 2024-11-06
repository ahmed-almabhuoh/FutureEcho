<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Receiver extends Model
{
    use HasFactory;

    // Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function memory(): BelongsTo
    {
        return $this->belongsTo(Memory::class, 'memory_id', 'id');
    }

    public function capsule(): BelongsTo
    {
        return $this->belongsTo(Capsule::class, 'capsule_id', 'id');
    }
}
