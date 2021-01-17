<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\TrendFilterInterval;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{


    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'healthy food',
        ]);
        Category::create([
            'name' => 'sports nutrition',
        ]);
        Category::create([
            'name' => 'food trends',
        ]);
    }
}
