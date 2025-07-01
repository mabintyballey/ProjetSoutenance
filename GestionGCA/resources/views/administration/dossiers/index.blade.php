@extends('administration.base')

@section('content')
<div class="container py-4 mt-3">
    <h4 class="text-center mb-4 fw-bold">
        <i class="fas fa-briefcase text-primary"></i> Gestion des Dossiers
    </h4>

    <!-- Statistiques -->
    @php
        $badges = [
            'total' => ['title' => 'Total Dossiers', 'color' => 'primary', 'icon' => 'fa-folder'],
            'en_attente' => ['title' => 'En attente', 'color' => 'warning', 'icon' => 'fa-hourglass-half'],
            'en_cours' => ['title' => 'En cours', 'color' => 'info', 'icon' => 'fa-spinner'],
            'termine' => ['title' => 'Terminés', 'color' => 'success', 'icon' => 'fa-check-circle'],
        ];
    @endphp
    <div class="row mb-4">
        @foreach($badges as $key => $info)
            <div class="col-md-3 mb-1">
                <div class="card text-white bg-{{ $info['color'] }}">
                    <div class="card-body d-flex justify-content-between align-items-center py-2">
                        <div>
                            <div class="small">{{ $info['title'] }}</div>
                            <h5>{{ $stats[$key] ?? 0 }}</h5>
                        </div>
                        <i class="fas {{ $info['icon'] }} fa-lg"></i>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <!-- Filtres -->
    <form method="GET" class="row g-2 mb-4">
        <div class="col-md-5">
            <input type="text" name="search" class="form-control" placeholder="Client ou avocat..." value="{{ request('search') }}">
        </div>
        <div class="col-md-4">
            <input type="text" name="description" class="form-control" placeholder="Filtrer par description" value="{{ request('description') }}">
        </div>
        <div class="col-md-2">
            <select name="statut" class="form-select">
                <option value="">Tous les statuts</option>
                <option value="en_attente" @selected(request('statut') == 'en_attente')>En attente</option>
                <option value="en_cours" @selected(request('statut') == 'en_cours')>En cours</option>
                <option value="termine" @selected(request('statut') == 'termine')>Terminé</option>
            </select>
        </div>
        <div class="col-md-1 d-grid">
            <button class="btn btn-outline-primary"><i class="fas fa-filter"></i></button>
        </div>
    </form>

    <!-- Dossiers -->
    <div class="row">
        @forelse ($dossiers as $dossier)
            <div class="col-md-4 mb-4">
                <div class="card h-100 shadow-sm">
                    <div class="card-body text-center">
                        <h5 class="card-title text-primary">Dossier du Client</h5>
                        <p><strong>Client :</strong>
                            {{ $dossier->client->user->prenom ?? 'Non défini' }} {{ $dossier->client->user->nom ?? '' }}
                        </p>
                        <p><strong>Avocat :</strong>
                            {{ $dossier->avocat->user->prenom ?? 'Non attribué' }} {{ $dossier->avocat->user->nom ?? '' }}
                        </p>
                        <p><strong>Date :</strong> {{ $dossier->created_at->format('d/m/Y') }}</p>
                        <span class="badge bg-{{ ['termine' => 'success', 'en_cours' => 'info', 'en_attente' => 'warning'][$dossier->statut] ?? 'secondary' }}">
                            {{ ucfirst(str_replace('_', ' ', $dossier->statut)) }}
                        </span>
                    </div>
                    <div class="card-footer text-end bg-light">
                        <button class="btn btn-sm btn-outline-info" data-bs-toggle="offcanvas" data-bs-target="#offcanvasDossier{{ $dossier->id }}">
                            <i class="fas fa-eye"></i> Voir
                        </button>
                    </div>
                </div>
            </div>

            <!-- Offcanvas dossier -->
            <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasDossier{{ $dossier->id }}">
                <div class="offcanvas-header">
                    <h5 class="offcanvas-title">Dossier #{{ $dossier->id }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <p><strong>Description :</strong> {{ $dossier->description }}</p>
                    <p><strong>Info adverse :</strong> {{ $dossier->information_adverse ?? 'Non renseignée' }}</p>

                    <!-- Assignation avocat -->
                    <!-- Si un avocat est déjà assigné -->
                    @if ($dossier->avocat_id)
                        <div class="mb-3">
                            <p class="mb-1"><strong>Avocat actuel :</strong> 
                                {{ $dossier->avocat->user->prenom }} {{ $dossier->avocat->user->nom }}
                            </p>
                    
                            <!-- Formulaire de modification -->
                            <form action="{{ route('admin.dossiers.assignerAvocat', $dossier->id) }}" method="POST">
                                @csrf
                                <div class="input-group">
                                    <select name="avocat_id" class="form-select" required>
                                        <option value="">-- Modifier l’avocat --</option>
                                        @foreach($dossier->domaine->avocats ?? [] as $avocat)
                                            <option value="{{ $avocat->id }}" {{ $avocat->id == $dossier->avocat_id ? 'selected' : '' }}>
                                                {{ $avocat->user->prenom }} {{ $avocat->user->nom }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <button class="btn btn-outline-warning" type="submit">Modifier</button>
                                </div>
                            </form>
                        </div>
                    @else
                        <!-- Aucune assignation encore faite -->
                        <form action="{{ route('admin.dossiers.assignerAvocat', $dossier->id) }}" method="POST" class="mb-3">
                            @csrf
                            <div class="input-group">
                                <select name="avocat_id" class="form-select" required>
                                    <option value="">-- Choisir un avocat --</option>
                                    @foreach($dossier->domaine->avocats ?? [] as $avocat)
                                        <option value="{{ $avocat->id }}">{{ $avocat->user->prenom }} {{ $avocat->user->nom }}</option>
                                    @endforeach
                                </select>
                                <button class="btn btn-outline-success" type="submit">Assigner</button>
                            </div>
                        </form>
                    @endif
                    

                    <!-- Upload document -->
                    <form action="{{ route('admin.documents.upload', $dossier->id) }}" method="POST" enctype="multipart/form-data" class="mb-3">
                        @csrf
                        <div class="input-group">
                            <input type="file" name="document" class="form-control" required>
                            <button class="btn btn-outline-primary" type="submit">
                                <i class="fas fa-upload"></i> Ajouter document
                            </button>
                        </div>
                        @error('document')
                            <div class="text-danger mt-1 small">{{ $message }}</div>
                        @enderror
                    </form>

                    <!-- Liste documents -->
                    <h6><i class="fas fa-file-alt"></i> Documents</h6>
                    <ul class="list-group list-group-flush">
                        @forelse ($dossier->documents as $doc)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                {{ $doc->nom }}
                                <a href="{{ asset('storage/documents/'.($doc->path_fichier)) }}" target="_blank" class="btn btn-sm btn-outline-success">
                                    <i class="fas fa-eye"></i> Voir
                                </a>
                            </li>
                        @empty
                            <li class="list-group-item text-muted fst-italic">Aucun document</li>
                        @endforelse
                    </ul>

                    <!-- Télécharger zip -->
                    <a href="{{ route('admin.dossiers.telechargerZip', $dossier->id) }}" class="btn btn-outline-secondary w-100 mt-3">
                        <i class="fas fa-file-archive"></i> Télécharger tous les documents (.zip)
                    </a>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-warning text-center">
                    <i class="fas fa-info-circle"></i> Aucun dossier trouvé.
                </div>
            </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="mt-4">
        {{ $dossiers->withQueryString()->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection