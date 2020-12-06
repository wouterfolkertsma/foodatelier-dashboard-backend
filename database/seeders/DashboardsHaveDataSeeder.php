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
        $dataCount = Data::all()->count();

        Dashboard::all()->each(function ($dashboard) use ($dataCount) {
            $randomNumber = rand(0, $dataCount);

            Data::all()->each(function ($data, $index) use ($dashboard, $randomNumber) {
                if ($index >= $randomNumber) {
                    return;
                }

                DB::table('dashboard_data')->insert([
                    ['dashboard_id' => $dashboard->id, 'data_id' => $data->id],
                ]);
            });
        });
    }
}