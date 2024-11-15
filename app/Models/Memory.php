<?php

namespace App\Models;

use App\Jobs\ProcessUploadedMemoryJob;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

class Memory extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'message',
        'medias',
        'user_id',
        'capsule_id'
    ];

    protected $casts = [
        'medias' => 'array',
    ];

    protected static function booted()
    {
        static::addGlobalScope(function ($query) {
            if (auth()->check())
                $query->where('user_id', auth()->id());
        });

        static::created(function ($memory) {
            ProcessUploadedMemoryJob::dispatch($memory, $memory->user_id);
        });
    }

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
