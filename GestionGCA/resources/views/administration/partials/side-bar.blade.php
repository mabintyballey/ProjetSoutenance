<!-- Sidebar -->
<div class="sidebar" data-background-color="dark">
    <!-- Logo Header -->
    <div class="sidebar-logo">
        <div class="logo-header" data-background-color="dark">
            <a href="{{ route(auth()->user()->role . '.dashboard') }}" class="logo d-flex align-items-center">
                <img src="{{ asset('assets/img/logobg.png') }}" alt="navbar brand" height="50" width="50" />
                <span class="ml-2" style="color: #aa9166; font-weight: bold;">JUGE-CABINET</span>
            </a>

            <!-- Toggler buttons -->
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
    </div>
    <!-- End Logo Header -->

    <!-- Sidebar Content -->
    <div class="sidebar-wrapper scrollbar scrollbar-inner">
        <div class="sidebar-content">
            <ul class="nav nav-secondary">

                <!-- Tableau de bord -->
                <li class="nav-item {{ request()->routeIs(auth()->user()->role . '.dashboard') ? 'active' : '' }}">
                    <a href="{{ route(auth()->user()->role . '.dashboard') }}">
                        <i class="fas fa-home"></i>
                        <p>Tableau de bord</p>
                    </a>
                </li>

                <li class="nav-section">
                    <span class="sidebar-mini-icon"><i class="fa fa-ellipsis-h"></i></span>
                    <h4 class="text-section">Menu</h4>
                </li>

                <!-- Menu spécifique par rôle -->
                @if(auth()->user()->role === 'admin')
                    <li class="nav-item {{ request()->routeIs('admin.avocats.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.avocats.index') }}">
                            <i class="icon-graduation"></i>
                            <p>Gestion Des Avocats</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('admin.clients.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.clients.index') }}">
                            <i class="icon-user"></i>
                            <p>Gestion Des Clients</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('admin.dossiers.index') ? 'active' : '' }}">
                        <a href="{{ route('admin.dossiers.index') }}">
                            <i class="icon-briefcase"></i>
                            <p>Gestion des dossiers</p>
                        </a>
                    </li>
                @elseif(auth()->user()->role === 'avocat')
                    <li class="nav-item {{ request()->routeIs('avocat.avocat.clients') ? 'active' : '' }}">
                        <a href="{{ route('avocat.avocat.clients') }}">
                            <i class="icon-user"></i>
                            <p>Mes Clients</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('avocat.dossiers.mes') ? 'active' : '' }}">
                        <a href="{{ route('avocat.dossiers.mes') }}">
                            <i class="icon-briefcase"></i>
                            <p>Gestion des dossiers</p>
                        </a>
                    </li>
                     <li class="nav-item {{ request()->routeIs('rendezvous.index') ? 'active' : '' }}">
                        <a href="{{ route('rendezvous.index') }}">
                            <i class="icon-briefcase"></i>
                            <p>Mes Rendez-Vous</p>
                        </a>
                    </li>
                    
                @elseif(auth()->user()->role === 'client')
                    <li class="nav-item {{ request()->routeIs('client.requetes.index') ? 'active' : '' }}">
                        <a href="{{ route('client.requetes.index') }}">
                            <i class="icon-folder-alt"></i>
                            <p>Mes requêtes</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('client.documents.index') ? 'active' : '' }}">
                        <a href="{{ route('client.documents.index') }}">
                            <i class="icon-doc"></i>
                            <p>Documents envoyés</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('client.requetes.createNouvelleRequete') ? 'active' : '' }}">
                        <a href="{{ route('client.requetes.createNouvelleRequete') }}">
                            <i class="icon-plus"></i>
                            <p>Soumettre une requête</p>
                        </a>
                    </li>
                    <li class="nav-item {{ request()->routeIs('client.dossiers.suivi') ? 'active' : '' }}">
                        <a href="{{ route('client.dossiers.suivi') }}">
                            <i class="icon-briefcase"></i>
                            <p>État des dossiers</p>
                        </a>
                    </li>
                      <li class="nav-item {{ request()->routeIs('rendezvous.index') ? 'active' : '' }}">
                          <a href="{{ route('rendezvous.index') }}">
                              <i class="icon-briefcase"></i>
                              <p>Mes Rendez-Vous</p>
                          </a>
                      </li>
                @endif

                <!-- Menu partagé -->
                <li class="nav-item {{ request()->routeIs('messagerie.index') ? 'active' : '' }}">
                    <a href="{{ route('messagerie.index') }}">
                        <i class="fa fa-envelope"></i>
                        <p>Messagerie</p>
                    </a>
                </li>

                <div class="divider"></div>

                <li class="nav-item">
                    <a href="{{ route('profile.edit') }}">
                        <i class="icon-settings"></i>
                        <p>Profil / Paramètres</p>
                    </a>
                </li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger w-100">
                            <i class="icon-logout"></i> Se déconnecter
                        </button>
                    </form>
                </li>

            </ul>
        </div>
    </div>
</div>
<!-- End Sidebar -->
