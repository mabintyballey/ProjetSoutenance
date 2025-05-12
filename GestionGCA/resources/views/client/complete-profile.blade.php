<x-app-layout>
    <div class="max-w-xl mx-auto mt-10 p-6 bg-white rounded shadow">
        <h2 class="text-xl font-bold mb-4">Compléter votre profil</h2>
        <form method="POST" action="{{ route('client.update-profile') }}">
            @csrf
            <!-- Champs spécifiques à compléter -->
            <div class="mb-4">
                <label class="block">Téléphone</label>
                <input type="text" name="telephone" class="w-full p-2 border rounded" required>
            </div>

            <div class="mb-4">
                <label class="block">Adresse</label>
                <input type="text" name="adresse" class="w-full p-2 border rounded" required>
            </div>
            <div class="mt-4">
    <label for="domaine_juridique" class="block text-sm font-medium">Choisissez un domaine juridique</label>
    <select name="domaine_juridique" required class="mt-1 block w-full border border-gray-300 rounded p-2">
        <option value="">-- Sélectionner --</option>
        <option value="conseiller_juridique">Conseiller juridique</option>
        <option value="avocat">Avocat (défense, assigné...)</option>
        <option value="juriste_entreprise">Jeune juriste pour entreprise</option>
        <option value="collaborateur">Collaborateur</option>
    </select>
</div>
<div class="mt-4">
    <label for="probleme" class="block text-sm font-medium">Décrivez votre problème</label>
    <textarea name="probleme" required class="w-full border border-gray-300 rounded p-2"></textarea>
</div>

<div class="mt-4">
    <label for="fichier" class="block text-sm font-medium">Dossier (PDF, PNG)</label>
    <input type="file" name="fichier" accept=".pdf,.png" required class="w-full border rounded p-2">
</div>

<div class="mt-4">
    <label for="information_adverse" class="block text-sm font-medium">Information sur la personne ou entité adverse</label>
    <textarea name="information_adverse" required class="w-full border border-gray-300 rounded p-2"></textarea>
</div>

            <button class="bg-blue-600 text-white py-2 px-4 rounded">Soumettre</button>
        </form>
    </div>
</x-app-layout>
