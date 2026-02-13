<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Speaker;
class EventSpeakerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $events = Event::all();
        $speakers = Speaker::all();

        foreach ($events as $event) {
            $selectedSpeakers = $speakers->random(rand(1, 3));
            
            foreach ($selectedSpeakers as $speaker) {
                $event->speakers()->attach($speaker->id, [
                    'topic' => fake()->sentence(4),
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }
    }
}
