@extends('administration.base')

@section('content')
<style>
    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .card-hover:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        transform: translateY(-4px);
        transition: all 0.3s ease-in-out;
    }
    .badge-custom {
        padding: 5px 12px;
        font-size: 0.8rem;
        font-weight: bold;
        border-radius: 20px;
        text-transform: uppercase;
    }
    .bg-actif {
        background-color: #2ecc71;
        color: white;
    }
    .bg-inactif {
        background-color: #e74c3c;
        color: white;
    }
</style>

<div class="container py-5">

    <!-- Titre principal -->
    <div class="text-center mb-5 mt-3">
        <h1 class="display-6 fw-bold" style="color: #001F3D;">
            <i class="fas fa-gavel fa-lg me-2 text-warning"></i> Gestion des Avocats
        </h1>
        <p class="text-secondary">Supervisez, ajoutez, modifiez et filtrez tous les avocats du cabinet.</p>
        <hr class="w-25 mx-auto" style="border: 2px solid #aa9166;">
    </div>

    <!-- Filtres -->
    <div class="row g-3 mb-4">
        <div class="col-md-4">
            <form method="GET" action="{{ route('admin.avocats.index') }}">
                <input type="text" name="search" class="form-control shadow-sm"
                    style="border: 1px solid #aa9166; background-color: rgba(0,0,0,.03);" placeholder="🔍 Rechercher un avocat..." value="{{ request('search') }}">
            </form>
        </div>

        <div class="col-md-4">
            <form method="GET" action="{{ route('admin.avocats.index') }}">
                <select name="sort_by" class="form-select shadow-sm" onchange="this.form.submit()"
                    style="border: 1px solid #3498db; background-color: rgba(0,0,0,.03);">
                    <option value="">-- Trier par --</option>
                    <option value="name" {{ request('sort_by') == 'name' ? 'selected' : '' }}>Nom</option>
                    <option value="specialite" {{ request('sort_by') == 'specialite' ? 'selected' : '' }}>Spécialité</option>
                    <option value="is_active" {{ request('sort_by') == 'is_active' ? 'selected' : '' }}>Statut</option>
                </select>
            </form>
        </div>

        <div class="col-md-4 text-end">
            <a href="{{ route('admin.avocats.create') }}" class="btn" style="background-color: #aa9166; color: white;">
                <i class="fas fa-user-plus me-1"></i> Ajouter un avocat
            </a>
        </div>
    </div>

    <!-- Liste des avocats -->
@forelse($avocats as $avocat)
<div class="card mb-3 border-0 shadow-sm card-hover" style="min-height: 150px;">
    <div class="row g-0 align-items-center">
        <!-- Image -->
        <div class="col-md-3">
            <div class="overflow-hidden rounded-start h-100">
                <img src="{{ asset('storage/' . $avocat->photo) }}"
                     class="img-fluid w-100 h-100"
                     style="object-fit: cover; min-height: 100px; max-height: 150px;"
                     alt="{{ $avocat->name }}">
            </div>
        </div>

        <!-- Informations -->
        <div class="col-md-9">
            <div class="card-body py-3 px-3 d-flex justify-content-between align-items-center flex-wrap">
                <!-- Infos -->
                <div class="me-3" style="line-height: 1.2;">
                    <h5 class="fw-bold mb-1 text-primary" style="font-size: 1rem; color: #001F3D;">
                        {{ $avocat->name }} {{ $avocat->prenom }}
                    </h5>
                    <p class="mb-1 text-muted fw-bold" style="font-size: 0.85rem;">
                        <i class="fas fa-briefcase me-1"></i>{{ $avocat->specialite }}
                    </p>
                    <small class="text-muted fw-bold" style="font-size: 0.8rem;">
                        <i class="fas fa-envelope me-1"></i>{{ $avocat->email }}
                    </small>
                </div>

                <!-- Actions -->
                <div class="d-flex align-items-center gap-2 mt-3 mt-md-0 flex-wrap">
                    <!-- Badge statut -->
                    @if($avocat->is_active)
                        <span class="badge bg-success">Actif</span>
                    @else
                        <span class="badge bg-danger">Inactif</span>
                    @endif

                    <!-- Activer / Désactiver -->
                    <form action="{{ route('admin.avocats.toggle', $avocat) }}" method="POST">
                        @csrf
                        <button type="submit"
                                class="btn btn-sm {{ $avocat->is_active ? 'btn-warning' : 'btn-success' }}">
                            {{ $avocat->is_active ? 'Désactiver' : 'Activer' }}
                        </button>
                    </form>

                    <!-- Menu dropdown -->
                    <div class="dropdown">
                        <button class="btn btn-outline-warning btn-sm" data-bs-toggle="dropdown">
                            <i class="fas fa-cogs"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.avocats.show', $avocat->id) }}">
                                    <i class="fas fa-eye me-1"></i> Voir
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.avocats.edit', $avocat->id) }}">
                                    <i class="fas fa-edit me-1"></i> Modifier
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('admin.avocats.destroy', $avocat->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Supprimer cet avocat ?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="dropdown-item text-danger">
                                        <i class="fas fa-trash-alt me-1"></i> Supprimer
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@empty
    <div class="alert alert-info text-center">Aucun avocat trouvé.</div>
@endforelse

    <!-- Pagination -->
    <div class="d-flex justify-content-center mt-4">
        {{ $avocats->links('pagination::bootstrap-5') }}
    </div>

</div>
@endsection
 