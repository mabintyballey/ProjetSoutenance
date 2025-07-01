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
                            ['name' => 'nom', 'label' => 'Nom', 'type' => 'text', 'icon' => 'fa-user'],
                            ['name' => 'prenom', 'label' => 'Prénom', 'type' => 'text', 'icon' => 'fa-user-tag'],
                            ['name' => 'email', 'label' => 'Email', 'type' => 'email', 'icon' => 'fa-envelope'],
                            ['name' => 'telephone', 'label' => 'Téléphone', 'type' => 'text', 'icon' => 'fa-phone'],
                            ['name' => 'adresse', 'label' => 'Adresse', 'type' => 'text', 'icon' => 'fa-map-marker-alt'],
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

                    <!-- Domaine -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="color: #001F3D;">Domaine juridique</label>
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-gavel text-primary"></i>
                            </span>
                            <select id="domaine_id" name="domaine_id" class="form-select border-start-0" required>
                                <option value="">-- Sélectionner un domaine --</option>
                                @foreach($domaines as $domaine)
                                    <option value="{{ $domaine->id }}" data-specialites='@json($domaine->specialites)'>
                                        {{ $domaine->nom }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    
                    <!-- Spécialité -->
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="color: #001F3D;">Spécialité</label>
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-briefcase text-primary"></i>
                            </span>
                            <select name="specialite_id" id="specialite_id" class="form-select border-start-0">
                                <option value="">-- Sélectionner une spécialité --</option>
                            </select>
                        </div>
                    </div>


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

                    <!-- Aperçu de la photo -->
                    <div class="text-center">
                        <img id="photo-preview" src="#" alt="Aperçu de la photo"
                            class="img-thumbnail mt-2 shadow-sm d-none"
                            style="max-width: 100px; border: 2px solid rgb(77, 91, 100); border-radius: 10px;">
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
