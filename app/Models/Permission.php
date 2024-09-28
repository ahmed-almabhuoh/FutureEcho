<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
<<<<<<< HEAD
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;

    const STATUS = ['active', 'inactive'];

=======
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory, SoftDeletes;

    const STATUS = ['active', 'inactive'];

    protected $fillable = [
        'name_ar',
        'name_en',
        'deleted_at',
        'user_group_id',
        'status'
    ];

>>>>>>> 0b82bd5957c42dde83842c16e4945048b95ae50d
    // Relations
    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'role_permissions', 'role_id', 'permission_id');
    }
<<<<<<< HEAD
=======

    public function userGroup(): BelongsTo
    {
        return $this->belongsTo(UserGroup::class, 'user_group_id', 'id');
    }
>>>>>>> 0b82bd5957c42dde83842c16e4945048b95ae50d
}
