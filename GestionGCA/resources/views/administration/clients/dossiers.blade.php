@extends('administration.base')

@section('content')
<div class="container py-5">
    <!-- Titre principal -->
    <div class="text-center mb-5">
        <h2 class="fw-bold text-dark d-inline-flex align-items-center border-bottom border-4 pb-2" style="border-color: #aa9166;">
            <i class="bi bi-folder2-open me-2 text-primary fs-3"></i>
            Dossiers de {{ $client->user->prenom }} {{ $client->user->nom }}
        </h2>
        <p class="mt-2 text-muted fst-italic">Chaque dossier est une étape vers la justice.</p>
    </div>

    <!-- Boutons de navigation -->
    <div class="d-flex flex-wrap gap-3 mb-4 justify-content-start">
        <a href="{{ route('admin.clients.index') }}" class="btn btn-outline-dark rounded-pill px-4">
            ← Retour
        </a>
    </div>

    <!-- Liste des dossiers -->
    @if ($client->dossiers->isEmpty())
        <div class="alert alert-warning shadow-sm rounded-3">
            <i class="bi bi-info-circle-fill me-2"></i> Aucun dossier soumis pour le moment.
        </div>
    @else
        <div class="row">
            @foreach ($dossiers as $dossier)
                <div class="col-md-6 mb-4">
                    <div class="card border-0 shadow-lg rounded-4 h-100">
                        <div class="card-body">
                            <h5 class="card-title text-uppercase text-primary fw-bold mb-3">
                                📁 Dossier n°{{ $loop->iteration }}
                            </h5>

                            <ul class="list-unstyled mb-3 text-muted">
                               <li><strong class="text-dark">📝 Description :</strong> {{ $dossier->description }}</li>
                               <li><strong class="text-dark">👤 Info adverse :</strong> {{ $dossier->information_adverse }}</li>
                               <li><strong class="text-dark">📚 Domaine :</strong> {{ $dossier->domaine->nom ?? 'Non défini' }}</li>
                               <li>
                                   <strong class="text-dark">📌 Statut :</strong>
                                   <span class="badge 
                                       @if($dossier->statut === 'valide') bg-success 
                                       @elseif($dossier->statut === 'rejete') bg-danger 
                                       @else bg-warning text-dark 
                                       @endif rounded-pill px-3 py-1">
                                       {{ ucfirst($dossier->statut ?? 'en attente') }}
                                   </span>
                               </li>
                               <li><strong class="text-dark">📅 Soumis le :</strong> {{ $dossier->created_at->format('d/m/Y à H:i') }}</li>
                            </ul>

                            @if ($dossier->documents)
                                <button 
                                    class="btn btn-sm btn-outline-secondary rounded-pill" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#previewModal" 
                                    data-document-url="{{ asset('storage/' . $dossier->documents) }}">
                                    👁️ Aperçu du fichier
                                </button>
                            @else
                                <p class="text-muted fst-italic mb-0">Aucun document joint.</p>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <div class="mt-4">
        {{ $dossiers->links('pagination::bootstrap-5') }}
    </div>
</div>

<!-- MODALE POUR APERÇU DU DOCUMENT -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl modal-dialog-scrollable">
    <div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title" id="previewModalLabel">Aperçu du document</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        <iframe src="" style="width: 100%; height: 75vh;" frameborder="0" id="documentIframe"></iframe>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
    const previewModal = document.getElementById('previewModal');
    previewModal.addEventListener('show.bs.modal', event => {
        const button = event.relatedTarget;
        const url = button.getAttribute('data-document-url');
        const iframe = previewModal.querySelector('#documentIframe');
        iframe.src = url;
    });

    previewModal.addEventListener('hidden.bs.modal', () => {
        previewModal.querySelector('#documentIframe').src = '';
    });
</script>
@endpush
