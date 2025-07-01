<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Soumettre une requête</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --gold: #aa9166;
            --blue: #34568B;
            --gray: #f8f9fa;
        }
        .bg-blue { background-color: var(--blue); }
        .btn-gold {
            background-color: var(--gold);
            color: white;
        }
        .btn-gold:hover {
            background-color: #8a734e;
            color: white;
        }
    </style>
</head>
<body class="bg-light" style="background: linear-gradient(120deg, #0f172a, #1e293b);">

<div class="container my-5">
    <div class="card shadow-sm border-top border-4" style="border-color: var(--gold);">
        <div class="card-header bg-blue text-white">
            <h4 class="mb-0">📄 Soumettre une requête juridique</h4>
            <small>Remplissez les champs ci-dessous pour lancer votre demande.</small>
        </div>
        <div class="card-body">

            <form action="{{ route('client.requetes.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Domaine -->
                <div class="mb-3">
                    <label for="type_aide" class="form-label">Type d’aide juridique</label>
                    <select class="form-select" name="type_aide" id="type_aide" required>
                        <option value="">-- Sélectionner un domaine --</option>
                        @foreach($domaines as $domaine)
                            <option value="{{ $domaine->id }}">{{ ucfirst($domaine->nom) }}</option>
                        @endforeach
                    </select>
                </div>

                <!-- Problème -->
                <div class="mb-3">
                    <label class="form-label">Votre problème</label>
                    <textarea name="probleme" class="form-control" rows="4" required></textarea>
                </div>

                <!-- Partie adverse -->
                <div class="mb-3">
                    <label class="form-label">Informations sur la partie adverse</label>
                    <textarea name="info_adverse" class="form-control" rows="3" required></textarea>
                </div>

                <!-- Documents multiples -->
                <div class="mb-3">
                    <label class="form-label">Documents justificatifs (PDF, Word, images)</label>
                    <input type="file" name="documents[]" multiple required class="form-control"
                           accept=".pdf,.doc,.docx,.jpg,.jpeg,.png">
                    <div class="form-text">Vous pouvez ajouter plusieurs fichiers à la fois.</div>
                </div>

                <!-- Soumettre -->
                <div class="text-end">
                    <button type="submit" class="btn btn-gold">📤 Soumettre la requête</button>
                </div>

            </form>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
