<?php

namespace Database\Seeders;

use App\Models\Data\Data;
use App\Models\Data\TrendFilter;
use Illuminate\Database\Seeder;

class TrendFilterSeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Terms Array
        $terms_arr = array("healthy food","fast food","athletic nutrition");
        $terms_str = serialize($terms_arr);
        Data::factory()->create([
            'data_type' => TrendFilter::class,
            'data_id' =>TrendFilter::create([
                'name' => 'TestFoodTrend',
                'description' => 'Query to test the GoogleTrends functionality',
                'search_term' => $terms_str,
                'category_id' => 2,
                'country_id' => 1,
                'standard_interval_id' => 2,
                'search_type' => 'Web-Search',
                'with_top_metric' => true,
                'with_rising_metric' => true
            ])
        ]);
    }
}
