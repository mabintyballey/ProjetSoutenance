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
      href="{{ asset('assets/img/ubo_logo.jpg') }}"
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
                  <img src="{{ asset('administration/assets/img/developper.jpg') }}"
                    class="img-fluid" alt="Phone image">
                </div>
                <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
                  <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- First_name and Last_name input -->
                    <div class="form-outline mb-4">
                        <input type="text" id="form1ExampleName" class="form-control form-control-lg" />
                        <label class="form-label" for="form1ExampleName">Prénom et Nom</label>
                    </div>

                    <!-- Gender input -->
                    <div class="form-outline mb-4">
                        <select class="form-select" name="gender" id="formGender">
                            <option value="masculin">Masculin</option>
                            <option value="feminin">Féminin</option>
                        </select>

                        <label class="form-label" for="formGender">Genre</label>
                    </div>

                    <!-- Email input -->
                    <div class="form-outline mb-4">
                      <input type="email" name="email" value="{{ old('email') }}" required autocomplete="email" id="form1Example13" class="form-control form-control-lg" />
                      <label class="form-label" for="form1Example13">Adresse email</label>

                      @error('email')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <!-- Password input -->
                    <div class="form-outline mb-4">
                      <input type="password" name="password" required id="form1Example23" class="form-control form-control-lg" />
                      <label class="form-label" for="form1Example23">Mot de passe</label>

                      @error('password')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <!-- Confirm Password input -->
                    <div class="form-outline mb-4">
                        <input type="password" name="password_confirmation" required id="form1ExamplePassword" class="form-control form-control-lg" />
                        <label class="form-label" for="form1ExamplePassword">Confirmer votre mot de passe</label>

                        @error('password_confirmation')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <!-- Submit button -->
                    <button type="submit" class="btn btn-primary btn-lg btn-block">
                        <i class="icon-user-follow"></i> Créer un compte
                    </button>
                  </form>

                  <div class="divider d-flex align-items-center my-4">
                    <p class="text-center fw-bold mx-3 mb-0 text-muted">OU</p>
                  </div>

                  <a href="{{ route('login') }}" class="btn btn-primary btn-lg mx-auto" style="background-color: #3b5998; width: 100%">
                    <i class="icon-login"></i> Se connecter
                  </a>
                </div>
              </div>
            </div>
        </section>
    </div>

    <script src="{{ asset('administration/assets/js/core/bootstrap.min.js') }}"></script>
</body>
</html>
