<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Memory extends Model
{
    use HasFactory, SoftDeletes;

    // Relations
    public function capsule(): BelongsTo
    {
        return $this->belongsTo(Capsule::class, 'capsule_id', 'id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function receivers(): HasMany
    {
        return $this->hasMany(Receiver::class, 'memory_id', 'id');
    }

    public function timeline(): HasOne
    {
        return $this->hasOne(TimeLine::class, 'memory_id', 'id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'memory_id', 'id');
    }
}
