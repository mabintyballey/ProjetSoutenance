@extends('administration.base')

@section('content')
<div class="page-inner">
  <h3 class="fw-bold mb-4">👤 Tableau de bord Client</h3>

  {{-- ✅ Cartes statistiques --}}
  <div class="row">
    <div class="col-sm-6 col-md-4">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-primary bubble-shadow-small">
                <i class="fas fa-folder-open"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Dossiers en cours</p>
                <h4 class="card-title">{{ $activeCases }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-4">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-success bubble-shadow-small">
                <i class="fas fa-check-circle"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Dossiers terminés</p>
                <h4 class="card-title">{{ $closedCases }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-4">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-info bubble-shadow-small">
                <i class="fas fa-folder"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Total Dossiers</p>
                <h4 class="card-title">{{ $totalCases }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- ✅ Dossiers récents --}}
  <div class="mt-5">
    <h4 class="fw-bold mb-3">📂 Mes dossiers récents</h4>
    @if($recentDossiers->isEmpty())
      <div class="alert alert-info rounded-pill px-4 py-2">
        <i class="bi bi-info-circle me-2"></i> Aucun dossier récent.
      </div>
    @else
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($recentDossiers as $dossier)
          <div class="col">
            <div class="card h-100 shadow-sm border-start border-4
              @if($dossier->statut === 'en_cours') border-warning
              @elseif($dossier->statut === 'termine') border-success
              @else border-secondary @endif rounded-4">

              <div class="card-body">
                <h5 class="card-title mb-2 fw-bold text-primary">
                  <i class="bi bi-folder-fill me-2"></i>
                  {{ $dossier->titre ?? 'Dossier :' . $loop->iteration }}
                </h5>

                <p class="mb-0 text-muted">
                  <i class="bi bi-calendar-event me-1"></i>
                  Créé le {{ $dossier->created_at->format('d/m/Y') }}
                </p>

                <span class="badge mt-2 rounded-pill
                  @if($dossier->statut === 'en_cours') bg-warning text-dark
                  @elseif($dossier->statut === 'termine') bg-success
                  @else bg-secondary @endif">
                  {{ ucfirst($dossier->statut) }}
                </span>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>

  {{-- ✅ Prochains rendez-vous --}}
  <div class="mt-5">
    <h4 class="fw-bold mb-3">📅 Mes prochains rendez-vous</h4>
    @if($upcomingRendezvous->isEmpty())
      <div class="alert alert-info rounded-pill px-4 py-2">
        <i class="bi bi-info-circle me-2"></i> Aucun rendez-vous à venir.
      </div>
    @else
      <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        @foreach($upcomingRendezvous as $rdv)
          <div class="col">
            <div class="card h-100 shadow-sm border-start border-4 border-primary rounded-4">
              <div class="card-body">
                <h5 class="card-title mb-2 fw-bold text-primary">
                  <i class="bi bi-calendar-check-fill me-2"></i>
                  {{ $rdv->date_heure->format('d/m/Y H:i') }}
                </h5>

                <p class="mb-1">
                  <i class="bi bi-geo-alt-fill me-1"></i>
                  Lieu: {{ $rdv->lieu }}
                </p>

                @if($rdv->motif)
                  <p class="mb-0 text-muted">
                    <i class="bi bi-chat-left-text me-1"></i>
                    {{ Str::limit($rdv->motif, 60) }}
                  </p>
                @endif
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @endif
  </div>

</div>
@endsection
