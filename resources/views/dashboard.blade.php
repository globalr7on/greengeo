@extends('layouts.app', ['activePage' => 'dashboard', 'titlePage' => __('Dashboard')])

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        holas
      </div>
      <div class="row">
        <div class="col-md-9">
          <div class="row">
            <div class="col-md-6">
              <div class="card card-chart">
                <div class="card-body">
                  <h3 class="card-title">Primeiro Gráfico</h3>
                  <p class="card-category">
                    <span class="text-success"></span> Informações do gráfico.</p>
                </div>
                <hr>
                <div class="card-header">
                  <div class="ct-chart-a ct-golden-section" id="ct-chart-a"></div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card card-chart">
                <div class="card-body">
                  <h3 class="card-title">Segundo Gráfico</h3>
                  <p class="card-category">
                    <span class="text-success"></span> Informações do gráfico.</p>
                </div>
                <hr>
                <div class="card-header">
                  <div class="ct-chart-b ct-golden-section" id="ct-chart-b"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="card card-chart mb-0 mt-2">
                <div class="card-body">
                  <h3 class="card-title">Terceiro Gráfico</h3>
                  <p class="card-category">
                    <span class="text-success"></span> Informações do gráfico.</p>
                </div>
                <hr>
                <div class="card-header">
                  <div class="ct-chart-c ct-golden-section" id="ct-chart-c"></div>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card card-chart mb-0 mt-2">
                <div class="card-body">
                  <h3 class="card-title">Quarto Gráfico</h3>
                  <p class="card-category">
                    <span class="text-success"></span> Informações do gráfico.</p>
                </div>
                <hr>
                <div class="card-header">
                  <div class="ct-chart-d ct-golden-section" id="ct-chart-d"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-3">
          <div class="row">
            <div class="col-md-12">
              <div class="card card-chart mb-0">
                <div class="card-body">
                  <h3 class="card-title">Novas Sucatas</h3>
                    <p class="card-category">
                      <span class="text-success"></span>últimos 2 meses 2022.</p>
                </div>
                <hr>
                <div class="card-header text-center">
                  <h1>10k</h1>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card card-chart mb-0 mt-2">
                <div class="card-body">
                  <h3 class="card-title">Contagem de novas contratações</h3>
                    <p class="card-category">
                      <span class="text-success"></span>últimos 2 meses 2022.</p>
                </div>
                <hr>
                <div class="card-header text-center">
                   <div class="ct-chart-lat ct-golden-section" id="ct-chart-lat"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card card-chart mb-0 mt-2">
                <div class="card-body">
                  <h3 class="card-title">Quantidades de Sucatas</h3>
                    <p class="card-category">
                      <span class="text-success"></span>últimos 2 meses 2022.</p>
                </div>
                <hr>
                <div class="card-header text-center">
                  <div class="ct-chart-let ct-golden-section" id="ct-chart-let"></div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="card card-chart mb-0 mt-2">
                <div class="card-body">
                  <h3 class="card-title">Novos Materiales</h3>
                    <p class="card-category">
                      <span class="text-success"></span>últimos 2 meses 2022.</p>
                </div>
                <hr>
                <div class="card-header text-center">
                <div class="ct-chart-lot ct-golden-section" id="ct-chart-lot"></div>
                </div>
              </div>
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
      // md.initDashboardPageCharts();
      var data = {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mai', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        series: [
          [5, 4, 3, 7, 5, 10, 3, 4, 8, 10, 6, 8],
          [3, 2, 9, 5, 4, 6, 4, 6, 7, 8, 7, 4]
        ]
      };
      var options = {
        seriesBarDistance: 10
      };
      var responsiveOptions = [
        ['screen and (max-width: 640px)', {
          seriesBarDistance: 5,
          axisX: {
            labelInterpolationFnc: function (value) {
              return value[0];
            }
          }
        }]
      ];
      new Chartist.Bar('.ct-chart-a', data, options, responsiveOptions);
      
      });
      var datacircle1 = {
        series: [5, 3, 4]
      };
      var sum = function(a, b) { return a + b };
      new Chartist.Pie('.ct-chart-lat', datacircle1, {
        labelInterpolationFnc: function(value) {
          return Math.round(value / datacircle1.series.reduce(sum) * 100) + '%';
        }
      });
      new Chartist.Bar('.ct-chart-let', {
        labels: ['Note ', 'Meio Oeste'],
        series: [
          [5, 20],
          [3, 30]
          // ['0k'],
          // ['4k']
        ]
      }, {
        seriesBarDistance: 10,
        reverseData: true,
        horizontalBars: true,
        axisY: {
          offset: 70
        }
      });
      var data = {
        labels: ['Ouro', 'Ferro', 'Platico'],
        series: [20, 15, 40]
      };

      var options = {
        labelInterpolationFnc: function(value) {
          return value[0]
        }
      };

      var responsiveOptions = [
        ['screen and (min-width: 640px)', {
          chartPadding: 30,
          labelOffset: 100,
          labelDirection: 'explode',
          labelInterpolationFnc: function(value) {
            return value;
          }
        }],
        ['screen and (min-width: 1024px)', {
          labelOffset: 80,
          chartPadding: 20
        }]
      ];

      new Chartist.Pie('.ct-chart-lot', data, options, responsiveOptions);

      new Chartist.Bar('.ct-chart-b', {
        labels: ['Q1', 'Q2', 'Q3', 'Q4'],
        series: [
          [800000, 1200000, 1400000, 1300000],
          [200000, 400000, 500000, 300000],
          [100000, 200000, 400000, 600000]
        ]
      }, {
        stackBars: true,
        axisY: {
          labelInterpolationFnc: function(value) {
            return (value / 1000) + 'k';
          }
        }
      }).on('draw', function(data) {
        if(data.type === 'bar') {
          data.element.attr({
            style: 'stroke-width: 30px'
          });
        }
      });

      new Chartist.Bar('.ct-chart-c', {
        labels: ['First quarter of the year', 'Second quarter of the year', 'Third quarter of the year', 'Fourth quarter of the year'],
        series: [
          [60000, 40000, 80000, 70000],
          [40000, 30000, 70000, 65000],
          [8000, 3000, 10000, 6000]
        ]
      }, {
        seriesBarDistance: 10,
        axisX: {
          offset: 60
        },
        axisY: {
          offset: 80,
          labelInterpolationFnc: function(value) {
            return value + ' CHF'
          },
          scaleMinSpace: 15
        }
      });
      var chart = new Chartist.Line('.ct-chart-d', {
        labels: ['1', '2', '3', '4', '5', '6', '7', '8', '9', '10', '11', '12'],
        series: [
          [12, 9, 7, 8, 5, 4, 6, 2, 3, 3, 4, 6],
          [4,  5, 3, 7, 3, 5, 5, 3, 4, 4, 5, 5],
          [5,  3, 4, 5, 6, 3, 3, 4, 5, 6, 3, 4],
          [3,  4, 5, 6, 7, 6, 4, 5, 6, 7, 6, 3]
        ]
      }, {
        low: 0
      });

      // Let's put a sequence number aside so we can use it in the event callbacks
      var seq = 0,
        delays = 80,
        durations = 500;

      // Once the chart is fully created we reset the sequence
      chart.on('created', function() {
        seq = 0;
      });

      // On each drawn element by Chartist we use the Chartist.Svg API to trigger SMIL animations
      chart.on('draw', function(data) {
        seq++;

        if(data.type === 'line') {
          // If the drawn element is a line we do a simple opacity fade in. This could also be achieved using CSS3 animations.
          data.element.animate({
            opacity: {
              // The delay when we like to start the animation
              begin: seq * delays + 1000,
              // Duration of the animation
              dur: durations,
              // The value where the animation should start
              from: 0,
              // The value where it should end
              to: 1
            }
          });
        } else if(data.type === 'label' && data.axis === 'x') {
          data.element.animate({
            y: {
              begin: seq * delays,
              dur: durations,
              from: data.y + 100,
              to: data.y,
              // We can specify an easing function from Chartist.Svg.Easing
              easing: 'easeOutQuart'
            }
          });
        } else if(data.type === 'label' && data.axis === 'y') {
          data.element.animate({
            x: {
              begin: seq * delays,
              dur: durations,
              from: data.x - 100,
              to: data.x,
              easing: 'easeOutQuart'
            }
          });
        } else if(data.type === 'point') {
          data.element.animate({
            x1: {
              begin: seq * delays,
              dur: durations,
              from: data.x - 10,
              to: data.x,
              easing: 'easeOutQuart'
            },
            x2: {
              begin: seq * delays,
              dur: durations,
              from: data.x - 10,
              to: data.x,
              easing: 'easeOutQuart'
            },
            opacity: {
              begin: seq * delays,
              dur: durations,
              from: 0,
              to: 1,
              easing: 'easeOutQuart'
            }
          });
        } else if(data.type === 'grid') {
          // Using data.axis we get x or y which we can use to construct our animation definition objects
          var pos1Animation = {
            begin: seq * delays,
            dur: durations,
            from: data[data.axis.units.pos + '1'] - 30,
            to: data[data.axis.units.pos + '1'],
            easing: 'easeOutQuart'
          };

          var pos2Animation = {
            begin: seq * delays,
            dur: durations,
            from: data[data.axis.units.pos + '2'] - 100,
            to: data[data.axis.units.pos + '2'],
            easing: 'easeOutQuart'
          };

          var animations = {};
          animations[data.axis.units.pos + '1'] = pos1Animation;
          animations[data.axis.units.pos + '2'] = pos2Animation;
          animations['opacity'] = {
            begin: seq * delays,
            dur: durations,
            from: 0,
            to: 1,
            easing: 'easeOutQuart'
          };

          data.element.animate(animations);
        }
      });

      // For the sake of the example we update the chart every time it's created with a delay of 10 seconds
      chart.on('created', function() {
        if(window.__exampleAnimateTimeout) {
          clearTimeout(window.__exampleAnimateTimeout);
          window.__exampleAnimateTimeout = null;
        }
        window.__exampleAnimateTimeout = setTimeout(chart.update.bind(chart), 12000);
      });

  </script>
 
  
@endpush