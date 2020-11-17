<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Employee::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'consulting_phone' => $this->faker->phoneNumber,
            'consulting_email' => $this->faker->companyEmail,
            'job_description' => $this->faker->jobTitle,
        ];
    }
}