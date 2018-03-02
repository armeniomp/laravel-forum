<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('counts', function ($builder) {
            $builder->withCount('threads', 'replies', 'favoritesThreads', 'favoritesReplies');
        });
    }

    public function threads()
    {
        return $this->hasMany(Thread::class);
    }

    public function replies()
    {
        return $this->hasMany(Reply::class);
    }

    public function favoritesThreads()
    {
        return $this->hasManyThrough(Favorite::class, Thread::class, 'user_id', 'favorite_id', 'id', 'id')
                        ->where('favorite_type', 'App\Thread');
    }

    public function favoritesReplies()
    {
        return $this->hasManyThrough(Favorite::class, Reply::class, 'user_id', 'favorite_id', 'id', 'id')
                        ->where('favorite_type', 'App\Reply');
    }

    public function getPostsAttribute()
    {
        return $this->threads_count + $this->replies_count;
    }

    public function getFavoritesAttribute()
    {
        return $this->favorites_threads_count + $this->favorites_replies_count;
    }
}
