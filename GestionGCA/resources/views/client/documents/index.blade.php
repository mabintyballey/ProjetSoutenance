@extends('administration.base')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-dark fw-bold">
        📁 Mes Documents
    </h2>

    @if($documents->isEmpty())
        <div class="alert alert-info shadow-sm rounded-4">
            Aucun document trouvé pour le moment.
        </div>
    @else
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
            @foreach ($documents as $index => $doc)
                <div class="col">
                    <div class="card border-0 shadow rounded-4 h-100 position-relative">
                        <div class="position-absolute top-0 start-0 translate-middle badge rounded-pill 
                            @switch($doc->type)
                                @case('requete') bg-primary @break
                                @case('assignation') bg-warning text-dark @break
                                @case('preuve') bg-success @break
                                @case('autre') bg-secondary @break
                            @endswitch" style="padding: .5em 1em; margin: 1rem;">
                            {{ ucfirst($doc->type) }}
                        </div>

                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title mb-2">
                                📄 Document :{{ $loop->iteration + ($documents->firstItem() - 1) }}
                            </h5>

                            <p class="card-text small mb-1">
                                <i class="bi bi-folder-fill text-primary me-1"></i>
                                <strong>Dossier :</strong> #{{ $loop->iteration + ($documents->firstItem() - 1) }}
                            </p>

                            <p class="card-text small mb-3">
                                <i class="bi bi-calendar-event me-1"></i>
                                <strong>Ajouté le :</strong> {{ $doc->created_at->format('d/m/Y à H:i') }}
                            </p>

                            <div class="mt-auto d-flex justify-content-between">
                                <a href="{{ asset('storage/documents/' . $doc->path_fichier) }}" 
                                   class="btn btn-outline-primary btn-sm rounded-pill"
                                   target="_blank">
                                    <i class="bi bi-eye me-1"></i> Voir
                                </a>
                                <a href="{{ asset('storage/documents/' . $doc->path_fichier) }}" 
                                   class="btn btn-outline-success btn-sm rounded-pill"
                                   target="_blank" download>
                                    <i class="bi bi-download me-1"></i> Télécharger
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $documents->withQueryString()->links('pagination::bootstrap-5') }}
        </div>
    @endif
</div>
@endsection
