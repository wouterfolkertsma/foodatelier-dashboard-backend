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
                'country_id' => 1,
                'standard_interval' => 'now -7 days',
                'consider_web_search' => true,
                'consider_image_search' => false,
                'consider_news_search' => false,
                'consider_youtube_search' => false,
                'consider_shopping_search' => false,
                'with_top_metric' => false,
                'with_rising_metric' => false
            ])
        ]);
    }
}
