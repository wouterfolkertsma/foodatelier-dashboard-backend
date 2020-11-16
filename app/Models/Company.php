<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static where(string $string, string $company)
 */
class Company extends Model
{
    /**
     * @return HasMany
     */
    public function students(): HasMany
    {
        return $this->hasMany(Client::class, 'client_id');
    }
}