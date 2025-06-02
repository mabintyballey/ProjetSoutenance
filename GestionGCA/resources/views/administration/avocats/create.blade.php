@extends('administration.base')

@section('content')
<div class="container mt-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h2 class="mb-4 text-uppercase fw-bold text-center" style="color: #2c3e50; border-bottom: 3px solid #3498db; padding-bottom: 10px;">
                ⚖️ Ajouter un Avocat
            </h2>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0 ps-3">
                        @foreach ($errors->all() as $error)
                            <li class="mb-1">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form id="form-avocat" method="POST" action="{{ route('admin.avocats.store') }}" enctype="multipart/form-data">
                @csrf

                <div class="row g-3">
                    @php
                        $fields = [
                            ['name' => 'name', 'label' => 'Nom', 'type' => 'text', 'icon' => 'fa-user'],
                            ['name' => 'prenom', 'label' => 'Prénom', 'type' => 'text', 'icon' => 'fa-user-tag'],
                            ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'icon' => 'fa-envelope'],
                            ['name' => 'telephone', 'label' => 'Téléphone', 'type' => 'text', 'icon' => 'fa-phone'],
                            ['name' => 'adresse', 'label' => 'Adresse', 'type' => 'text', 'icon' => 'fa-map-marker-alt'],
                            ['name' => 'specialite', 'label' => 'Spécialité', 'type' => 'text', 'icon' => 'fa-briefcase'],
                            ['name' => 'password', 'label' => 'Mot de passe', 'type' => 'password', 'icon' => 'fa-lock'],
                        ];
                    @endphp

                    @foreach ($fields as $field)
                        <div class="col-md-6">
                            <label class="form-label fw-semibold" style="color: #001F3D;">{{ $field['label'] }}</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fas {{ $field['icon'] }} text-primary"></i>
                                </span>
                                <input
                                    type="{{ $field['type'] }}"
                                    name="{{ $field['name'] }}"
                                    class="form-control border-start-0"
                                    required="{{ in_array($field['name'], ['name','prenom','email','password']) ? 'required' : '' }}">
                            </div>
                        </div>
                    @endforeach

                    <!-- Photo -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="color: #001F3D;">Photo</label>
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-image text-primary"></i>
                            </span>
                            <input type="file" name="photo" class="form-control border-start-0" accept="image/*">
                        </div>
                    </div>
                </div>

                <!-- Boutons -->
                <div class="d-flex flex-wrap align-items-center gap-2 mt-4">
                    <button type="submit" class="btn text-white fw-semibold" style="background-color: #3498db;">
                        <i class="fas fa-save me-1"></i> Enregistrer l’avocat
                    </button>

                    <button type="button" onclick="document.getElementById('form-avocat').reset();"
                            class="btn text-white fw-semibold" style="background-color: #aa9166;">
                        <i class="fas fa-times me-1"></i> Annuler
                    </button>

                    <a href="{{ route('admin.avocats.index') }}" class="ms-auto text-decoration-none fw-semibold" style="color: #3498db;">
                        ← Retour à la liste des avocats
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
