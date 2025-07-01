<div class="main-header" style="background-color: #2c3e50;">
    <div class="main-header-logo">
      <!-- Logo Header -->
      <div class="logo-header" data-background-color="dark">
        <a href="index.html" class="logo">
          <img
            src="{{ asset('administration/assets/img/logo_cabinet.jpg') }}"
            alt="navbar brand"
            class="navbar-brand"
            height="50"
          />
        </a>
        <div class="nav-toggle">
          <button class="btn btn-toggle toggle-sidebar">
            <i class="gg-menu-right"></i>
          </button>
          <button class="btn btn-toggle sidenav-toggler">
            <i class="gg-menu-left"></i>
          </button>
        </div>
        <button class="topbar-toggler more">
          <i class="gg-more-vertical-alt"></i>
        </button>
      </div>
      <!-- End Logo Header -->
    </div>

    <!-- Navbar Header -->
    <nav
      class="navbar navbar-header navbar-header-transparent navbar-expand-lg border-bottom"
    >
      <div class="container-fluid">

        <ul class="navbar-nav topbar-nav ms-md-auto align-items-center">
               
            <!-- Messages -->
          @php
    $user = Auth::user();
    $messagesNonLus = \App\Models\Message::where('destinataire_id', $user->id)->where('lu', false)->latest()->take(5)->get();
    $nbNonLus = $messagesNonLus->count();
@endphp

<li class="nav-item dropdown">
    <a class="nav-link dropdown-toggle position-relative" href="#" id="messageDropdown" role="button"
        data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
        <i class="fa fa-envelope"></i>
        @if ($nbNonLus > 0)
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                {{ $nbNonLus }}
            </span>
        @endif
    </a>

    <ul class="dropdown-menu dropdown-menu-end shadow animated fadeIn" aria-labelledby="messageDropdown" style="width: 300px;">
        <li class="px-3 py-2 d-flex justify-content-between align-items-center">
            <span class="fw-bold">📩 Messages</span>
            <form action="{{ route('messagerie.lus') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-link btn-sm text-decoration-none">Tout marquer lu</button>
            </form>
        </li>

        <li>
            <div class="overflow-auto" style="max-height: 300px;">
                @forelse ($messagesNonLus as $msg)
                    <a href="{{ route('messagerie.show', $msg->id) }}" class="dropdown-item d-flex align-items-start">
                        <img src="{{ $msg->expediteur->profile_photo_url ?? asset('default-avatar.png') }}"
                             alt="avatar" class="rounded-circle me-2" width="40" height="40">
                        <div class="w-100">
                            <div class="fw-semibold">{{ $msg->expediteur->prenom }} {{ $msg->expediteur->nom }}</div>
                            <div class="text-muted small text-truncate">{{ $msg->contenu }}</div>
                            <div class="text-end text-muted small">{{ $msg->created_at->diffForHumans() }}</div>
                        </div>
                    </a>
                @empty
                    <div class="dropdown-item text-muted small fst-italic">Aucun message non lu</div>
                @endforelse
            </div>
        </li>

        <li>
            <a class="dropdown-item text-center text-primary fw-bold" href="{{ route('messagerie.index') }}">
                Voir tous les messages <i class="fa fa-angle-right ms-1"></i>
            </a>
        </li>
    </ul>
</li>

             @php
                $notifications = auth()->user()->unreadNotifications;
            @endphp
            
            <li class="nav-item topbar-icon dropdown hidden-caret">
                <a class="nav-link dropdown-toggle" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fa fa-bell"></i>
                    @if($notifications->count() > 0)
                        <span class="notification">{{ $notifications->count() }}</span>
                    @endif
                </a>
            
                <ul class="dropdown-menu notif-box animated fadeIn" aria-labelledby="notifDropdown">
                    <li>
                        <div class="dropdown-title">
                            Vous avez {{ $notifications->count() }} nouvelle(s) notification(s)
                        </div>
                    </li>
            
                    <li>
                        <div class="notif-scroll scrollbar-outer">
                            <div class="notif-center">
                                @forelse($notifications as $notif)
                                    <a href="{{ route('notifications.read', $notif->id) }}">
                                        <div class="notif-icon notif-primary">
                                            <i class="fa fa-folder-open"></i>
                                        </div>
                                        <div class="notif-content">
                                            <span class="block">{{ $notif->data['message'] }}</span>
                                            <span class="time">{{ $notif->created_at->diffForHumans() }}</span>
                                        </div>
                                    </a>
                                @empty
                                    <div class="text-center text-muted p-3">Aucune notification</div>
                                @endforelse
                            </div>
                        </div>
                    </li>
            
                    <li>
                        <form action="{{ route('notifications.markAllRead') }}" method="POST" class="text-center my-2">
                            @csrf
                            <button class="see-all text-primary border-0 bg-transparent" type="submit">
                                Marquer tout comme lu <i class="fa fa-check-circle"></i>
                            </button>
                        </form>
                    </li>
                </ul>
            </li>

          <!-- Profile -->
          <li class="nav-item topbar-user dropdown hidden-caret">
        <a class="dropdown-toggle profile-pic" data-bs-toggle="dropdown" href="#" aria-expanded="false">
            <div class="avatar-sm">
              @php
                  $photoPath = null;
              
                  if (Auth::user()->photo) {
                      // Si le fichier existe dans storage/public/photos
                      if (\Illuminate\Support\Facades\Storage::disk('public')->exists(Auth::user()->photo)) {
                          $photoPath = asset('storage/' . Auth::user()->photo);
                      }
                      // Sinon on suppose que c’est dans uploads/photos (public/uploads/photos)
                      elseif (file_exists(public_path('uploads/photos/' . Auth::user()->photo))) {
                          $photoPath = asset('uploads/photos/' . Auth::user()->photo);
                      }
                  }
              @endphp

           <img src="{{ $photoPath ?? asset('uploads/photos/default.png') }}" alt="Profil" class="avatar-img rounded-circle" />

            </div>
            <span class="profile-username d-block text-center" style="color: #aa9166; font-size: 1.25rem; font-weight: 600; letter-spacing: 0.5px;">
             {{ Auth::user()->nom }} {{ Auth::user()->prenom }}
            </span>
        </a>

        <ul class="dropdown-menu dropdown-user animated fadeIn">
            <div class="dropdown-user-scroll scrollbar-outer">
                <li>
                    <div class="user-box">
                        <div class="avatar-lg">
                            <img
                                src="{{ asset(Auth::user()->photo ? 'storage/photos/' . Auth::user()->photo : 'uploads/photos/default.png') }}"
                                alt="image profile"
                                class="avatar-img rounded"
                            />
                        </div>
                        <div class="u-text">
                            <h4>{{ Auth::user()->nom }}</h4>
                            <p class="text-muted">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="{{route('profile.edit')}}">Mon Profil</a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="dropdown-item btn btn-danger p-2 rounded" type="submit">Se déconnecter</button>
                    </form>
                </li>
            </div>
        </ul>
    </li>
        </ul>
      </div>
    </nav>
    <!-- End Navbar -->
  </div>
@section('script')
<audio id="notifSound" src="{{ asset('sounds/notification.mp3') }}" preload="auto"></audio>

<script>
  document.addEventListener('DOMContentLoaded', () => {
        let lastCount = {{auth()->user()->unreadNotifications->count()}};
        const notifDropdown = document.getElementById("notifDropdown");
        const notifMenu = document.querySelector('#notifDropdown + .dropdown-menu .notif-center');
        const notifBadge = notifDropdown.querySelector('.notification');
        const notifSound = document.getElementById('notifSound');

        // Fonction pour mettre à jour l'affichage des notifications
        function updateNotifications(data) {
            if (!notifBadge || !notifMenu) return;

            // Mise à jour du badge
            if (data.count > 0) {
                notifBadge.innerText = data.count;
                notifBadge.style.display = 'inline-block';
            } else {
                notifBadge.style.display = 'none';
            }

            // Injection des notifications dans le menu
            if (data.list.length === 0) {
                notifMenu.innerHTML = '<div class="text-center text-muted p-3">Aucune notification</div>';
            } else {
                let html = '';
                data.list.forEach(notif => {
                    html += `
                        <a href="/client/requete/${notif.requete_id}" class="d-flex align-items-center p-2 border-bottom text-decoration-none text-dark">
                            <div class="notif-icon notif-primary me-3">
                                <i class="fa fa-folder-open fa-lg"></i>
                            </div>
                            <div class="notif-content flex-grow-1">
                                <span class="block fw-semibold">${notif.message}</span>
                                <small class="text-muted">${notif.time}</small>
                            </div>
                        </a>
                    `;
                });
                notifMenu.innerHTML = html;
            }
        }

        // Fonction pour récupérer les notifications du serveur
        function fetchNotifications() {
            fetch('{{ route("notifications.json") }}', {cache: "no-store"})
                .then(response => {
                    if (!response.ok) throw new Error("Erreur HTTP " + response.status);
                    return response.json();
                })
                .then(data => {
                    if (data.count > lastCount) {
                        // Jouer le son de notification
                        notifSound.play().catch(() => {/* Ignorer si pas possible */});

                        // Ajouter animation
                        notifDropdown.classList.add("animate__animated", "animate__tada");
                        setTimeout(() => {
                            notifDropdown.classList.remove("animate__animated", "animate__tada");
                        }, 1500);
                    }

                    updateNotifications(data);
                    lastCount = data.count;
                })
                .catch(err => {
                    console.error("Erreur lors du chargement des notifications:", err);
                });
        }

        // Charger initialement les notifications
        fetchNotifications();

        // Rafraîchir toutes les 10 secondes
        setInterval(fetchNotifications, 10000);
  });
</script>
@endsection
