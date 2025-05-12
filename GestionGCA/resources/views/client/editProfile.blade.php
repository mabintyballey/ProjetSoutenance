<form method="POST" action="{{ route('client.updateProfile') }}">
    @csrf
    <!-- Champs pour prénom, téléphone, adresse, etc. -->
    <button type="submit">Soumettre</button>
</form>
