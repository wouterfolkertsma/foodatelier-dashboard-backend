<?php

namespace App\Models\Data;

use App\Models\Model;

/**
 * Class Data
 *
 * @package App\Models
 */
class Data extends Model
{
    public function data()
    {
        return $this->morphTo();
    }
}