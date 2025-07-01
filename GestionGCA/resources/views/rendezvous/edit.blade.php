@extends('administration.base')

@section('content')
<div class="container py-5">
    <h3 class="mb-4 fw-bold text-dark">✏️ Modifier le rendez-vous</h3>

    <form action="{{ route('rendezvous.update', $rendezvous->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Date & Heure</label>
            <input type="datetime-local" name="date_heure"
                   value="{{ $rendezvous->date_heure->format('Y-m-d\TH:i') }}"
                   class="form-control rounded-pill border-2 border-primary">
        </div>

        <div class="mb-3">
            <label class="form-label">Lieu</label>
            <input type="text" name="lieu" value="{{ $rendezvous->lieu }}"
                   class="form-control rounded-pill border-2 border-primary">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" rows="4"
                      class="form-control rounded-4 border-2 border-primary">{{ $rendezvous->description }}</textarea>
        </div>

        {{-- ✅ Confirmer par modal --}}
        <button type="button" class="btn btn-warning rounded-pill px-4"
                data-bs-toggle="modal" data-bs-target="#confirmModal">
            Sauvegarder la modification
        </button>

        {{-- Modal confirmation --}}
        <div class="modal fade" id="confirmModal" tabindex="-1">
            <div class="modal-dialog">
                <div class="modal-content rounded-4 border border-warning">
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Confirmer la modification</h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        Êtes-vous sûr de vouloir enregistrer cette modification ?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary rounded-pill" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-success rounded-pill">Confirmer</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
