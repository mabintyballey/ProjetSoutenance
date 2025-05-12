<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Connexion AdministrationClient</title>
  <link rel="icon" href="{{ asset('administration/assets/img/ubo_logo.jpg') }}" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-200 min-h-screen flex items-center justify-center">

  <div class="flex flex-col lg:flex-row w-full max-w-6xl bg-white rounded-2xl shadow-xl overflow-hidden">
    
    <!-- Image -->
    <div class="hidden lg:block lg:w-1/2 bg-gray-100">
      <img src="{{ asset('assets/img/connexionClient.png') }}" alt="Illustration" class="h-full w-full object-cover">
    </div>

    <!-- Formulaire -->
    <div class="w-full lg:w-1/2 p-8 sm:p-10">
      <h2 class="text-2xl font-bold text-center text-gray-700 mb-6">Connexion à l'administration</h2>

      <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Nom -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
          <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
            class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
          @error('name')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
          <input id="email" name="email" type="email" value="{{ old('email') }}" required
            class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
          @error('email')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Mot de passe -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
          <input id="password" name="password" type="password" required
            class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
          @error('password')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Confirmation -->
        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
          <input id="password_confirmation" name="password_confirmation" type="password" required
            class="w-full mt-1 p-3 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" />
          @error('password_confirmation')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Bouton & lien -->
        <div class="flex justify-between items-center">
          <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">Déjà inscrit ?</a>
          <button type="submit"
            class="bg-blue-600 text-white px-6 py-2 rounded-md hover:bg-blue-700 transition">S'inscrire</button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
