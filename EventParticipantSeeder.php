<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Event;
use App\Models\Participant;
class EventParticipantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $events = Event::all();
        $participants = Participant::all();

        foreach ($events as $event) {
            $selectedParticipants = $participants->random(rand(3, 8));
            
            foreach ($selectedParticipants as $participant) {
                $event->participants()->attach($participant->id, [
                    'registered_at' => now()
                ]);
            }
        }
    }
}
