@extends('administration.base')

@section('content')
<div class="container py-5">
   <!-- Titre principal -->
<div class="text-center mb-5" style="color: #001F3D;">
    <h1 class="display-5 fw-bold">
        <i class="fas fa-user-edit me-2"></i> Modifier l’Avocat
    </h1>
    <p class="fs-5" style="color: #3A4A63; font-weight: 500; max-width: 600px; margin: 0 auto;">
      Une mise à jour précise des données permet une meilleure gestion des services juridiques.
    </p>

    <hr class="w-25 mx-auto" style="border: 2px solid #aa9166;">
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

    <form method="POST" action="{{ route('admin.avocats.update', $avocat->id) }}" enctype="multipart/form-data" class="bg-white p-4 rounded shadow-sm">
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

            @foreach (array_chunk($fields, 2) as $chunk)
                @foreach ($chunk as $field)
                <div class="col-md-6">
                    <div class="form-floating position-relative">
                        <input type="{{ $field['type'] }}" name="{{ $field['name'] }} "
                            value="{{ old($field['name'], $avocat->{$field['name']}) }}"
                            class="form-control p-4 mr-5 shadow-sm" id="{{ $field['name'] }}" placeholder="{{ $field['label'] }}" required>
                        <label for="{{ $field['name'] }}">{{ $field['label'] }}</label>
                        <i class="fas {{ $field['icon'] }} position-absolute top-50 start-0 translate-middle-y mx-3 text-primary"></i>
                    </div>
                </div>
                @endforeach
            @endforeach

            <div class="col-md-6">
                <label class="form-label fw-semibold">Photo de profil</label>
                <div class="input-group shadow-sm">
                    <span class="input-group-text bg-white"><i class="fas fa-image text-primary"></i></span>
                    <input type="file" name="photo" class="form-control">
                </div>
            </div>

            <div class="col-md-6 d-flex flex-column justify-content-start">
                @if ($avocat->photo)
                    <div class="mb-3">
                        <img src="{{ asset('storage/' . $avocat->photo) }}" alt="Photo" class="img-thumbnail" style="max-height: 100px;">
                    </div>
                @endif

                <div class="d-flex gap-3 mt-4">
                    <button type="submit" class="btn text-white btn-lg px-4 shadow-sm" style="background-color: #3498db;">
                        <i class="fas fa-save me-2"></i> Mettre à jour
                    </button>
                    <a href="{{ route('admin.avocats.index') }}" class="btn btn-outline-secondary btn-lg px-4 shadow-sm" >
                        <i class="fas fa-arrow-left me-2"></i> Annuler
                    </a>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
