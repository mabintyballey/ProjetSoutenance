<!-- Sidebar -->
<div class="sidebar" style="background-color: #1a252f;">
    <div class="sidebar-logo pt-3">
      <!-- Logo Header -->
      <div class="logo-header" style="background-color: #1a252f">
        <a href="{{ route('administration.dashboard') }}" class="logo">
        <img
            src="{{ asset('assets/img/logobg.png') }}"
            alt="navbar brand"
            class="navbar-brand"
            height="90"  
            width="auto"
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

    <div class="sidebar-wrapper scrollbar scrollbar-inner">
      <div class="sidebar-content">
        <ul class="nav nav-secondary">
          <li class="nav-item {{ Route::is('administration.dashboard') ? 'active' : '' }}">
            <a href="{{ route('administration.dashboard') }}" style="background-color: #2c3e50;">
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

          <li class="nav-item {{ Route::is('proffesseur.list') ? 'active' : '' }}">
            <a href="#">
              <i class="icon-briefcase"></i>
              <p>Gestion des dossiers</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#">
                <i class="icon-user"></i>
                <p>Clients</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#">
              <i class="icon-graduation"></i>
              <p>Avocats</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#">
            <i class="fa fa-envelope"></i>
              <p>Messagerie</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="">
              <i class="icon-grid"></i>
              <p>Avocat juge</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#">
              <i class="icon-folder-alt"></i>
              <p>Administration</p>
            </a>
          </li>
           <!--
          <li class="nav-item">
          <a href="">
              <i class="icon-grid"></i>
              <p>Avocat juge</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#">
              <i class="icon-note"></i>
              <p>Avocat juge</p>
            </a>
          </li> -->
          <div class="divider"></div>
          <li class="nav-item">
            <a href="">
              <i class="icon-information"></i>
              <p>Mon profile</p>
            </a>
          </li>
          <li class="nav-item">
            <form action="#" method="POST">
                @csrf
                <button type="submit">
                  <i class="icon-logout"></i>
                  <p class="btn btn-danger text-light">Se deconnecter</p>
                </button>
            </form>
          </li>
        </ul>
      </div>
    </div>
  </div>
  <!-- End Sidebar -->
