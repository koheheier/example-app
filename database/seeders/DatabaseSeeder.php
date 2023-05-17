<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // tweetにuser_idが関連づけられているので、userが最初にする
        $this->call([
            UsersSeeder::class,
            TweetsSeeder::class
        ]);
        
    }
}
