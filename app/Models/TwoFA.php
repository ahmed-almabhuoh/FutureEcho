<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TwoFA extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'user_id',
    ];

    protected static function booted()
    {
        self::creating(function ($model) {
            TwoFA::where('user_id', auth()->id())->delete();
        });
    }

    /**
     * The name of the "updated at" column.
     *
     * @var string|null
     */
    const UPDATED_AT = null;

    /**
     * The name of the "updated at" column.
     *
     * @var string|null
     */
    const CREATED_AT = null;


    // Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
