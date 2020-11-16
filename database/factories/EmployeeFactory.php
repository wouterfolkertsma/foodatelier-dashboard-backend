<?php

/** @var Factory $factory */

use App\Models\Employee;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'consulting_phone' => $faker->phoneNumber,
        'consulting_email' => $faker->companyEmail,
        'job_description' => $faker->jobTitle,
    ];
});