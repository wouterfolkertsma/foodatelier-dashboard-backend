<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class Data
 *
 * @package App\Models
 */
class UsersMessage extends Message
{

    public function users_message()
    {
        return $this->morphToMany(Message::class, 'message');
    }

}
