<?php

/** @var Factory $factory */

use App\Models\Client;
use App\Models\Company;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Client::class, function (Faker $faker) {
    return [
        'company_id' => factory(Company::class)
    ];
});