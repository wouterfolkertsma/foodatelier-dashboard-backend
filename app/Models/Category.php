<?php


namespace App\Models;

use App\Models\Data\File;
use App\Models\Data\RssFeed;
use App\Models\Model;
use Illuminate\Support\Facades\DB;


/**
 * Class Data
 *
 * @package App\Models
 * @method static pluck(string $string, string $string1)
 */
class Category extends Model
{
    public function Category()
    {
        return $this->morphTo();
    }

    public function rssMembersCount()
    {
        $count = DB::table('rss_feeds')
            ->where('category_id', '=', $this->id)
            ->count();
        return $count;
    }
    public function fileMembersCount()
    {
        $count = DB::table('files')
            ->where('category_id', '=', $this->id)
            ->count();
        return $count;
    }
    public function trendFilterMembersCount()
    {
        $count = DB::table('trend_filters')
            ->where('category_id', '=', $this->id)
            ->count();
        return $count;
    }
}
