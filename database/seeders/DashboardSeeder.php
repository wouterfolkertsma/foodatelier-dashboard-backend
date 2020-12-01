<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Dashboard;
use Illuminate\Database\Seeder;

class DashboardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (CompanySeeder::$companies as $company) {
            Dashboard::factory()->create([
                'name' => $company . ' Dashboard',
                'company_id' => Company::whereName($company)->get()->first()->id
            ]);
        }
    }
}