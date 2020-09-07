<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
Use App\User;
Use App\Article;
Use App\Comment;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class)->create([
            'email' => 'testroot@mail.com',
            'password' => Hash::make("testroot"),
        ]);

        factory(Article::class)->times(20)->create();
        factory(Comment::class)->times(10)->create();


    }
}