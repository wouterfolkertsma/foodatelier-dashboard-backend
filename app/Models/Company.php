<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static where(string $string, string $company)
 * @method static factory()
 * @method static findOrFail(int $id)
 */
class Company extends Model
{
    /**
     * @return HasMany
     */
    public function users(): HasMany
    {
        return $this->hasMany(Client::class, 'company_id');
    }
}