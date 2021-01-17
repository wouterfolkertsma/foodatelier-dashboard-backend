<?php


namespace App\Http\Repositories;


use App\Models\Data\TrendFilter;


class FilterRepository extends Repository
{
    public function __construct(TrendFilter $model)
    {
        parent::__construct($model);
    }
    /**
     * @return string
     */
    protected function getType()
    {
        return TrendFilter::class;
    }
}
