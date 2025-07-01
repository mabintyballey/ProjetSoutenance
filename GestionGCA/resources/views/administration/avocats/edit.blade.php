@extends('administration.base')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold text-uppercase" style="font-size: 2rem; color: #2c3e50;">
            <i class="fas fa-user-edit me-2 text-primary"></i> Modifier l’Avocat
        </h1>
        <p class="text-muted mt-2 mb-3" style="font-size: 1rem; max-width: 650px; margin: 0 auto;">
            Mettez à jour les informations personnelles et professionnelles de l’avocat afin d’assurer une gestion fluide et conforme aux normes du cabinet.
        </p>
        <div class="mx-auto" style="width: 80px; height: 4px; background-color: #3498db; border-radius: 2px;"></div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li class="fw-semibold">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('admin.avocats.update', $avocat->id) }}" enctype="multipart/form-data" class="bg-white border rounded-3 shadow p-4">
        @csrf
        @method('PUT')

        <div class="row g-4">

            <!-- Nom -->
            <div class="col-md-6">
                <label for="nom" class="form-label fw-semibold">Nom</label>
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-user text-primary"></i>
                    </span>
                    <input type="text" name="nom" id="nom" class="form-control border-start-0"
                           value="{{ old('nom', $avocat->nom) }}" required>
                </div>
            </div>

            <!-- Prénom -->
            <div class="col-md-6">
                <label for="prenom" class="form-label fw-semibold">Prénom</label>
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-user-tag text-primary"></i>
                    </span>
                    <input type="text" name="prenom" id="prenom" class="form-control border-start-0"
                           value="{{ old('prenom', $avocat->prenom) }}">
                </div>
            </div>

            <!-- Email -->
            <div class="col-md-6">
                <label for="email" class="form-label fw-semibold">Email</label>
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-envelope text-primary"></i>
                    </span>
                    <input type="email" name="email" id="email" class="form-control border-start-0"
                           value="{{ old('email', $avocat->email) }}" required>
                </div>
            </div>

            <!-- Téléphone -->
            <div class="col-md-6">
                <label for="telephone" class="form-label fw-semibold">Téléphone</label>
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-phone text-primary"></i>
                    </span>
                    <input type="text" name="telephone" id="telephone" class="form-control border-start-0"
                           value="{{ old('telephone', $avocat->telephone) }}" required>
                </div>
            </div>

            <!-- Adresse -->
            <div class="col-md-6">
                <label for="adresse" class="form-label fw-semibold">Adresse</label>
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas fa-map-marker-alt text-primary"></i>
                    </span>
                    <input type="text" name="adresse" id="adresse" class="form-control border-start-0"
                           value="{{ old('adresse', $avocat->adresse) }}" required>
                </div>
            </div>

            <!-- Domaine -->
            <div class="col-md-6">
                <label for="domaine_id" class="form-label fw-semibold">Domaine</label>
                <select name="domaine_id" id="domaine_id" class="form-select shadow-sm" required>
                    <option value="">-- Choisir un domaine --</option>
                    @foreach($domaines as $domaine)
                        <option value="{{ $domaine->id }}"
                            {{ (old('domaine_id', $avocat->avocat->domaine_id ?? '') == $domaine->id) ? 'selected' : '' }}>
                            {{ $domaine->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Spécialité -->
            <div class="col-md-6">
                <label for="specialite_id" class="form-label fw-semibold">Spécialité</label>
                <select name="specialite_id" id="specialite_id" class="form-select shadow-sm" required>
                    <option value="">-- Choisir une spécialité --</option>
                    @foreach($specialites as $specialite)
                        <option value="{{ $specialite->id }}"
                            {{ (old('specialite_id', $avocat->avocat->specialite_id ?? '') == $specialite->id) ? 'selected' : '' }}>
                            {{ $specialite->nom }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Photo -->
            <div class="col-md-6">
                <label for="photo" class="form-label fw-semibold">Photo de profil</label>
                <input type="file" name="photo" id="photo" class="form-control shadow-sm">
                @if($avocat->photo)
                <img src="{{ asset('storage/' . $avocat->photo) }}" alt="Photo profil" class="img-thumbnail mt-2" style="max-height: 100px;">
                @endif
            </div>

            <!-- Boutons -->
            <div class="col-12 mt-4 d-flex gap-3 justify-content-end">
                <button type="submit" class="btn btn-primary px-4">
                    <i class="fas fa-save me-2"></i> Mettre à jour
                </button>
                <a href="{{ route('admin.avocats.index') }}" class="btn btn-secondary px-4">
                    <i class="fas fa-arrow-left me-2"></i> Annuler
                </a>
            </div>
        </div>
    </form>
</div>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const input = document.querySelector('input[name="photo"]');
        const preview = document.getElementById('photo-preview');

        input.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    preview.src = event.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.classList.add('d-none');
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        const domaineSelect = document.getElementById('domaine_id');
        const specialiteSelect = document.getElementById('specialite_id');

        domaineSelect.addEventListener('change', function () {
            const selectedOption = domaineSelect.options[domaineSelect.selectedIndex];
            const specialites = JSON.parse(selectedOption.dataset.specialites || '[]');

            // Vider les options précédentes
            specialiteSelect.innerHTML = '<option value="">-- Sélectionner une spécialité --</option>';

            // Ajouter les nouvelles spécialités
            specialites.forEach(spec => {
                const option = document.createElement('option');
                option.value = spec.id;
                option.text = spec.nom;
                specialiteSelect.appendChild(option);
            });
        });

        // Preview image logic (conservé)
        const input = document.querySelector('input[name="photo"]');
        const preview = document.getElementById('photo-preview');

        input.addEventListener('change', function (e) {
            const file = e.target.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function (event) {
                    preview.src = event.target.result;
                    preview.classList.remove('d-none');
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '#';
                preview.classList.add('d-none');
            }
        });
    });
</script>
@endsection
