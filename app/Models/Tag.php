<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text', 'user_id'];

    /**
     * The "booting" method of the model.
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserScope());
    }
}
