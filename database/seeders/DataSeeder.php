<?php

namespace Database\Seeders;

use App\Admin\Renderers\FileRenderer;
use App\Models\Data\Data;
use App\Models\Data\File;
use App\Blocks\File as FileBlock;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            Data::factory()->create([
                'frontend_renderer' => FileBlock::class,
                'backend_renderer' => FileRenderer::class,
                'data_type' => File::class,
                'data_id' => File::factory()->create()
            ]);
        }
    }
}