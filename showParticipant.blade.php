<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Participant</title>
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
        <h1>{{ $participant->first_name }} {{ $participant->last_name }}</h1>

        <p><strong>Email:</strong> {{ $participant->email }}</p>
        <p><strong>Téléphone:</strong> {{ $participant->phone }}</p>

        <h3>Événements participés</h3>
        <ul class="list-group">
            <?php foreach($participant->events as $event): ?>
                <li class="list-group-item">
                    <a href="{{ route('events.show', $event) }}">{{ $event->title }}</a>
                </li>
            <?php endforeach; ?>
        </ul>

        <div class="mt-3">
            <a href="{{ route('participants.index') }}" class="btn btn-secondary">Retour</a>
            <a href="{{ route('participants.edit', $participant) }}" class="btn btn-warning">Modifier</a>
        </div>
    </div>
</body>
</html>