<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Dossiers PDF</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h2 { margin-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 15px; }
        th, td { border: 1px solid #000; padding: 6px; text-align: left; }
        th { background-color: #f0f0f0; }
    </style>
</head>
<body>
    <h2>Dossiers du client : {{ $client->prenom }} {{ $client->name }}</h2>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>Titre</th>
                <th>Domaine</th>
                <th>Adversaire</th>
                <th>Problème</th>
                <th>Statut</th>
                <th>Date de soumission</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($dossiers as $index => $dossier)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $dossier->titre ?? 'Sans titre' }}</td>
                    <td>{{ $dossier->domaine }}</td>
                    <td>{{ $dossier->adversaire }}</td>
                    <td>{{ Str::limit($dossier->probleme, 50) }}</td>
                    <td>{{ ucfirst($dossier->statut ?? 'En attente') }}</td>
                    <td>{{ $dossier->created_at->format('d/m/Y') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="7">Aucun dossier trouvé.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</body>
</html>
