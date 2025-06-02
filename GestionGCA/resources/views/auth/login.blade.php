<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Connexion | Espace Client</title>
  <link rel="icon" href="{{ asset('administration/assets/img/ubo_logo.jpg') }}" type="image/x-icon">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        fontFamily: {
          sans: ['Inter', 'sans-serif'],
        },
        extend: {
          colors: {
            primary: '#1e3a8a',
            light: '#f9fafb',
            grayText: '#6b7280'
          }
        }
      }
    };
  </script>
 
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&display=swap" rel="stylesheet">
</head>

<body class="bg-light min-h-screen flex items-center justify-center px-4" style="background: linear-gradient(120deg, #0f172a, #1e293b);">

  <div class="w-full max-w-5xl bg-white rounded-3xl shadow-2xl overflow-hidden grid grid-cols-1 md:grid-cols-2">
    
    <!-- Illustration -->
    <div class="hidden md:flex bg-primary items-center justify-center p-8">
      <img src="{{ asset('assets/img/connexionClient.png') }}" alt="Illustration" class="w-full h-auto object-contain">
    </div>

    <!-- Formulaire -->
    <div class="p-10 space-y-6">
      <h2 class="text-3xl font-semibold text-gray-800">Connexion Espace Client</h2>
      <p class="text-grayText">Bienvenue ! Veuillez vous connecter pour accéder à votre espace personnel.</p>

      <form method="POST" action="{{ route('login') }}" class="space-y-5">
        @csrf

        <!-- Email -->
        <div>
          <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Adresse email</label>
          <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
            class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-primary" />
          @error('email')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Mot de passe -->
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
          <input type="password" name="password" id="password" required
            class="w-full border border-gray-300 rounded-md p-3 focus:outline-none focus:ring-2 focus:ring-primary" />
          @error('password')
            <p class="text-sm text-red-500 mt-1">{{ $message }}</p>
          @enderror
        </div>

        <!-- Options -->
        <div class="flex items-center justify-between">
          <label class="flex items-center text-sm text-gray-600">
            <input type="checkbox" name="remember" class="form-checkbox text-primary mr-2">
            Se souvenir de moi
          </label>
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-sm text-primary hover:underline">Mot de passe oublié ?</a>
          @endif
        </div>

        <!-- Bouton de connexion -->
        <button type="submit"
          class="w-full bg-primary text-white py-3 rounded-md hover:bg-blue-900 transition text-sm font-semibold">
          Se connecter
        </button>
      </form>

      <!-- Lien vers inscription -->
      <div class="text-center text-sm text-grayText mt-4">
        Vous n’avez pas de compte ?
        <a href="{{ route('register') }}" class="text-primary font-medium hover:underline">Créer un compte</a>
      </div>
    </div>
  </div>

</body>
</html>
