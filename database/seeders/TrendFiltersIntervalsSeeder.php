<?php

namespace Database\Seeders;

use App\Models\TrendFilterInterval;
use Illuminate\Database\Seeder;

class TrendFiltersIntervalsSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        TrendFilterInterval::create([
            'name' => 'last day',
            'from' => 'now -1 days',
            'to' => 'now',
        ]);
        TrendFilterInterval::create([
            'name' => 'last 7 days',
            'from' => 'now -8 days',
            'to' => 'now',
        ]);
        TrendFilterInterval::create([
            'name' => 'last 30 days',
            'from' => 'now -31 days',
            'to' => 'now',
        ]);
        TrendFilterInterval::create([
            'name' => 'last 90 days',
            'from' => 'now -91 days',
            'to' => 'now',
        ]);
    }
}
