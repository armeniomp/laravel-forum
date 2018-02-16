<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ForumParticipationTest extends TestCase
{
    public function testUnauthUserCannotReplyToThread()
    {
        $this->post('forum/threads/aut/1/replies', [])
            ->assertRedirect('/login');
    }

    public function testAuthUserCanReplyToThread()
    {
        $this->withoutExceptionHandling();
        $this->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply');
        
        $this->post($thread->path() . '/replies', $reply->toArray());

        $this->get($thread->path())
            ->assertSee($reply->body);
    }

    public function testReplyValidation()
    {
        $this->signIn();

        $thread = create('App\Thread');
        $reply = make('App\Reply', ['body' => null]);

        $this->post($thread->path() . '/replies', $reply->toArray())
            ->assertSessionHasErrors('body');
    }
}
