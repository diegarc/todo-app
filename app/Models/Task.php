<?php

namespace App\Models;

use App\Models\Scopes\UserScope;
use Carbon\Carbon;
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
    protected $dates = ['due_at', 'deleted_at'];

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
     * Get the due date formatted.
     *
     * @return null|string
     */
    public function getDueAtFormattedAttribute()
    {
        if ($this->due_at) {
            if ($this->due_at->eq(Carbon::today())) {
                return 'Hoy';
            } elseif ($this->due_at->eq(Carbon::tomorrow())) {
                return 'Mañana';
            } elseif ($this->due_at->between(Carbon::today()->addDays(2), Carbon::today()->addDays(6))) {
                return 'En ' . $this->due_at->diffInDays(Carbon::today()) . ' días';
            } elseif ($this->due_at->gt(Carbon::today()->addDays(6))) {
                return $this->due_at->toFormattedDateString();
            } elseif ($this->due_at->eq(Carbon::yesterday())) {
                return 'Ayer';
            } elseif ($this->due_at->lt(Carbon::yesterday())) {
                return $this->due_at->diffInDays(Carbon::today()) . ' días tarde';
            }
        } else {
            return null;
        }
    }

    /**
     * Get the due date state.
     *
     * @return null|string
     */
    public function getDueAtStateAttribute()
    {
        if ($this->due_at) {
            if ($this->due_at->gt(Carbon::today())) {
                return 'normal';
            } else {
                return 'danger';
            }
        } else {
            return null;
        }
    }
}
