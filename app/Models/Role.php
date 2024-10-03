<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS = ['active', 'inactive'];
    protected $fillable = [
        'role_ar',
        'role_en',
        'deleted_at',
        'updated_at',
        'created_at',

        'status'
    ];
    // Relations
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'user_roles', 'user_id', 'role_id');
    }

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'role_permissions', 'permission_id', 'role_id');
    }
}
