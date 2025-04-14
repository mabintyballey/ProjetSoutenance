<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Administration login</title>

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
            <a href="{{ route('acceuil') }}" class="btn btn-info text-white">
                <i class="icon-arrow-left-circle"></i>
                Acceuil
            </a>

            <div class="container py85 h-100">
              <div class="row d-flex align-items-center justify-content-center h-100">
                <div class="col-md-8 col-lg-7 col-xl-6">
                  <img src="{{ asset('assets/img/hero-img.png') }}"
                    class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                  <form method="POST" action="{{ route('login') }}">
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

                  <div class="divider d-flex align-items-center my-4">
                    <p class="text-center fw-bold mx-3 mb-0 text-muted">OU</p>
                  </div>

                  <a href="{{ route('admin.register') }}" class="btn btn-primary btn-lg mx-auto" style="background-color: #3b5998; width: 100%">
                    <i class="icon-user-follow"></i> Créer un compte
                  </a>
                </div>
              </div>
            </div>
        </section>
    </div>

    <script src="{{ asset('administration/assets/js/core/bootstrap.min.js') }}"></script>
</body>
</html>
