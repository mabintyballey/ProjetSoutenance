@extends('administration.base')

@section('content')
<div class="container py-5">
    <!-- Titre -->
    <div class="text-center mb-5">
        <h1 class="fw-bold text-uppercase" style="font-size: 2rem; color: #2c3e50;">
            <i class="fas fa-user-edit me-2 text-primary"></i> Modifier l’Avocat
        </h1>
        <p class="text-muted mt-2 mb-3" style="font-size: 1rem; max-width: 650px; margin: 0 auto;">
            Mettez à jour les informations personnelles et professionnelles de l’avocat afin d’assurer une gestion fluide et conforme aux normes du cabinet.
        </p>
        <div class="mx-auto" style="width: 80px; height: 4px; background-color: #3498db; border-radius: 2px;"></div>
    </div>


    <!-- Erreurs -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li class="fw-semibold">{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulaire -->
    <form method="POST" action="{{ route('admin.avocats.update', $avocat->id) }}" enctype="multipart/form-data" class="bg-white border rounded-3 shadow p-4">
        @csrf
        @method('PUT')

        <div class="row g-4">
            @php
                $fields = [
                    ['name' => 'name', 'label' => 'Nom', 'icon' => 'fa-user', 'type' => 'text'],
                    ['name' => 'prenom', 'label' => 'Prénom', 'icon' => 'fa-user-tag', 'type' => 'text'],
                    ['name' => 'email', 'label' => 'Email', 'icon' => 'fa-envelope', 'type' => 'email'],
                    ['name' => 'specialite', 'label' => 'Spécialité', 'icon' => 'fa-briefcase', 'type' => 'text'],
                    ['name' => 'telephone', 'label' => 'Téléphone', 'icon' => 'fa-phone', 'type' => 'text'],
                    ['name' => 'adresse', 'label' => 'Adresse', 'icon' => 'fa-map-marker-alt', 'type' => 'text'],
                ];
            @endphp

            @foreach ($fields as $field)
            <div class="col-md-6">
                <label for="{{ $field['name'] }}" class="form-label fw-semibold">{{ $field['label'] }}</label>
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white border-end-0">
                        <i class="fas {{ $field['icon'] }} text-primary"></i>
                    </span>
                    <input type="{{ $field['type'] }}"
                           name="{{ $field['name'] }}"
                           id="{{ $field['name'] }}"
                           class="form-control border-start-0"
                           placeholder="{{ $field['label'] }}"
                           value="{{ old($field['name'], $avocat->{$field['name']}) }}"
                           required>
                </div>
            </div>
            @endforeach

            <!-- Photo -->
            <div class="col-md-6">
                <label for="photo" class="form-label fw-semibold">Photo de profil</label>
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white">
                        <i class="fas fa-image text-primary"></i>
                    </span>
                    <input type="file" name="photo" class="form-control">
                </div>
            </div>

            <!-- Affichage photo actuelle -->
            <div class="col-md-6 d-flex flex-column justify-content-start">
                @if ($avocat->photo)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $avocat->photo) }}" alt="Photo" class="img-thumbnail" style="max-height: 100px;">
                </div>
                @endif

                <!-- Boutons -->
                <div class="d-flex flex-wrap gap-3 mt-4">
                    <button type="submit" class="btn text-white btn-lg px-4 shadow-sm" style="background-color: #3498db;">
                        <i class="fas fa-save me-2"></i> Mettre à jour
                    </button>
                    <a href="{{ route('admin.avocats.index') }}" class="btn btn-outline-secondary btn-lg px-4 shadow-sm">
                        <i class="fas fa-arrow-left me-2"></i> Annuler
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
