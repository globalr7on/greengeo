@extends('layouts.app', ['activePage' => 'rastreamento', 'titlePage' => __('Rastreamento')])

@section('subheaderTitle')
  OS E Rastreamento
@endsection
@section('content')

<div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoSearch">
          Pesquisar
        </button>

        <div class="modal fade" id="modalMapaSearch" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="tituloModal">Nova Pesquisa</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="row">
                <div class="col-md-12">
                <form>
                    <div class="row">
                      <div class="col">
                        <label for="inputIdOs" class="mb-0 font-weight-bold">ID OS</label>
                        <input type="text" class="form-control">
                      </div>
                      <div class="col">
                        <label for="inputIdOs" class="mb-0 font-weight-bold">Transportadora</label>
                        <input type="text" class="form-control">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <label for="inputIdOs" class="mb-0 font-weight-bold">CNPJ</label>
                        <input type="text" class="form-control">
                      </div>
                      <div class="col">
                        <label for="inputIdOs" class="mb-0 font-weight-bold">OS</label>
                        <input type="text" class="form-control">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col">
                        <label for="inputIdOs" class="mb-0 font-weight-bold">MTR</label>
                        <input type="text" class="form-control">
                      </div>
                      <div class="col">
                        <label for="inputIdOs" class="mb-0 font-weight-bold">CELULAR</label>
                        <input type="text" class="form-control">
                      </div>
                      <div class="col-md-12">
                        <label for="inputIdOs" class="mb-0 font-weight-bold">Número de Serie</label>
                        <input type="text" class="form-control">
                      </div>
                    </div>
                    <button type="button" class="btn btn-primary" id="pesquisaMap">Pesquisar</button>
                  </form>
                </div>
              </div>
            </div>
            </div>
          </div>
        </div>
      </div>
      


        <div id="map"></div>
      </div>
  </div>
</div>
@endsection

@push('js')
<script>
  $(document).ready(function() {
    var santaFelicidade = L.marker([-25.3954825,-49.3466]).bindPopup('Santa Felicidade');
    var novoMundo = L.marker([-25.4877125,-49.3042128]).bindPopup('Novo Mundo');
    var uberaba = L.marker([-25.4900417,-49.2332382]).bindPopup('Uberaba');
    var colombo = L.marker([-25.3127019,-49.2596]).bindPopup('Colombo');
    var curitiba = L.marker([-25.4476186,-49.3026774]).bindPopup('Colombo');
    // var sanJose = L.marker([-25.5863324,-49.295225]).bindPopup('San Jose');
    // var piraquara = L.marker([-25.4674252,-49.1429172]).bindPopup('Piraquara');
    
    var cities1 = L.layerGroup([
      santaFelicidade,
      novoMundo,
      uberaba
    ]);
    var cities2 = L.layerGroup([
      colombo,
      curitiba
    ]);
    
    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    });
    var map = L.map('map', {
      center: [-25.4476186,-49.3026774],
      zoom: 10,
      layers: [osm, cities1, cities2]
    })
    // .setView([51.505, -0.09], 13);
    var overlayMaps = {
      "Empresa1": cities1,
      "Empresa2": cities2
      // {"<img src='my-layer-icon' /> <span class='my-layer-item'>My Layer</span>": myLayer}
    };
    var layerControl = L.control.layers(null, overlayMaps).addTo(map);
    var route1 = [
      L.latLng(-25.4124496,-49.2267533),
      L.latLng(-25.4245853,-49.1955658)
    ]
    var route2 = [
      L.latLng(-25.5863324,-49.295225),
      L.latLng(-25.4674252,-49.1429172)
    ]
    // Add route
    L.Routing.control({
      waypoints: route1,
      lineOptions: {
        styles: [{color: 'red', opacity: 1, weight: 5}]
      },
      addWaypoints: false,
      routeWhileDragging: false,
      show: false,
    }).addTo(map);
    L.Routing.control({
      waypoints: route2,
      lineOptions: {
        styles: [{color: 'blue', opacity: 1, weight: 5}]
      },
      show: false
    }).addTo(map);
    // L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    //   attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    // }).addTo(map);
    // L.marker([-25.4476186,-49.3026774]).addTo(map)
    //   .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
    //   .openPopup();
    if(!navigator.geolocation){
      console.log("Your Browser doesn't support geolocation feature!")
    } else {
      setInterval(() => {
        navigator.geolocation.getCurrentPosition(getPosition)
      }, 5000);
    }
    var marker, circle;
    function getPosition(position) {
      // console.log(position)
      var lat = position.coords.latitude
      var long = position.coords.longitude
      var accuracy = position.coords.accuracy
      if(marker){
        map.removeLayer(marker)
      }
      if(circle){
        map.removeLayer(circle)
      }
      marker = L.marker([lat, long])
        .bindPopup('Eu estou aqui.<br> Teste.')
        .openPopup();
      circle = L.circle([lat, long],{radius:accuracy})
      var featureGroup = L.featureGroup([marker, circle]).addTo(map)
      map.fitBounds(featureGroup.getBounds())
      console.log("sua coordenada é: Lat: "+ lat+" Long: "+ long+ " Accuracy:"+ accuracy)
    }
    
    // Open Modal New
    $('body').on('click', '#novoSearch', function() {
      $("#modalMapaSearch").modal("show");
      $('#tituloModal').text("Nova Pesquisa");
      // $('#inputId').val("");
      // $("#inputDescricao").val("");
      // $("#checkAtivo").prop("checked", false)
    });
  });
</script>
@endpush