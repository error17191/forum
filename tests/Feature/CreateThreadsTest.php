<?php

namespace Tests\Feature;

use App\Thread;
use App\User;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateThreadsTest extends TestCase
{
    use DatabaseMigrations;

    function test_guest_user_can_not_post_threads()
    {
        $this->expectException(AuthenticationException::class);

        $thread = make(Thread::class);
        $this->post('/threads', $thread->toArray());
    }

    function test_authenticated_user_can_post_new_forum_threads()
    {
        $this->signIn();
        $thread = create(Thread::class);

        $this->post('/threads', $thread->toArray());

        $this->get($thread->path())
            ->assertSee($thread->title)
            ->assertSee($thread->body);

    }
}
