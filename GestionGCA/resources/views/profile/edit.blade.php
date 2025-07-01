@extends('administration.base')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-light-emphasis">⚙️ Paramètres du profil</h2>

    {{-- ✅ Carte Informations du profil --}}
    <div class="card shadow-sm border-0 rounded-4 mb-5" style="background-color: #1f2d35; color: #fff;">
        <div class="card-header rounded-top-4 py-3 px-4" style="background-color: #aa9166;">
            <h5 class="mb-0">
                <i class="bi bi-person-fill me-2"></i> Informations du profil
            </h5>
        </div>
        <div class="card-body p-4">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    {{-- 🔐 Carte Changement de mot de passe --}}
    <div class="card shadow-sm border-0 rounded-4" style="background-color: #1f2d35; color: #fff;">
        <div class="card-header rounded-top-4 py-3 px-4" style="background-color: #aa9166;">
            <h5 class="mb-0">
                <i class="bi bi-lock-fill me-2"></i> Modifier le mot de passe
            </h5>
        </div>
        <div class="card-body p-4">
            @include('profile.partials.update-password-form')
        </div>
    </div>
</div>
@endsection
