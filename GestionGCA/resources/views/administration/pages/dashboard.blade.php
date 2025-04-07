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
                  <p class="card-category">Total Etudiants</p>
                  <h4 class="card-title">1 294</h4>
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
                  <i class="icon-briefcase"></i>
                </div>
              </div>
              <div class="col col-stats ms-3 ms-sm-0">
                <div class="numbers">
                  <p class="card-category">Tot. Avocats</p>
                  <h4 class="card-title">130</h4>
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
                  <p class="card-category">Avocats</p>
                  <h4 class="card-title">4</h4>
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
                  <p class="card-category">Avocats</p>
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


    <div class="row">
        <div class="col-md-4">
            <div class="card card-round">
              <div class="card-body">
                <div class="card-head-row card-tools-still-right">
                  <div class="card-title">Nouveaux client</div>
                  <div class="card-tools">
                    <div class="dropdown">
                      <button
                        class="btn btn-icon btn-clean me-0"
                        type="button"
                        id="dropdownMenuButton"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        aria-expanded="false"
                      >
                        <i class="fas fa-ellipsis-h"></i>
                      </button>
                      <div
                        class="dropdown-menu"
                        aria-labelledby="dropdownMenuButton"
                      >
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <a class="dropdown-item" href="#"
                          >Something else here</a
                        >
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-list py-4">
                  <div class="item-list">
                    <div class="avatar">
                      <span
                        class="avatar-title rounded-circle border border-white"
                        >CF</span
                      >
                    </div>
                    <div class="info-user ms-3">
                      <div class="username">Chandra Felix</div>
                      <div class="status">Sales Promotion</div>
                    </div>
                    <button class="btn btn-icon btn-link op-8 me-1">
                      <i class="far fa-envelope"></i>
                    </button>
                    <button class="btn btn-icon btn-link btn-danger op-8">
                      <i class="fas fa-ban"></i>
                    </button>
                  </div>
                  <div class="item-list">
                    <div class="avatar">
                      <span
                        class="avatar-title rounded-circle border border-white bg-primary"
                        >H</span
                      >
                    </div>
                    <div class="info-user ms-3">
                      <div class="username">Hizrian</div>
                      <div class="status">Web Designer</div>
                    </div>
                    <button class="btn btn-icon btn-link op-8 me-1">
                      <i class="far fa-envelope"></i>
                    </button>
                    <button class="btn btn-icon btn-link btn-danger op-8">
                      <i class="fas fa-ban"></i>
                    </button>
                  </div>
                  <div class="item-list">
                    <div class="avatar">
                      <span
                        class="avatar-title rounded-circle border border-white bg-secondary"
                        >F</span
                      >
                    </div>
                    <div class="info-user ms-3">
                      <div class="username">Farrah</div>
                      <div class="status">Marketing</div>
                    </div>
                    <button class="btn btn-icon btn-link op-8 me-1">
                      <i class="far fa-envelope"></i>
                    </button>
                    <button class="btn btn-icon btn-link btn-danger op-8">
                      <i class="fas fa-ban"></i>
                    </button>
                  </div>
                </div>
              </div>
            </div>
        </div>

        <div class="col-md-8">
        <div class="card card-round">
          <div class="card-header">
            <div class="card-head-row card-tools-still-right">
              <h4 class="card-title">Users Geolocation</h4>
              <div class="card-tools">
                <button
                  class="btn btn-icon btn-link btn-primary btn-xs"
                >
                  <span class="fa fa-angle-down"></span>
                </button>
                <button
                  class="btn btn-icon btn-link btn-primary btn-xs btn-refresh-card"
                >
                  <span class="fa fa-sync-alt"></span>
                </button>
                <button
                  class="btn btn-icon btn-link btn-primary btn-xs"
                >
                  <span class="fa fa-times"></span>
                </button>
              </div>
            </div>
            <p class="card-category">
              Map of the distribution of users around the world
            </p>
          </div>
          <div class="card-body">
            <div class="row">
              <div class="col-md-6">
                <div class="table-responsive table-hover table-sales">
                  <table class="table">
                    <tbody>
                      <tr>
                        <td>
                          <div class="flag">
                            <img
                              src="{{ asset('administration/assets/img/flags/id.png') }}"
                              alt="indonesia"
                            />
                          </div>
                        </td>
                        <td>Indonesia</td>
                        <td class="text-end">2.320</td>
                        <td class="text-end">42.18%</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="flag">
                            <img
                              src="{{ asset('administration/assets/img/flags/us.png') }}"
                              alt="united states"
                            />
                          </div>
                        </td>
                        <td>USA</td>
                        <td class="text-end">240</td>
                        <td class="text-end">4.36%</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="flag">
                            <img
                              src="{{ asset('administration/assets/img/flags/au.png') }}"
                              alt="australia"
                            />
                          </div>
                        </td>
                        <td>Australia</td>
                        <td class="text-end">119</td>
                        <td class="text-end">2.16%</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="flag">
                            <img
                              src="{{ asset('administration/assets/img/flags/ru.png') }}"
                              alt="russia"
                            />
                          </div>
                        </td>
                        <td>Russia</td>
                        <td class="text-end">1.081</td>
                        <td class="text-end">19.65%</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="flag">
                            <img
                              src="{{ asset('administration/assets/img/flags/cn.png') }}"
                              alt="china"
                            />
                          </div>
                        </td>
                        <td>China</td>
                        <td class="text-end">1.100</td>
                        <td class="text-end">20%</td>
                      </tr>
                      <tr>
                        <td>
                          <div class="flag">
                            <img
                              src="{{ asset('administration/assets/img/flags/br.png') }}"
                              alt="brazil"
                            />
                          </div>
                        </td>
                        <td>Brasil</td>
                        <td class="text-end">640</td>
                        <td class="text-end">11.63%</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div class="col-md-6">
                <div class="mapcontainer">
                  <div
                    id="world-map"
                    class="w-100"
                    style="height: 300px"
                  ></div>
                </div>
              </div>
            </div>
          </div>
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
