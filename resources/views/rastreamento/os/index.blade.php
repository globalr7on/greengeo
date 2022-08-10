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
                    <th class="text-primary font-weight-bold" style="width:5%">OS</th>
                    <th class="text-primary font-weight-bold" style="width:10%">Emissão</th>
                    <th class="text-primary font-weight-bold" style="width:10%">Integração</th>
                    <th class="text-primary font-weight-bold" style="width:auto">Gerador</th>
                    <th class="text-primary font-weight-bold" style="width:auto">Transportador</th>
                    <th class="text-primary font-weight-bold" style="width:auto">Destinador</th>
                    <th class="text-primary font-weight-bold" style="width:5%">MTR</th>
                    <th class="text-primary font-weight-bold" style="width:7%">Estágio</th>
                    <th class="text-primary font-weight-bold text-center" style="width:10%">Ação</th>
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
          { data: "emissao" },
          { data: "integracao" },
          { data: "gerador" },
          { data: "transportador" },
          { data: "destinador" },
          { data: "mtr" },
          { data: "estagio" },
        ],
        useDefaultDataTableColumnDefs: false,
        apiDataTableColumnDefs : [
          {
            targets : 8,
            className: "text-center",
            render : function (data, type, row) {
              const deleteBtn = row.estagio == 'Emitida' ? `<i class="fa fa-trash cursor-pointer deleteAction" data-id="${row.id}" title="Excluir"></i>&nbsp;` : ''
              const editBtn = row.estagio == 'Emitida' ? `<i class="fa fa-pen cursor-pointer editAction" data-id="${row.id}" title="Editar"></i>&nbsp;` : ''
              const addPhotoBtn = `<i class="fa-solid fa-cloud-arrow-up cursor-pointer novaFoto" data-id="${row.id}" title="Adicionar Foto"></i>&nbsp;`
              const updateStatusColetaBtn = row.estagio == 'Emitida'
                ? `<i class="fas fa-hourglass-half cursor-pointer updateStatusColeta" data-id="${row.id}" title="Aguardando Coleta"></i>&nbsp;`
                : ''
              const updateStatusTransporteBtn = row.estagio == 'Aguardando Coleta'
                ? `<i class="fas fa-truck cursor-pointer updateStatusTransporte" data-id="${row.id}" title="Transporte"></i>&nbsp;`
                : ''
              const updateStatusEntregueBtn = row.estagio == 'Transporte'
                ? `<i class="fas fa-truck-loading cursor-pointer updateStatusEntregue" data-id="${row.id}" title="Entregue"></i>&nbsp;`
                : ''

              return `${deleteBtn}${editBtn}${addPhotoBtn}${updateStatusColetaBtn}${updateStatusTransporteBtn}${updateStatusEntregueBtn}`
            }
          }
        ],
        useDefaultDataTableColumnDefs: false,
        datatableSelector: '#osTbl',
      })

      let tipoEmpresaData = []
      app.api.get('/tipo_empresa').then(response => {
        (response && response.status) && (tipoEmpresaData = response.data)
      }).catch(error => notifyDanger('Falha ao obter dados. Tente novamente'))
     
      // Open Modal New
      $('body').on('click', '#novaOs', function() {
        $('body').on('change', '#input_gerador_id', updateTransportadorFromGerador)
        $('body').on('change', '#input_transportador_id', updateMotoristaFromTransportador)
        app.stepper()
        delFormValidationErrors()
        $("#modalOs").modal("show")
        $('#tituloModal').text("Nova OS")
        $('#input_id').val("")
        $('#formOs')[0].reset()
        getEstagio('Emitida', true, true)
        const usuarioResponsavelCadastroId = $('#input_usuario_responsavel_cadastro_id').val()
        const tipoEmpresaGerador = tipoEmpresaData.find(curr => curr.descricao.toLowerCase() == 'gerador')?.id
        getEmpresa(null, '#input_gerador_id', usuarioResponsavelCadastroId, tipoEmpresaGerador, true)
        getEmpresa(null, '#input_destinador_id', null, null, false, true, true)
        getEmpresa(null, '#input_transportador_id', null, null, false, true, true)
        getMotorista(null, null, true, true)
        getVeiculo(null, null, true, true)
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
        $('body').off('change', '#input_gerador_id', updateTransportadorFromGerador)
        $('body').off('change', '#input_transportador_id', updateMotoristaFromTransportador)
        app.stepper()
        const id = $(this).attr('data-id');
        app.api.get(`/os/${id}`).then(response =>  {
          if (response && response.status) {
            getEmpresa(response.data.gerador_id, '#input_gerador_id', null, null, false, false, true)
            getEmpresa(response.data.destinador_id, '#input_destinador_id', null, null, false, false, true)
            getEmpresa(response.data.transportador_id, '#input_transportador_id', null, null, false, false, true)
            getMotorista(response.data.motorista_id, null, false, true)
            getVeiculo(response.data.veiculo_id, null, false, true)
            getEstagio(response.data.estagio_id, true)
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

      function getEmpresa(value, selector, usuarioResponsavelId, tipoEmpresaId, showCurrentEmpresa = false, withoutData, disabled) {
        if (withoutData) {
          loadSelect(selector, [], [], null, disabled)
        } else {
          const usuarioResponsavel = usuarioResponsavelId ? `&usuario_responsavel_cadastro_id=${usuarioResponsavelId}` : ''
          const tipoEmpresa = tipoEmpresaId ? `&tipo_empresa_id=${tipoEmpresaId}` : ''
          const url = `/pessoa_juridica?show_current_empresa=${showCurrentEmpresa}${tipoEmpresa}${usuarioResponsavel}`
          app.api.get(url).then(response =>  {
            if (response && response.status) {
              loadSelect(selector, response.data, ['id', 'razao_social'], value, disabled)
            }
          })
          .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
        }
      }

      function getMotorista(value, empresaId, withoutData, disabled) {
        if (withoutData) {
          loadSelect('#input_motorista_id', [], [], null, disabled)
        } else {
          const empresa = empresaId ? `?pessoa_juridica_id=${empresaId}&funcao=motorista` : ''
          app.api.get(`/users${empresa}`).then(response =>  {
            if (response && response.status) {
              loadSelect('#input_motorista_id', response.data, ['id', 'name'], value, disabled)
            }
          })
          .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
        }
      }

      function mergeVeiculoOption(value) {
        const optionValue = value.id
        const optionText = `${value.marca} [${value.modelo}]: ${value.placa} - ${value.capacidade_media_carga}Kg`
        return [optionValue, optionText]
      }

      function getVeiculo(value, empresaId, withoutData, disabled = false) {
        if (withoutData) {
          loadSelect('#input_veiculo_id', [], [], null, disabled)
        } else {
          const empresa = empresaId ? `?pessoa_juridica_id=${empresaId}` : ''
          app.api.get(`/veiculo${empresa}`).then(response =>  {
            if (response && response.status) {
              loadSelect('#input_veiculo_id', response.data, ['id', 'placa'], value, disabled, mergeVeiculoOption)
            }
          })
          .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
        }
      }

      function getEstagio(value, disabled, byText) {
        app.api.get('/estagio_os').then(response =>  {
          if (response && response.status) {
            if (byText) {
              value = response.data.find(curr => curr.descricao == value)?.id
            }
            loadSelect('#input_estagio_id', response.data, ['id', 'descricao'], value, disabled)
          }
        })
        .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
      }

      function updateTransportadorFromGerador() {
        const tipoEmpresaDestinadorId = tipoEmpresaData.find(curr => curr.descricao.toLowerCase() == 'destinador')?.id
        const tipoEmpresaTransportadorId = tipoEmpresaData.find(curr => curr.descricao.toLowerCase() == 'transportador')?.id
        const usuarioResponsavelCadastroId = $('#input_usuario_responsavel_cadastro_id').val()
        getEmpresa(null, '#input_destinador_id', usuarioResponsavelCadastroId, tipoEmpresaDestinadorId)
        getEmpresa(null, '#input_transportador_id', usuarioResponsavelCadastroId, tipoEmpresaTransportadorId)
      }

      function updateMotoristaFromTransportador() {
        const transportadorId = $('#input_transportador_id').val()
        getMotorista(null, transportadorId)
        getVeiculo(null, transportadorId)
      }
    })
  </script>
@endpush