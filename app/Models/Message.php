<?php

namespace App\Models;

use App\Models\Model;

/**
 * Class Data
 *
 * @package App\Models
 * @method static whereId($message_id)
 */
class Message extends Model
{
    public function message()
    {
        return $this->morphTo();
    }
}
