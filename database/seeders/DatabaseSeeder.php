<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(CompanySeeder::class);
        $this->call(DashboardSeeder::class);
        $this->call(DataSeeder::class);
        $this->call(DashboardsHaveDataSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(MessageSeeder::class);
    }
}
