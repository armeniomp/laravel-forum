<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('threadCount', function ($builder) {
            $builder->withCount('threads');
        });

        static::addGlobalScope('repliesCount', function ($builder) {
            $builder->withCount('replies');
        });
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeMain($query)
    {
        return $query->where('parent_id', 0);
    }

    public function parent()
    {
        return $this->belongsTo($this, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany($this, 'parent_id');
    }

    public function threads()
    {
        return $this->hasMany('App\Thread');
    }

    public function replies()
    {
        return $this->hasManyThrough(Reply::class, Thread::class);
    }
}
