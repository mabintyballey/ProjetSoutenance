<section class="text-white shadow-lg border-0 rounded-4 mb-5">
    <div class="card-header text-white rounded-top-4 py-3 px-4">
        <small class="text-light">Utilisez un mot de passe long et sécurisé pour renforcer la sécurité de votre compte.</small>
    </div>

    <div class="text-white p-4">
        <form method="POST" action="{{ route('password.update') }} " class="text-white">
            @csrf
            @method('put')

            {{-- 🔐 Mot de passe actuel --}}
            <div class="mb-4">
                <label for="update_password_current_password" class="form-label fw-semibold">Mot de passe actuel</label>
                <input type="password" name="current_password" id="update_password_current_password"
                       class="form-control @error('current_password', 'updatePassword') is-invalid @enderror"
                       autocomplete="current-password">
                <div class="invalid-feedback">
                    @foreach($errors->updatePassword->get('current_password') as $message)
                        {{ $message }}
                    @endforeach
                </div>
            </div>

            {{-- 🔁 Nouveau mot de passe --}}
            <div class="mb-4">
                <label for="update_password_password" class="form-label fw-semibold">Nouveau mot de passe</label>
                <input type="password" name="password" id="update_password_password"
                       class="form-control @error('password', 'updatePassword') is-invalid @enderror"
                       autocomplete="new-password">
                <div class="invalid-feedback">
                    @foreach($errors->updatePassword->get('password') as $message)
                        {{ $message }}
                    @endforeach
                </div>
            </div>

            {{-- ✅ Confirmation --}}
            <div class="mb-4">
                <label for="update_password_password_confirmation" class="form-label fw-semibold">Confirmer le mot de passe</label>
                <input type="password" name="password_confirmation" id="update_password_password_confirmation"
                       class="form-control @error('password_confirmation', 'updatePassword') is-invalid @enderror"
                       autocomplete="new-password">
                <div class="invalid-feedback">
                    @foreach($errors->updatePassword->get('password_confirmation') as $message)
                        {{ $message }}
                    @endforeach
                </div>
            </div>

            {{-- 📩 Bouton + Message --}}
            <div class="d-flex align-items-center justify-content-between">
                <button type="submit" class="btn px-4" style="background-color: #aa9166;">
                    <i class="bi bi-shield-lock-fill me-1"></i> Enregistrer
                </button>

                @if (session('status') === 'password-updated')
                    <div class="alert alert-success mb-0 py-2 px-3 small fade show" role="alert">
                        ✔️ Mot de passe mis à jour avec succès.
                    </div>
                @endif
            </div>
        </form>
    </div>
</section>
