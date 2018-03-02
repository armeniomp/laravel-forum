<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class FavoritesTest extends TestCase
{
    public function testAuthUserCanFavoriteRepliesAndThreads()
    {
        $this->signIn();

        $reply = create('App\Reply');
        $thread = create('App\Thread');

        $this->post('/forum/replies/' . $reply->id . '/like');
        $this->post('/forum/threads/' . $thread->id . '/like');

        $this->assertCount(1, $reply->favorites);
        $this->assertCount(1, $thread->favorites);
    }

    public function testGuestCannotFavoriteRepliesAndThreads()
    {
        $reply = create('App\Reply');
        $thread = create('App\Thread');

        $this->post('/forum/replies/' . $reply->id . '/like')
            ->assertRedirect('/login');
        $this->post('/forum/threads/' . $thread->id . '/like')
            ->assertRedirect('/login');
    }

    public function testAuthUserCanOnlyFavoriteAPostOnce()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $reply = create('App\Reply');
        $thread = create('App\Thread');

        $this->post('/forum/replies/' . $reply->id . '/like');
        $this->post('/forum/replies/' . $reply->id . '/like');
        $this->post('/forum/threads/' . $thread->id . '/like');
        $this->post('/forum/threads/' . $thread->id . '/like');
        
        $this->assertCount(0, $reply->favorites);
        $this->assertCount(0, $thread->favorites);
    }
}
