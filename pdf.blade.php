<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Événement - {{ $event->title }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        h1 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h1>{{ $event->title }}</h1>
    
    <p><strong>Description:</strong> {{ $event->description }}</p>
    <p><strong>Date:</strong> {{ date('d/m/Y', strtotime($event->date)) }}</p>
    <p><strong>Lieu:</strong> {{ $event->location }}</p>

    <h2>Intervenants</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Email</th>
                <th>Sujet</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($event->speakers as $speaker): ?>
                <tr>
                    <td>{{ $speaker->name }}</td>
                    <td>{{ $speaker->email }}</td>
                    <td>{{ $speaker->pivot->topic }}</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Participants</h2>
    <table>
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($event->participants as $participant): ?>
                <tr>
                    <td>{{ $participant->last_name }}</td>
                    <td>{{ $participant->first_name }}</td>
                    <td>{{ $participant->email }}</td>
                    <td>{{ $participant->phone }}</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>