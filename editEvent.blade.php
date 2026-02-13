<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'Événement</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('events.index') }}">Événements Pro</a>
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('events.index') }}">Événements</a>
                <a class="nav-link" href="{{ route('participants.index') }}">Participants</a>
                <a class="nav-link" href="{{ route('speakers.index') }}">Intervenants</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h1>Modifier l'Événement</h1>

        <form action="{{ route('events.update', $event) }}" method="POST">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PUT'); ?>
            
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $event->title }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ $event->description }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ $event->date }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="location" class="form-label">Lieu</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{ $event->location }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image (URL)</label>
                <input type="text" class="form-control" id="image" name="image" value="{{ $event->image }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Intervenants</label>
                
                <?php 
                $eventSpeakersData = [];
                foreach($event->speakers as $speaker) {
                    $pivotData = \DB::table('event_speaker')
                        ->where('event_id', $event->id)
                        ->where('speaker_id', $speaker->id)
                        ->first();
                    
                    $eventSpeakersData[] = [
                        'id' => $speaker->id,
                        'name' => $speaker->name,
                        'topic' => $pivotData ? $pivotData->topic : ''
                    ];
                }
                
                $maxSpeakers = max(3, count($eventSpeakersData));
                ?>

                <?php for($i = 0; $i < $maxSpeakers; $i++): ?>
                <div class="mb-2">
                    <div class="row">
                        <div class="col-md-6">
                            <select name="speakers[]" class="form-control">
                                <option value="">-- Sélectionner un intervenant --</option>
                                <?php foreach($speakers as $speaker): ?>
                                    <option value="{{ $speaker->id }}" 
                                        <?php if(isset($eventSpeakersData[$i]) && $eventSpeakersData[$i]['id'] == $speaker->id): ?>
                                            selected
                                        <?php endif; ?>
                                    >
                                        {{ $speaker->name }}
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="topics[]" class="form-control" placeholder="Sujet" 
                                value="<?php echo isset($eventSpeakersData[$i]) ? $eventSpeakersData[$i]['topic'] : ''; ?>">
                        </div>
                    </div>
                </div>
                <?php endfor; ?>
            </div>

            <button type="submit" class="btn btn-primary">Mettre à jour</button>
            <a href="{{ route('events.show', $event) }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>