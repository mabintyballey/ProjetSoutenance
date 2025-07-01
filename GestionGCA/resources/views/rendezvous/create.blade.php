@extends('administration.base')

@section('content')
<div class="container py-5">
    <div class="card shadow-lg border-0 rounded-4" style="border-left: 5px solid gold;">
        <div class="card-body">
            <h4 class="fw-bold text-primary mb-4">📅 Programmer un Rendez-vous</h4>

            <form action="{{ route('rendezvous.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label fw-semibold">Sélectionner le dossier concerné</label>
                    <select name="dossier_id" class="form-select rounded-pill" required>
                        <option value="">-- Choisir --</option>
                        @foreach ($clients as $client)
                            @foreach ($client->dossiers as $dossier)
                                <option value="{{ $dossier->id }}">
                                    Dossier #{{ $dossier->id }} - 
                                    {{ $client->user->prenom }} {{ $client->user->nom }}
                                </option>
                            @endforeach
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Date & Heure</label>
                    <input type="datetime-local" name="date_heure" class="form-control rounded-pill" required>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Lieu</label>
                    <input type="text" name="lieu" class="form-control rounded-pill">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-semibold">Motif</label>
                    <textarea name="motif" class="form-control rounded-4" rows="3"></textarea>
                </div>

                <button type="submit" class="btn text-white rounded-pill"
                    style="background: linear-gradient(135deg, gold, #0d6efd); box-shadow: 0 4px 10px rgba(0,0,0,0.15);">
                    Confirmer le rendez-vous
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
