<?php

namespace Database\Seeders;

use App\Models\Company;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * @var string[]
     */
    public static $companies = ['Beemster', 'Body & Fit', "Unilever"];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$companies as $company) {
            Company::factory()->create([
                'name' => $company,
            ]);
        }
    }
}