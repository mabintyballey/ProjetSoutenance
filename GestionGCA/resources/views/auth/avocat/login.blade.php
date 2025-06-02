<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Connexion Avocat</title>

  <link rel="icon" href="{{ asset('administration/assets/img/ubo_logo.jpg') }}" type="image/x-icon" />
  <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;600&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="{{ asset('administration/assets/css/bootstrap.min.css') }}" />
  
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Public Sans', sans-serif;
      background: linear-gradient(120deg, #0f172a, #1e293b);
      color: #fff;
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-card {
      background-color: #ffffff;
      color: #0f172a;
      border-radius: 12px;
      padding: 40px;
      box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
      max-width: 500px;
      width: 100%;
    }

    .login-card h3 {
      margin-bottom: 30px;
      font-weight: 600;
      color: #1e293b;
    }

    .form-control {
      border-radius: 8px;
      height: 48px;
      border: 1px solid #cbd5e1;
    }

    .btn-primary {
      background-color: #1e40af;
      border: none;
      border-radius: 8px;
      height: 48px;
      font-weight: 600;
      transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
      background-color: #1d4ed8;
    }

    .form-check-label {
      font-size: 0.9rem;
    }

    .forgot-password {
      font-size: 0.9rem;
      color: #1e40af;
    }

    .forgot-password:hover {
      text-decoration: underline;
    }

    .logo {
      max-width: 100px;
      margin-bottom: 20px;
    }

    .btn-back {
      position: absolute;
      top: 30px;
      left: 30px;
      background: none;
      border: none;
      color: white;
      font-weight: 500;
      font-size: 1rem;
    }
  </style>
</head>
<body>

  <a href="{{ route('accueil') }}" class="btn-back">
    ← Retour à l'accueil
  </a>

  <div class="login-card">
    <div class="text-center">
      <img src="{{ asset('administration/assets/img/ubo_logo.jpg') }}" class="logo" alt="Logo cabinet" />
      <h3>Connexion Avocat</h3>
    </div>

    <form method="POST" action="{{ route('avocat.login') }}">
      @csrf

      <div class="mb-3">
        <label for="email" class="form-label">Adresse Email</label>
        <input type="email" name="email" id="email" value="{{ old('email') }}" class="form-control" required autofocus />
        @error('email')
          <span class="text-danger">Adresse email incorrect</span>
        @enderror
      </div>

      <div class="mb-3">
        <label for="password" class="form-label">Mot de passe</label>
        <input type="password" name="password" id="password" class="form-control" required />
      </div>

      <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="form-check">
          <input class="form-check-input" type="checkbox" name="remember" id="remember" />
          <label class="form-check-label" for="remember">Se souvenir de moi</label>
        </div>

        @if (Route::has('password.request'))
          <a href="{{ route('password.request') }}" class="forgot-password">Mot de passe oublié ?</a>
        @endif
      </div>

      <button type="submit" class="btn btn-primary w-100">Se connecter</button>
    </form>
  </div>

  <script src="{{ asset('administration/assets/js/core/bootstrap.min.js') }}"></script>
</body>
</html>
