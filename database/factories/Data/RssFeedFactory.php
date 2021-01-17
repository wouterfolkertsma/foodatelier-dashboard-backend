<?php

namespace Database\Factories\Data;

use App\Models\Data\RssFeed;
use Illuminate\Database\Eloquent\Factories\Factory;

class RssFeedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RssFeed::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'url' => $this->faker->url,
        ];
    }
}