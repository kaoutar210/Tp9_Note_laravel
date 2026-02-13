<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Événement</title>
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
        <h1>Créer un Événement</h1>

        <?php if($errors->any()): ?>
            <div class="alert alert-danger">
                <ul>
                    <?php foreach($errors->all() as $error): ?>
                        <li>{{ $error }}</li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

        <form action="{{ route('events.store') }}" method="POST">
            <?php echo csrf_field(); ?>
            
            <div class="mb-3">
                <label for="title" class="form-label">Titre</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="date" class="form-label">Date</label>
                    <input type="date" class="form-control" id="date" name="date" value="{{ old('date') }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label for="location" class="form-label">Lieu</label>
                    <input type="text" class="form-control" id="location" name="location" value="{{ old('location') }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Image (URL)</label>
                <input type="text" class="form-control" id="image" name="image" value="{{ old('image') }}">
            </div>

            <div class="mb-3">
                <label class="form-label">Intervenants</label>
                
                <div class="mb-2">
                    <div class="row">
                        <div class="col-md-6">
                            <select name="speakers[]" class="form-control">
                                <option value="">-- Sélectionner un intervenant --</option>
                                <?php foreach($speakers as $speaker): ?>
                                    <option value="{{ $speaker->id }}">{{ $speaker->name }}</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="topics[]" class="form-control" placeholder="Sujet">
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <div class="row">
                        <div class="col-md-6">
                            <select name="speakers[]" class="form-control">
                                <option value="">-- Sélectionner un intervenant --</option>
                                <?php foreach($speakers as $speaker): ?>
                                    <option value="{{ $speaker->id }}">{{ $speaker->name }}</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="topics[]" class="form-control" placeholder="Sujet">
                        </div>
                    </div>
                </div>

                <div class="mb-2">
                    <div class="row">
                        <div class="col-md-6">
                            <select name="speakers[]" class="form-control">
                                <option value="">-- Sélectionner un intervenant --</option>
                                <?php foreach($speakers as $speaker): ?>
                                    <option value="{{ $speaker->id }}">{{ $speaker->name }}</option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <input type="text" name="topics[]" class="form-control" placeholder="Sujet">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Créer</button>
            <a href="{{ route('events.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</body>
</html>