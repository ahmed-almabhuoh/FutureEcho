<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContributorPermission extends Model
{
    use HasFactory, SoftDeletes;

    const Permissions = ['r', 'w'];

    protected $table = "contributor_permissions";

    protected $fillable = ["permission", "contributor_id", "capsule_id", "deleted_at"];

    public function  contributor()
    {
        return $this->belongsTo(Contributor::class);
    }

    public function capsule()
    {
        return $this->belongsTo(Capsule::class);
    }
}
