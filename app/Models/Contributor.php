<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Contributor extends Model
{
    use HasFactory;

    // protected $fillable = [
    //     'user_id',
    //     'capsule_id',
    // ];

    protected $guarded = [];

    const Permissions = ['r', 'w'];
    const UPDATED_AT = null;

    /**
     * The name of the "created at" column.
     *
     * @var string|null
     */
    const CREATED_AT = 'added_at';


    // Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function capsule(): BelongsTo
    {
        return $this->belongsTo(Capsule::class, 'capsule_id', 'id');
    }

    public function permissions(): HasMany
    { // Contributor has more than one permission on a specific capsule
        return $this->hasMany(ContributorPermission::class, 'contributor_id', 'id');
    }
}
