<?php

/** @var Factory $factory */

use App\Models\Client;
use App\Models\Role;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'infix' => null,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => bcrypt('secret'),
        'profile_type' => 'client',
        'profile_id' => factory(Client::class),
        'role_id' => function () {
            return Role::where('name', 'Client')->first()->id;
        },
        'remember_token' => Str::random(10),
    ];
});

$factory->state(App\Models\User::class, 'admin', [
    'email' => 'admin@foodatelier.nl',
    'role_id' => function () {
        return Role::where('name', 'Admin')->first()->id;
    }
]);