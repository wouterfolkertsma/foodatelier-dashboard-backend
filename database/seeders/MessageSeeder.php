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
        Message::factory()->count(250)->create();
    }
}
