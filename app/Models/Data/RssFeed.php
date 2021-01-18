<?php

namespace App\Models\Data;

use App\Models\Category;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

/**
 * Class File
 *
 * @property mixed file_path
 * @package App\Models
 */
class RssFeed extends Data
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
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
