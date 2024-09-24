<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Capsule extends Model
{
    use HasFactory;

    // Relations
    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function contributors(): HasMany
    {
        return $this->hasMany(Contributor::class, 'user_id', 'id');
    }

    public function memories(): HasMany
    {
        return $this->hasMany(Memory::class, 'capsule_id', 'id');
    }

    public function receivers(): HasMany
    {
        return $this->hasMany(Receiver::class, 'capsule', 'id');
    }

    public function timeline(): HasOne
    {
        return $this->hasOne(TimeLine::class, 'capsule_id', 'id');
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class, 'capsule_id', 'id');
    }
}