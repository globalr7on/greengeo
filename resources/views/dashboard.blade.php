@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      
      <div class="row">
        <div class="col-md-8">
          <div class="card card-chart">
            <div class="card-header card-header-warning">
              <div class="ct-chart" id="dailySalesChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Itens coleados no mës</h4>
              <p class="card-category">
                <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> updated 4 minutes ago
              </div>
            </div>
          </div>
        </div>
        <!-- <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-warning">
              <div class="ct-chart" id="websiteViewsChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Email Subscriptions</h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div> -->
        <div class="col-md-4">
          <div class="card card-chart">
            <div class="card-header card-header-danger">
              <div class="ct-chart" id="completedTasksChart"></div>
            </div>
            <div class="card-body">
              <h4 class="card-title">Toneladas de material reciclado</h4>
              <p class="card-category">Last Campaign Performance</p>
            </div>
            <div class="card-footer">
              <div class="stats">
                <i class="material-icons">access_time</i> campaign sent 2 days ago
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-warning card-header-icon">
              <div class="card-icon">
                <!-- <i class="material-icons">content_copy</i> -->
                <i class="fa-solid fa-arrow-trend-up"></i>
              </div>
              <p class="card-category">Traffic</p>
              <h3 class="card-title">350,897
                <!-- <small>GB</small> -->
              </h3>
            </div>
            <div class="card-footer">
              <div class="stats">
              <p class="card-category"><span class="text-success"><i class="fa fa-long-arrow-up"></i>3,48 </span> Since last month.</p>
                <!-- <i class="material-icons text-danger">warning</i> -->
                <!-- <a href="#pablo">Get More Space...</a> -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-success card-header-icon">
              <div class="card-icon">
                 <!-- <i class="material-icons text-danger">warning</i> -->
                <!-- <i class="material-icons">store</i> -->
                <i class="fa-solid fa-users"></i>
              </div>
              <p class="card-category">New Users</p>
              <h3 class="card-title">2,356</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
              <p class="card-category"><span class="text-danger"><i class="fa fa-long-arrow-down"></i>3,48 </span> Since last Week.</p>
                <!-- <i class="material-icons">date_range</i> Last 24 Hours -->
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-danger card-header-icon">
              <div class="card-icon">
                <!-- <i class="material-icons">info_outline</i> -->
                <i class="fa-solid fa-dollar"></i>
              </div>
              <p class="card-category">Sales</p>
              <h3 class="card-title">924</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
                <!-- <i class="material-icons">local_offer</i> Tracked from Github -->
                <p class="card-category"><span class="text-warning"><i class="fa fa-long-arrow-down"></i>3,48 </span> Since last Week.</p>
                
              </div>
            </div>
          </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-6">
          <div class="card card-stats">
            <div class="card-header card-header-info card-header-icon">
              <div class="card-icon">
                <!-- <i class="fa fa-twitter"></i> -->
                <i class="fa-solid fa-chart-column"></i>
              </div>
              <p class="card-category">Performance</p>
              <h3 class="card-title">46,65%</h3>
            </div>
            <div class="card-footer">
              <div class="stats">
              <p class="card-category"><span class="text-success"><i class="fa fa-long-arrow-up"></i>12 </span> Since last month.</p>
                 
              <!-- <i class="material-icons">update</i> Just Updated -->
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        
        <div class="col-lg-8 col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">Clientes atendidos por mës</h4>
              <!-- <p class="card-category">New employees on 15th September, 2016</p> -->
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>ID</th>
                  <th>Name</th>
                  <th>Salary</th>
                  <th>Country</th>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Dakota Rice</td>
                    <td>$36,738</td>
                    <td>Niger</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Minerva Hooper</td>
                    <td>$23,789</td>
                    <td>Curaçao</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Sage Rodriguez</td>
                    <td>$56,142</td>
                    <td>Netherlands</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Philip Chaney</td>
                    <td>$38,735</td>
                    <td>Korea, South</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-md-12">
          <div class="card">
            <div class="card-header card-header-warning">
              <h4 class="card-title">Total de itens reciclados por mës</h4>
              <!-- <p class="card-category">New employees on 15th September, 2016</p> -->
            </div>
            <div class="card-body table-responsive">
              <table class="table table-hover">
                <thead class="text-warning">
                  <th>ID</th>
                  <th>Name</th>
                  <th>Salary</th>
                  <th>Country</th>
                </thead>
                <tbody>
                  <tr>
                    <td>1</td>
                    <td>Dakota Rice</td>
                    <td>$36,738</td>
                    <td>Niger</td>
                  </tr>
                  <tr>
                    <td>2</td>
                    <td>Minerva Hooper</td>
                    <td>$23,789</td>
                    <td>Curaçao</td>
                  </tr>
                  <tr>
                    <td>3</td>
                    <td>Sage Rodriguez</td>
                    <td>$56,142</td>
                    <td>Netherlands</td>
                  </tr>
                  <tr>
                    <td>4</td>
                    <td>Philip Chaney</td>
                    <td>$38,735</td>
                    <td>Korea, South</td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      md.initDashboardPageCharts();
    });
  </script>
@endpush