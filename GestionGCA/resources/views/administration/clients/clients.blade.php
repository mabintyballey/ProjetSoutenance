@extends('administration.base')

@section('content')
<div class="container py-5">

    <!-- 🔹 Titre principal -->
    <div class="text-center mb-5">
        <h2 class="fw-bold">
            <i class="bi bi-person-check-fill me-2 text-primary"></i> Validation des Comptes Clients
        </h2>
        <p class="text-muted">Gérez les comptes clients en attente d’activation ou rejetez-les si nécessaire.</p>
        <hr class="w-25 mx-auto border-primary">
    </div>

    <!-- 🔙 Bouton retour -->
    <div class="mb-4">
        <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-secondary rounded-pill shadow-sm">
            <i class="bi bi-arrow-left me-1"></i> Retour à la liste des clients
        </a>
    </div>

    <!-- 🟢 Alertes de feedback -->
    <!-- @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif -->

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <!-- 🔽 Liste des clients -->
   @if ($clients->count() > 0)
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach ($clients as $client)
            <div class="col">
                <div class="card shadow border-0 h-100">
                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-primary">
                            <i class="bi bi-person-badge me-2"></i>
                            {{ $client->user->nom }} {{ $client->user->prenom }}
                        </span>
                        <span class="badge bg-warning text-dark">En attente</span>
                    </div>
                    <div class="card-body">
                        <p class="mb-2">
                            <i class="bi bi-envelope text-muted me-1"></i>
                            <strong>Email:</strong> {{ $client->user->email }}
                        </p>
                        <p class="mb-2">
                            <i class="bi bi-telephone text-muted me-1"></i>
                            <strong>Téléphone:</strong> {{ $client->user->telephone ?? '—' }}
                        </p>
                        <p class="mb-3">
                            <i class="bi bi-geo-alt text-muted me-1"></i>
                            <strong>Adresse:</strong> {{ $client->user->adresse ?? '—' }}
                        </p>
                    </div>
                    <div class="card-footer bg-white border-top-0 d-flex gap-2">
                        <form action="{{ route('admin.clients.valider', $client->id) }}" method="POST" class="w-100">
                            @csrf
                            <button type="submit" class="btn btn-success w-100 btn-sm rounded-pill">
                                <i class="bi bi-check-circle me-1"></i> Valider
                            </button>
                        </form>
                        <form action="{{ route('admin.clients.rejeter', $client->id) }}" method="POST" class="w-100">
                            @csrf
                            <button type="submit" class="btn btn-danger w-100 btn-sm rounded-pill">
                                <i class="bi bi-x-circle me-1"></i> Rejeter
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

        <!-- 📄 Pagination -->
        <div class="mt-4 d-flex justify-content-center">
            {{ $clients->links('pagination::bootstrap-5') }}
        </div>
    @else
        <div class="alert alert-info text-center mt-5">
            <i class="bi bi-info-circle me-2"></i> Aucun client en attente de validation.
        </div>
    @endif

</div>
@endsection
