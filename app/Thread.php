<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thread extends Model
{
    protected $guarded = [];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('repliesCount', function ($builder) {
            $builder->withCount('replies');
        });
    }

    public function addReply($reply)
    {
        $this->replies()->create($reply);
    }

    public function toggleFavorite()
    {
        $user_id = ['user_id' => auth()->id()];
        if (!$this->favorites()->where($user_id)->exists()) {
            return $this->favorites()->create($user_id);
        } else {
            return $this->favorites()->where('user_id', $user_id)->first()->delete();
        }
    }

    public function path() 
    {
        return "/forum/threads/{$this->category->slug}/{$this->id}";
    }

    public function replies() 
    {
        return $this->hasMany(Reply::class);
    }
    
    public function user() 
    {
        return $this->belongsTo(User::class);
    }
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorite');
    }
    
    public function latestReply() 
    {
        return $this->hasOne(Reply::class)->latest();
    }

    public function scopeFilter($query, $filters)
    {
        return $filters->apply($query);
    }
    
    public function isFavorited() 
    {
        return $this->favorites()->where('user_id', auth()->id())->exists();
    }
    
    public function isOwner() 
    {
        return $this->user_id == auth()->id();
    }
}
