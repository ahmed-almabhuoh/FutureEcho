<?php

namespace App\Models;

use App\Notifications\LegacyAddedNotification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Legacy extends Model
{
    use HasFactory, SoftDeletes;

    // protected $guarded = [];
    protected $fillable = [
        'email',
        'status',
        'user_id',
    ];

    /**
     * The name of the "updated at" column.
     *
     * @var string|null
     */
    const UPDATED_AT = null;

    const STATUS = ['pending', 'accepted', 'rejected'];

    protected static function booted()
    {
        static::created(function ($legacy) {
            // This will queue the notification
            $user = User::where('email', $legacy->email)->first();


            if ($user)
                if ($code = generate2FA($user->id))
                    $user->notify(new LegacyAddedNotification($user, $code));
        });

        static::addGlobalScope(function ($query) {
            $query->where('user_id', auth()->id());
        });
    }

    // Relations
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
