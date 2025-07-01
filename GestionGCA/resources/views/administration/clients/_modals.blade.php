{{-- Modal de confirmation de suppression --}}
<div class="modal fade" id="confirmDeleteClientModal" tabindex="-1" aria-labelledby="confirmDeleteClientLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header" style="background-color:  #001F3D; color: white;">
        <h5 class="modal-title" id="confirmDeleteClientLabel">
          <i class="bi bi-trash3 me-2"></i> Confirmer la suppression
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body text-center">
        <p class="fw-bold">Êtes-vous sûr(e) de vouloir supprimer ce client ?</p>
      </div>
      <div class="modal-footer justify-content-center">
        <form method="POST" id="deleteClientForm" class="d-flex gap-2">
          @csrf
          @method('DELETE')
          <button type="button" class="btn btn-secondary" style="background-color: #001F3D; border:none;" data-bs-dismiss="modal">Annuler</button>
          <button type="submit" class="btn" style="background-color: #aa9166; color: white;">Supprimer</button>
        </form>
      </div>
    </div>
  </div>
</div>

{{-- Modal d'erreur si le client ne peut pas être supprimé --}}
<div class="modal fade" id="clientHasDossiersModal" tabindex="-1" aria-labelledby="clientHasDossiersModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow">
      <div class="modal-header" style="background-color: #aa9166; color: white;">
        <h5 class="modal-title" id="clientHasDossiersModalLabel">
          <i class="bi bi-exclamation-triangle me-2"></i> Suppression impossible
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body text-center">
        <p class="fw-bold" style="color: #001F3D;">
          Ce client possède des dossiers en cours ou rejetés.<br>
          Veuillez les clôturer avant de pouvoir le supprimer.
        </p>
      </div>
      <div class="modal-footer justify-content-center">
        <button type="button" class="btn" style="background-color: #aa9166; color: white;" data-bs-dismiss="modal">Compris</button>
      </div>
    </div>
  </div>
</div>
