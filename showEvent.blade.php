<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $event->title }}</title>
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
        <div class="mb-4">
            <a href="{{ route('events.index') }}" class="btn btn-secondary">Retour</a>
            <a href="{{ route('events.edit', $event) }}" class="btn btn-warning">Modifier</a>
            <a href="{{ route('events.pdf', $event) }}" class="btn btn-success">Générer PDF</a>
            <a href="{{ route('events.export', $event) }}" class="btn btn-info">Exporter Participants</a>
        </div>

        <h1>{{ $event->title }}</h1>

        <?php if($event->image): ?>
            <img src="{{ $event->image }}" class="img-fluid mb-3" alt="{{ $event->title }}">
        <?php endif; ?>

        <p><strong>Description:</strong> {{ $event->description }}</p>
        <p><strong>Date:</strong> {{ date('d/m/Y', strtotime($event->date)) }}</p>
        <p><strong>Lieu:</strong> {{ $event->location }}</p>

        <hr>

        <h3>Intervenants ({{ $event->speakers->count() }})</h3>
        <ul class="list-group mb-4">
            <?php if($event->speakers->count() > 0): ?>
                <?php foreach($event->speakers as $speaker): ?>
                    <li class="list-group-item">
                        <strong>{{ $speaker->name }}</strong> - {{ $speaker->email }}<br>
                        <em>Sujet: {{ $speaker->pivot->topic }}</em>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li class="list-group-item">Aucun intervenant</li>
            <?php endif; ?>
        </ul>

        <h3>Participants ({{ $event->participants->count() }})</h3>

        <form action="{{ route('events.add-participant', $event) }}" method="POST" class="mb-3">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-10">
                    <select name="participant_id" class="form-control" required>
                        <option value="">-- Ajouter un participant --</option>
                        <?php foreach($allParticipants as $participant): ?>
                            <option value="{{ $participant->id }}">
                                {{ $participant->first_name }} {{ $participant->last_name }} ({{ $participant->email }})
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Ajouter</button>
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Date d'inscription</th>
                </tr>
            </thead>
            <tbody>
                <?php if($event->participants->count() > 0): ?>
                    <?php foreach($event->participants as $participant): ?>
                        <tr>
                            <td>{{ $participant->last_name }}</td>
                            <td>{{ $participant->first_name }}</td>
                            <td>{{ $participant->email }}</td>
                            <td>{{ $participant->phone }}</td>
                            <td>{{ date('d/m/Y H:i', strtotime($participant->pivot->registered_at)) }}</td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Aucun participant</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <hr>

        <h3>Importer des participants depuis Excel</h3>
        <form action="{{ route('events.import', $event) }}" method="POST" enctype="multipart/form-data">
            <?php echo csrf_field(); ?>
            <div class="row">
                <div class="col-md-10">
                    <input type="file" name="file" class="form-control" accept=".xlsx,.xls" required>
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Importer</button>
                </div>
            </div>
        </form>
    </div>
</body>
</html>