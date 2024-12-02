<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserGroup extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS = [
        'active',
        'inactive'
    ];

    protected $fillable = [
        'name_ar',
        'name_en',
        'status',
        'deleted_at'
    ];

    // Relations
    public function permissions(): HasMany
    {
        return $this->hasMany(Permission::class, 'user_group_id', 'id');
    }

    public function roles(): HasMany
    {
        return $this->hasMany(Role::class, 'user_group_id', 'id');
    }
}
