@extends('administration.base')

@section('content')
<div class="container mt-4">
    <h4 class="mb-3">📄 Détails de la requête</h4>

    <p><strong>Client :</strong> {{ $requete->client->user->prenom }} {{ $requete->client->user->nom }}</p>
    <p><strong>Domaine :</strong> {{ $requete->domaine->nom }}</p>
    <p><strong>Problème :</strong> {{ $requete->probleme }}</p>
    <p><strong>Infos partie adverse :</strong> {{ $requete->info_adverse }}</p>
        <a href="{{ route('admin.requetes.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
