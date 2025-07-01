<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Inscription - Espace Client</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" href="{{ asset('assets/img/logobg.png') }}" type="image/x-icon">
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center" style="background: linear-gradient(120deg, #0f172a, #1e293b);">

  <div class="flex w-full max-w-6xl shadow-lg rounded-xl overflow-hidden bg-white border border-gray-200">

    <!-- Section gauche -->
    <div class="w-1/2 bg-[#1a252f] text-white p-10 hidden lg:flex flex-col justify-center">
      <div class="text-center">
        <img src="{{ asset('assets/img/logobg.png') }}" alt="Logo" class="mx-auto w-20 h-20 rounded-full mb-4 border border-white">
        <h2 class="text-2xl font-bold">Bienvenue au Cabinet</h2>
        <p class="text-sm mt-2 text-gray-300">Inscrivez-vous pour accéder à nos services juridiques en toute sécurité.</p>
      </div>
      <div class="mt-8 text-center text-sm text-gray-400">
        <p>Professionnalisme & Confidentialité</p>
      </div>
    </div>

    <!-- Formulaire -->
    <div class="w-full lg:w-1/2 p-8">
      <h2 class="text-2xl font-bold text-gray-800 mb-6 text-center">Créer un compte client</h2>
      <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="space-y-4">
        @csrf

        <div class="grid grid-cols-2 gap-4">
          <!-- Nom -->
          <div>
            <label class="block text-sm font-medium text-gray-700">Nom</label>
            <input name="nom" type="text" value="{{ old('nom') }}" required
              class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-blue-400" />
            @error('nom') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
          </div>

          <!-- Prénom -->
          <div>
            <label class="block text-sm font-medium text-gray-700">Prénom</label>
            <input name="prenom" type="text" value="{{ old('prenom') }}" required
              class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-blue-400" />
            @error('prenom') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
          </div>

          <!-- Email -->
          <div>
            <label class="block text-sm font-medium text-gray-700">Email</label>
            <input name="email" type="email" value="{{ old('email') }}" required
              class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-blue-400" />
            @error('email') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
          </div>

          <!-- Téléphone -->
          <div>
            <label class="block text-sm font-medium text-gray-700">Téléphone</label>
            <input name="telephone" type="text" value="{{ old('telephone') }}"
              class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-blue-400" />
            @error('telephone') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
          </div>
        </div>

        <!-- Adresse -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Adresse</label>
          <input name="adresse" type="text" value="{{ old('adresse') }}"
            class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-blue-400" />
          @error('adresse') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <div class="grid grid-cols-2 gap-4">
          <!-- Mot de passe -->
          <div>
            <label class="block text-sm font-medium text-gray-700">Mot de passe</label>
            <input name="password" type="password" required
              class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-blue-400" />
            @error('password') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
          </div>

          <!-- Confirmation -->
          <div>
            <label class="block text-sm font-medium text-gray-700">Confirmation</label>
            <input name="password_confirmation" type="password" required
              class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none focus:ring focus:ring-blue-400" />
          </div>
        </div>

        <!-- Photo -->
        <div>
          <label class="block text-sm font-medium text-gray-700">Photo de profil</label>
          <input name="photo" type="file" accept="image/*" onchange="previewImage(event)"
            class="mt-1 w-full border border-gray-300 rounded-md px-3 py-2 focus:outline-none" />
          <img id="preview" class="mt-2 w-20 h-20 rounded-full hidden object-cover shadow" />
          @error('photo') <p class="text-xs text-red-500 mt-1">{{ $message }}</p> @enderror
        </div>

        <!-- Actions -->
        <div class="flex justify-between items-center mt-4">
          <a href="{{ route('login') }}" class="text-sm text-blue-700 hover:underline">Déjà un compte ?</a>
          <button type="submit"
            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md text-sm font-medium transition duration-300">
            Créer mon compte
          </button>
        </div>
      </form>
    </div>
  </div>

  <script>
    function previewImage(event) {
      const preview = document.getElementById('preview');
      const file = event.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = e => {
          preview.src = e.target.result;
          preview.classList.remove('hidden');
        };
        reader.readAsDataURL(file);
      }
    }
  </script>
</body>
</html>
