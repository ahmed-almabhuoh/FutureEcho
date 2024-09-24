<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    const STATUS = ['active', 'inactive'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }


    // Relations
    public function identity(): HasOne
    {
        return $this->hasOne(IdentityVerification::class, 'user_id', 'id');
    }

    public function tokens(): HasMany
    {
        return $this->hasMany(Token::class, 'user_id', 'id');
    }

    public function twoFACodes(): HasMany
    {
        return $this->hasMany(TwoFA::class, 'user_id', 'id');
    }

    public function roles(): BelongsToMany
    {
        return $this->belongsToMany(Role::class, 'user_roles', 'role_id', 'user_id');
    }

    public function legacy(): HasOne
    {
        return $this->hasOne(Legacy::class, 'user_id', 'id');
    }

    public function capsule(): HasMany
    {
        return $this->hasMany(Capsule::class, 'user_id', 'id');
    }

    public function contribute(): HasMany
    {
        return $this->hasMany(Contributor::class, 'user_id', 'id');
    }

    public function memories(): HasMany
    {
        return $this->hasMany(Memory::class, 'user_id', 'id');
    }

    public function receiver(): HasOne
    {
        return $this->hasOne(Receiver::class, 'user_id', 'id');
    }
}
