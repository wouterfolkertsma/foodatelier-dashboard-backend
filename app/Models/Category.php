<?php


namespace App\Models;

use App\Models\Model;


/**
 * Class Data
 *
 * @package App\Models
 */
class Category extends Model
{
    public function Category()
    {
        return $this->morphTo();
    }
}
