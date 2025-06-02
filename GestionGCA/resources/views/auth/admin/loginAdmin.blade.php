<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Connexion - Cabinet Juridique</title>

    <link rel="stylesheet" href="{{ asset('administration/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('administration/assets/css/fonts.min.css') }}">
    <link rel="icon" href="{{ asset('administration/assets/img/ubo_logo.jpg') }}" type="image/x-icon" />
    
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

        .login-wrapper {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            overflow: hidden;
            display: flex;
            max-width: 1000px;
            width: 100%;
        }

        .login-image {
            flex: 1;
            background: url('{{ asset('assets/img/portfolio-1.jpg') }}') no-repeat center center;
            background-size: cover;
        }

        .login-form {
            flex: 1;
            padding: 3rem;
        }

        .login-form h2 {
            color: #001F3D;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .form-control {
            border-radius: 0.5rem;
        }

        .btn-primary {
            background-color: #001F3D;
            border: none;
            padding: 0.75rem 2rem;
            font-weight: 600;
            border-radius: 30px;
        }

        .btn-primary:hover {
            background-color: #003366;
        }

        .form-check-label {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .small-link {
            font-size: 0.9rem;
        }

        .text-danger {
            font-size: 0.85rem;
        }
    </style>
</head>
<body>

<div class="login-wrapper">
    <div class="login-image d-none d-md-block"></div>
    <div class="login-form">
        <a href="{{ route('accueil') }}" class="btn btn-sm btn-outline-secondary mb-4">
            <i class="icon-arrow-left-circle"></i> Retour à l'accueil
        </a>

        <h2><i class="fas fa-user-shield me-2 text-primary"></i> Connexion Admin</h2>

        <form method="POST" action="{{ route('admin.login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Adresse email</label>
                <input type="email" class="form-control" id="email" name="email" required autofocus value="{{ old('email') }}" />
                @error('email')
                    <span class="text-danger">Adresse email incorrecte</span>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" id="password" name="password" required />
            </div>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember" name="remember" checked />
                    <label class="form-check-label" for="remember"> Se souvenir de moi </label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="small-link">Mot de passe oublié ?</a>
                @endif
            </div>

            <button type="submit" class="btn btn-primary w-100">
                <i class="icon-login me-1"></i> Se connecter
            </button>
        </form>
    </div>
</div>

<script src="{{ asset('administration/assets/js/core/bootstrap.min.js') }}"></script>
</body>
</html>
