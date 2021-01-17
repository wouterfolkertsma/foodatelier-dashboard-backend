<?php


namespace App\Models\Data;


use App\Models\Category;
use App\Models\Country;
use App\Models\TrendFilterInterval;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class TrendFilter extends Data
{
    /**
     * @return MorphTo|MorphToMany
     */
    public function data()
    {
        return $this->morphToMany(Data::class, 'data');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function standardInterval()
    {
        return $this->belongsTo(TrendFilterInterval::class, 'standard_interval_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

}


