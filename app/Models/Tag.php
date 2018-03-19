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

    /**
     * Scope a query to find by the text.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $text
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeFindByText($query, $text)
    {
        return $query->where('text', $text);
    }

}
