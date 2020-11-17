<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphOne;

/**
 * @method static factory()
 */
class Employee extends User
{

    /**
     * @return MorphOne
     */
    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'profile');
    }
}