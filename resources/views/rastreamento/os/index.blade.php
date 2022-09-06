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
                    <th class="text-primary font-weight-bold text-center" style="width:10%">Codigo</th>
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
                
              const isMotoristaForApproval = row.aprovacao_motorista.length > 0 ? row.aprovacao_motorista[0].usuario_id == currentUserId : false
              if (isMotoristaForApproval && estagio == statusEsperandoMotorista) {
                const approvalBtn = `<i class="fas fa-check text-success cursor-pointer approvalAction" data-id="${row.id}" data-approval="1" title="Aceitar OS"></i>&nbsp;`
                const rejectBtn = `<i class="fas fa-times text-danger cursor-pointer approvalAction" data-id="${row.id}" data-approval="0" title="Recusar OS"></i>&nbsp;`
                return `${showBtn}${approvalBtn}${rejectBtn}`
              }

              return `${editBtn}${showBtn}${aguardandoColetaBtn}${transporteBtn}${entregueBtn}${addPhotoBtn}${addMTRBtn}${addCDFBtn}${listMotoristasBtn}`
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
          errorCallback: (error) => notifyDanger('Ocorreu um erro ao subir MTR, tente novamente'),
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
          errorCallback: (error) => notifyDanger('Ocorreu um erro ao subir CDF, tente novamente'),
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
          codigo: curr.codigo,
          ean: curr.ean,
          altura: formatStringToFloat(curr.altura),
          largura: formatStringToFloat(curr.largura),
          profundidade: formatStringToFloat(curr.profundidade),
          comprimento: formatStringToFloat(curr.comprimento),
          peso: formatStringToFloat(curr.peso),
          descricao: curr.descricao,
          especie: curr.especie,
          marca: curr.marca,
          produto_id: curr.produto_id,
          quantidade: curr.quantidade,
          numero_serie: curr.numero_serie,
          data_fabricacao: curr.data_fabricacao,
          observacao: curr.observacao,
          tratamento_id: curr.tratamento_id,
          unidade_id: curr.unidade_id,
          pessoa_juridica_id: curr.pessoa_juridica_id,
        }))
        if (!produtosData.length) {
          return notifyDanger('Por favor, adicione os produtos')
        }
        const JSONRequest = {
          gerador_id: $("#input_gerador_id").val(), 
          destinador_id: $("#input_destinador_id").val(),
          transportador_id: $("#input_transportador_id").val(),
          data_estagio: $("#input_data_estagio").val(),
          data_emissao: $("#input_data_emissao").val(),
          data_preenchimento: $("#input_data_preenchimento").val(),
          data_integracao: $("#input_data_integracao").val(),
          motorista_id: $("#input_motorista_id").val(),
          veiculo_id: $("#input_veiculo_id").val(),
          peso_controle: formatStringToFloat($("#input_peso_controle").val()),
          description: $("#input_description").val(),
          acondicionamento_id: $("#input_acondicionamento_id").val(),
          data_inicio_coleta: $("#input_data_inicio_coleta").val(),
          data_final_coleta: $("#input_data_final_coleta").val(),
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
            $("#input_data_estagio").val(response.data.data_estagio).attr('disabled', onlyShow)
            $("#input_data_emissao").val(response.data.data_emissao).attr('disabled', onlyShow)
            $("#input_data_preenchimento").val(response.data.data_preenchimento).attr('disabled', onlyShow)
            $("#input_data_integracao").val(response.data.data_integracao).attr('disabled', onlyShow)
            maskPeso("#input_peso_controle", formatFloatToString(response.data.peso_controle))
            $("#input_peso_controle").attr('disabled', onlyShow)
            $("#input_data_inicio_coleta").val(response.data.data_inicio_coleta).attr('disabled', true)
            $("#input_data_final_coleta").val(response.data.data_final_coleta).attr('disabled', true)
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
                altura: formatFloatToString(item.produto.altura),
                largura: formatFloatToString(item.produto.largura),
                profundidade: formatFloatToString(item.produto.profundidade),
                comprimento: formatFloatToString(item.produto.comprimento),
                peso: formatFloatToString(item.peso),
                descricao: item.produto.descricao,
                especie: item.produto.especie,
                marca: item.produto.marca,
                produto_id: item.produto.id,
                quantidade: item.quantidade,
                numero_serie: item.numero_serie,
                data_fabricacao: item.data_fabricacao,
                observacao: item.observacao,
                tratamento: item?.tratamento?.descricao,
                tratamento_id: item.tratamento_id,
                unidade: item.produto.unidade,
                unidade_id: item.produto.unidade_id,
                pessoa_juridica_id: item.produto.pessoa_juridica_id,
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
                      <span class="d-block">[${row.descricao}] ${row.ean}</span>
                      <small class="d-block">Marca: ${row.marca} - Especie: ${row.especie}</small>
                      <small class="d-block">Serie: ${row.numero_serie} (${row.data_fabricacao})</small>
                    </div>
                  `
                }
              },
              { data: 'altura' },
              { data: 'largura' },
              { data: 'profundidade' },
              { data: 'comprimento' },
              {
                data: 'peso',
                render: function (data, type, row, meta) {
                  return data ? `${data} ${row?.unidade}` : ''
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
                targets: [2,3,4,5,6,7],
                className: 'text-center',
              },
              {
                targets: 9,
                className: 'text-center',
                render: function (data, type, row, meta) {
                  const addDetailsBtn = `<i class="fas fa-clipboard-list cursor-pointer addDetailsAction" data-id="${row.id}" title="Adicionar details"></i>`
                  return row?.disabledBtn ? '' : addDetailsBtn
                }
              },
            ],
            footerCallback: function (row, data, start, end, display) {
              const dataTable = this.api().data().toArray()
              const totalPeso = dataTable.reduce((acc, curr) => acc + (formatStringToFloat(curr?.peso) || 0), 0)
              $(this.api().column(6).footer()).html(formatFloatToString(totalPeso.toFixed(2)))
            },
          })
        }
      }

      // Adicionar tratamento al produto
      $('body').on('click', '.addDetailsAction', function() {
        const tratamentoData = JSON.parse($('#tratamentoData').text() || '[]')
        const id = $(this).attr('data-id')
        const html = `
          <div class="row mx-0 mb-4">
            <div class="col-md-4">
              <div class="form-group">
                <label for="produto_ean">EAN</label>
                <input type="text" class="form-control" id="produto_ean">
              </div>
            </div>

            <div class="col-md-4">
              <div class="form-group">
                <label for="produto_especie">Especie</label>
                <input type="text" class="form-control" id="produto_especie">
              </div>
            </div>
            
            <div class="col-md-4">
              <div class="form-group">
                <label for="produto_marca">Marca</label>
                <input type="text" class="form-control" id="produto_marca">
              </div>
            </div>
          </div>

          <div class="row mx-0 mb-4">
            <div class="col-md-3">
              <div class="form-group">
                <label for=produto_altura">Altura</label>
                <input type="text" class="form-control" id="produto_altura">
              </div>
            </div>

            <div class="col-md-3">
              <div class="form-group">
                <label for="produto__largura">Largura</label>
                <input type="text" class="form-control" id="produto_largura">
              </div>
            </div>
            
            <div class="col-md-3">
              <div class="form-group">
                <label for="produto__profundidade">Profundidade</label>
                <input type="text" class="form-control" id="produto_profundidade">
              </div>
            </div>
            
            <div class="col-md-3">
              <div class="form-group">
                <label for="produto__comprimento">Comprimento</label>
                <input type="text" class="form-control" id="produto_comprimento">
              </div>
            </div>
          </div>

          <div class="row mx-0 mb-4">
            <div class="col-md-4">
              <div class="form-group">
                <label for="produto_tratamento" class="display-inherit mb-0">Tratamento</label>
                <select id="produto_tratamento" data-style="btn btn-warning text-white" title="Selecione"></select>
              </div>
            </div>

            <div class="col-md-4 align-self-center">
              <div class="form-group">
                <label for="produto_numero_serie">Numero Serie</label>
                <input type="text" class="form-control" id="produto_numero_serie">
              </div>
            </div>
            
            <div class="col-md-4 align-self-center">
              <div class="form-group">
                <label for="produto_data_fabricacao">Data Fabricação</label>
                <input type="text" class="form-control" id="produto_data_fabricacao">
              </div>
            </div>
          </div>

          <div class="row mx-0 mb-4">
            <div class="col-md-12">
              <div class="form-group">
                <label for="produto_observacao">Observação</label>
                <textarea class="form-control" id="produto_observacao" rows="3"></textarea>
              </div>
            </div>
          </div>
        `
        sweetInput({
          title: 'Preencha os dados do produto',
          width: '50em',
          html: html,
          showCancelButton: true,
          confirmButtonText: 'Adicionar',
          // showLoaderOnConfirm: true,
          focusConfirm: false,
          allowOutsideClick: false,
          buttonsStyling: false,
          confirmButtonClass: 'btn btn-primary',
          cancelButtonClass: 'btn btn-danger',
          onOpen: () => {
            loadSelect('select#produto_tratamento', tratamentoData, ['id', 'descricao'])
            maskPeso("#produto_altura")
            maskPeso("#produto_largura")
            maskPeso("#produto_profundidade")
            maskPeso("#produto_comprimento")
            $('#produto_data_fabricacao').datetimepicker({
              locale: 'pt-br',
              format: 'YYYY-MM-DD',
              icons: {
                time: "fa fa-clock-o",
                date: "fa fa-calendar",
                up: "fa fa-chevron-up",
                down: "fa fa-chevron-down",
                previous: 'fa fa-chevron-left',
                next: 'fa fa-chevron-right',
                today: 'fa fa-screenshot',
                clear: 'fa fa-trash',
                close: 'fa fa-remove'
              }
            })
          },
          preConfirm: () => {
            const details = {
              ean: $('#produto_ean').val(),
              especie: $('#produto_especie').val(),
              marca: $('#produto_marca').val(),
              altura: $('#produto_altura').val(),
              largura: $('#produto_largura').val(),
              profundidade: $('#produto_profundidade').val(),
              comprimento: $('#produto_comprimento').val(),
              tratamento_id: $('select#produto_tratamento').val(),
              tratamento: $('select#produto_tratamento option:selected').text(),
              numero_serie: $('#produto_numero_serie').val(),
              data_fabricacao: $('#produto_data_fabricacao').val(),
              observacao: $('#produto_observacao').val(),
            }
            if (Object.values(details).some(value => !value)) {
              swal.showValidationError('Por favor, adicione todos os dados!')
            }
            return details
          },
          errorCallback: (error) => notifyDanger('Ocorreu um erro ao adicionar ao dedos, tente novamente'),
          successCallback: (result) => {
            if (result?.dismiss) return
            const dataInTable = $('#produtosTbl').DataTable().data().toArray()
            const produtoIndex = dataInTable.findIndex(curr => curr.id == id)
            $('#produtosTbl').DataTable().row(produtoIndex).data({...dataInTable[produtoIndex], ...result.value || {}}).draw(false)
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
                preConfirm: (value) => !value ? swal.showValidationError('Por favor, adicione uma observacao') : value,
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