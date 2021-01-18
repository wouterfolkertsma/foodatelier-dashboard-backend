<?php

namespace Database\Seeders;

use App\Models\Category;

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
            'name' => 'undefined category',
        ]);
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
