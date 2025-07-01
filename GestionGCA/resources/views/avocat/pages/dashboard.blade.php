@extends('administration.base')

@section('content')

<div class="page-inner">
  <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
      <h3 class="fw-bold mb-3">Tableau de bord</h3>
    </div>
  </div>

  <div class="row g-4">
    {{-- Dossiers en cours --}}
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round shadow-sm">
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

    {{-- Dossiers terminés --}}
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round shadow-sm">
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

    {{-- Clients --}}
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round shadow-sm">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-info bubble-shadow-small">
                <i class="fas fa-users"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Mes clients</p>
                <h4 class="card-title">{{ $myClients }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    {{-- Total dossiers --}}
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round shadow-sm">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-secondary bubble-shadow-small">
                <i class="fas fa-folder"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Total dossiers</p>
                <h4 class="card-title">{{ $totalDossiers }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  {{-- Zone du graphique (exemple, tu peux adapter les labels et données) --}}
  <div class="card card-round mt-4">
    <div class="card-header">
      <div class="card-head-row">
        <div class="card-title">Statistiques mensuelles des dossiers</div>
      </div>
    </div>
    <div class="card-body">
      <canvas id="monthlyCasesChart" style="min-height: 375px;"></canvas>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<!-- Chart JS -->
<script src="{{ asset('administration/assets/js/plugin/chart.js/chart.min.js') }}"></script>

<script>
  document.addEventListener('DOMContentLoaded', function () {
    var ctx = document.getElementById('monthlyCasesChart').getContext('2d');

    var monthlyCasesData = @json($monthlyCases);

    var monthlyCasesChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
        datasets: [{
          label: 'Dossiers créés',
          data: monthlyCasesData,
          backgroundColor: 'rgba(23, 125, 255, 0.2)',
          borderColor: '#177dff',
          borderWidth: 2,
          fill: true,
          tension: 0.4
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            precision: 0
          }
        }
      }
    });
  });
</script>
@endpush
