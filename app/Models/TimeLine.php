<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use SebastianBergmann\Diff\MemoryEfficientLongestCommonSubsequenceCalculator;

class TimeLine extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    // Relations
    public function memory(): BelongsTo
    {
        return $this->belongsTo(Memory::class, 'memory_id', 'id');
    }

    public function capsule(): BelongsTo
    {
        return $this->belongsTo(Capsule::class, 'capsule_id', 'id');
    }
}
