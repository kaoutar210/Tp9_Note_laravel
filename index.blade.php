<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Intervenants</title>
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
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Liste des Intervenants</h1>
            <a href="{{ route('speakers.create') }}" class="btn btn-primary">Créer un intervenant</a>
        </div>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Bio</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($speakers as $speaker): ?>
                    <tr>
                        <td>{{ $speaker->id }}</td>
                        <td>{{ $speaker->name }}</td>
                        <td>{{ $speaker->email }}</td>
                        <td>{{ substr($speaker->bio, 0, 50) }}...</td>
                        <td>
                            <a href="{{ route('speakers.show', $speaker) }}" class="btn btn-sm btn-info">Voir</a>
                            <a href="{{ route('speakers.edit', $speaker) }}" class="btn btn-sm btn-warning">Modifier</a>
                            <form action="{{ route('speakers.destroy', $speaker) }}" method="POST" style="display:inline;">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Confirmer?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</body>
</html>