<?php


namespace App\Http\Repositories;


use App\Models\Category;


class CategoryRepository extends Repository
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }
    /**
     * @return string
     */
    protected function getType()
    {
        return Category::class;
    }
}
