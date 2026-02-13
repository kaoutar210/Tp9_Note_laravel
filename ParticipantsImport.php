<?php

namespace App\Imports;

use App\Models\Event;
use App\Models\Participant;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ParticipantsImport implements ToModel, WithHeadingRow
{
    protected $event;

    public function __construct(Event $event)
    {
        $this->event = $event;
    }

    public function model(array $row)
    {
        $participant = Participant::firstOrCreate(
            ['email' => $row['email']],
            [
                'first_name' => $row['prenom'] ?? $row['first_name'],
                'last_name' => $row['nom'] ?? $row['last_name'],
                'phone' => $row['telephone'] ?? $row['phone'],
            ]
        );

        $this->event->participants()->syncWithoutDetaching([
            $participant->id => ['registered_at' => now()]
        ]);

        return $participant;
    }
}