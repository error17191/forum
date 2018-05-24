<?php

use Illuminate\Database\Seeder;
use App\Thread;
use App\Reply;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Thread::truncate();
        User::truncate();
        Reply::truncate();

        factory(Thread::class,50)->create()->each(function ($thread){
            factory(Reply::class,10)->create(['thread_id' => $thread->id]);
        });

    }
}
