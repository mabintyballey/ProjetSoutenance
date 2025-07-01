<section class="shadow-lg border-0 rounded-4 mb-5">
    <div class="card-header text-white rounded-top-4 py-3 px-4">
        <small class="text-light">Mettez à jour votre nom et adresse email associée à votre compte.</small>
    </div>

    <div class="p-4">
        {{-- Formulaire de renvoi du lien de vérification --}}
        <form id="send-verification" method="POST" action="{{ route('verification.send') }}">
            @csrf
        </form>

        {{-- Formulaire de mise à jour --}}
        <form method="POST" action="{{ route('profile.update') }}">
            @csrf
            @method('patch')

            {{-- 🧑 Nom complet --}}
            <div class="mb-4">
                <label for="name" class="form-label fw-semibold">Nom complet</label>
                <input type="text" id="name" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name', $user->name) }}" required autofocus>
                <div class="invalid-feedback">
                    @foreach($errors->get('name') as $message)
                        {{ $message }}
                    @endforeach
                </div>
            </div>

            {{-- 📧 Email --}}
            <div class="mb-4">
                <label for="email" class="form-label fw-semibold">Adresse Email</label>
                <input type="email" id="email" name="email"
                       class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $user->email) }}" required>
                <div class="invalid-feedback">
                    @foreach($errors->get('email') as $message)
                        {{ $message }}
                    @endforeach
                </div>

                {{-- 📩 Vérification email --}}
                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="alert alert-warning mt-3 py-2 px-3 small">
                        Votre adresse email n’est pas encore vérifiée.
                        <button form="send-verification" class="btn btn-sm btn-link p-0 m-0 align-baseline">
                            <u>Cliquez ici pour renvoyer le lien de vérification</u>
                        </button>
                    </div>

                    @if (session('status') === 'verification-link-sent')
                        <div class="alert alert-success mt-2 py-2 px-3 small mb-0">
                            Un nouveau lien de vérification a été envoyé à votre adresse email.
                        </div>
                    @endif
                @endif
            </div>

            {{-- ✅ Bouton Enregistrer + Confirmation --}}
            <div class="d-flex justify-content-between align-items-center mt-4">
                <button type="submit" class="btn px-4" style="background-color: #aa9166;">
                    <i class="bi bi-check2-circle me-1"></i> Enregistrer
                </button>

                @if (session('status') === 'profile-updated')
                    <div class="alert alert-success mb-0 py-2 px-3 small fade show" role="alert">
                        ✔️ Profil mis à jour avec succès.
                    </div>
                @endif
            </div>
        </form>
    </div>
</section>
