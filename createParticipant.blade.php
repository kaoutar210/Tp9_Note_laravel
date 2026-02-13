<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Participant</title>
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
        <h1>Créer un Participant</h1>

        <form action="{{ route('participants.store') }}" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="mb-3">
                <label for="first_name" class="form-label">Prénom</label>
                <input type="text" class="form-control" id="first_name" name="first_name" required>
            </div>

            <div class="mb-3">
                <label for="last_name" class="form-label">Nom</label>
                <input type="text" class="form-control" id="last_name" name="last_name" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Téléphone</label>
                <input type="text" class="form-control" id="phone" name="phone" required>
            </div>

            <button type="submit" class="btn btn-primary">Créer</button>
            <a href="{{ route('participants.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>