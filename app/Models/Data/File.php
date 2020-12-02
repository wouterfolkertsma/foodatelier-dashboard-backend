<?php

namespace App\Models\Data;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class File
 *
 * @property mixed file_path
 * @package App\Models
 */
class File extends Data
{
    /**
     * @return MorphTo|MorphToMany
     */
    public function data()
    {
        return $this->morphToMany(Data::class, 'data');
    }

    /**
     * @return false|int
     */
    public function imageable() {
        return preg_match("/^.*\.(jpg|jpeg|png)$/i", $this->file_path);
    }
}