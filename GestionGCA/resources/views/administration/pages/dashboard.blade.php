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
                <div
                  class="icon-big text-center icon-primary bubble-shadow-small"
                >
                  <i class="fas fa-users"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Total Clients</p>
                  <h4 class="card-title">{{$clientsCount}}</h4>
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
                <div
                  class="icon-big text-center icon-info bubble-shadow-small"
                >
                  <i class="fas fa-gavel"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Total Avocats</p>
                  <h4 class="card-title">{{$avocatsCount}}</h4>
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
                <div
                  class="icon-big text-center icon-success bubble-shadow-small"
                >
                  <i class="icon-folder-alt"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Total Dossiers</p>
                  <h4 class="card-title">{{$dossiersCount}}</h4>
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
                <div
                  class="icon-big text-center icon-secondary bubble-shadow-small"
                >
                  <i class="icon-calendar"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Matières</p>
                  <h4 class="card-title">40</h4>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
      
    <div>
        <div class="card card-round">
          <div class="card-header">
            <div class="card-head-row">
              <div class="card-title">User Statistics</div>
              <div class="card-tools">
                <a
                  href="#"
                  class="btn btn-label-success btn-round btn-sm me-2"
                >
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
            <div class="chart-container" style="min-height: 375px">
              <canvas id="statisticsChart"></canvas>
            </div>
            <div id="myChartLegend"></div>
          </div>
        </div>
    </div>
 </div>
@endsection

@push('scripts')
<!-- Chart Circle -->
<script src="{{ asset('administration/assets/js/plugin/chart-circle/circles.min.js') }}"></script>

<!-- Chart JS -->
<script src="{{ asset('administration/assets/js/plugin/chart.js/chart.min.js') }}"></script>

<!-- jQuery Vector Maps -->
<script src="{{ asset('administration/assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
<script src="{{ asset('administration/assets/js/plugin/jsvectormap/world.js') }}"></script>

<script>
    $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#177dff",
    fillColor: "rgba(23, 125, 255, 0.14)",
    });

    $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#f3545d",
    fillColor: "rgba(243, 84, 93, .14)",
    });

    $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
    type: "line",
    height: "70",
    width: "100%",
    lineWidth: "2",
    lineColor: "#ffa534",
    fillColor: "rgba(255, 165, 52, .14)",
    });

</script>

<script src="{{ asset('administration/assets/js/demo.js') }}"></script>
@endpush
