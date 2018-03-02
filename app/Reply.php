<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $touches = ['thread'];
    protected $guarded = [];

    public function user() 
    {
        return $this->belongsTo(User::class);
    }

    public function thread()
    {
        return $this->belongsTo(Thread::class);
    }

    public function favorites()
    {
        return $this->morphMany(Favorite::class, 'favorite');
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
    
    public function isFavorited() 
    {
        return $this->favorites()->where('user_id', auth()->id())->exists();
    }
    
    public function isOwner() 
    {
        return $this->user_id == auth()->id();
    }
}
