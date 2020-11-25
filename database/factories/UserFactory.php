<?php

namespace Database\Factories;

use App\Models\Client;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'infix' => null,
            'last_name' => $this->faker->lastName,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => bcrypt('secret'),
            'profile_type' => Client::class,
            'profile_id' => Client::factory()->make(),
            'role_id' => function () {
                return Role::where('name', 'Client')->first()->id;
            },
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * @return UserFactory
     */
    public function admin()
    {
        return $this->state(function (array $attributes) {
            return [
                'email' => 'admin@foodatelier.nl',
                'role_id' => function () {
                    return Role::where('name', 'Admin')->first()->id;
                }
            ];
        });
    }
}