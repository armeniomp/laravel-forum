<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadsTest extends TestCase
{
    protected $thread;

    public function setUp() 
    {
        parent::setUp();

        $this->thread = create('App\Thread');
    }

    public function testUserBrowsingOneThread()
    {
        $this->get($this->thread->path())
            ->assertSee($this->thread->title);
    }

    public function testUserCanSeeReplies() 
    {
        $reply = factory('App\Reply')
            ->create(['thread_id' => $this->thread->id]);

        $this->get($this->thread->path())
            ->assertSee($reply->body);
    }

    public function testFilterThreadsByCategory()
    {
        $category = create('App\Category');

        $threadInCategory = create('App\Thread', ['category_id' => $category->id]);
        $threadNotInCategory = create('App\Thread');

        $this->get('forum/' . $category->slug)
            ->assertSee($threadInCategory->title)
            ->assertDontSee($threadNotInCategory->title);
    }

    public function testFilterThreadsByUsername()
    {
        $user = create('App\User');
        $this->signIn($user);

        $this->thread->user_id = $user->id;
        $this->thread->save();

        $anotherThread = create('App\Thread');

        $this->get("forum/threads/filter?by=" . $user->name)
            ->assertSee($this->thread->title)
            ->assertDontSee($anotherThread->title);
    }
}
