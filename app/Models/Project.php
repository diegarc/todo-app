<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The "booting" method of the model.
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserScope());
    }
}
