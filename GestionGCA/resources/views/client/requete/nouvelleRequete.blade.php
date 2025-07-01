@extends('administration.base')

@section('content')

<div class="form-container shadow-sm">
    <h4>📄 Soumettre une requête juridique</h4>
    <form action="{{ route('client.requetes.storeNouvelleRequete') }}" method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        <label for="type_aide" class="form-label">
            Type d’aide juridique <span class="text-danger">*</span>
        </label>
        <select name="type_aide" id="type_aide" class="form-control" required>
            <option value="" disabled selected>-- Sélectionnez un domaine --</option>
            @foreach($domaines as $domaine)
                <option value="{{ $domaine->id }}">{{ ucfirst($domaine->nom) }}</option>
            @endforeach
        </select>

        <label for="probleme" class="form-label mt-4">
            Expliquez votre problème <span class="text-danger">*</span>
        </label>
        <textarea name="probleme" id="probleme" rows="5" class="form-control" placeholder="Décrivez les faits de manière claire..." required></textarea>

        <label for="info_adverse" class="form-label mt-4">
            Informations sur la partie adverse <span class="text-danger">*</span>
        </label>
        <textarea name="info_adverse" id="info_adverse" rows="4" class="form-control" placeholder="Nom, lien avec vous, situation actuelle..." required></textarea>

        <label for="documents" class="form-label mt-4">
            Joindre des documents justificatifs <span class="text-danger">*</span>
        </label>
        <input type="file" name="documents[]" id="documents" class="form-control" accept=".pdf,.doc,.docx,.jpg,.jpeg,.png" multiple required>
        <small class="form-text">Formats acceptés : PDF, Word, images. Vous pouvez en ajouter plusieurs.</small>

        <button type="submit" class="btn-submit mt-4">📤 Soumettre ma requête</button>
    </form>
</div>

@endsection
