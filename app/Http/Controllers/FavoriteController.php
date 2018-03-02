<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Favorite;
use App\Thread;
use App\Reply;

class FavoriteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');    
    }

    public function storeReply(Reply $reply)
    {
        if (!$reply->isOwner()) $reply->toggleFavorite();

        return redirect()->back();
    }

    public function storeThread(Thread $thread)
    {
        if (!$thread->isOwner()) $thread->toggleFavorite();

        return redirect()->back();
    }
}
