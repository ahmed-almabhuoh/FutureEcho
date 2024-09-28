<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Legacy extends Model
{
    use HasFactory, SoftDeletes;

<<<<<<< HEAD
=======
    protected $guarded = [];

    /**
     * The name of the "updated at" column.
     *
     * @var string|null
     */
    const UPDATED_AT = null;

>>>>>>> 0b82bd5957c42dde83842c16e4945048b95ae50d
    const STATUS = ['pending', 'accepted', 'rejected'];

    // Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
