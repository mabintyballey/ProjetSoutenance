@extends('administration.base')

@section('content')
<div class="container py-5">

    <h2 class="mb-4 fw-bold text-primary">
        📅 Liste des Rendez-vous
    </h2>

    {{-- ✅ Bouton créer un RDV (pour avocat uniquement) --}}
    @if(auth()->user()->role === 'avocat')
        <a href="{{ route('rendezvous.create') }}" class="btn btn-primary rounded-pill mb-4">
            <i class="bi bi-plus-circle me-2"></i> Nouveau Rendez-vous
        </a>
    @endif

    @if($rendezvous->isEmpty())
        <div class="alert alert-info shadow-sm rounded-pill px-4 py-2">
            <i class="bi bi-info-circle me-2"></i> Aucun rendez-vous trouvé.
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach($rendezvous as $rdv)
                <div class="col">
                    <div class="card shadow-lg border-start border-5
                        @switch($rdv->statut)
                            @case('en_attente') border-warning @break
                            @case('accepte') border-success @break
                            @case('rejete') border-danger @break
                            @case('modifie') border-info @break
                            @default border-primary
                        @endswitch
                        rounded-4"
                        style="border-color: var(--color-primary);"
                    >
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title fw-bold text-primary mb-3">
                                <i class="bi bi-calendar-event fs-3 me-2"></i>
                                Rendez-vous #{{ $loop->iteration }}
                            </h5>

                            {{-- ✅ Affichage conditionnel : avocat ou client --}}
                            <p class="mb-2">
                                @if(auth()->user()->role === 'client')
                                    <i class="bi bi-person-badge-fill fs-5 me-2 text-secondary"></i>
                                    <strong>Avocat :</strong>
                                    {{ $rdv->dossier->avocat->user->prenom }} {{ $rdv->dossier->avocat->user->nom }}
                                @else
                                    <i class="bi bi-person-fill fs-5 me-2 text-secondary"></i>
                                    <strong>Client :</strong>
                                    {{ $rdv->dossier->client->user->prenom }} {{ $rdv->dossier->client->user->nom }}
                                @endif
                            </p>

                            <p class="mb-2">
                                <i class="bi bi-clock-fill fs-5 me-2 text-secondary"></i>
                                <strong>Date :</strong> {{ $rdv->date_heure->format('d/m/Y H:i') }}
                            </p>

                            <p class="mb-2">
                                <i class="bi bi-geo-alt-fill fs-5 me-2 text-secondary"></i>
                                <strong>Lieu :</strong> {{ $rdv->lieu }}
                            </p>

                            {{-- ✅ Badge statut --}}
                            <span class="badge rounded-pill mt-2
                                @switch($rdv->statut)
                                    @case('en_attente') bg-warning text-dark @break
                                    @case('accepte') bg-success @break
                                    @case('rejete') bg-danger @break
                                    @case('modifie') bg-info text-dark @break
                                    @default bg-secondary
                                @endswitch">
                                {{ ucfirst($rdv->statut) }}
                            </span>

                            <button type="button" class="btn btn-outline-primary rounded-pill mt-auto mt-3"
                                data-bs-toggle="modal" data-bs-target="#rdvModal{{ $rdv->id }}">
                                <i class="bi bi-eye-fill me-1"></i> Voir détails
                            </button>
                        </div>
                    </div>
                </div>

                {{-- ✅ MODAL DETAILS --}}
                <div class="modal fade" id="rdvModal{{ $rdv->id }}" tabindex="-1" aria-labelledby="rdvModalLabel{{ $rdv->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content rounded-4 shadow border border-primary">
                            {{-- Header --}}
                            <div class="modal-header bg-primary text-white rounded-top">
                                <h5 class="modal-title fw-bold" id="rdvModalLabel{{ $rdv->id }}">
                                    <i class="bi bi-pin-angle-fill me-2"></i> Détails Rendez-vous #{{ $loop->iteration }}
                                </h5>
                                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                            </div>
                            {{-- Body --}}
                            <div class="modal-body">
                                <p>
                                    @if(auth()->user()->role === 'client')
                                        <i class="bi bi-person-badge-fill fs-5 me-2 text-primary"></i>
                                        <strong>Avocat :</strong>
                                        {{ $rdv->dossier->avocat->user->prenom }} {{ $rdv->dossier->avocat->user->nom }}
                                    @else
                                        <i class="bi bi-person-fill fs-5 me-2 text-primary"></i>
                                        <strong>Client :</strong>
                                        {{ $rdv->dossier->client->user->prenom }} {{ $rdv->dossier->client->user->nom }}
                                    @endif
                                </p>
                                <p>
                                    <i class="bi bi-calendar-event-fill fs-5 me-2 text-primary"></i>
                                    <strong>Date & Heure :</strong>
                                    {{ $rdv->date_heure->format('d/m/Y H:i') }}
                                </p>
                                <p>
                                    <i class="bi bi-geo-alt-fill fs-5 me-2 text-primary"></i>
                                    <strong>Lieu :</strong>
                                    {{ $rdv->lieu }}
                                </p>
                                <p>
                                    <i class="bi bi-chat-left-text-fill fs-5 me-2 text-primary"></i>
                                    <strong>Description :</strong>
                                </p>
                                <p class="text-secondary">
                                    {{ $rdv->motif ?? 'Aucune description.' }}
                                </p>
                            </div>
                            {{-- Footer --}}
                            <div class="modal-footer d-flex flex-wrap justify-content-between">
                                <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-1"></i> Fermer
                                </button>

                                @if(auth()->user()->role === 'client' && $rdv->statut === 'en_attente')
                                    <form action="{{ route('rendezvous.updateStatut', $rdv->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="statut" value="accepte">
                                        <button type="submit" class="btn btn-success rounded-pill">
                                            <i class="bi bi-check-circle me-1"></i> Accepter
                                        </button>
                                    </form>
                                    <form action="{{ route('rendezvous.updateStatut', $rdv->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PATCH')
                                        <input type="hidden" name="statut" value="rejete">
                                        <button type="submit" class="btn btn-danger rounded-pill">
                                            <i class="bi bi-x-circle me-1"></i> Rejeter
                                        </button>
                                    </form>
                                    <a href="{{ route('rendezvous.edit', $rdv->id) }}" class="btn btn-warning rounded-pill">
                                        <i class="bi bi-pencil-square me-1"></i> Proposer modification
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination Bootstrap --}}
        <div class="mt-4 d-flex justify-content-center">
            {{ $rendezvous->links('pagination::bootstrap-5') }}
        </div>
    @endif

</div>
@endsection
