<?php

namespace App\Models;

use App\Models\Model;

/**
 * Class Data
 *
 * @package App\Models
 */
class UserMessage extends Model
{

    public function users_message()
    {
        return $this->morphTo();
    }

}
