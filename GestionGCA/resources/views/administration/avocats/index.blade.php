@extends('administration.base')

@section('content')
<!-- Styles -->
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
    <!-- Titre -->
    <div class="text-center mb-5 mt-3">
        <h1 class="display-6 fw-bold" style="color: #001F3D;">
            <i class="fas fa-gavel fa-lg me-2 text-warning"></i> Gestion des Avocats
        </h1>
        <p class="text-secondary">Supervisez, ajoutez, modifiez et filtrez tous les avocats du cabinet.</p>
        <hr class="w-25 mx-auto" style="border: 2px solid #aa9166;">
    </div>

    <!-- Filtres -->
    <div class="row g-3 mb-4">
        <!-- Recherche -->
        <div class="col-md-4">
            <form method="GET" action="{{ route('admin.avocats.index') }}">
                <input type="text" name="search" class="form-control shadow-sm"
                    style="border: 1px solid #aa9166; background-color: rgba(0,0,0,.03);" placeholder="🔍 Rechercher un avocat..."
                    value="{{ request('search') }}">
                <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
                <input type="hidden" name="domaine_id" value="{{ request('domaine_id') }}">
            </form>
        </div>
        <!-- Tri -->
        <div class="col-md-4">
            <form method="GET" action="{{ route('admin.avocats.index') }}">
                <select name="sort_by" class="form-select shadow-sm" onchange="this.form.submit()"
                    style="border: 1px solid #3498db; background-color: rgba(0,0,0,.03);">
                    <option value="">-- Trier par --</option>
                    <option value="nom" {{ request('sort_by') == 'nom' ? 'selected' : '' }}>Nom</option>
                    <option value="specialite" {{ request('sort_by') == 'specialite' ? 'selected' : '' }}>Spécialité</option>
                    <option value="is_active" {{ request('sort_by') == 'is_active' ? 'selected' : '' }}>Statut</option>
                </select>
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="domaine_id" value="{{ request('domaine_id') }}">
            </form>
        </div>
        <!-- Domaine -->
        <div class="col-md-4">
            <form method="GET" action="{{ route('admin.avocats.index') }}">
                <select name="domaine_id" class="form-select shadow-sm" onchange="this.form.submit()"
                    style="border: 1px solid #27ae60; background-color: rgba(0,0,0,.03);">
                    <option value="">-- Filtrer par domaine --</option>
                    @foreach ($domaines as $domaine)
                        <option value="{{ $domaine->id }}" {{ request('domaine_id') == $domaine->id ? 'selected' : '' }}>
                            {{ $domaine->nom }}
                        </option>
                    @endforeach
                </select>
                <input type="hidden" name="search" value="{{ request('search') }}">
                <input type="hidden" name="sort_by" value="{{ request('sort_by') }}">
            </form>
        </div>
        <!-- Ajouter -->
        <div class="col-md-12 text-end mt-3">
            <a href="{{ route('admin.avocats.create') }}" class="btn" style="background-color: #aa9166; color: white;">
                <i class="fas fa-user-plus me-1"></i> Ajouter un avocat
            </a>
        </div>
    </div>

    <!-- Liste des avocats -->
    @forelse($avocats as $avocat)
        @include('administration.avocats._card', ['avocat' => $avocat])
    @empty
        <div class="alert alert-info text-center">Aucun avocat trouvé.</div>
    @endforelse

    <div class="d-flex justify-content-center mt-4">
        {{ $avocats->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- Modals globaux -->
@include('administration.avocats._modals')
@include('administration.avocats._toggle_modals')
@endsection


@section('scripts')
<script>
    function setDeleteAction(avocatId) {
        const form = document.getElementById('deleteAvocatForm');
        form.action = `/admin/avocats/${avocatId}`;
    }

    @if(session('error') === 'avocat_a_dossiers')
        document.addEventListener("DOMContentLoaded", function () {
            const modalErreur = new bootstrap.Modal(document.getElementById('avocatHasDossiersModal'));
            modalErreur.show();
        });
    @endif
</script>
@endsection

