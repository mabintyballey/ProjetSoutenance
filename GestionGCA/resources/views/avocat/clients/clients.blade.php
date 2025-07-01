@extends('administration.base')

@section('content')
<div class="container py-5">
    <!-- 🔹 Titre + Barre de recherche -->
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-4 gap-3">
        <h2 class="fw-bold text-dark mb-0">
            <i class="bi bi-person-lines-fill text-primary me-2"></i>
            Clients assignés
        </h2>
        <div class="w-100 w-md-50">
            <input type="text" id="searchInput" class="form-control rounded-pill shadow-sm" placeholder="🔍 Rechercher un client par nom...">
        </div>
    </div>

    @if ($clients->isEmpty())
        <div class="alert alert-info shadow-sm rounded-3 text-center">
            <i class="bi bi-info-circle me-2"></i> Aucun client ne vous est encore assigné.
        </div>
    @else
        <div class="row g-4" id="clientsContainer">
            @foreach ($clients as $client)
                <div class="col-12 col-md-6 col-lg-6 client-card">
                    <div class="card border-0 shadow-lg rounded-4 h-100" style="min-height: 220px;">
                        <!-- 🌐 Avatar cercle -->
                        <div class="card-body d-flex align-items-center gap-4 py-4">
                            <div class="flex-shrink-0">
                                <img src="{{ $client->photo ? asset('storage/photos/' . $client->photo) : asset('uploads/photos/default.png') }}"
                                     alt="Photo de {{ $client->prenom }}"
                                     class="rounded-circle border border-3 border-primary shadow"
                                     style="width: 90px; height: 90px; object-fit: cover;">
                            </div>
                            <div>
                                <h5 class="fw-bold text-dark client-name mb-1">
                                    {{ $client->prenom }} {{ $client->nom }}
                                </h5>
                                <p class="mb-1 text-muted small">
                                    <i class="bi bi-envelope-at-fill me-1 text-primary"></i> {{ $client->email }}
                                </p>
                                <p class="mb-1 text-muted small">
                                    <i class="bi bi-phone-fill me-1 text-success"></i> {{ $client->telephone ?? '—' }}
                                </p>
                                <p class="mb-0 text-muted small">
                                    <i class="bi bi-geo-alt-fill me-1 text-danger"></i> {{ $client->adresse ?? '—' }}
                                </p>
                            </div>
                        </div>

                        <!-- 🛠️ Boutons action -->
                        <div class="card-footer border-top-0 bg-light d-flex justify-content-between align-items-center px-4 py-3 rounded-bottom-4">
                            <a href="{{ route('avocat.clients.dossiers', $client->id) }}"
                               class="btn btn-outline-primary btn-sm rounded-pill">
                                <i class="bi bi-folder2-open me-1"></i> Dossiers
                            </a>
                            <a href="{{ route('messagerie.dossier', $client->dernier_dossier_id) }}"
                               class="btn btn-outline-success btn-sm rounded-pill">
                                <i class="bi bi-chat-dots me-1"></i> Discuter
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
     <div class="d-flex justify-content-center mt-4">
        {{ $clients->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.getElementById('searchInput').addEventListener('keyup', function () {
        const search = this.value.toLowerCase();
        document.querySelectorAll('.client-card').forEach(card => {
            const name = card.querySelector('.client-name').textContent.toLowerCase();
            card.style.display = name.includes(search) ? 'block' : 'none';
        });
    });
</script>
@endpush
