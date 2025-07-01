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
    <form method="GET" class="bg-white border-0 shadow rounded-4 p-4 mb-5">
        <div class="row gy-4 align-items-end">

            <!-- Recherche -->
            <div class="col-lg-3 col-md-6">
                <label class="form-label fw-semibold text-secondary">
                    <i class="fas fa-search me-2 text-primary"></i> Recherche
                </label>
                <input type="text" name="search"
                       class="form-control rounded-pill shadow-sm px-4 border border-light-subtle"
                       placeholder="Nom ou prénom"
                       value="{{ request('search') }}">
            </div>

            <!-- Tri -->
            <div class="col-lg-3 col-md-6">
                <label class="form-label fw-semibold text-secondary">
                    <i class="fas fa-sort me-2 text-primary"></i> Trier par
                </label>
                <select name="sort_by"
                        class="form-select rounded-pill shadow-sm px-4 border border-light-subtle">
                    <option value="">-- Choisir --</option>
                    <option value="name" @selected(request('sort_by') == 'name')>Nom</option>
                    <option value="prenom" @selected(request('sort_by') == 'prenom')>Prénom</option>
                    <option value="email" @selected(request('sort_by') == 'email')>Email</option>
                </select>
            </div>

            <!-- Statut -->
            <div class="col-lg-3 col-md-6">
                <label class="form-label fw-semibold text-secondary">
                    <i class="fas fa-toggle-on me-2 text-primary"></i> Statut
                </label>
                <select name="statut"
                        class="form-select rounded-pill shadow-sm px-4 border border-light-subtle">
                    <option value="">Tous les statuts</option>
                    <option value="valide" @selected(request('statut') == 'valide')>Validé</option>
                    <option value="rejete" @selected(request('statut') == 'rejete')>Rejeté</option>
                    <option value="en_attente" @selected(request('statut') == 'en_attente')>En attente</option>
                </select>
            </div>

            <!-- Boutons -->
            <div class="col-lg-3 col-md-6 d-flex flex-column gap-2">
                <button type="submit" class="btn btn-primary rounded-pill shadow-sm w-100">
                    <i class="fas fa-filter me-2"></i> Filtrer
                </button>
                <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-secondary rounded-pill shadow-sm w-100">
                    <i class="fas fa-times-circle me-2"></i> Réinitialiser
                </a>
            </div>

            <!-- Lien vers clients en attente -->
            <div class="col-12 text-end mt-3">
                <a href="{{ route('admin.clients.attente') }}" class="btn btn-outline-warning rounded-pill shadow-sm">
                    <i class="fas fa-clock me-2"></i> Clients en attente
                </a>
            </div>

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
                            <img src="{{ $client->photo ? asset('storage/photos/' . $client->photo) : asset('uploads/photos/default.png') }}"
                                 alt="Photo de profil"
                                 class="rounded-circle border shadow-sm mx-auto d-block"
                                 style="width: 80px; height: 80px; object-fit: cover;">
                        </div>
                        <h5 class="card-title text-center fw-bold text-primary">
                            <i class="bi bi-person-circle me-2"></i> {{ $client->prenom }} {{ $client->nom }}
                        </h5>
                        <p class="text-muted text-center mb-2">
                            <i class="bi bi-envelope-fill me-2"></i> {{ $client->email }}
                        </p>
                        
                        {{-- Statut stylisé --}}
                        <div class="text-center">
                            @if ($client->client && $client->client->statut === 'valide')
                                <span class="badge bg-success py-2 px-3">
                                    <i class="bi bi-check-circle me-1"></i> Validé
                                </span>
                            @elseif ($client->client && $client->client->statut === 'rejete')
                                <span class="badge bg-danger py-2 px-3">
                                    <i class="bi bi-x-circle me-1"></i> Rejeté
                                </span>
                            @else
                                <span class="badge bg-warning text-dark py-2 px-3">
                                    <i class="bi bi-hourglass-split me-1"></i> En attente
                                </span>
                            @endif
                        </div>

                        <div class="d-flex justify-content-between mt-3">
                            <a href="{{ route('admin.clients.dossiers', $client->id) }}" class="btn btn-sm btn-outline-primary w-100 me-1">
                                <i class="bi bi-folder2-open me-1"></i> Dossiers
                            </a>
                            <button type="button" class="btn btn-sm btn-outline-danger w-100 ms-1"
                                onclick="showDeleteClientModal({{ $client->id }})">
                                <i class="bi bi-trash3 me-1"></i> Supprimer
                            </button>
                            
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
    @include('administration.clients._modals')
<!-- Toast succès -->
<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 1100;">
  <div id="successToast" class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="d-flex">
      <div class="toast-body">
        {{ session('success') }}
      </div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
  </div>
</div>
</div>
@endsection
@section('scripts')
<script>
  function showDeleteClientModal(clientId) {
    const form = document.getElementById('deleteClientForm');
    form.action = `/admin/clients/${clientId}`;
    const modal = new bootstrap.Modal(document.getElementById('confirmDeleteClientModal'));
    modal.show();
  }

  @if(session('error') === 'client_dossiers_invalides')
    document.addEventListener("DOMContentLoaded", function () {
      const errorModal = new bootstrap.Modal(document.getElementById('clientHasDossiersModal'));
      errorModal.show();
    });
  @endif

  @if(session('success'))
    document.addEventListener("DOMContentLoaded", function () {
      const toastEl = document.getElementById('successToast');
      const toast = new bootstrap.Toast(toastEl);
      toast.show();
    });
  @endif
</script>
@endsection