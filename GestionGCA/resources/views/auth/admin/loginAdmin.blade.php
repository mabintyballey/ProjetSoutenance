<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administration login admin</title>

    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <link
      rel="icon"
      href="{{ asset('administration/assets/img/ubo_logo.jpg') }}"
      type="image/x-icon"
    />

    <!-- Fonts and icons -->
    <script src="{{ asset('administration/assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
      WebFont.load({
        google: { families: ["Public Sans:300,400,500,600,700"] },
        custom: {
          families: [
            "Font Awesome 5 Solid",
            "Font Awesome 5 Regular",
            "Font Awesome 5 Brands",
            "simple-line-icons",
          ],
          urls: ["{{ asset('administration/assets/css/fonts.min.css') }}"],
        },
        active: function () {
          sessionStorage.fonts = true;
        },
      });
    </script>

    <link rel="stylesheet" href="{{ asset('administration/assets/css/bootstrap.min.css') }}" />

    <style>
        body {
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    font-family: 'Public Sans', sans-serif;
    color: #343a40;
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 0;
    margin: 0;
    position: relative;
    overflow-x: hidden;
}

.wrapper {
    width: 100%;
    max-width: 1200px;
    background-color: white;
    border-radius: 16px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

section.p-5 {
    padding: 3rem !important;
}

a.btn-info {
    border-radius: 30px;
    padding: 0.5rem 1.5rem;
    font-weight: 500;
}

button.btn-primary {
    border-radius: 30px;
    font-weight: 600;
    transition: all 0.3s ease;
}

button.btn-primary:hover {
    background-color: #0056b3;
    transform: translateY(-2px);
}

img.img-fluid {
    border-radius: 8px;
}

        .divider:after,
        .divider:before {
        content: "";
        flex: 1;
        height: 1px;
        background: #eee;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <section class="p-5">
        <a href="{{ route('accueil') }}" class="btn btn-info text-white">
                <i class="icon-arrow-left-circle"></i>
                Acceuil
            </a>

            <div class="container py85 h-100">
              <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                  <img src="{{ asset('assets/img/portfolio-1.jpg') }}"
                    class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                  <form method="POST" action="{{ route('admin.login') }}">
                    @csrf

                    <!-- Email input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" id="form1Example13" class="form-control form-control-lg" />
                      <label class="form-label" for="form1Example13">Adresse email</label>
                      @error('email')
                         <span class="text-danger">Adresse email incorrect</span>
                      @enderror
                    </div>

                    <!-- Password input -->
                    <div data-mdb-input-init class="form-outline mb-4">
                      <input type="password" name="password" required autocomplete="current-password" id="form1Example23" class="form-control form-control-lg" />
                      <label class="form-label" for="form1Example23">Mot de passe</label>
                    </div>

                    <div class="d-flex justify-content-around align-items-center mb-4">
                      <!-- Checkbox -->
                      <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" value="" id="form1Example3" checked />
                        <label class="form-check-label" for="form1Example3"> Se souvenir de moi </label>
                      </div>

                      @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}">Mot de passe oublié ?</a>
                      @endif
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><i class=" icon-login"></i> Se connecter</button>
                  </form>
                </div>
              </div>
            </div>
        </section>
    </div>

    <script src="{{ asset('administration/assets/js/core/bootstrap.min.js') }}"></script>
</body>
</html>
