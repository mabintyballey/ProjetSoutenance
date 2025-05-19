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
                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="color: #001F3D;">Nom</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="color: #001F3D;">Prénom</label>
                        <input type="text" name="prenom" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="color: #001F3D;">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="color: #001F3D;">Téléphone</label>
                        <input type="text" name="telephone" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="color: #001F3D;">Adresse</label>
                        <input type="text" name="adresse" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="color: #001F3D;">Spécialité</label>
                        <input type="text" name="specialite" class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="color: #001F3D;">Mot de passe</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-semibold" style="color: #001F3D;">Photo</label>
                        <input type="file" name="photo" class="form-control" accept="image/*">
                    </div>
                </div>

                <!-- Boutons -->
                <div class="d-flex flex-wrap align-items-center gap-2 mt-4">
                    <button type="submit" class="btn text-white fw-semibold" style="background-color: #3498db;">
                        💾 Enregistrer l’avocat
                    </button>

                    <button type="button" onclick="document.getElementById('form-avocat').reset();"
                            class="btn text-white fw-semibold" style="background-color: #aa9166;">
                        ❌ Annuler
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
