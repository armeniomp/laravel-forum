<?php

namespace App\Filters;

use Illuminate\Http\Request;
use App\User;

class ThreadFilters extends Filters
{
    protected $filters = ['by'];

    /**
     * Filter the query by a user name 
     * 
     * @param String $username
     * @return mixed
    */
    public function by($username)
    {
        $user = User::where('name', $username)->firstOrFail();

        return $this->builder->where('user_id', $user->id);
    }

    /**
     * Get the search terms from the request
     * 
     * @return String
     */
    public function terms()
    {
        return "Filters: " .  implode(', ', $this->getFilters());
    }
}
