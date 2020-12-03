<?php

namespace Database\Factories\Data;

use App\Models\Data\DataType;
use Illuminate\Database\Eloquent\Factories\Factory;

class DataTypeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DataType::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [];
    }
}