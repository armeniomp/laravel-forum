<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
    protected $thread;

    public function setUp() 
    {
        parent::setUp();

        $this->thread = create('App\Thread');
    }

    public function testThreadStringPath()
    {
        $this->assertEquals("/forum/threads/{$this->thread->category->slug}/{$this->thread->id}", $this->thread->path());
    }

    public function testThreadBelongsToAUser()
    {
        $this->assertInstanceOf('App\User', $this->thread->user);
    }

    public function testThreadHasReplies() 
    {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->thread->replies);
    }

    public function testThreadCanAddReply()
    {
        $this->thread->addReply([
            'user_id' => 1,
            'body' => 'Lorem Ipsum'
        ]);

        $this->assertCount(1, $this->thread->replies);
    }

    public function testThreadBelongsToCategory()
    {
        $this->assertInstanceOf('App\Category', $this->thread->category);
    }
}
