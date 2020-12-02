<?php

namespace Database\Seeders;

use App\Models\Dashboard;
use App\Models\Data\Data;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DashboardsHaveDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Dashboard::all()->each(function ($dashboard) {
            Data::all()->each(function ($data) use ($dashboard) {
                DB::table('dashboard_data')->insert([
                    ['dashboard_id' => $dashboard->id, 'data_id' => $data->id],
                ]);
            });
        });
    }
}