<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Événements</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="{{ route('events.index') }}">Événements </a>
            <div class="navbar-nav">
                <a class="nav-link" href="{{ route('events.index') }}">Événements</a>
                <a class="nav-link" href="{{ route('participants.index') }}">Participants</a>
                <a class="nav-link" href="{{ route('speakers.index') }}">Intervenants</a>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Liste des Événements</h1>
            <a href="{{ route('events.create') }}" class="btn btn-primary">Créer un événement</a>
        </div>

        <form action="{{ route('events.index') }}" method="GET" class="mb-4">
            <div class="input-group">
                <input type="text" name="search" class="form-control" placeholder="Rechercher un événement..." value="{{ $search }}">
                <button class="btn btn-outline-secondary" type="submit">Rechercher</button>
            </div>
        </form>

        <div class="row">
            <?php foreach($events as $event): ?>
            <div class="col-md-6 mb-4">
                <div class="card">
                    <?php if($event->image): ?>
                        <img src="{{ $event->image }}" class="card-img-top" alt="{{ $event->title }}">
                    <?php endif; ?>
                    <div class="card-body">
                        <h5 class="card-title">{{ $event->title }}</h5>
                        <p class="card-text">{{ substr($event->description, 0, 100) }}...</p>
                        <p class="text-muted">
                            <strong>Date:</strong> {{ date('d/m/Y', strtotime($event->date)) }}<br>
                            <strong>Lieu:</strong> {{ $event->location }}
                        </p>
                        <a href="{{ route('events.show', $event) }}" class="btn btn-sm btn-info">Détails</a>
                        <a href="{{ route('events.edit', $event) }}" class="btn btn-sm btn-warning">Modifier</a>
                        <form action="{{ route('events.destroy', $event) }}" method="POST" style="display:inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer la suppression?')">Supprimer</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</body>
</html>