<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContributorPermission extends Model
{
    use HasFactory, SoftDeletes;

    const Permissions = ['r', 'w'];

    protected $table = "contributor_permissions";

    // protected $fillable = ["permission", "contributor_id", "capsule_id", "deleted_at"];
    protected $guarded = [];

    public function  contributor(): BelongsTo
    {
        return $this->belongsTo(Contributor::class, 'contributor_id', 'id');
    }

    public function capsule(): BelongsTo
    {
        return $this->belongsTo(Capsule::class, 'capsule_id', 'id');
    }
}
