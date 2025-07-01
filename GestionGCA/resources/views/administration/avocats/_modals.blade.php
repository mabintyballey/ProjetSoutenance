<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border: 2px solid #aa9166; background-color: #f8f9fa;">
      <div class="modal-header" style="background-color: #001F3D;">
        <h5 class="modal-title text-white" id="deleteModalLabel">
          <i class="fas fa-exclamation-triangle text-warning me-2"></i> Confirmation requise
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body text-center">
        <p class="mb-3 fw-bold text-dark">Êtes-vous sûr de vouloir supprimer cet avocat ?</p>
        <form method="POST" id="deleteAvocatForm">
          @csrf
          @method('DELETE')
          <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn text-white" style="background-color: #aa9166;">Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal erreur si l'avocat a encore des dossiers -->
<div class="modal fade" id="avocatHasDossiersModal" tabindex="-1" aria-labelledby="avocatHasDossiersModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border: 2px solid #aa9166; background-color: #f8f9fa;">
      <div class="modal-header" style="background-color: #001F3D;">
        <h5 class="modal-title text-white" id="avocatHasDossiersModalLabel">
          <i class="fas fa-exclamation-circle text-warning me-2"></i> Suppression impossible
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body text-center">
        <p class="fw-bold text-dark mb-0">
          Cet avocat ne peut pas être supprimé car il a encore des dossiers en charge.<br>
          Veuillez réattribuer ou clôturer les dossiers avant la suppression.
        </p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn" style="background-color: #aa9166; color: white;" data-bs-dismiss="modal">
          <i class="fas fa-check me-1"></i> Compris
        </button>
      </div>
    </div>
  </div>
</div>
