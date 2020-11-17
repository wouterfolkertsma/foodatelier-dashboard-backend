<?php

namespace App\Models;


use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Notifications\Notifiable;

/**
 * Class User
 *
 * @property mixed first_name
 * @property mixed profile_type
 * @property mixed last_name
 * @package App\Models
 * @method static factory()
 */
class User extends Model
{
    use Authenticatable, MustVerifyEmail, Notifiable;

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * @var string[]
     */
    protected $appends = [
        'full_name'
    ];

    /**
     * @return BelongsTo
     */
    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * @return MorphTo
     */
    public function profile(): MorphTo
    {
        return $this->morphTo('profile');
    }

    /**
     * @return string
     */
    public function getFullNameAttribute(): string
    {
        return $this->first_name . $this->last_name;
    }

    /**
     * @return bool
     */
    public function isEmployee(): bool
    {
        return $this->profile_type === 'employee';
    }

    /**
     * @return bool
     */
    public function isClient(): bool
    {
        return $this->profile_type === 'client';
    }
}