@extends('layouts.app', ['activePage' => 'map', 'titlePage' => __('Rastreamento')])

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
      


        <div id="map"></div>
      </div>
  </div>
</div>
@endsection

@push('js')
<script>
  $(document).ready(function() {
    var map = L.map('map').setView([51.505, -0.09], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([51.5, -0.09]).addTo(map)
    .bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
    .openPopup();

    if(!navigator.geolocation){
      console.log("Your Browser doesn't support geolocation feature!")
    } else {
      navigator.geolocation.getCurrentPosition(getPosition)
    }

    function getPosition(position){
      // console.log(position)
      var lat = position.coords.latitude
      var long = position.coords.longitude
      var accuracy = position.coords.accuracy

      var marcker = L.marker([lat, long]).addTo(map)
      .bindPopup('Eu estou aqui.<br> Teste.')
      .openPopup();
      var circle = L.circle([lat, long],{radius:accuracy}).addTo(map)

      console.log("sua coordenada é: Lat: "+ lat+" Long: "+ long+ " Accuracy:"+ accuracy)
    }
    // Javascript method's body can be found in assets/js/demos.js
    // demo.initGoogleMaps();
  });
  // Open Modal New
  $('body').on('click', '#novoSearch', function() {
      $("#modalMapaSearch").modal("show");
      $('#tituloModal').text("Nova Pesquisa");
      // $('#inputId').val("");
      // $("#inputDescricao").val("");
      // $("#checkAtivo").prop("checked", false)
    });
</script>
@endpush