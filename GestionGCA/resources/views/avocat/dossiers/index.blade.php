@extends('administration.base')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4" style="color: #134074;">
        📂 Dossiers assignés à vous
    </h2>

    {{-- 🔍 Filtres --}}
    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-5">
            <label class="form-label fw-semibold text-dark">Filtrer par domaine</label>
            <select name="domaine_id" class="form-select rounded-pill">
                <option value="">-- Tous les domaines --</option>
                @foreach($domaines as $domaine)
                    <option value="{{ $domaine->id }}" {{ request('domaine_id') == $domaine->id ? 'selected' : '' }}>
                        {{ $domaine->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-5">
            <label class="form-label fw-semibold text-dark">Filtrer par statut</label>
            <select name="statut" class="form-select rounded-pill">
                <option value="">-- Tous les statuts --</option>
                @foreach(['en_attente', 'en_cours', 'termine', 'rejete'] as $statut)
                    <option value="{{ $statut }}" {{ request('statut') == $statut ? 'selected' : '' }}>
                        {{ ucfirst(str_replace('_', ' ', $statut)) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-gradient w-100 rounded-pill fw-bold">
                🔍 Rechercher
            </button>
        </div>
    </form>

    {{-- 🗂 Liste des dossiers --}}
    @if($dossiers->isEmpty())
        <div class="alert alert-info text-center rounded-4 shadow-sm">
            Aucun dossier assigné avec ces critères.
        </div>
    @else
        <div class="row g-4">
            @foreach($dossiers as $dossier)
                <div class="col-md-6 col-xl-4">
                    <div class="card border-0 shadow-lg h-100 rounded-4">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-2" style="color: #134074;">
                                {{ $dossier->titre }}
                            </h5>
                            <p class="text-muted mb-2">
                                Domaine : <span class="fw-semibold text-dark">{{ $dossier->domaine->nom }}</span><br>
                                Soumis le : {{ $dossier->created_at->format('d/m/Y') }}
                            </p>

                            <span class="badge rounded-pill mb-3
                                @switch($dossier->statut)
                                    @case('termine') bg-success @break
                                    @case('en_cours') bg-info text-dark @break
                                    @case('en_attente') bg-warning text-dark @break
                                    @case('rejete') bg-danger @break
                                    @default bg-secondary
                                @endswitch">
                                {{ ucfirst(str_replace('_', ' ', $dossier->statut)) }}
                            </span>

                            {{-- 📎 Documents --}}
                            <ul class="list-group list-group-flush mb-3">
                                @forelse ($dossier->documents as $doc)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span class="fw-semibold">{{ $doc->nom }}</span>
                                        <a href="{{ asset('storage/documents/' . $doc->path_fichier) }}" target="_blank"
                                           class="btn btn-sm btn-outline-primary rounded-pill">
                                            <i class="bi bi-eye"></i> Voir
                                        </a>
                                    </li>
                                @empty
                                    <li class="list-group-item text-muted">Aucun document joint</li>
                                @endforelse
                            </ul>

                            {{-- Actions --}}
                            <div class="d-flex justify-content-between flex-wrap gap-2 mt-auto">
                                <button class="btn btn-outline-dark rounded-pill btn-sm"
                                        data-bs-toggle="modal" data-bs-target="#clientModal{{ $dossier->id }}">
                                    👤 Voir Client
                                </button>
                                <div class="dropdown">
                                    <button class="btn btn-outline-primary rounded-pill btn-sm dropdown-toggle"
                                            type="button" data-bs-toggle="dropdown">
                                        🔄 Statut
                                    </button>
                                    <ul class="dropdown-menu">
                                        @foreach(['en_attente', 'en_cours', 'termine', 'rejete'] as $status)
                                            <li>
                                                <a class="dropdown-item" href="#"
                                                   onclick="changerStatut({{ $dossier->id }}, '{{ $status }}')">
                                                    {{ ucfirst(str_replace('_', ' ', $status)) }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- 👤 Modal infos client --}}
                <div class="modal fade" id="clientModal{{ $dossier->id }}" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content rounded-4">
                            <div class="modal-header bg-gradient text-white">
                                <h5 class="modal-title">Informations du client</h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            <div class="modal-body">
                                <p><strong>Nom :</strong> {{ $dossier->client->user->nom }}</p>
                                <p><strong>Prénom :</strong> {{ $dossier->client->user->prenom }}</p>
                                <p><strong>Email :</strong> {{ $dossier->client->user->email }}</p>
                                <p><strong>Téléphone :</strong> {{ $dossier->client->user->telephone }}</p>
                                <p><strong>Adresse :</strong> {{ $dossier->client->user->adresse }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- 📄 Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $dossiers->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>

{{-- ✅ Modal confirmation avec couleur dorée --}}
<div class="modal fade" id="confirmStatutModal" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content rounded-4 border-0" style="background-color: rgb(140, 120, 8); color: #fff;">
      <div class="modal-header border-0" style="background-color: rgb(140, 120, 8); color: #fff;">
        <h5 class="modal-title">Confirmation de changement</h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body">
        Voulez-vous vraiment changer le statut à :
        <strong id="newStatusText" class="text-capitalize">...</strong> ?
      </div>
      <div class="modal-footer border-0">
        <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Annuler</button>
        <a href="#" id="confirmChangeBtn" class="btn btn-success rounded-pill">Confirmer</a>
      </div>
    </div>
  </div>
</div>


{{-- ✅ Toast --}}
@if(session('success'))
<div class="toast-container position-fixed bottom-0 end-0 p-3">
  <div class="toast align-items-center text-white bg-success border-0 show">
    <div class="d-flex">
      <div class="toast-body">{{ session('success') }}</div>
      <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"></button>
    </div>
  </div>
</div>
@endif
@endsection

@section('scripts')
<script>
    function changerStatut(dossierId, newStatus) {
        document.getElementById('newStatusText').innerText = newStatus.replace('_', ' ');
        document.getElementById('confirmChangeBtn').href = `/avocat/dossiers/${dossierId}/changer-statut/${newStatus}`;
        const modal = new bootstrap.Modal(document.getElementById('confirmStatutModal'));
        modal.show();
    }
</script>
@endsection
