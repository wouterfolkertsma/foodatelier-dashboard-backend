<?php

namespace App\Models;

use App\Models\Model;

/**
 * Class Data
 *
 * @package App\Models
 */
class Message extends Model
{

    public function message()
    {
        return $this->morphTo();
    }

}
