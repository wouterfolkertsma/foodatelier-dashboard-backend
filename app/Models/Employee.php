<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphOne;

class Employee extends Model
{

    /**
     * @return MorphOne
     */
    public function user(): MorphOne
    {
        return $this->morphOne(User::class, 'profile');
    }
}