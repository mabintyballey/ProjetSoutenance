@extends('administration.base')

@section('content')
<div class="container py-5">

    <!-- Titre principal -->
    <div class="text-center mb-5">
        <h1 class="fw-bold d-inline-flex align-items-center"
            style="border-bottom: 4px solid #aa9166; padding-bottom: 10px;">
            <i class="bi bi-people-fill me-2" style="font-size: 1.8rem;"></i>
            Gestion des Clients
        </h1>
        <p class="mt-3 text-muted fst-italic">
            « Un bon service commence toujours par une bonne écoute de ses clients. »
        </p>
    </div>

    <!-- Formulaire de filtre -->
    <form method="GET" class="row g-3 align-items-end mb-4 bg-white border shadow-sm rounded p-4">
        <div class="col-md-3">
            <label class="form-label fw-semibold text-dark">Recherche</label>
            <input type="text" name="search" class="form-control"
                   placeholder="Nom ou prénom" value="{{ request('search') }}">
        </div>

        <div class="col-md-3">
            <label class="form-label fw-semibold text-dark">Trier par</label>
            <select name="sort_by" class="form-select">
                <option value="">Trier par</option>
                <option value="name" @selected(request('sort_by') == 'name')>Nom</option>
                <option value="prenom" @selected(request('sort_by') == 'prenom')>Prénom</option>
                <option value="email" @selected(request('sort_by') == 'email')>Email</option>
            </select>
        </div>

        <div class="col-md-3">
            <label class="form-label fw-semibold text-dark">Filtrer par statut</label>
            <select name="statut" class="form-select">
                <option value="">Tous les statuts</option>
                <option value="valide" @selected(request('statut') == 'valide')>Validé</option>
                <option value="rejete" @selected(request('statut') == 'rejete')>Rejeté</option>
                <option value="en_attente" @selected(request('statut') == 'en_attente')>En attente</option>
            </select>
        </div>

        <div class="col-md-auto">
            <button type="submit" class="btn btn-primary w-100 mb-2 mb-md-0">
                <i class="bi bi-filter me-1"></i> Filtrer
            </button>
            <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary w-100 mt-2">
                <i class="bi bi-x-circle me-1"></i> Réinitialiser
            </a>
        </div>

        <div class="col-md text-md-end mt-3 mt-md-0">
            <a href="{{ route('admin.clients.attente') }}" class="btn btn-outline-warning">
                Voir les clients en attente
            </a>
        </div>
    </form>

    <!-- Nombre de clients -->
    <div class="mb-3 text-end text-muted">
        <i class="bi bi-people me-1"></i>
        {{ $clients->total() }} client{{ $clients->total() > 1 ? 's' : '' }} trouvé{{ $clients->total() > 1 ? 's' : '' }}.
    </div>

    <!-- Cartes des clients -->
    <div class="row g-4">
        @forelse ($clients as $client)
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div class="text-center mb-3">
                            <img src="{{ $client->photo_profil ? asset('storage/' . $client->photo_profil) : asset('images/default-user.png') }}"
                                 alt="Photo de profil"
                                 class="rounded-circle border shadow-sm mx-auto d-block"
                                 style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                        <h5 class="card-title text-center fw-bold text-primary">
                            <i class="bi bi-person-circle me-2"></i> {{ $client->prenom }} {{ $client->name }}
                        </h5>
                        <p class="text-muted text-center mb-2">
                            <i class="bi bi-envelope-fill me-2"></i> {{ $client->email }}
                        </p>
                        <p class="text-center">
                            <i class="bi bi-shield-check me-2"></i>
                            @if ($client->statut_validation === 'valide')
                                <span class="badge bg-success">Validé</span>
                            @elseif ($client->statut_validation === 'rejete')
                                <span class="badge bg-danger">Rejeté</span>
                            @else
                                <span class="badge bg-warning text-dark">En attente</span>
                            @endif
                        </p>
                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('admin.clients.dossiers', $client->id) }}" class="btn btn-sm btn-outline-primary w-100 me-1">
                                <i class="bi bi-folder2-open me-1"></i> Dossiers
                            </a>
                            <form action="{{ route('admin.clients.destroy', $client->id) }}" method="POST"
                                  onsubmit="return confirm('Confirmer la suppression ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger w-100 ms-1">
                                    <i class="bi bi-trash3 me-1"></i> Supprimer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center text-muted py-4">
                <i class="bi bi-emoji-frown fs-3 d-block mb-2"></i>
                Aucun client trouvé.
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4 d-flex justify-content-center">
        {{ $clients->withQueryString()->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection
