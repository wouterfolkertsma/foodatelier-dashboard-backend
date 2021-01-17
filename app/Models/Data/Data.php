<?php

namespace App\Models\Data;

use App\Models\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Class Data
 *
 * @package App\Models
 * @method static where(string $string, int $data)
 */
class Data extends Model
{
    /**
     * @return MorphTo
     */
    public function data()
    {
        return $this->morphTo();
    }
}