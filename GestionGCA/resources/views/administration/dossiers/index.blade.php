@extends('administration.base')

@section('content')
<div class="container py-4 mt-3">

    <!-- Titre principal -->
    <h4 class="text-center text-primary mb-4 fw-bold">
        <i class="fas fa-briefcase"></i> Gestion des Dossiers
    </h4>

    <!-- Statistiques -->
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-white bg-primary">
                <div class="card-body py-2 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small">Total Dossiers</div>
                        <h5>{{ $stats['total'] }}</h5>
                    </div>
                    <i class="fas fa-folder fa-lg"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-success">
                <div class="card-body py-2 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small">Validés</div>
                        <h5>{{ $stats['valide'] }}</h5>
                    </div>
                    <i class="fas fa-check-circle fa-lg"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-warning">
                <div class="card-body py-2 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small">En attente</div>
                        <h5>{{ $stats['attente'] }}</h5>
                    </div>
                    <i class="fas fa-hourglass-half fa-lg"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-white bg-danger">
                <div class="card-body py-2 d-flex justify-content-between align-items-center">
                    <div>
                        <div class="small">Rejetés</div>
                        <h5>{{ $stats['rejete'] }}</h5>
                    </div>
                    <i class="fas fa-times-circle fa-lg"></i>
                </div>
            </div>
        </div>
    </div>


    <!-- Barre de recherche -->
  <form method="GET" class="row g-2 mb-4">
    <div class="col-md-6">
        <input type="text" name="search" class="form-control" placeholder="Rechercher un client, avocat, type..." value="{{ request('search') }}">
    </div>

    <div class="col-md-3">
        <select name="statut" class="form-select">
            <option value="">Tous les statuts</option>
            <option value="validé" {{ request('statut') == 'validé' ? 'selected' : '' }}>Validés</option>
            <option value="en attente" {{ request('statut') == 'en attente' ? 'selected' : '' }}>En attente</option>
            <option value="rejeté" {{ request('statut') == 'rejeté' ? 'selected' : '' }}>Rejetés</option>
        </select>
    </div>

    <div class="col-md-3">
        <select name="type_affaire" class="form-select">
            <option value="">Tous les types</option>
            @foreach ($types_affaires as $type)
                <option value="{{ $type }}" {{ request('type_affaire') == $type ? 'selected' : '' }}>
                    {{ ucfirst($type) }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="col-md-12 text-end">
        <button class="btn btn-outline-primary">
            <i class="fas fa-filter"></i> Filtrer
        </button>
    </div>
</form>

    <!-- Affichage des dossiers -->
    <div class="row">
        @forelse ($dossiers as $dossier)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title text-primary">{{ $dossier->type_affaire }}</h5>
                        <p><i class="fas fa-user me-1"></i><strong>Client :</strong> {{ $dossier->client->prenom }} {{ $dossier->client->name }}</p>
                        <p><i class="fas fa-user-tie me-1"></i><strong>Avocat :</strong> {{ $dossier->avocat->name ?? 'Non attribué' }}</p>
                        <p><i class="fas fa-calendar me-1"></i><strong>Date :</strong> {{ $dossier->created_at->format('d/m/Y') }}</p>
                        <span class="badge bg-{{ $dossier->statut == 'validé' ? 'success' : ($dossier->statut == 'rejeté' ? 'danger' : 'warning') }}">
                            {{ ucfirst($dossier->statut) }}
                        </span>
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-sm btn-outline-info" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDossier{{ $dossier->id }}">
                            <i class="fas fa-eye"></i> Voir
                        </button>
                    </div>
                </div>
            </div>

            <!-- Offcanvas -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDossier{{ $dossier->id }}">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Dossier #{{ $dossier->id }}</h5>
                    <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <p><strong>Description :</strong> {{ $dossier->description }}</p>
                    <p><strong>Info adverse :</strong> {{ $dossier->information_adverse }}</p>
                    <p><strong>Statut :</strong> {{ ucfirst($dossier->statut) }}</p>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning">Aucun dossier trouvé.</div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $dossiers->links() }}
    </div>
</div>
@endsection
