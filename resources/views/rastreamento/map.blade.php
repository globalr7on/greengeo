@extends('layouts.app', ['activePage' => 'rastreamento', 'titlePage' => __('Mapa')])
@section('css')
<style>
  .coordinate {
  position: absolute;
  bottom: 10px;
  right: 50%;
  background-color: black !important; 
  color: white !important
}

</style>

@endsection
@section('subheaderTitle')
  Rastreamento
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
      


        <div id="map">
          <div class="leaflet-control coordinate"></div>
        </div>
      </div>
  </div>
</div>
@endsection

@push('js')

<!-- <script>
   // Inicialização do mapa
    var map = L.map('map').setView([-25.441105, -49.276855], 12);
  //OMS LAyer 
    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: '© OpenStreetMap'
    })
    osm.addTo(map);

    //google street map
  googleStreet = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
      maxZoom: 20,
      subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
  }); 

  googleStreet.addTo(map);

  // mapa satelital
  googleSat = L.tileLayer('https://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}', {
      maxZoom: 20,
      subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
  }); 

  // googleStreet.addTo(map);

  // marker 
  var myIcon = L.icon({
    iconUrl:'material/img/truck.png',
    iconSize:[50,30],
  });
  var singleMarker = L.marker([-25.4697961, -49.2492506], {icon: myIcon, draggable: true});
  var popup = singleMarker.bindPopup('eu estou aqui ' + singleMarker.getLatLng()).openPopup();
  popup.addTo(map);

  // marker 
  var myIcon1 = L.icon({
    iconUrl:'material/img/truck.png',
    iconSize:[50,30],
  });
  var secondMarker = L.marker([-25.4097961, -49.3192506], {icon: myIcon});
  var popup = secondMarker.bindPopup('Destinador '+ secondMarker.getLatLng()).openPopup();
  popup.addTo(map);

  console.log(secondMarker.toGeoJSON())

  //Layer Controller 
  var baseMaps = {
    "OSM": osm,
    "Google Street": googleStreet,
    "Google Satellite" : googleSat,
  };

  var overlayMaps = {
      "First Marker": singleMarker,
      "Second Marker": secondMarker
  };

  // map.removeLayer(singleMarker1)

  L.control.layers(baseMaps, overlayMaps, {collapsed: false}).addTo(map);

  // eventos mouse 
  map.on('mouseover', function(){
    console.log('o mouse esta sobre o mapa')
  })

  map.on('mousemove', function(e){
    document.getElementsByClassName('coordinate')[0].innerHTML = ' Latitude: '+ e.latlng.lat + '  longitude: ' + e.latlng.lng;
    console.log('lat:'+ e.latlng.lat, 'lng:'+ e.latlng.lng)
  })
</script>  -->
<script>
// Inicialização do mapa
    var map = L.map('map').setView([-25.441105, -49.276855], 12);
  //OMS LAyer 
    var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
      maxZoom: 19,
      attribution: 'OMS'
    })
    osm.addTo(map);

    if(!navigator.geolocation){
      console.log("Nao é compatible")
    }else {
      navigator.geolocation.getCurrentPosition(getPosition)
    }

    function getPosition(position){
      console.log(position)
      var lat = position.coords.latitude
      var long = position.coords.longitude
      var accuracy = position.coords.accuracy

      var marker = L.marker([lat,long])
      var circle = L.circle([lat, long],{radius: accuracy})
      var featureGroup = L.featureGroup([marker,circle]).addTo(map)
      
      console.log(lat,long,accuracy)
    }

      //google street map
  googleStreet = L.tileLayer('https://{s}.google.com/vt/lyrs=m&x={x}&y={y}&z={z}', {
      maxZoom: 20,
      subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
  }); 

  googleStreet.addTo(map);

  // marker icon 
    var truckIcon = L.icon({
      iconUrl:'material/img/truck.png',
      iconSize:[50,30]
    })

    // marker
    var marker = L.marker([-25.441105, -49.276855], {icon: truckIcon}).addTo(map)

    map.on('click', function (e){
      console.log(e);
      var secondMarker = L.marker([e.latlng.lat, e.latlng.lng]).addTo(map);
      
      L.Routing.control({
      waypoints: [
        L.latLng(-25.441105, -49.276855), 
        L.latLng(e.latlng.lat, e.latlng.lng)
      ]
    }).on('routesfound', function(e){
      console.log(e);
      e.routes[0].coordinates.forEach(function(coord, index){
        setTimeout(() => {
          marker.setLatLng([coord.lat, coord.lng])
        }, 100 * index);
      })
    })
    
    .addTo(map);
    
    });
</script>

@endpush

