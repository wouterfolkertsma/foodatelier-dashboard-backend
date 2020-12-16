<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model as BaseModel;

/**
 * Class Data
 *
 * @package App\Models
 * @method save()
 * @method static firstOrCreate(array $array)
 * @method static where(string $string, $user_id)
 */
class UsersMessage extends BaseModel
{
    protected $fillable = [
        'user_id_from',
        'user_id_to',
        'message_id'
    ];

    protected $table = 'users_messages';
}
