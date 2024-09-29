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

    protected $fillable = [
        'file',
        'status',
        'submitted_at',
        'deleted_at',
        'user_id',
    ];

    /**
     * The name of the "created at" column.
     *
     * @var string|null
     */
    const CREATED_AT = 'submitted_at';

    /**
     * The name of the "updated at" column.
     *
     * @var string|null
     */
    const UPDATED_AT = null;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
