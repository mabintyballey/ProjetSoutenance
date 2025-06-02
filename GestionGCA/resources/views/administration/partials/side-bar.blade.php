<!-- Sidebar -->
<div class="sidebar" style="background-color: #1a252f;">
    <div class="sidebar-logo pt-3">
      <!-- Logo Header -->
      <div class="logo-header ml-0" style="background-color: #1a252f">
       <a href="#" class="logo d-flex align-items-center">
         <img src="{{ asset('assets/img/logobg.png') }}" alt="navbar brand" class="navbar-brand" height="70" width="70"/>
                <span style="color: #aa9166">JUGE-CABINET</span>
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

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        <ul class="nav nav-secondary">
          <li class="nav-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
            <a href="{{route('admin.dashboard')}}" class="nav-link text-light d-flex align-items-center py-2" style="background-color: #2c3e50;">
              <i class="fas fa-home"></i>
              <p>Tableau de bord</p>
            </a>
          </li>

          <li class="nav-section">
            <span class="sidebar-mini-icon">
              <i class="fa fa-ellipsis-h"></i>
            </span>
            <h4 class="text-section">Menu</h4>
          </li>

           <li class="nav-item {{ Route::is('admin.avocats.index') ? 'active' : '' }}">
          <a href="{{ route('admin.avocats.index') }}" class="nav-link text-light d-flex align-items-center py-2">
            <i class="icon-graduation me-2"></i> Gestion Des Avocats
          </a>
        </li>

          <li class="nav-item {{ Route::is('admin.clients.index') ? 'active' : '' }}">
          <a href="{{ route('admin.clients.index') }}" class="nav-link text-light d-flex align-items-center py-2">
            <i class="icon-user me-2"></i> Gestion Des Clients
          </a>
        </li>
         <li class="nav-item {{ Route::is('admin.dossiers.index') ? 'active' : '' }}">
          <a href="{{ route('admin.dossiers.index') }}" class="nav-link text-light d-flex align-items-center py-2">
            <i class="icon-briefcase me-2"></i> Gestion des dossiers
          </a>
        </li>

          <li class="nav-item">
          <a href="#" class="nav-link text-light d-flex align-items-center py-2">
            <i class="fa fa-envelope me-2"></i> Messagerie
          </a>
        </li>

          <li class="nav-item">
            <a href="#" class="nav-link text-light d-flex align-items-center py-2">
              <i class="fas fa-archive me-2"></i> Archives & Historique
            </a>
         </li>
          <li><hr class="text-secondary my-2"></li>
           <li class="nav-item mb-1">
          <a href="#" class="nav-link text-light d-flex align-items-center">
            <i class="icon-information me-2"></i> Mon profile
          </a>
        </li>

        <li class="nav-item mt-2">
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger w-100 d-flex align-items-center justify-content-center">
              <i class="fas fa-sign-out-alt me-2"></i> Se déconnecter
            </button>
          </form>
        </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- End Sidebar -->
