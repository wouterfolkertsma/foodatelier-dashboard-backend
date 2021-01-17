<?php


namespace App\Models;

use App\Models\Model;


/**
 * Class Data
 *
 * @package App\Models
 */
class Country extends Model
{


    public function country()
    {
        return $this->morphTo();
    }
}
