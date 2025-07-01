<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Juge Cabinet D'avocat</title>
    <meta
      content="width=device-width, initial-scale=1.0, shrink-to-fit=no"
      name="viewport"
    />
    <!-- CSS -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />

<!-- JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css"> 
    <link
      rel="icon"
      href="{{ asset('assets/img/logo_cabinet.png') }}"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

   <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- À ajouter dans <head> -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

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

    <!-- CSS Files -->
    <link rel="stylesheet" href="{{ asset('administration/assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('administration/assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('administration/assets/css/kaiadmin.min.css') }}" />

    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link rel="stylesheet" href="{{ asset('administration/assets/css/demo.css') }}" />
    <style>
/* Cache la sidebar sur mobile par défaut */
.sidebar-responsive {
    transition: transform 0.3s ease;
}
@media (max-width: 991.98px) {
    .sidebar-responsive {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        width: 250px;
        transform: translateX(-100%);
        z-index: 1040;
    }
    .sidebar-responsive.show {
        transform: translateX(0);
    }
}
.card {
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
    .btn-gradient {
        background: linear-gradient(135deg, #134074, #13315c);
        color: #fff;
        border: none;
    }
    .btn-gradient:hover {
        background: linear-gradient(135deg,rgb(140, 120, 8),rgb(140, 120, 8));
        color: #000;
    }
    .bg-gradient {
        background: linear-gradient(135deg, #134074, #13315c);
    }
    /* Conteneur épuré avec ombre douce et coins arrondis */
    .form-container {
        max-width: 600px;
        margin: 3rem auto;
        padding: 2.5rem 3rem;
        background: #ffffff;
        border-radius: 16px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.08);
        font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
        transition: box-shadow 0.3s ease;
    }
    .form-container:hover {
        box-shadow: 0 15px 40px rgba(0,0,0,0.12);
    }
    /* Titre clair, épais, et espacé */
    .form-container h4 {
        color: #1e2a47; /* Bleu nuit profond */
        font-weight: 700;
        margin-bottom: 1.8rem;
        text-align: center;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }
    /* Labels modernisés */
    .form-label {
        font-weight: 600;
        color: #2e3a59;
        font-size: 1rem;
        margin-bottom: 0.4rem;
        display: block;
    }
    /* Champs avec bordure subtile et ombre au focus */
    .form-control {
        border-radius: 12px;
        border: 1.8px solid #cbd5e0;
        padding: 0.75rem 1.25rem;
        font-size: 1rem;
        color: #394867;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        box-shadow: none;
    }
    .form-control:focus {
        border-color: #0077b6; /* Bleu vif */
        box-shadow: 0 0 10px rgba(0, 119, 182, 0.4);
        outline: none;
    }
    /* Placeholder plus clair et italique */
    .form-control::placeholder {
        color: #a0aec0;
        font-style: italic;
    }
    /* Texte d'aide discrètement stylé */
    .form-text {
        font-size: 0.85rem;
        color: #6b7280;
        margin-top: 0.3rem;
        font-style: italic;
    }
    /* Bouton grand, arrondi, avec dégradé bleu/doré */
    .btn-submit {
        display: block;
        width: 100%;
        padding: 0.85rem 0;
        background: linear-gradient(90deg, #0077b6 0%, #f5c518 100%);
        color: #1e1e1e;
        font-weight: 700;
        font-size: 1.15rem;
        border: none;
        border-radius: 14px;
        cursor: pointer;
        box-shadow: 0 6px 15px rgba(245, 197, 24, 0.5);
        transition: background 0.3s ease, box-shadow 0.3s ease;
        letter-spacing: 0.04em;
    }
    .btn-submit:hover,
    .btn-submit:focus {
        background: linear-gradient(90deg, #005f87 0%, #d4ac0d 100%);
        box-shadow: 0 8px 20px rgba(212, 172, 13, 0.7);
        color: #111;
        outline: none;
    }
    /* Espacement vertical entre champs */
    .form-label + .form-control,
    .form-control + .form-label,
    .form-control + .form-text {
        margin-top: 1.2rem;
    }
    /* Pour le champ multiple fichiers : curseur pointer */
    input[type="file"] {
        cursor: pointer;
    }
    /* Tes couleurs principales */
    :root {
        --gold: #B8860B; /* Doré chic */
        --blue-dark: #00274D; /* Bleu ombre élégant */
    }

    .btn-gold {
        background-color: var(--gold);
        color: #fff;
    }

    .btn-gold:hover {
        background-color: #A0770A;
    }

    .border-left-gold {
        border-left: 5px solid var(--gold);
    }

    .bg-blue-dark {
        background-color: var(--blue-dark);
    }

    .text-blue-dark {
        color: var(--blue-dark);
    }

    .rounded-circle-initial {
        width: 50px; 
        height: 50px; 
        font-weight: bold; 
        background-color: var(--blue-dark); 
        color: #fff;
    }
     :root {
    --color-primary: #1e3a8a;   /* Bleu foncé corporate */
    --color-accent: #aa9166;    /* Doré élégant */
  }
  .text-primary { color: var(--color-primary) !important; }
  .bg-primary { background-color: var(--color-primary) !important; }
  .border-primary { border-color: var(--color-primary) !important; }
  .btn-primary { background-color: var(--color-primary) !important; border-color: var(--color-primary) !important; }
</style>
  </head>
