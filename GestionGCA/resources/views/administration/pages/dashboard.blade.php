@extends('administration.base')

@section('content')

<div class="page-inner">
  <div class="d-flex align-items-left align-items-md-center flex-column flex-md-row pt-2 pb-4">
    <div>
      <h3 class="fw-bold mb-3">Tableau de bord</h3>
    </div>
  </div>

  <div class="row">
    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-primary bubble-shadow-small">
                <i class="fas fa-users"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Total Clients</p>
                <h4 class="card-title">{{ $clientsCount }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-info bubble-shadow-small">
                <i class="fas fa-gavel"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Total Avocats</p>
                <h4 class="card-title">{{ $avocatsCount }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-secondary bubble-shadow-small">
                <i class="icon-folder-alt"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Total Dossiers</p>
                <h4 class="card-title">{{ $dossiersCount }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-sm-6 col-md-3">
      <div class="card card-stats card-round">
        <div class="card-body">
          <div class="row align-items-center">
            <div class="col-icon">
              <div class="icon-big text-center icon-success bubble-shadow-small">
                <i class="icon-folder-alt"></i>
              </div>
            </div>
            <div class="col col-stats ms-3 ms-sm-0">
              <div class="numbers">
                <p class="card-category">Closed Cases</p>
                <h4 class="card-title">{{ $totalDossiersTermines }}</h4>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- USER & VISITOR STATISTICS SECTION -->
  <div class="card card-round mt-4">
    <div class="card-header">
      <div class="card-head-row">
        <div class="card-title">User & Visitor Statistics</div>
        <div class="card-tools">
          <a href="#" class="btn btn-label-success btn-round btn-sm me-2">
            <span class="btn-label">
              <i class="fa fa-pencil"></i>
            </span>
            Export
          </a>
          <a href="#" class="btn btn-label-info btn-round btn-sm">
            <span class="btn-label">
              <i class="fa fa-print"></i>
            </span>
            Print
          </a>
        </div>
      </div>
    </div>
    <div class="card-body">
      <div class="row text-center mb-4">
        <div class="col-md-6">
          <h5>Total Users</h5>
          <h3 class="fw-bold">{{ $clientsCount + $avocatsCount }}</h3>
        </div>
        <div class="col-md-6">
          <h5>Total Visitors</h5>
          <h3 class="fw-bold">{{ $visitorsCount }}</h3>
        </div>
      </div>
      <div class="chart-container" style="min-height: 375px">
        <canvas id="statisticsChart"></canvas>
      </div>
      <div id="myChartLegend"></div>
    </div>
  </div>
</div>

@if (session('notification'))
<script>
  toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-top-right"
  };
  toastr.success("{{ session('notification') }}");
</script>
@endif

@endsection

@push('scripts')
<!-- Chart Circle -->
<script src="{{ asset('administration/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('administration/assets/js/plugin/chart.js/chart.min.js') }}"></script>

<!-- jQuery Vector Maps -->
<script src="{{ asset('administration/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ asset('administration/assets/js/plugin/jsvectormap/world.js') }}"></script>

<!-- Ton chart existant -->
<script>
  var ctx = document.getElementById("statisticsChart").getContext("2d");

  var statisticsChart = new Chart(ctx, {
    type: 'line',
    data: {
      labels: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul"],
      datasets: [{
        label: "Users",
        borderColor: '#177dff',
        data: [12, 19, 3, 5, 2, 3, 9],
        fill: false
      }, {
        label: "Visitors",
        borderColor: '#f3545d',
        data: [7, 11, 5, 8, 3, 7, 14],
        fill: false
      }]
    },
    options: {
      responsive: true,
      maintainAspectRatio: false,
      legend: {
        display: true
      },
      tooltips: {
        mode: 'index',
        intersect: false,
      }
    }
  });
</script>

<script src="{{ asset('administration/assets/js/demo.js') }}"></script>
@endpush
