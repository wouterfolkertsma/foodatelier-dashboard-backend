<?php

use App\Models\Company;
use App\Models\Employee;
use App\Models\Staff;
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
                factory(App\Models\User::class)->create([
                    'profile_id' => factory(App\Models\Client::class)->create([
                        'company_id' => Company::where('name', $company)->first()->id
                    ])
                ]);
            }
        }

        factory(App\Models\User::class, 1)->state( 'admin')->create([
            'profile_type' => 'employee',
            'profile_id' => factory(Employee::class)
        ]);
    }
}