@foreach($avocats as $avocat)
    <!-- Modale d'activation/désactivation -->
    <div class="modal fade" id="confirmToggleModal{{ $avocat->id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border: 2px solid #aa9166; background-color: #f5f5f5;">
                <div class="modal-header text-white" style="background-color: #001F3D;">
                    <h5 class="modal-title">
                        Confirmation
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
                </div>
                <div class="modal-body">
                    Êtes-vous sûr de vouloir
                    <strong>{{ $avocat->avocat && $avocat->avocat->is_active ? 'désactiver' : 'activer' }}</strong>
                    le compte de
                    <strong>{{ $avocat->prenom }} {{ $avocat->nom }}</strong> ?
                </div>
                <div class="modal-footer">
                    <form action="{{ route('admin.avocats.toggle', $avocat) }}" method="POST">
                        @csrf
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn text-white" style="background-color: #aa9166;">Confirmer</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
