@extends('layouts.app')

@section('content')
<div class="container">
    <h3 class="mb-3">Dossier de {{ $client->nom }}</h3>

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Email :</strong> {{ $client->email }}</p>
            <p><strong>Téléphone :</strong> {{ $client->telephone }}</p>
            <p><strong>Adresse :</strong> {{ $client->adresse }}</p>
            <p><strong>Service demandé :</strong> {{ $client->type_service }}</p>
            <p><strong>Problème :</strong> {{ $client->probleme }}</p>
            <p><strong>Adverse info :</strong> {{ $client->adverse_info }}</p>
            <p><strong>Pièce d’identité :</strong> <a href="{{ asset('storage/' . $client->piece_identite) }}" target="_blank">Voir</a></p>
            <p><strong>Documents :</strong></p>
            <ul>
                @foreach (json_decode($client->documents) as $doc)
                    <li><a href="{{ asset('storage/' . $doc) }}" target="_blank">📎 Voir document</a></li>
                @endforeach
            </ul>
        </div>
    </div>
    <div class="card mb-4">
    <div class="card-body">
        <form method="POST" action="{{ route('dossiers.updateStatut', $client->id) }}">
            @csrf
            @method('PUT')

            <label for="statut" class="form-label"><strong>Statut du dossier</strong></label>
            <select name="statut" id="statut" class="form-select mb-3" required>
                <option value="nouveau" {{ $client->statut == 'nouveau' ? 'selected' : '' }}>Nouveau</option>
                <option value="en cours" {{ $client->statut == 'en cours' ? 'selected' : '' }}>En cours</option>
                <option value="terminé" {{ $client->statut == 'terminé' ? 'selected' : '' }}>Terminé</option>
            </select>

            <button type="submit" class="btn btn-success">Mettre à jour le statut</button>
        </form>
    </div>
</div>
    <a href="{{ route('chat.show', $client->id) }}" class="btn btn-primary">Ouvrir le chat</a>
</div>
@endsection
