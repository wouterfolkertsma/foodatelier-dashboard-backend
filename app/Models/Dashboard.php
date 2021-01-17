<?php

namespace App\Models;

use App\Models\Data\Data;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @method static factory()
 * @method static firstWhere(string $string, $company_id)
 * @method static pluck(string $string, string $string1)
 * @property mixed|string name
 * @property mixed company_id
 */
class Dashboard extends Model
{
    /**
     * @return BelongsToMany
     */
    public function data(): BelongsToMany
    {
        return $this->belongsToMany(Data::class, 'dashboard_data');
    }

    /**
     * @return BelongsTo
     */
    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class, 'company_id');
    }
}