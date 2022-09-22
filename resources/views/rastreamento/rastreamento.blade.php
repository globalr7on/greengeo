@extends('layouts.app', ['activePage' => 'rastreamento', 'titlePage' => __('Rastreamento')])

@section('subheaderTitle')
  OS E Rastreamento
@endsection

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col"></div>

        <div class="col-md-4 px-0">
          <div class="d-flex align-items-center justify-content-end m-0 p-0">
            <label for="ordem_servicos" class="mb-0 mr-2">Ordens de Serviço</label>
            <select id="ordem_servicos" data-style="btn-warning text-white" title="Selecione"></select>
          </div>
        </div>
            
        <div class="col-2 px-0 text-center">
          <button type="button" class="btn btn-primary" id="novoFiltro">
            Filtrar pesquisa 
          </button>

          <!-- <button type="button" class="btn btn-primary" id="novoSearch">
            Mostrar OS
          </button> -->
    
          <!-- <button type="button" class="btn btn-primary" id="novoTempo">
            Posição real
          </button> -->
        </div>
      </div>

      <div class="row">
        <div class="col-12">
        <div id="map" class="mt-2"></div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
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
                <div class="row my-2">
                  <div class="col-6">
                    <label for="inputIdOs" class="mb-0 font-weight-bold">ID OS</label>
                    <input type="text" class="form-control">
                  </div>
                  <div class="col-6">
                    <label for="inputIdOs" class="mb-0 font-weight-bold">Transportadora</label>
                    <input type="text" class="form-control">
                  </div>
                </div>

                <div class="row my-2">
                  <div class="col-6">
                    <label for="inputIdOs" class="mb-0 font-weight-bold">CNPJ</label>
                    <input type="text" class="form-control">
                  </div>

                  <div class="col-6">
                    <label for="inputIdOs" class="mb-0 font-weight-bold">OS</label>
                    <input type="text" class="form-control">
                  </div>
                </div>

                <div class="row my-2">
                  <div class="col-6">
                    <label for="inputIdOs" class="mb-0 font-weight-bold">MTR</label>
                    <input type="text" class="form-control">
                  </div>

                  <div class="col-6">
                    <label for="inputIdOs" class="mb-0 font-weight-bold">Celular</label>
                    <input type="text" class="form-control">
                  </div>
                </div>

                <div class="row my-2">
                  <div class="col-12">
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
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      let osData = [], mainInterval = null, currentInterval = null
      const INTERVAL = 10000 // 10 seg
      const app = new App({})
      const map = L.map('map').setView([-25.441105, -49.276855], 15)
      const osm = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', { attribution: 'OMS' }).addTo(map)
      const greenTruckIcon = L.icon({ iconUrl: "{{ asset('material') }}/img/green_truck.png", iconSize: [35, 25] })
      const redTruckIcon = L.icon({ iconUrl: "{{ asset('material') }}/img/red_truck.png", iconSize: [35, 25] })
      const startTrackIcon = L.icon({ iconUrl: "{{ asset('material') }}/img/start_track.png", iconSize: [25, 25] })
      const endTrackIcon = L.icon({ iconUrl: "{{ asset('material') }}/img/end_track.png", iconSize: [25, 25] })

      function addOSMap(osId, gerador, destinador, veiculo, motorista, codigo_os, addMark = true) {
        const geradorPopup = `<b>Gerador:</b> ${gerador.name}<br><b>Codigo OS:</b> ${codigo_os}`
        const destinadorPopup = `<b>Destinador:</b> ${destinador.name}<br><b>Codigo OS:</b> ${codigo_os}`
        const truckPopup = `<b>Veiculo:</b> ${veiculo}<br><b>Motorista:</b> ${motorista}<br><b>Codigo OS:</b> ${codigo_os}`

        const control = L.Routing.control({
          show: false,
          addWaypoints: false,
          draggableWaypoints: false,
          fitSelectedRoutes: false,
          waypoints: [
            L.latLng(gerador.coord.lat, gerador.coord.lng),
            L.latLng(destinador.coord.lat, destinador.coord.lng)
          ],
          lineOptions: {
            styles: [{color: getRandomColor(), opacity: 1, weight: 7}],
            addWaypoints: false
          },
          createMarker: function (index, waypoint, n) {
            return L.marker(waypoint.latLng, {
              icon: !index ? startTrackIcon : endTrackIcon
            }).bindPopup(!index ? geradorPopup : destinadorPopup)
          }
        })
        .addTo(map)

        const marker = L.marker([parseFloat(gerador.coord.lat) + 0.00005, parseFloat(gerador.coord.lng) + 0.00005], {icon: redTruckIcon}).bindPopup(truckPopup).addTo(map)
        osData = osData.map(currOs => {
          return currOs.id == osId ? {
            ...currOs,
            layer: control,
            mark: marker
          } : currOs
        })
      }
        
      function getAllOS(callback) {
        app.api.get('/estagio_os').then(response => {
          if (response && response.status) {
            const estagioAguardandoColetaId = response.data.find(curr => curr.descricao.toLowerCase() == 'aguardando coleta')?.id
            const estagioTransporteId = response.data.find(curr => curr.descricao.toLowerCase() == 'transporte')?.id
            app.api.get(`/os?estagio_id=${estagioAguardandoColetaId},${estagioTransporteId}`).then(response =>  {
              if (response && response.status) {
                osData = response.data
                loadSelect('#ordem_servicos', response.data, ['id', 'codigo'])
                for (let i = 0; i < response.data.length; i++) {
                  const gerador = {
                    name: response.data[i].gerador,
                    coord: response.data[i].gerador_coord
                  }
                  const destinador = {
                    name: response.data[i].destinador,
                    coord: response.data[i].destinador_coord
                  }
                  const osId = response.data[i].id
                  addOSMap(osId, gerador, destinador, response.data[i].veiculo, response.data[i].motorista, response.data[i].codigo)
                }
                callback()
              }
            })
            .catch(error => notifyDanger('Falha ao obter mapa, tente novamente'))
          } else {
            notifyDanger('Falha ao obter estagios, tente novamente')
          }
        }).catch(error => notifyDanger('Falha ao obter dados. Tente novamente'))
      }

      getAllOS(() => {
        if (!mainInterval && osData.length > 0) {
          mainInterval = setInterval(() => {
            osData.map(curr => getLastLocation(curr.id))
          }, INTERVAL)
        }
      })

      $('body').on('click', '#novoFiltro', function() {
        $("#modalMapaSearch").modal("show")
      })
      
      $('body').on('click', '#pesquisaMap', function() {
        notifyWarning('Filtro inativo, ainda em processo')
      })

      $('body').on('change', '#ordem_servicos', function(event) {
        mainInterval && clearInterval(mainInterval)
        currentInterval && clearInterval(currentInterval)
        osData.map(curr => {
          curr.layer.remove(map)
          curr.mark.remove(map)
        })
        const currentOS = osData.find(curr => curr.id == event.target.value)
        const gerador = { name: currentOS.gerador, coord: currentOS.gerador_coord }
        const destinador = { name: currentOS.destinador, coord: currentOS.destinador_coord }
        addOSMap(currentOS.id, gerador, destinador, currentOS.veiculo, currentOS.motorista, currentOS.codigo)
        getLastLocation(currentOS.id)
        currentInterval = setInterval(() => {
          getLastLocation(currentOS.id)
        }, INTERVAL)
      })

      function getLastLocation(osId) {
        app.api.get(`/rastreamentos/${osId}?ultimo`).then(response => {
          if (response && response.status) {
            const { rastreamentos } = response.data
            const coordinates = [
              rastreamentos.latitude,
              rastreamentos.longitude,
            ]
            osData = osData.map(currOs => {
              const truck = currOs.estagio.toLowerCase() == 'transporte'
                ? greenTruckIcon
                : redTruckIcon
              const truckPopup = currOs.mark._popup._content
              const isCurrentOS = currOs.id == osId

              if (isCurrentOS) {
                currOs.mark.remove(map)
              }

              return isCurrentOS ? {
                ...currOs,
                mark: L.marker(coordinates, {icon: truck}).bindPopup(truckPopup).addTo(map)
              } : currOs
            })
          }
        }).catch(error => notifyDanger('Falha ao obter dados. Tente novamente'))
      }
    })
  </script>
@endpush