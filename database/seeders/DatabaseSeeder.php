<?php

namespace Database\Seeders;

use App\Models\Ticket;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create([
            'email' => 'jdiaz77711@gmail.com',
            'password' => 'password',
            'name' => 'Admin'
        ]);

        $users = User::factory(10)->create();

        Ticket::factory(100)
            ->recycle($users) // This method asigns a random user from the $users array to each ticket.
            ->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


    }
}
