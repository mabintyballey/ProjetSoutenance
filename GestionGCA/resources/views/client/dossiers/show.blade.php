@extends('client.base')

@section('content')
<div class="container mt-6">
    <h2 class="text-xl font-bold mb-4">Détails du Dossier</h2>

    <p><strong>Type d'affaire :</strong> {{ $dossier->type_affaire }}</p>
    <p><strong>Description :</strong> {{ $dossier->description }}</p>
    <p><strong>Information adverse :</strong> {{ $dossier->information_adverse }}</p>
    <p><strong>Statut :</strong> {{ $dossier->statut_validation }}</p>
</div>
@endsection
