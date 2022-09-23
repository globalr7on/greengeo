@extends('layouts.app', ['activePage' => 'os', 'titlePage' => __('Ordem de Serviço')])
@section('subheaderTitle')
  OS E Rastreamento
@endsection
@section('content')
  <style>
    .custom-loader {
      animation: none !important;
      border-width: 0 !important;
    }
  </style>
  <div class="content mt-0">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">OS E Rastreamento</h4>
              <p class="card-category">Ordem de Serviço</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="osTbl">
                  <thead>
                    <th class="text-primary font-weight-bold text-center" style="width:10%">Código</th>
                    <th class="text-primary font-weight-bold" style="width:8%">Emissão</th>
                    <th class="text-primary font-weight-bold" style="width:9%">Integração</th>
                    <th class="text-primary font-weight-bold" style="width:auto">Gerador</th>
                    <th class="text-primary font-weight-bold" style="width:auto">Transportador</th>
                    <th class="text-primary font-weight-bold" style="width:auto">Destinador</th>
                    <th class="text-primary font-weight-bold" style="width:9%">Peso Total</th>
                    <th class="text-primary font-weight-bold" style="width:12%">Estágio</th>
                    <th class="text-primary font-weight-bold text-center" style="width:8%">Ação</th>
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
  @include('rastreamento.os.modalGalleryFotos')
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      // fix issue with sweetInput and bootstrap modal
      $.fn.modal.Constructor.prototype._enforceFocus = function () {}
      const currentParentUserId = $('#parent_usuario_responsavel_id').val() ? parseInt($('#parent_usuario_responsavel_id').val()) : null
      const currentParentTipoEmpresaId = $('#parent_tipo_empresa_id').val() ? parseInt($('#parent_tipo_empresa_id').val()) : null
      const currentUserId = parseInt($('#input_usuario_responsavel_cadastro_id').val())
      const currentEmpresaId = $('#current_empresa_id').val()
      let notaFiscalsData = []
      let app = new App({
        apiUrl: '/api/os',
        apiDataTableColumns: [
          { data: 'codigo'},
          { data: "data_emissao" },
          { data: "data_integracao" },
          { data: "gerador" },
          { data: "transportador" },
          { data: "destinador" },
          { data: "peso_total" },
          { data: "estagio" },
        ],
        useDefaultDataTableColumnDefs: false,
        apiDataTableColumnDefs: [
          {
            targets: [0,7],
            className: "text-center",
          },
          {
            targets: 8,
            render: function (data, type, row) {
              const estagio = row.estagio.toLowerCase()
              const statusEsperandoMotorista = 'esperando motorista'
              const statusAgendada = 'agendada'
              const statusAguardandoColeta = 'aguardando coleta'
              const statusEmitida = 'emitida'
              const statusTransporte = 'transporte'
              const statusEntregue = 'entregue'
              // const deleteBtn = estagio == statusEmitida ? `<i class="fa fa-trash cursor-pointer deleteAction" data-id="${row.id}" title="Excluir"></i>&nbsp;` : ''
              const editBtn = estagio == statusAguardandoColeta && row.gerador_id == currentEmpresaId
                ? `<i class="fa fa-pen cursor-pointer editAction" data-id="${row.id}" title="Editar"></i>&nbsp;`
                : ''
              const showBtn = estagio !== statusAguardandoColeta ||  row.gerador_id !== currentEmpresaId
                ? `<i class="fas fa-list-alt cursor-pointer showAction" data-id="${row.id}" title="Mostrar"></i>&nbsp;`
                : ''
              const aguardandoColetaBtn = estagio == statusAgendada && row.motorista_id == currentUserId
                ? `<i class="fas fa-truck-loading cursor-pointer updateEstagio" data-id="${row.id}" title="Atualizar a ${statusAguardandoColeta}"></i>&nbsp;`
                : ''
              const transporteBtn = estagio == statusEmitida && row.motorista_id == currentUserId
                ? `<i class="fas fa-truck cursor-pointer updateEstagio" data-id="${row.id}" title="Atualizar a ${statusTransporte}"></i>&nbsp;`
                : ''
              const entregueBtn = estagio == statusTransporte && row.destinador_id == currentEmpresaId
                ? `<i class="fas fa-check-double cursor-pointer updateEstagio" data-id="${row.id}" title="Atualizar a ${statusEntregue}"></i>&nbsp;`
                : ''
              const addPhotoBtn = estagio == statusTransporte
                ? `<i class="fa-solid fa-cloud-arrow-up cursor-pointer novaFoto" data-id="${row.id}" data-codigo="${row.codigo}" title="Adicionar Foto"></i>&nbsp;`
                : ''
              const addMTRBtn = estagio == statusEmitida
                ? `<i class="fa-solid fa-trash-can-arrow-up cursor-pointer addMTR" data-id="${row.id}" title="Adicionar MTR"></i>&nbsp;`
                : ''
              const addCDFBtn = estagio == statusEntregue
                ? `<i class="fa-solid fa-square-check cursor-pointer addCDF" data-id="${row.id}" title="Adicionar CDF"></i>&nbsp;`
                : ''
              const listMotoristasBtn = `<i class="fa-solid fas fa-clipboard-list cursor-pointer listMotoristas" data-id="${row.id}" title="Lista motoristas"></i>&nbsp;`
              const addPesoControleTransBtn = estagio == statusEmitida
                ? `<i class="fas fa-weight cursor-pointer addPesoControleTrans" data-id="${row.id}" title="Adicionar Peso Controle Motorista"></i>&nbsp;`
                : ''
              const addPesoControleDestBtn = estagio == statusTransporte
                ? `<i class="fas fa-weight cursor-pointer addPesoControleDest" data-id="${row.id}" title="Adicionar Peso Controle Destinador"></i>&nbsp;`
                : ''
                
              const isMotoristaForApproval = row.aprovacao_motorista.length > 0 ? row.aprovacao_motorista[0].usuario_id == currentUserId : false
              if (isMotoristaForApproval && estagio == statusEsperandoMotorista) {
                const approvalBtn = `<i class="fas fa-check text-success cursor-pointer approvalAction" data-id="${row.id}" data-approval="1" title="Aceitar OS"></i>&nbsp;`
                const rejectBtn = `<i class="fas fa-times text-danger cursor-pointer approvalAction" data-id="${row.id}" data-approval="0" title="Recusar OS"></i>&nbsp;`
                return `${showBtn}${approvalBtn}${rejectBtn}`
              }

              return `${editBtn}${showBtn}${aguardandoColetaBtn}${transporteBtn}${entregueBtn}${addPhotoBtn}${addMTRBtn}${addCDFBtn}${listMotoristasBtn}${addPesoControleTransBtn}${addPesoControleDestBtn}`
            }
          }
        ],
        useDefaultDataTableColumnDefs: false,
        datatableSelector: '#osTbl',
      })
      getTratamentos()

      // Open Modal novaFoto
      $('body').on('click', '.novaFoto', function() {
        const id = $(this).attr('data-id')
        const codigo = $(this).attr('data-codigo')
        $('#imagensPreview').empty()
        $('#formImagens')[0].reset()
        $('#input_orden_servicio_id').val(id)
        $('#input_orden_servicio').val(codigo)
        $("#modalFoto").modal("show")
      })

      // Open Modal addMTR
      $('body').on('click', '.addMTR', function() {
        const id = $(this).attr('data-id')
        sweetInput({
          title: 'Carregar o MTR',
          input: 'file',
          inputAttributes: {
            'accept': 'application/pdf',
            'aria-label': 'Upload o MTR'
          },
          confirmButtonText: 'Subir',
          focusConfirm: false,
          buttonsStyling: false,
          showCancelButton: true,
          confirmButtonClass: 'btn btn-primary',
          cancelButtonClass: 'btn btn-danger',
          preConfirm: (value) => !value ? swal.showValidationError('Por favor, carregue o MTR') : value,
          errorCallback: (error) => notifyDanger('Ocorreu um erro ao carregar MTR, tente novamente'),
          successCallback: (result) => {
            if (result?.dismiss) return
            const data = new FormData()
            data.append('pdf', result.value)
            app.api.post(`/os/${id}/mtr`, data, true).then(response =>  {
              if (response && response.status) {
                notifySuccess('MTR enviado com sucesso')
              } else {
                notifyDanger('Falha ao carregar o MTR, tente novamente')
              }
            }).catch(error => notifyDanger('Falha ao carregar o MTR, tente novamente'))
          }
        })
      })

      // Open Modal addCDF
      $('body').on('click', '.addCDF', function() {
        const id = $(this).attr('data-id')
        sweetInput({
          title: 'Carregar o CDF',
          input: 'file',
          inputAttributes: {
            'accept': 'application/pdf',
            'aria-label': 'Upload o CDF'
          },
          confirmButtonText: 'Subir',
          focusConfirm: false,
          buttonsStyling: false,
          showCancelButton: true,
          confirmButtonClass: 'btn btn-primary',
          cancelButtonClass: 'btn btn-danger',
          preConfirm: (value) => !value ? swal.showValidationError('Por favor, carregue o CDF') : value,
          errorCallback: (error) => notifyDanger('Ocorreu um erro ao carregar CDF, tente novamente'),
          successCallback: (result) => {
            if (result?.dismiss) return
            const data = new FormData()
            data.append('pdf', result.value)
            app.api.post(`/os/${id}/cdf`, data, true).then(response =>  {
              if (response && response.status) {
                notifySuccess('CDF enviado com sucesso')
              } else {
                notifyDanger('Falha ao carregar o CDF, tente novamente')
              }
            }).catch(error => notifyDanger('Falha ao carregar o CDF, tente novamente'))
          }
        })
      })
      
      // Open Modal listMotoristas
      $('body').on('click', '.listMotoristas', function() {
        const id = $(this).attr('data-id')
        app.api.get(`/os/${id}`).then(response =>  {
          if (response && response.status) {
            let content = `
              <div class="row px-2 py-2" style="font-size: 16px;font-weight: bold;">
                <div class="col-4">Datas</div>
                <div class="col-3 text-left">Usuario</div>
                <div class="col-1 px-0">Status</div>
                <div class="col-4">Observacao</div>
              </div>
            `
            response.data.lista_motoristas.map(motorista => {
              const dateStart = new Date(motorista.data_inicio).toLocaleString()
              const dateEnd = new Date(motorista.data_final).toLocaleString()
              const status = motorista.status === 1
                ? '<i class="fas fa-check text-success" title="Aceitado"></i>'
                : motorista.status === 0
                  ? '<i class="fas fa-times text-danger" title="Recusou"></i>'
                  : '<i class="fas fa-minus" title="Por aprovação"></i>'
              content += `
                <div class="row px-2 py-2">
                  <div class="col-4 text-left pr-0"><i class="far fa-clock" title="Data inicio"></i> ${dateStart}<br/><i class="fas fa-clock" title="Data final"></i> ${dateEnd}</div>
                  <div class="col-3 text-left pl-0 align-self-center">${motorista.usuario.name}</div>
                  <div class="col-1 px-0 align-self-center">${status}</div>
                  <div class="col-4 text-left align-self-center"><i class="far fa-sticky-note"></i> ${motorista.observacao || 'Sem observação'}</div>
                </div>
              `
            })
            sweetInput({
              title: 'Lista Motoristas',
              width: '50em',
              html: content,
              confirmButtonText: 'Ok',
              focusConfirm: false,
              buttonsStyling: false,
              confirmButtonClass: 'btn btn-primary',
            })
          } else {
            notifyDanger('Falha ao obter detalhes. Tente novamente')
          }
        }).catch(error => notifyDanger('Falha ao obter detalhes. Tente novamente'))
      })

      // Open PDF Preview
      $('body').on('click', '.mtrPreview, .cdfPreview', function() {
        const isMTR = $(this).hasClass('mtrPreview')
        const url = isMTR ? $("#mtr_link").val() : $("#cdf_link").val()
        if (!url) {
          notifyWarning(`Não há ${isMTR ? 'MTR' : 'CDF'} para mostrar`)
        } else {
          window.open(url, '_blank')
        }
      })

      // Salvar
      $('body').on('click', '#salvarOs', function() {
        const produtosData = $('#produtosTbl').DataTable().data().toArray().map(curr => ({
          id: curr.id,
          produto_id: curr.produto_id,
          peso: formatStringToFloat(curr.peso),
          quantidade: curr.quantidade,
          observacao: curr.observacao,
          tratamento_id: curr.tratamento_id,
        }))
        if (produtosData.some(curr => !curr.tratamento_id)) {
          return notifyDanger('Por favor, adicione o tratamento sobre os produtos')
        }
        const dataEstagio = $("#input_data_estagio").val() ? $.fullCalendar.moment($("#input_data_estagio").val(), 'DD-MM-YYYY').format('YYYY-MM-DD') : null
        const dataEmissao = $("#input_data_emissao").val() ? $.fullCalendar.moment($("#input_data_emissao").val(), 'DD-MM-YYYY').format('YYYY-MM-DD') : null
        const dataPreenchimento = $("#input_data_preenchimento").val() ? $.fullCalendar.moment($("#input_data_preenchimento").val(), 'DD-MM-YYYY').format('YYYY-MM-DD') : null
        const dataIntegracao = $("#input_data_integracao").val() ? $.fullCalendar.moment($("#input_data_integracao").val(), 'DD-MM-YYYY').format('YYYY-MM-DD') : null
        const dataInicioColeta = $("#input_data_inicio_coleta").val() ? $.fullCalendar.moment($("#input_data_inicio_coleta").val(), 'DD-MM-YYYY HH:mm:ss').format('YYYY-MM-DD HH:mm:ss') : null
        const dataFinalColeta = $("#input_data_final_coleta").val() ? $.fullCalendar.moment($("#input_data_final_coleta").val(), 'DD-MM-YYYY HH:mm:ss').format('YYYY-MM-DD HH:mm:ss') : null
        const JSONRequest = {
          gerador_id: $("#input_gerador_id").val(), 
          destinador_id: $("#input_destinador_id").val(),
          transportador_id: $("#input_transportador_id").val(),
          data_estagio: dataEstagio,
          data_emissao: dataEmissao,
          data_preenchimento: dataPreenchimento,
          data_integracao: dataIntegracao,
          motorista_id: $("#input_motorista_id").val(),
          veiculo_id: $("#input_veiculo_id").val(),
          description: $("#input_description").val(),
          acondicionamento_id: $("#input_acondicionamento_id").val(),
          data_inicio_coleta: dataInicioColeta,
          data_final_coleta: dataFinalColeta,
          responsavel_id: currentUserId,
          produtos: produtosData
        }
        const id = $('#input_id').val()
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
      })

      // Editar
      $('body').on('click', '.editAction, .showAction', function() {
        const onlyShow = $(this).hasClass("showAction")
        app.stepper()
        const id = $(this).attr('data-id')
        app.api.get(`/os/${id}`).then(response =>  {
          if (response && response.status) {
            const dataEstagio = response.data.data_estagio ? $.fullCalendar.moment(response.data.data_estagio, 'YYYY-MM-DD').format('DD-MM-YYYY') : null
            const dataEmissao = response.data.data_emissao ? $.fullCalendar.moment(response.data.data_emissao, 'YYYY-MM-DD').format('DD-MM-YYYY') : null
            const dataPreenchimento = response.data.data_preenchimento ? $.fullCalendar.moment(response.data.data_preenchimento, 'YYYY-MM-DD').format('DD-MM-YYYY') : null
            const dataIntegracao = response.data.data_integracao ? $.fullCalendar.moment(response.data.data_integracao, 'YYYY-MM-DD').format('DD-MM-YYYY') : null
            const dataInicioColeta = response.data.data_inicio_coleta ? $.fullCalendar.moment(response.data.data_inicio_coleta, 'YYYY-MM-DD HH:mm:ss').format('DD-MM-YYYY HH:mm:ss') : null
            const dataFinalColeta = response.data.data_final_coleta ? $.fullCalendar.moment(response.data.data_final_coleta, 'YYYY-MM-DD HH:mm:ss').format('DD-MM-YYYY HH:mm:ss') : null
            getEmpresa(response.data.gerador_id, '#input_gerador_id', null, null, false, false, true)
            getEmpresa(response.data.destinador_id, '#input_destinador_id', null, null, false, false, true)
            getEmpresa(response.data.transportador_id, '#input_transportador_id', null, null, false, false, true)
            getMotorista(response.data.motorista_id, response.data.transportador_id, false, response.data.motorista_id ? true : false)
            getVeiculo(response.data.veiculo_id, response.data.transportador_id, false, response.data.veiculo_id ? true : false)
            delFormValidationErrors()
            $('#formOs')[0].reset()
            $("#modalOs").modal("show")
            $('#tituloModal').text("Editar OS")
            $('#input_id').val(response.data.id)
            $('#input_acondicionamento_id').val(response.data.acondicionamento_id)
            $("#input_data_estagio").val(dataEstagio).attr('disabled', onlyShow)
            $("#input_data_emissao").val(dataEmissao).attr('disabled', onlyShow)
            $("#input_data_preenchimento").val(dataPreenchimento).attr('disabled', onlyShow)
            $("#input_data_integracao").val(dataIntegracao).attr('disabled', onlyShow)
            $("#input_data_inicio_coleta").val(dataInicioColeta).attr('disabled', true)
            $("#input_data_final_coleta").val(dataFinalColeta).attr('disabled', true)
            $("#input_description").val(response.data.description).attr('disabled', onlyShow)
            $("#imagensData").val(JSON.stringify(response.data.imagens))
            $("#mtr_link").val(response.data.mtr_link)
            $("#cdf_link").val(response.data.cdf_link)
            initProdutoDataTable(response.data.itens.map((item, pos) => {
              return {
                id: item.id,
                disabledBtn: onlyShow,
                position: pos + 1,
                codigo: item.produto.codigo,
                ean: item.produto.ean,
                descricao: item.produto.descricao,
                peso: formatFloatToString(item.peso),
                peso_controle_transportador: formatFloatToString(item.peso_controle_transportador),
                peso_controle_destinador: formatFloatToString(item.peso_controle_destinador),
                produto_id: item.produto.id,
                quantidade: item.quantidade,
                observacao: item.observacao,
                tratamento: item?.tratamento?.descricao,
                tratamento_id: item.tratamento_id,
              }
            }))
            if (onlyShow) {
              $("#salvarOs").hide()
              $('.showFotos').show()
              $('.cdfPreview').show()
              $('.mtrPreview').show()
            } else {
              $("#salvarOs").show()
              $('.showFotos').hide()
              $('.cdfPreview').hide()
              $('.mtrPreview').hide()
            }
          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes. Tente novamente'))
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

      function getVeiculo(value, empresaId, withoutData, disabled = false) {
        if (withoutData) {
          loadSelect('#input_veiculo_id', [], [], null, disabled)
        } else {
          const empresa = empresaId ? `?pessoa_juridica_id=${empresaId}` : ''
          app.api.get(`/veiculo${empresa}`).then(response =>  {
            if (response && response.status) {
              loadSelect('#input_veiculo_id', response.data, [], value, disabled, (option) => {
                return [
                  option.id,
                  `${option.marca} [${option.modelo}]: ${option.placa} - ${option.capacidade_media_carga}Kg`
                ]
              })
            }
          })
          .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
        }
      }

      // Salvar imagens
      $('body').on('click', '#salvarImagens', function() {
        const ordenServicioId = $('#input_orden_servicio_id').val()
        const imagens = $('form#formImagens input[type="file"]')[0].files
        const data = new FormData()
        data.append('orden_servicio_id', ordenServicioId)
        for (let i = 0; i < imagens.length; i++) {
          data.append('imagens[]', imagens[i])
        }

        app.api.post('/imagens', data, true).then(response => {
          if (response && response.status) {
            $("#modalFoto").modal("hide")
            notifySuccess('Salvado com sucesso')
          }
        })
        .catch(error => Object.keys(error?.data).map(curr => error.data[curr].map(error => notifyDanger(error))))
      })

      // Update estagio
      $('body').on('click', '.updateEstagio', function() {
        const title = $(this).attr('title')?.toLowerCase()
        sweetConfirm(`Deseja realmente ${title}?`).then(confirmed => {
          if (confirmed) {
            const id = $(this).attr('data-id')
            app.api.put(`/os/${id}/estagio`).then(response => {
              if (response && response.status) {
                app.datatable.ajax.reload()
                notifySuccess('Atualizada com sucesso')
              }
            })
            .catch(error => notifyDanger('Falha ao atualizar, tente novamente'))
          }
        })
      })
      
      function getTratamentos() {
        app.api.get('/tratamento').then(response =>  {
          if (response && response.status) {
            $('#tratamentoData').text(JSON.stringify(response.data || []))
          }
        })
        .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
      }

      $('body').on('click', '.addProdutos', function() {
        $("#modalProdutos").modal("show")
      })

      function initProdutoDataTable(data) {
        if ($.fn.dataTable.isDataTable('#produtosTbl')) {
          $('#produtosTbl').DataTable().clear().draw()
          $('#produtosTbl').DataTable().rows.add(data).draw()
        } else {
          $('#produtosTbl').DataTable({
            language: app.dataTableConfig.language,
            data: data,
            autoWidth: false,
            pageLength: 10,
            ordering: false,
            info: false,
            lengthChange: false,
            columns: [
              { data: 'position' },
              {
                data: 'produto',
                render: function (data, type, row, meta) {
                  return `
                    <div style="line-height: 1;">
                      <span class="d-block">[${row.codigo}]</span>
                      <small class="d-block">${row.descricao}</small>
                    </div>
                  `
                }
              },
              {
                data: 'peso',
                render: function (data, type, row, meta) {
                  return data ? data : ''
                }
              },
              {
                data: 'peso_controle_transportador',
                render: function (data, type, row, meta) {
                  return data ? data : ''
                }
              },
              {
                data: 'peso_controle_destinador',
                render: function (data, type, row, meta) {
                  return data ? data : ''
                }
              },
              {
                data: 'tratamento',
                render: function (data, type, row, meta) {
                  return data ? data : ''
                }
              },
              {
                data: 'observacao',
                render: function (data, type, row, meta) {
                  return data ? data : ''
                }
              },
            ],
            columnDefs: [
              {
                targets: 0,
                className: 'text-center',
                render: function (data, type, row, meta) {
                  row.position = row.position ? row.position : meta.row + 1
                  return row.position
                }
              },
              {
                targets: [2,3,4,5],
                className: 'text-center',
              },
              {
                targets: 7,
                className: 'text-center',
                render: function (data, type, row, meta) {
                  const addTratamentoBtn = `<i class="fas fa-recycle cursor-pointer addTratamentoAction" data-id="${row.id}" title="Adicionar tratamento"></i>`
                  const addObsBtn = `<i class="fas fa-clipboard cursor-pointer addObsAction" data-id="${row.id}" title="Adicionar observação"></i>`

                  return row?.disabledBtn ? '' : `<div class="d-flex align-items-center" style="justify-content:space-evenly">${addTratamentoBtn}${addObsBtn}</div>`
                }
              },
            ],
            footerCallback: function (row, data, start, end, display) {
              const dataTable = this.api().data().toArray()
              const totalPeso = dataTable.reduce((acc, curr) => acc + (formatStringToFloat(curr?.peso) || 0), 0)
              const totalPesoControleTrans = dataTable.reduce((acc, curr) => acc + (formatStringToFloat(curr?.peso_controle_transportador) || 0), 0)
              const totalPesoControleDest = dataTable.reduce((acc, curr) => acc + (formatStringToFloat(curr?.peso_controle_destinador) || 0), 0)
              $(this.api().column(2).footer()).html(formatFloatToString(totalPeso.toFixed(2)))
              $(this.api().column(3).footer()).html(formatFloatToString(totalPesoControleTrans.toFixed(2)))
              $(this.api().column(4).footer()).html(formatFloatToString(totalPesoControleDest.toFixed(2)))
            },
          })
        }
      }

      // Adicionar observacao al produto
      $('body').on('click', '.addObsAction', function() {
        const id = $(this).attr('data-id')
        sweetInput({
          title: 'Adicionar observação ao produto',
          showCancelButton: true,
          input: 'textarea',
          confirmButtonText: 'Adicionar',
          focusConfirm: false,
          allowOutsideClick: false,
          buttonsStyling: false,
          confirmButtonClass: 'btn btn-primary',
          cancelButtonClass: 'btn btn-danger',
          preConfirm: (value) => !value ? swal.showValidationError('Por favor, adicione uma observação') : value,
          errorCallback: (error) => notifyDanger('Ocorreu um erro ao adicionar a observação, tente novamente'),
          successCallback: (result) => {
            if (result?.dismiss) return
            const dataInTable = $('#produtosTbl').DataTable().data().toArray()
            const produtoIndex = dataInTable.findIndex(curr => curr.id == id)
            $('#produtosTbl').DataTable().row(produtoIndex).data({...dataInTable[produtoIndex], observacao: result.value}).draw(false)
          }
        })
      })

      // Adicionar tratamento ao produto
      $('body').on('click', '.addTratamentoAction', function() {
        const tratamentoData = JSON.parse($('#tratamentoData').text() || '[]')
        const id = $(this).attr('data-id')
        sweetInput({
          title: 'Selecione o tratamento ao produto',
          html: '<select id="tratamento" data-style="btn-warning text-white" title="Selecione"></select>',
          showCancelButton: true,
          confirmButtonText: 'Adicionar',
          focusConfirm: false,
          allowOutsideClick: false,
          buttonsStyling: false,
          confirmButtonClass: 'btn btn-primary',
          cancelButtonClass: 'btn btn-danger',
          onOpen: () => loadSelect('select#tratamento', tratamentoData, ['id', 'descricao']),
          preConfirm: () => {
            const id = $('select#tratamento').val()
            const text = $('select#tratamento option:selected').text()
            if (!id) {
              swal.showValidationError('Por favor, selecione o tratamento')
            }
            return { id, text }
          },
          errorCallback: (error) => notifyDanger('Ocorreu um erro ao adicionar ao tratamento, tente novamente'),
          successCallback: (result) => {
            if (result?.dismiss) return
            const dataInTable = $('#produtosTbl').DataTable().data().toArray()
            const produtoIndex = dataInTable.findIndex(curr => curr.id == id)
            $('#produtosTbl').DataTable().row(produtoIndex).data({...dataInTable[produtoIndex], ...{ tratamento_id: result.value.id, tratamento: result.value.text}}).draw(false)
          }
        })
      })

      // Adicionar Peso Controle Transportador
      $('body').on('click', '.addPesoControleTrans', function() {
        const id = $(this).attr('data-id')
        app.api.get(`/os/${id}`).then(response => {
          if (response && response.status) {
            let html = ''
            const items = response.data.itens.map(curr => {
              html += `
                <div class="row mx-0 mb-4">
                  <div class="col-md-7 text-left">
                    <div class="form-group pb-0 mt-0">
                      <label>Produto</label>
                      <input type="hidden" id="produto_id[]" value="${curr.id}">
                      <div style="line-height: 1;">
                        <span class="d-block">[${curr.produto.ean}] ${curr.produto.codigo}</span>
                        <small class="d-block">${curr.produto.descricao}</small>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-5 align-self-center">
                    <div class="form-group">
                      <label for="produto_peso_controle">Peso Controle</label>
                      <input type="text" class="form-control" id="produto_peso_controle_${curr.id}" ${curr.peso_controle_transportador ? 'disabled' : ''}>
                    </div>
                  </div>
                </div>
              `
              return curr
            })
            sweetInput({
              title: 'Adicione o peso controle',
              width: '30em',
              html: html,
              showCancelButton: true,
              confirmButtonText: 'Salvar',
              focusConfirm: false,
              allowOutsideClick: false,
              buttonsStyling: false,
              confirmButtonClass: 'btn btn-primary',
              cancelButtonClass: 'btn btn-danger',
              onOpen: () => items.map(curr => maskPeso(`#produto_peso_controle_${curr.id}`, curr.peso_controle_transportador)),
              preConfirm: () => {
                const ids = $("input[id='produto_id[]']").map(function(){ return $(this).val() }).get()
                const details = ids.map(curr => ({ id: curr, peso_controle: formatStringToFloat($(`#produto_peso_controle_${curr}`).val()) }))
                if (Object.values(details).some(curr => !curr.peso_controle)) {
                  swal.showValidationError('Por favor, adicione todos os pesos!')
                }
                return details
              },
              errorCallback: (error) => notifyDanger('Ocorreu um erro ao adicionar ao peso controle, tente novamente'),
              successCallback: (result) => {
                if (result?.dismiss) return
                app.api.post(`/os/${id}/peso_controle_motorista`, {itens: result?.value || []}).then(response => {
                  if (response && response.status) {
                    notifySuccess('Peso controle adicionada com sucesso')
                  } else {
                    notifyDanger('Falha ao salvar ao peso controle, tente novamente')
                  }
                }).catch(error => notifyDanger('Falha ao salvar ao peso controle, tente novamente'))
              }
            })
          } else {
            notifyDanger('Falha ao obter detalhes ao itens a OS. Tente novamente')
          }
        })
      })
      
      // Adicionar Peso Controle Destinador
      $('body').on('click', '.addPesoControleDest', function() {
        const id = $(this).attr('data-id')
        app.api.get(`/os/${id}`).then(response => {
          if (response && response.status) {
            let html = ''
            const items = response.data.itens.map(curr => {
              html += `
                <div class="row mx-0 mb-4">
                  <div class="col-md-7 text-left">
                    <div class="form-group pb-0 mt-0">
                      <label>Produto</label>
                      <input type="hidden" id="produto_id[]" value="${curr.id}">
                      <div style="line-height: 1;">
                        <span class="d-block">[${curr.produto.codigo}] ${curr.produto.descricao}</span>
                      </div>
                    </div>
                  </div>
                  
                  <div class="col-md-5 align-self-center">
                    <div class="form-group">
                      <label for="produto_peso_controle">Peso Controle</label>
                      <input type="text" class="form-control" id="produto_peso_controle_${curr.id}" ${curr.peso_controle_destinador ? 'disabled' : ''}>
                    </div>
                  </div>
                </div>
              `
              return curr
            })
            sweetInput({
              title: 'Adicione o peso controle',
              width: '30em',
              html: html,
              showCancelButton: true,
              confirmButtonText: 'Salvar',
              focusConfirm: false,
              allowOutsideClick: false,
              buttonsStyling: false,
              confirmButtonClass: 'btn btn-primary',
              cancelButtonClass: 'btn btn-danger',
              onOpen: () => items.map(curr => maskPeso(`#produto_peso_controle_${curr.id}`, curr.peso_controle_destinador)),
              preConfirm: () => {
                const ids = $("input[id='produto_id[]']").map(function(){ return $(this).val() }).get()
                const details = ids.map(curr => ({ id: curr, peso_controle: formatStringToFloat($(`#produto_peso_controle_${curr}`).val()) }))
                if (Object.values(details).some(curr => !curr.peso_controle)) {
                  swal.showValidationError('Por favor, adicione todos os pesos!')
                }
                return details
              },
              errorCallback: (error) => notifyDanger('Ocorreu um erro ao adicionar ao peso controle, tente novamente'),
              successCallback: (result) => {
                if (result?.dismiss) return
                app.api.post(`/os/${id}/peso_controle_destinador`, {itens: result?.value || []}).then(response => {
                  if (response && response.status) {
                    notifySuccess('Peso controle adicionada com sucesso')
                  } else {
                    notifyDanger('Falha ao salvar ao peso controle, tente novamente')
                  }
                }).catch(error => notifyDanger('Falha ao salvar ao peso controle, tente novamente'))
              }
            })
          } else {
            notifyDanger('Falha ao obter detalhes ao itens a OS. Tente novamente')
          }
        })
      })

      // Approval/Reject OS by motorista
      $('body').on('click', '.approvalAction', function() {
        const isApproval = parseInt($(this).attr('data-approval'))
        sweetConfirm(`Deseja realmente ${isApproval ? 'aceitar' : 'recusar'} la OS?`).then(confirmed => {
          if (confirmed) {
            const id = $(this).attr('data-id')
            const JSONRequest = {
              status: isApproval
            }
            if (isApproval) {
              app.api.put(`/os/${id}/aprovacao/`, JSONRequest).then(response => {
                if (response && response.status) {
                  app.datatable.ajax.reload()
                  notifySuccess('Atualizada com sucesso')
                }
              })
              .catch(error => notifyDanger('Falha ao atualizar, tente novamente'))
            } else {
              sweetInput({
                title: 'Razão para recusar a OS?',
                input: 'textarea',
                confirmButtonText: 'Enviar',
                focusConfirm: false,
                allowOutsideClick: false,
                buttonsStyling: false,
                confirmButtonClass: 'btn btn-primary',
                preConfirm: (value) => !value ? swal.showValidationError('Por favor, adicione uma observação') : value,
                errorCallback: (error) => notifyDanger('Ocorreu um erro, tente novamente'),
                successCallback: (result) => {
                  if (result?.dismiss) return
                  app.api.put(`/os/${id}/aprovacao/`, {...JSONRequest, observacao: result.value}).then(response => {
                    if (response && response.status) {
                      app.datatable.ajax.reload()
                      notifySuccess('Atualizada com sucesso')
                    }
                  })
                  .catch(error => notifyDanger('Falha ao atualizar, tente novamente'))
                }
              })
            }            
          }
        })
      })
    })
  </script>
@endpush