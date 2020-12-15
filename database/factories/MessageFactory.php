<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Role;
use App\Models\User;
use App\Models\Message;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/** @var Factory $factory */

class MessageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Message::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return[
            'message' => $this->faker->sentence,
            'is_read' => rand(0,1)
        ];
    }


}
