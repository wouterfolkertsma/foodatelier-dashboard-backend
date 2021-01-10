<?php


namespace App\Models\Data;


use App\Models\Country;
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

}

