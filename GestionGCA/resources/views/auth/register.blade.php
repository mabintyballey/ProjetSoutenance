<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" /> 
  <title>Inscription - Espace Administration</title>
  <link rel="icon" href="{{ asset('administration/assets/img/ubo_logo.jpg') }}" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
    } 
    
  </style>
</head>
<body class="flex items-center justify-center min-h-screen">
    <!-- Lien vers l'accueil -->
    <a href="{{ route('accueil') }}" class="btn-back">
    ← Retour à l'accueil
  </a>
  <div class="flex flex-col lg:flex-row w-full max-w-5xl bg-white rounded-2xl shadow-lg overflow-hidden border border-gray-200">

    <!-- Image + Logo -->
    <div class="hidden lg:flex lg:flex-col lg:w-1/2 bg-[#f4f6f8] justify-center items-center p-8">
      <img src="{{ asset('assets/img/connexionClient.png') }}" alt="Illustration" class="w-full max-h-[300px] object-contain rounded-xl shadow-md">
      <div class="mt-6 text-center">
        <img src="{{ asset('administration/assets/img/ubo_logo.jpg') }}" alt="Logo Cabinet" class="h-16 mx-auto mb-2 rounded-full border border-gray-300">
        <p class="text-gray-700 font-semibold text-lg">CABINET JURIDIQUE</p>
        <p class="text-sm text-gray-500">Professionnalisme & Confidentialité</p>
      </div>
    </div>

    <!-- Formulaire -->
    <div class="w-full lg:w-1/2 px-6 py-8 overflow-auto max-h-[90vh]">
    
      <h2 class="text-2xl font-semibold text-gray-800 text-center mb-6">Créer un compte administrateur</h2>

      <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <!-- Nom -->
        <div>
          <label for="name" class="block text-sm font-medium text-gray-700">Nom complet</label>
          <input id="name" name="name" type="text" value="{{ old('name') }}" required autofocus
            class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none shadow-sm" />
          @error('name')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700">Adresse email</label>
          <input id="email" name="email" type="email" value="{{ old('email') }}" required
            class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none shadow-sm" />
          @error('email')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Mot de passe -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700">Mot de passe</label>
          <input id="password" name="password" type="password" required
            class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none shadow-sm" />
          @error('password')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Confirmation -->
        <div>
          <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirmation du mot de passe</label>
          <input id="password_confirmation" name="password_confirmation" type="password" required
            class="mt-2 w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring focus:ring-blue-500 focus:outline-none shadow-sm" />
          @error('password_confirmation')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Actions -->
        <div class="flex flex-col sm:flex-row justify-between items-center pt-4 gap-4">
          <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">Vous avez déjà un compte ?</a>
          <button type="submit"
            class="bg-blue-700 hover:bg-blue-800 text-white font-medium px-6 py-3 rounded-lg shadow-md transition duration-300">Créer un compte</button>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
