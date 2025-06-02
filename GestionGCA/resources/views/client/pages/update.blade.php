<form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT') <!-- C'est ça qui simule un formulaire de type PUT -->

    <!-- Champ prénom -->
    <div>
        <label for="prenom">Prénom</label>
        <input type="text" name="prenom" id="prenom" value="{{ old('prenom', auth()->user()->prenom) }}">
    </div>

    <!-- Champ téléphone -->
    <div>
        <label for="telephone">Téléphone</label>
        <input type="text" name="telephone" id="telephone" value="{{ old('telephone', auth()->user()->telephone) }}">
    </div>

    <!-- Bouton -->
    <button type="submit">Mettre à jour</button>
</form>
