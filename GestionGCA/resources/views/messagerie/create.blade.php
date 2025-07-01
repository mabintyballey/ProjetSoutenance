@extends('administration.base')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">

            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-header text-white rounded-top-4"
                     style="background: linear-gradient(135deg, #123b63, #0e2e4d);">
                    <h4 class="mb-0">
                        💬 Nouvelle Conversation
                    </h4>
                </div>
                <div class="card-body bg-light">
                    <form action="{{ route('messagerie.conversation.store') }}" method="POST" class="needs-validation" novalidate>
                        @csrf

                        <div class="mb-4">
                            <label for="user_id" class="form-label fw-semibold text-dark">
                                👤 Choisir un utilisateur
                            </label>
                            <select name="user_id" id="user_id"
                                    class="form-select form-select-lg rounded-pill border-2 shadow-sm"
                                    style="border-color: #CFA935;" required>
                                <option value="">-- Sélectionnez --</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->prenom }} {{ $user->nom }} ({{ ucfirst($user->role) }})
                                    </option>
                                @endforeach
                            </select>
                            <div class="invalid-feedback">
                                Veuillez choisir un utilisateur.
                            </div>
                        </div>

                        <div class="d-grid">
                            <button type="submit"
                                    class="btn btn-lg rounded-pill border-0 text-white fw-bold"
                                    style="background: linear-gradient(135deg, #CFA935, #b48a18);">
                                  Démarrer la conversation
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>

{{-- ✅ Script pour validation Bootstrap --}}
<script>
    (() => {
      'use strict'
      const forms = document.querySelectorAll('.needs-validation')
      Array.from(forms).forEach(form => {
        form.addEventListener('submit', event => {
          if (!form.checkValidity()) {
            event.preventDefault()
            event.stopPropagation()
          }
          form.classList.add('was-validated')
        }, false)
      })
    })()
</script>
@endsection
