@extends('administration.base')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-dark">
        📂 Mes Requêtes
    </h2>

    {{-- Filtres --}}
    <form method="GET" action="{{ route('client.requetes.index') }}" class="row g-3 mb-5">
        <div class="col-md-4">
            <label for="statut" class="form-label">Filtrer par Statut</label>
            <select name="statut" id="statut" class="form-select rounded-3">
                <option value="">Tous</option>
                @foreach(['en_attente', 'acceptee', 'rejete', 'en_cours', 'terminee'] as $statut)
                    <option value="{{ $statut }}" {{ request('statut') == $statut ? 'selected' : '' }}>
                        {{ ucfirst(str_replace('_', ' ', $statut)) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4">
            <label for="domaine" class="form-label">Filtrer par Domaine</label>
            <select name="domaine" id="domaine" class="form-select rounded-3">
                <option value="">Tous</option>
                @foreach($domaines as $domaine)
                    <option value="{{ $domaine->id }}" {{ request('domaine') == $domaine->id ? 'selected' : '' }}>
                        {{ $domaine->nom }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-dark rounded-pill w-100">
                🔍 Filtrer
            </button>
        </div>
    </form>

    {{-- Liste --}}
    @if($requetes->isEmpty())
        <div class="alert alert-warning text-center rounded-4">
            <i class="bi bi-folder-x fs-3 mb-2 d-block"></i>
            Aucune requête trouvée.
        </div>
    @else
        <div class="row g-4">
            @foreach ($requetes as $index => $requete)
                <div class="col-md-6 col-lg-4">
                    <div class="card border-0 shadow-lg h-100 rounded-4 
                        border-start border-5
                        @switch($requete->statut)
                            @case('en_attente') border-warning @break
                            @case('acceptee') border-success @break
                            @case('rejete') border-danger @break
                            @case('en_cours') border-primary @break
                            @case('terminee') border-secondary @break
                        @endswitch"
                        style="background: linear-gradient(135deg, #fdf6e3, #f5f5f5);">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-dark">
                                #{{ $loop->iteration + ($requetes->firstItem() - 1) }} - {{ $requete->type_aide }}
                            </h5>
                            <p class="card-text text-muted small mb-2">
                                <strong>Problème :</strong> {{ Str::limit($requete->probleme, 100) }}
                            </p>
                            <p class="card-text mb-2">
                                <span class="badge rounded-pill 
                                    @switch($requete->statut)
                                        @case('en_attente') bg-warning text-dark @break
                                        @case('acceptee') bg-success @break
                                        @case('rejete') bg-danger @break
                                        @case('en_cours') bg-primary @break
                                        @case('terminee') bg-secondary @break
                                    @endswitch">
                                    {{ ucfirst(str_replace('_', ' ', $requete->statut)) }}
                                </span>
                            </p>
                            @if ($requete->avocat)
                                <p class="card-text small">
                                    <strong>Avocat :</strong> {{ $requete->avocat->user->prenom }} {{ $requete->avocat->user->nom }}
                                </p>
                            @endif
                            <div class="mt-auto">
                                <button class="btn btn-outline-dark btn-sm rounded-pill px-3"
                                    data-bs-toggle="offcanvas"
                                    data-bs-target="#offcanvasRequete{{ $requete->id }}">
                                    📄 Détails
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ✅ Offcanvas détails --}}
                <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRequete{{ $requete->id }}">
                    <div class="offcanvas-header bg-dark text-white">
                        <h5 class="offcanvas-title">Détails de la requête</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
                    </div>
                    <div class="offcanvas-body">
                        <p><strong>Type d'aide :</strong> {{ $requete->type_aide }}</p>
                        <p><strong>Domaine :</strong> {{ $requete->domaine->nom }}</p>
                        <p><strong>Problème complet :</strong> {{ $requete->probleme }}</p>
                        <p><strong>Statut :</strong> {{ ucfirst(str_replace('_', ' ', $requete->statut)) }}</p>
                        @if ($requete->avocat)
                            <p><strong>Avocat :</strong> {{ $requete->avocat->user->prenom }} {{ $requete->avocat->user->nom }}</p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>

        {{-- ✅ Pagination --}}
        <div class="d-flex justify-content-center mt-4">
            {{ $requetes->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
