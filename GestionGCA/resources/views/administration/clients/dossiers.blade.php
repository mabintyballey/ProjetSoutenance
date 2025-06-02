@extends('administration.base')

@section('content')
<div class="container py-5">
    <!-- Titre principal -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-primary font-semibold d-inline-flex align-items-center" style="border-bottom: 4px solid #aa9166; padding-bottom: 10px;">
            <i class="bi bi-folder2-open me-2" style="font-size: 1.5rem;"></i>
            Dossiers de {{ $client->prenom }} {{ $client->name }}
        </h2>
        <p class="mt-2 text-muted fst-italic">Chaque dossier est une étape vers la justice.</p>
    </div>

    <!-- Boutons de navigation -->
    <div class="d-flex flex-wrap gap-3 mb-4 justify-content-start">
        <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-secondary">
            ← Retour
        </a>

        <form action="{{ route('admin.clients.valider', $client->id) }}" method="POST" onsubmit="return confirm('Valider ce client ?')">
            @csrf
            <button type="submit" class="btn btn-success">
                Valider le client
            </button>
        </form>

        <form action="{{ route('admin.clients.rejeter', $client->id) }}" method="POST" onsubmit="return confirm('Rejeter ce client ?')">
            @csrf
            <button type="submit" class="btn btn-danger">
                Rejeter le client
            </button>
        </form>

        <a href="{{ route('admin.clients.dossiers.pdf', ['id' => $client->id] + request()->query()) }}"
           class="btn btn-outline-primary">
           <i class="bi bi-download me-1"></i> Télécharger PDF
        </a>
    </div>

    <!-- Liste des dossiers -->
    @if ($client->dossiersSoumis->isEmpty())
        <div class="alert alert-warning">
            Aucun dossier soumis pour le moment.
        </div>
    @else
        <div class="row">
            @foreach ($client->dossiersSoumis as $dossier)
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="card-title text-uppercase text-primary">
                                {{ $dossier->titre ?? 'Sans titre' }}
                            </h5>
                            <ul class="list-unstyled mb-2">
                                <li><strong>Problème :</strong> {{ $dossier->probleme }}</li>
                                <li><strong>Adversaire :</strong> {{ $dossier->adversaire }}</li>
                                <li><strong>Domaine :</strong> {{ $dossier->domaine }}</li>
                                <li><strong>Statut :</strong> 
                                    <span class="badge 
                                        @if($dossier->statut === 'valide') bg-success 
                                        @elseif($dossier->statut === 'rejete') bg-danger 
                                        @else bg-warning text-dark 
                                        @endif">
                                        {{ ucfirst($dossier->statut ?? 'en attente') }}
                                    </span>
                                </li>
                                <li><strong>Soumis le :</strong> {{ $dossier->created_at->format('d/m/Y à H:i') }}</li>
                            </ul>

                            @if ($dossier->document)
                                <a href="{{ asset('storage/' . $dossier->document) }}" target="_blank" class="btn btn-sm btn-outline-secondary">
                                    Voir le fichier
                                </a>
                            @else
                                <p class="text-muted fst-italic mb-0">Aucun document joint.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
