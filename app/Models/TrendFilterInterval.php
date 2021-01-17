<?php


namespace App\Models;

use App\Models\Model;


/**
 * Class Data
 *
 * @package App\Models
 */
class TrendFilterInterval extends Model
{
    public function TrendFilterInterval()
    {
        return $this->morphTo();
    }
}
