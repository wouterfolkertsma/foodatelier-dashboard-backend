<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Company;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (CompanySeeder::$companies as $company) {
            for ($i = 0; $i < 5; $i++) {
                User::factory()->create([
                    'profile_id' => Client::factory()->create([
                        'company_id' => Company::where('name', $company)->first()->id
                    ])
                ]);
            }
        }

        User::factory()->count(1)->admin()->create([
            'profile_type' => Employee::class,
            'profile_id' => Employee::factory()->create()
        ]);
    }
}