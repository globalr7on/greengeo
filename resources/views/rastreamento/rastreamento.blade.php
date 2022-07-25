@extends('layouts.app', ['activePage' => 'rastreamento', 'titlePage' => __('Rastreamento')])

@section('subheaderTitle')
  OS E Rastreamento
@endsection

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoFiltro">
          Filtrar pesquisa 
        </button>
        <button type="button" class="btn btn-primary" id="novoSearch">
          Mostrar OS
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

        <div id="map"></div>
      </div>
    </div>
  </div>
@endsection

@push('js')
<script>

  // Inicialização do mapa
  var map = L.map('map').setView([-25.441105, -49.276855], 12);
  //OMS LAyer 
  var osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: 'OMS'
  })
  osm.addTo(map);

  var truckIcon = L.icon({
    iconUrl: "{{ asset('material') }}/img/green_truck.png",
    iconSize: [35,25]
  })

  var marker = L.marker([-25.441105, -49.276855], {icon:truckIcon}).addTo(map);

  function getOs(gerador, destinador) {
    L.Routing.control({
      waypoints: [
        L.latLng(gerador.lat, gerador.lng),
        L.latLng(destinador.lat, destinador.lng)
      ]
    }).on('routesfound', function(e) {
      e.routes[0].coordinates.forEach(function(coord, index) {
        setTimeout(() => {
          marker.setLatLng([coord.lat, coord.lng])
        }, 100 * index);
      })
    })
    .addTo(map);
  }

  let app = new App({})
 
  $('body').on('click', '#novoFiltro', function() {
     $("#modalMapaSearch").modal("show")
     $('#tituloModal').text("Nova Pesquisa");
  });
  $('body').on('click', '#novoSearch', function() {
   getOsMap()
  });
   
  function getOsMap(value) {
    app.api.get('/os').then(response =>  {
      if (response && response.status) {
        console.log(response);
        for (let i = 0; i < response.data.length; i++) {
          getOs(response.data[i].gerador_coord, response.data[i].destinador_coord)
        }
      }
    })
    .catch(error => notifyDanger('Falha ao obter mapa, tente novamente'))
  }
</script>
@endpush