@extends('administration.base')

@section('content')
<div class="container py-5">
    <h2 class="fw-bold mb-4 text-dark">
        📂 Documents soumis par 
        <span class="text-primary">{{ $client->user->prenom }} {{ $client->user->nom }}</span>
    </h2>

    @forelse ($dossiers as $dossier)
        <div class="card border-0 shadow-lg rounded-4 mb-5">
            <div class="card-header rounded-top-4 py-3"
                 style="background: linear-gradient(135deg,rgb(20, 51, 86),rgb(16, 46, 76)); color: #fff;">
                <div class="d-flex justify-content-between align-items-center">
                    <strong>
                        <i class="bi bi-briefcase me-2"></i> 
                        Dossier n°{{ $loop->iteration + ($dossiers->firstItem() - 1) }}
                    </strong>
                    <span class="badge rounded-pill 
                        @switch($dossier->statut)
                            @case('termine') bg-success @break
                            @case('en_cours') bg-info text-dark @break
                            @case('en_attente') bg-warning text-dark @break
                            @case('rejete') bg-danger @break
                            @default bg-secondary
                        @endswitch">
                        {{ ucfirst(str_replace('_', ' ', $dossier->statut)) }}
                    </span>
                </div>
                <div class="small fst-italic mt-1">
                    Domaine : {{ $dossier->domaine->nom ?? 'Non défini' }}
                </div>
            </div>

            <div class="card-body bg-light">
                @if ($dossier->documents->isEmpty())
                    <div class="alert alert-secondary d-flex align-items-center rounded-3">
                        <i class="bi bi-info-circle me-2"></i> Aucun document soumis pour ce dossier.
                    </div>
                @else
                    <ul class="list-group list-group-flush">
                        @foreach ($dossier->documents as $doc)
                            @php
                                $extension = strtolower(pathinfo($doc->path_fichier, PATHINFO_EXTENSION));
                                $icons = [
                                    'pdf' => 'bi bi-file-earmark-pdf text-danger',
                                    'doc' => 'bi bi-file-earmark-word text-primary',
                                    'docx' => 'bi bi-file-earmark-word text-primary',
                                    'jpg' => 'bi bi-file-earmark-image text-warning',
                                    'jpeg' => 'bi bi-file-earmark-image text-warning',
                                    'png' => 'bi bi-file-earmark-image text-warning',
                                    'xls' => 'bi bi-file-earmark-excel text-success',
                                    'xlsx' => 'bi bi-file-earmark-excel text-success',
                                    'txt' => 'bi bi-file-earmark-text text-muted',
                                ];
                                $iconClass = $icons[$extension] ?? 'bi bi-file-earmark text-secondary';
                                $isPdf = $extension === 'pdf';
                            @endphp

                            <li class="list-group-item d-flex justify-content-between align-items-center border-0 border-bottom">
                                <div class="d-flex align-items-center">
                                    <i class="{{ $iconClass }} me-3 fs-4"></i>
                                    <div>
                                        <div class="fw-semibold">{{ $doc->nom ?? 'Document' }}</div>
                                        <small class="text-muted">Envoyé le {{ $doc->created_at->format('d/m/Y à H:i') }}</small>
                                    </div>
                                </div>
                                <div class="d-flex gap-2">
                                    <a href="{{ asset('storage/documents/' . $doc->path_fichier) }}"
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3"
                                       target="_blank">
                                        <i class="bi bi-download me-1"></i> Télécharger
                                    </a>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center rounded-4 shadow-sm">
            <i class="bi bi-folder-x fs-3 mb-2 d-block"></i>
            Aucun dossier assigné à ce client pour le moment.
        </div>
    @endforelse

    <!-- ✅ Pagination -->
    <div class="mt-4">
        {{ $dossiers->links() }}
    </div>
</div>
@endsection
