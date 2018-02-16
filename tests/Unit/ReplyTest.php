<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReplyTest extends TestCase
{
    protected $reply;

    public function setUp() 
    {
        parent::setUp();

        $this->reply = create('App\Reply');
    }

    public function testReplyBelongsToAUser()
    {
        $this->assertInstanceOf('App\User', $this->reply->user);
    }
}
