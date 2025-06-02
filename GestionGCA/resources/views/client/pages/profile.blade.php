<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Compléter le profil</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    function afficherChampsSpecifiques() {
      const choix = document.getElementById('besoin').value;
      document.getElementById('section-details').classList.remove('hidden');
    }
  </script>
</head>
<body class="bg-gray-100 p-6">
  <div class="max-w-3xl mx-auto bg-white shadow-md rounded p-6">
    <h2 class="text-2xl font-bold mb-4">Complétez votre profil et soumettez votre demande</h2>
    
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
      @csrf

      <!-- Informations personnelles -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div>
          <label>Prénom</label>
          <input type="text" name="prenom" value="{{ old('prenom', Auth::user()->prenom) }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div>
          <label>Téléphone</label>
          <input type="text" name="telephone" value="{{ old('telephone', Auth::user()->telephone) }}" class="w-full border px-3 py-2 rounded" required>
        </div>
        <div class="md:col-span-2">
          <label>Adresse</label>
          <input type="text" name="adresse" value="{{ old('adresse', Auth::user()->adresse) }}" class="w-full border px-3 py-2 rounded" required>
        </div>
      </div>

      <!-- Choix du service juridique -->
      <div class="mt-6">
        <label for="besoin">Quel est votre besoin juridique ?</label>
        <select id="besoin" name="besoin" class="w-full border px-3 py-2 rounded" required onchange="afficherChampsSpecifiques()">
          <option value="">-- Choisissez une option --</option>
          <option value="conseiller">Conseiller juridique</option>
          <option value="avocat">Fournir des Avocats</option>
          <option value="juriste">Fournir des jeunes juristes</option>
          <option value="collaborateur">Fournir un collaborateur</option>
        </select>
      </div>

      <!-- Champs spécifiques -->
      <div id="section-details" class="mt-6 hidden">
        <div class="mb-4">
          <label>Description de votre problème <span class="text-red-600">*</span></label>
          <textarea name="probleme" class="w-full border px-3 py-2 rounded" rows="4" required></textarea>
        </div>

        <div class="mb-4">
          <label>Pièces jointes (PDF ou image)</label>
          <input type="file" name="documents[]" accept=".pdf,.png,.jpg" class="w-full border px-3 py-2 rounded" multiple required>
        </div>

        <div class="mb-4">
          <label>Informations sur la personne / entité adverse <span class="text-red-600">*</span></label>
          <input type="text" name="adverse" class="w-full border px-3 py-2 rounded" required>
        </div>
      </div>

      <!-- Soumission -->
      <div class="mt-6">
        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded shadow">
          Soumettre la demande
        </button>
      </div>
    </form>
  </div>
</body>
</html>
