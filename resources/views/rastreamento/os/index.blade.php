@extends('layouts.app', ['activePage' => 'os', 'titlePage' => __('Ordem de Serviço')])
@section('subheaderTitle')
  Administrativo
@endsection
@section('content')
   <div class="content mt-0">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novaOs">
         + Nova OS
        </button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Cadastros</h4>
              <p class="card-category">Ordem de Servico</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="osTbl">
                  <thead>
                  <th class="text-primary font-weight-bold">OS</th>
                    <th class="text-primary font-weight-bold">Integração</th>
                    <th class="text-primary font-weight-bold">Gerador</th>
                    <th class="text-primary font-weight-bold">Transportador</th>
                    <th class="text-primary font-weight-bold">Estágio</th>
                    <th class="text-primary font-weight-bold">Destinador</th>
                    <th class="text-primary font-weight-bold">Emissão</th>
                    <th class="text-primary font-weight-bold">MTR</th>
                    <th class="text-primary font-weight-bold text-center">Ação</th>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
   @include('rastreamento.os.modal')
   @include('rastreamento.os.modalFotos')
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      let app = new App({
        apiUrl: '/api/os',
        apiDataTableColumns: [
          { data: 'id'},
          { data: "integracao" },
          { data: "gerador" },
          { data: "transportador" },
          { data: "estagio" },
          { data: "destinador" },
          { data: "emissao" },
          { data: "mtr" },
        ],
        apiDataTableColumnDefs : [
          {
            targets : 8,
            className: "text-center",
            render : function (data, type, row) {
              return `
                <i class="fa fa-trash cursor-pointer deleteAction" data-id="${row.id}"  title="Excluir" ></i>
                &nbsp;
                <i class="fa fa-pen cursor-pointer editAction" data-id="${row.id}"  title="Editar"></i>
                &nbsp;
                <i class="fa-solid fa-cloud-arrow-up cursor-pointer novaFoto" data-id="${row.id}"  title="Adicionar Foto"></i>
              `
            }
          }
        ],
        useDefaultDataTableColumnDefs: false,
        datatableSelector: '#osTbl',
      })
     
      // Open Modal New
      $('body').on('click', '#novaOs', function() {
        app.stepper()
        delFormValidationErrors()
        $("#modalOs").modal("show")
        $('#tituloModal').text("Nova OS")
        $('#input_id').val("")
        $('#formOs')[0].reset()
        getPessoaJuridica()
        getVeiculo()
        getMotorista()
        getEstagio()
      })

      // Open Modal novaFoto
      $('body').on('click', '.novaFoto', function() {
        const id = $(this).attr('data-id');
        $('#orden_servicio_id').val(id);
        $("#modalFoto").modal("show")
      })

      // Salvar
      $('body').on('click', '#salvarOs', function() {
        const JSONRequest = {
          estagio_id: $("#input_estagio_id").val(),
          gerador_id: $("#input_gerador_id").val(), 
          destinador_id: $("#input_destinador_id").val(),
          transportador_id: $("#input_transportador_id").val(),
          mtr: $("#input_mtr").val(),
          data_estagio: $("#input_data_estagio").val(),
          emissao: $("#input_emissao").val(),
          preenchimento: $("#input_preenchimento").val(),
          integracao: $("#input_integracao").val(),
          motorista_id: $("#input_motorista_id").val(),
          veiculo_id: $("#input_veiculo_id").val(),
          serie: $("#input_serie").val(),
          description: $("#input_description").val(),
          cdf_serial: '123456',
          cdf_ano:'2022',
          peso_total_os: '1234.21',
          area_total: '13456.22',
          peso_de_controle:'23456.2',
          nota_fiscal_id: 1,
        }
        const id = $('#input_id').val()
        if (id) {
          app.api.put(`/os/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalOs").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Atualizada com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar, tente novamente')
          })
        } else {
          app.api.post('/os', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalOs").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Criado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao criar, tente novamente')
          })
        }
      })

      // Editar
      $('body').on('click', '.editAction', function() {
        app.stepper()
        const id = $(this).attr('data-id');
        app.api.get(`/os/${id}`).then(response =>  {
          if (response && response.status) {
            getPessoaJuridica(response.data.gerador_id, response.data.destinador_id, response.data.transportador_id)
            getVeiculo(response.data.veiculo_id)
            getMotorista(response.data.motorista_id)
            getEstagio(response.data.estagio_id)
            delFormValidationErrors()
            $('#formOs')[0].reset()
            $("#modalOs").modal("show");
            $('#tituloModal').text("Editar Os")
            $('#input_id').val(response.data.id);
            $("#input_integracao").val(response.data.integracao)
            $("#input_emissao").val(response.data.emissao)
            $("#input_mtr").val(response.data.mtr)
            $("#input_serie").val(response.data.serie)
            $("#input_description").val(response.data.description)
            $("#input_data_estagio").val(response.data.data_estagio)
            $("#input_preenchimento").val(response.data.preenchimento)
          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes. Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction', function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/os/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('os excluída com sucesso')
            })
            .catch(error => notifyDanger('Falha ao excluir. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      })

      function getPessoaJuridica(valueGerador, valueDestinador, valueTransportador) {
        app.api.get('/pessoa_juridica').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_gerador_id', response.data, ['id', 'razao_social'], valueGerador)
            loadSelect('#input_destinador_id', response.data, ['id', 'razao_social'], valueDestinador)
            loadSelect('#input_transportador_id', response.data, ['id', 'razao_social'], valueTransportador)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter dados, tente novamente')
        })
      }

      function getVeiculo(value) {
        app.api.get('/veiculo').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_veiculo_id', response.data, ['id', 'placa'], value)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter dados, tente novamente')
        })
      }

      function getMotorista(value) {
        app.api.get('/users').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_motorista_id', response.data, ['id', 'name'], value)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter dados, tente novamente')
        })
      }

      function getEstagio(value) {
        app.api.get('/estagio_os').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_estagio_id', response.data, ['id', 'descricao'], value)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter dados, tente novamente')
        })
      }
    })
  </script>
@endpush