<?php

namespace App\Traits;

use App\Http\Requests\StoreUser;
use App\Models\Dashboard;
use App\Models\Data\File;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * Trait HasDashboard
 *
 * @package App\Traits
 */
trait HasDashboard
{
    /**
     * @return array
     */
    protected function getDashboard()
    {
        return Dashboard::firstWhere('company_id', auth()->user()->load('profile')->profile->company_id)->load('data');
    }
}