<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['text', 'description', 'user_id'];

    /**
     * The "booting" method of the model.
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new UserScope());
    }

    /**
     * The tags that belong to the task.
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }

    /**
     * Scope a query to only include filtered tasks.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param boolean $starred
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFilter($query, $starred)
    {
        if ($starred !== null) {
            $query->where('starred', $starred);
        }

        return $query;
    }
}
