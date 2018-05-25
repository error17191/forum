<?php

namespace Tests\Unit;

use App\Thread;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ThreadTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->thread = create(Thread::class);
    }

    /** @test */

    public function a_thread_has_replies()
    {
        $this->assertInstanceOf(Collection::class, $this->thread->replies);
    }

    /** @test */
    public function a_thread_has_an_owner()
    {
        $this->assertInstanceOf(User::class, $this->thread->owner);
    }

    /** @test */

    public function a_thread_can_add_a_reply()
    {
        $this->thread->addReply([
            'body' => 'bla bla',
            'user_id' => 1
        ]);

        $this->assertCount(1,$this->thread->replies);
    }
}
