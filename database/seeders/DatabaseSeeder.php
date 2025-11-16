<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            ClientSeeder::class,
            LeadSeeder::class,
            NoteSeeder::class,
            TaskSeeder::class,
            ReminderSeeder::class,
        ]);
    }
}

