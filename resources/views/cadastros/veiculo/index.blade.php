@extends('layouts.app', ['activePage' => 'veiculo', 'titlePage' => __('Veiculo')])
@section('css')
@endsection
@section('subheaderTitle')
  Cadastros
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoVeiculo">+ Novo Veiculo</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Cadastros</h4>
              <p class="card-category">Veiculos</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="veiculoTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Empresa</th>
                    <th class="text-primary font-weight-bold">Placa</th>
                    <th class="text-primary font-weight-bold">Chassis</th>
                    <th class="text-primary font-weight-bold">Capacidade</th>
                    <th class="text-primary font-weight-bold">Renavam</th>
                    <th class="text-primary font-weight-bold">Combustivel</th>
                    <th class="text-primary font-weight-bold">Modelo</th>
                    <th class="text-primary font-weight-bold">Marca</th>
                    <th class="text-primary font-weight-bold">Acondicionamento</th>
                    <th class="text-primary font-weight-bold">Ativo</th>
                    <th class="text-primary font-weight-bold">Ação</th>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
 @include('cadastros.veiculo.modal')
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      let app = new App({
        apiUrl: '/api/veiculo',
        apiDataTableColumns: [
          { data: "pessoa_juridica" },
          { data: "placa" },
          { data: "chassis" },
          { data: "capacidade_media_carga" },
          { data: "renavam" },
          { data: "combustivel" },
          { data: "modelo" },
          { data: "marca" },
          { data: "acondicionamento" },
          {
            data: "ativo",
            className: "text-center",
            orderable: false,
            render: function (data, type, row) {
              return `<i class="fas fa-${data ? 'check' : 'times'} cursor-pointer changeStatus" data-id="${row.id}" data-value-old="${data}" title="Deseja atualizar o status?"></i>`
            }
          }
        ],
        apiDataTableColumnsDefs : [
          { width: "180px", targets: [0,1,2,3,4,5,6,7,8,9,10] },
        ],
        datatableSelector: '#veiculoTbl'
      })
     
      // Open Modal New
      $('body').on('click', '#novoVeiculo', function() {
        app.stepper()
        delFormValidationErrors()
        $("#modalVeiculo").modal("show")
        $('#tituloModal').text("Novo Veiculo")
        $('#input_id').val("")
        $('#formVeiculo')[0].reset()
        getMarca()
        getModelo()
        getAcondicionamento()
        getEmpresa({{ Auth::user()->pessoa_juridica_id }}, true)
        getCombustivel()
        maskPeso("#input_capacidade_media_carga")
      })

      // Salvar
      $('body').on('click', '#salvarVeiculo', function() {
        const JSONRequest = {
          placa: $("#input_placa").val(),
          chassis: $("#input_chassis").val(),
          capacidade_media_carga: formatStringToFloat($("#input_capacidade_media_carga").val()),
          renavam: $("#input_renavam").val(),
          combustivel: $("#input_combustivel").val(),
          modelo_id: $("#input_modelo_id").val(),
          marca_id: $("#input_marca_id").val(),
          acondicionamento_id: $("#input_acondicionamento_id").val(),
          pessoa_juridica_id: $("#input_pessoa_juridica_id").val(),
        }
        const id = $('#inputId').val()
        if (id) {
          app.api.put(`/veiculo/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalVeiculo").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Veiculo atualizado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar o veiculo, tente novamente')
          })
        } else {
          app.api.post('/veiculo', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalVeiculo").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Veiculo Criado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao criar veiculo, tente novamente')
          })
        }
      });

      // Editar
      $('body').on('click', '.editAction', function() {
        app.stepper()
        const id = $(this).attr('data-id');
        app.api.get(`/veiculo/${id}`).then(response =>  {
          if (response && response.status) {
            getMarca(response.data.marca_id)
            getModelo(response.data.modelo_id)
            getAcondicionamento(response.data.acondicionamento_id)
            getEmpresa(response.data.pessoa_juridica_id, true)
            getCombustivel(response.data.combustivel)
            delFormValidationErrors()
            $('#formVeiculo')[0].reset()
            $("#modalVeiculo").modal("show")
            $('#tituloModal').text("Editar Veiculo")
            $('#inputId').val(response.data.id)
            $("#input_placa").val(response.data.placa)
            $("#input_chassis").val(response.data.chassis)
            $("#input_renavam").val(response.data.renavam)
            $("#input_combustivel").val(response.data.combustivel)
            maskPeso("#input_capacidade_media_carga", formatFloatToString(response.data.capacidade_media_carga))
          }
        })
        .catch(error => console.log(error) && notifyDanger('Falha ao obter detalhes do veiculo. Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction',  function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/veiculo/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('veiculo excluída com sucesso')
            }).catch(error => notifyDanger('Falha ao excluir. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      })

      function getMarca(value) {
        app.api.get('/marca').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_marca_id', response.data, ['id', 'descricao'], value)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter marca, tente novamente')
        })
      }

      function getModelo(value) {
        app.api.get('/modelo').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_modelo_id', response.data, ['id', 'descricao'], value)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter modelo, tente novamente')
        })
      }

      function getAcondicionamento(value) {
        app.api.get('/acondicionamento').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_acondicionamento_id', response.data, ['id', 'descricao'], value)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter acondicionamento, tente novamente')
        })
      }

      function getCombustivel(value) {
        const data = [
          { id: 1, descricao: 'Diesel' },
          { id: 2, descricao: 'Diesel S10' },
          { id: 3, descricao: 'Gasolina' },
          { id: 4, descricao: 'Bio-Diesel' },
          { id: 5, descricao: 'Alcool' }
        ]
        loadSelect('#input_combustivel', data, ['id', 'descricao'], value)
      }      

      function getEmpresa(value, disabled) {
        app.api.get('/pessoa_juridica').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_pessoa_juridica_id', response.data, ['id', 'razao_social'], value, disabled)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter acondicionamento, tente novamente')
        })
      }

      // Change status
      $('body').on('click', '.changeStatus', function() {
        sweetConfirm('Deseja realmente atualizar?').then(confirmed => {
          if (confirmed) {
            const id = $(this).attr('data-id')
            const valueOld = $(this).attr('data-value-old')
            app.api.put(`/veiculo/${id}/status`, { ativo: parseInt(valueOld) ? 0 : 1 }).then(response =>  {
              if (response && response.status) {
                app.datatable.ajax.reload()
                notifySuccess('Atualizada com sucesso')
              } else {
                notifySuccess('Não foi possível atualizar, tente novamente')
              }
            })
            .catch(error => notifyDanger('Falha ao atualizar. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      })
    })
  </script>
@endpush