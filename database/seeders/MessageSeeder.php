<?php

namespace Database\Seeders;

use App\Admin\Renderers\FileRenderer;
use App\Models\Message;
use App\Models\Data\File;
use App\Blocks\File as FileBlock;

use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 250; $i++) {
            Message::factory()->create([
                /**
                'frontend_renderer' => FileBlock::class,
                'backend_renderer' => FileRenderer::class,
                 * */

            ]);
        }
    }
}
