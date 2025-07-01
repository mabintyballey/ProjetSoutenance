@extends('administration.base')

@section('content')
<div class="container py-5">

    <!-- Header & Bouton retour -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-dark fw-bold mb-0">
            <i class="fas fa-user-tie text-primary me-2"></i> Détails de l'Avocat
        </h2>
        <a href="{{ route('admin.avocats.index') }}" class="btn btn-outline-secondary rounded-pill">
            <i class="fas fa-arrow-left me-2"></i> Retour à la liste
        </a>
    </div>

    <!-- Carte Avocat -->
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="row g-0">
            <!-- Photo -->
            <div class="col-lg-4 bg-light text-center p-4">
                <img src="{{ $avocat->photo ? asset('storage/' . $avocat->photo) : asset('uploads/photos/default.png') }}"
                     class="rounded-circle border"
                     alt="Photo de {{ $avocat->name }}"
                     style="width: 180px; height: 180px; object-fit: cover; margin-left: 60px;">
                <h5 class="mt-3 fw-bold text-dark">{{ $avocat->name }} {{ $avocat->prenom }}</h5>
                <span class="badge rounded-pill {{ $avocat->avocat->is_active ? 'bg-success' : 'bg-danger' }}">
                    {{ $avocat->avocat->is_active ? 'Actif' : 'Inactif' }}
                </span>
            </div>

            <!-- Infos -->
            <div class="col-lg-8 bg-white p-4">
                <div class="row mb-3">
                    <div class="col-md-6 mb-2">
                        <strong><i class="fas fa-envelope me-2 text-primary"></i>Email :</strong><br>
                        <span class="text-muted">{{ $avocat->email }}</span>
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong><i class="fas fa-phone me-2 text-primary"></i>Téléphone :</strong><br>
                        <span class="text-muted">{{ $avocat->telephone ?? 'Non renseigné' }}</span>
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong><i class="fas fa-map-marker-alt me-2 text-primary"></i>Adresse :</strong><br>
                        <span class="text-muted">{{ $avocat->adresse ?? 'Non renseignée' }}</span>
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong><i class="fas fa-gavel me-2 text-primary"></i>Domaine :</strong><br>
                        <span class="text-muted">{{ $avocat->avocat->domaine->nom ?? 'Non spécifié' }}</span>
                    </div>
                    <div class="col-md-6 mb-2">
                        <strong><i class="fas fa-briefcase me-2 text-primary"></i>Spécialité :</strong><br>
                        <span class="text-muted">{{ $avocat->avocat->specialite->nom ?? 'Non spécifiée' }}</span>
                    </div>
                </div>

                <!-- Actions -->
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <a href="{{ route('admin.avocats.edit', $avocat->id) }}" class="btn btn-outline-primary rounded-pill px-4">
                        <i class="fas fa-edit me-2"></i> Modifier
                    </a>

                    <form action="{{ route('admin.avocats.destroy', $avocat->id) }}" method="POST" onsubmit="return confirm('Confirmer la suppression ?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger rounded-pill px-4">
                            <i class="fas fa-trash-alt me-2"></i> Supprimer
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
