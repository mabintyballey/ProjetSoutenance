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
          <li class="nav-item topbar-icon dropdown hidden-caret">
            <a
              class="nav-link dropdown-toggle"
              href="#"
              id="messageDropdown"
              role="button"
              data-bs-toggle="dropdown"
              aria-haspopup="true"
              aria-expanded="false"
            >
              <i class="fa fa-envelope"></i>
            </a>

            <ul
              class="dropdown-menu messages-notif-box animated fadeIn"
              aria-labelledby="messageDropdown"
            >
              <li>
                <div
                  class="dropdown-title d-flex justify-content-between align-items-center"
                >
                  Messages
                  <a href="#" class="small">Mark all as read</a>
                </div>
              </li>
              <li>
                <div class="message-notif-scroll scrollbar-outer">
                  <div class="notif-center">
                    <a href="#">
                      <div class="notif-img">
                        <img
                          src="assets/img/jm_denis.jpg"
                          alt="Img Profile"
                        />
                      </div>
                      <div class="notif-content">
                        <span class="subject">Jimmy Denis</span>
                        <span class="block"> How are you ? </span>
                        <span class="time">5 minutes ago</span>
                      </div>
                    </a>
                  </div>
                </div>
              </li>
              <li>
                <a class="see-all" href="javascript:void(0);"
                  >Voir tous les messages<i class="fa fa-angle-right"></i>
                </a>
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
             {{ Auth::user()->name }} {{ Auth::user()->prenom }}
            </span>

        </a>

        <ul class="dropdown-menu dropdown-user animated fadeIn">
            <div class="dropdown-user-scroll scrollbar-outer">
                <li>
                    <div class="user-box">
                        <div class="avatar-lg">
                            <img
                                src="{{ asset(Auth::user()->photo ? 'uploads/photos/' . Auth::user()->photo : 'default.png') }}"
                                alt="image profile"
                                class="avatar-img rounded"
                            />
                        </div>
                        <div class="u-text">
                            <h4>{{ Auth::user()->name }}</h4>
                            <p class="text-muted">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Mon Profil</a>
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
