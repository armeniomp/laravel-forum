<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadTest extends TestCase
{
    public function testAuthUserCanCreateThreads()
    {
        $this->signIn();
        
        $thread = make('App\Thread');

        $response = $this->post('/forum/threads', $thread->toArray());
        
        $this->get($response->headers->get('Location'))
            ->assertSee($thread->title)
            ->assertSee($thread->body);
    }

    public function testGuestsCannotCreateThreads()
    {
        $thread = make('App\Thread');

        $this->get('/forum/threads/create')
            ->assertRedirect('/login');

        $this->post('/forum/threads', $thread->toArray())
            ->assertRedirect('/login');
    }

    public function testThreadValidation()
    {
        $this->signIn();

        $this->postThread(['title' => null])
            ->assertSessionHasErrors('title');
        
        $this->postThread(['body' => null])
            ->assertSessionHasErrors('body');

        $this->postThread(['category_id' => null])
            ->assertSessionHasErrors('category_id');
    }

    public function testThreadCategoryMustExistValidation()
    {
        $this->signIn();
        
        factory('App\Category', 2)->create();

        $this->postThread(['category_id' => 9999])
            ->assertSessionHasErrors('category_id');
    }

    public function postThread($attributes = [])
    {
        $thread = make('App\Thread', $attributes);

        return $this->post('forum/threads', $thread->toArray());
    }
}
