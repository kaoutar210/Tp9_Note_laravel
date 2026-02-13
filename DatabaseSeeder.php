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

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        //$this->call([
        //    AuthorSeeder::class,
        //  ReaderSeeder::class,
        //    BookSeeder::class,
        //]);

        /*$this->call([
            UserSeeder::class,
            CoursSeeder::class,
            EtudiantSeeder::class,
        ]);*/

        $this->call([
            ClientSeeder::class,
            SpeakerSeeder::class,
            ParticipantSeeder::class,
            EventSeeder::class,
            EventSpeakerSeeder::class,
            EventParticipantSeeder::class,
        ]);

    }
}
