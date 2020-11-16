<?php

use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * @var string[]
     */
    public static $companies = ['Beemster', 'Body & Fit'];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (self::$companies as $company) {
            factory(App\Models\Company::class)->create([
                'name' => $company,
            ]);
        }
    }
}