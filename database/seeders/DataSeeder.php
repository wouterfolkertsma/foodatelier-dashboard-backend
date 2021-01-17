<?php

namespace Database\Seeders;

use App\Admin\Renderers\FileRenderer;
use App\Models\Data\Data;
use App\Models\Data\File;
use App\Blocks\File as FileBlock;
use App\Models\Data\RssFeed;
use Illuminate\Database\Seeder;

class DataSeeder extends Seeder
{
    const RSS_FEEDS = [
        'BBC Newsfeed' => 'http://feeds.bbci.co.uk/news/world/rss.xml',
        'NyTimes Newsfeed' => 'https://www.nytimes.com/svc/collections/v1/publish/https://www.nytimes.com/section/world/rss.xml',
        'Buzzfeed Newsfeed' => 'https://www.buzzfeed.com/world.xml',
        'Globalissues Newsfeed' => 'https://www.globalissues.org/news/feed',
        'Yahoo Newsfeed' => 'https://www.yahoo.com/news/rss/world'
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 10; $i++) {
            Data::factory()->create([
                'data_type' => File::class,
                'data_id' => File::factory()->create()
            ]);
        }

        foreach (self::RSS_FEEDS as $name => $feed) {
            Data::factory()->create([
               'data_type' => RssFeed::class,
               'data_id' => RssFeed::factory()->create([
                   'url' => $feed,
                   'name' => $name
               ])
            ]);
        }
    }
}
