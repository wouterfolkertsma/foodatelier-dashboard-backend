<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Data\Data;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DataHaveCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dataCount = Data::all()->count();

        Category::all()->each(function ($category) use ($dataCount) {
            $randomNumber = rand(0, $dataCount);

            Data::all()->each(function ($data, $index) use ($category, $randomNumber) {
                if ($index >= $randomNumber) {
                    return;
                }

                DB::table('data_category')->insert([
                    ['category_id' => $category->id, 'data_id' => $data->id],
                ]);
            });
        });
    }
}
