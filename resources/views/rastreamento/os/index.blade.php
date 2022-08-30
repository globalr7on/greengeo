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
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novaOs">
         + Nova OS
        </button>
      </div>
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
      const currentUser = parseInt($('#input_usuario_responsavel_cadastro_id').val())
      let notaFiscalsData = []
      let itemsSelectSettings = {
        dropdownParent: $('#modalProdutos'),
        placeholder: 'Pesquisar um produto acabado',
        allowClear: true,
        width: 'resolve',
      }
      let app = new App({
        apiUrl: '/api/os',
        apiDataTableColumns: [
          { data: 'codigo'},
          { data: "emissao" },
          { data: "integracao" },
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
              const statusEmitida = 'emitida'
              const statusAguardandoColeta = 'aguardando coleta'
              const statusTransporte = 'transporte'
              const statusEsperandoMotorista = 'esperando motorista'
              const deleteBtn = estagio == statusEmitida ? `<i class="fa fa-trash cursor-pointer deleteAction" data-id="${row.id}" title="Excluir"></i>&nbsp;` : ''
              const editBtn = estagio == statusEmitida ? `<i class="fa fa-pen cursor-pointer editAction" data-id="${row.id}" title="Editar"></i>&nbsp;` : ''
              const showBtn = estagio !== statusEmitida ? `<i class="fas fa-list-alt cursor-pointer showAction" data-id="${row.id}" title="Mostrar"></i>&nbsp;` : ''
              
              // const updateStatusColetaBtn = estagio == statusEmitida
              //   ? `<i class="fas fa-hourglass-half cursor-pointer updateEstagio" data-id="${row.id}" title="Atualizar a Aguardando Coleta"></i>&nbsp;`
              //   : ''
              const updateStatusTransporteBtn = estagio == statusAguardandoColeta
                ? `<i class="fas fa-truck cursor-pointer updateEstagio" data-id="${row.id}" title="Atualizar a Transporte"></i>&nbsp;`
                : ''
              const updateStatusEntregueBtn = estagio == statusTransporte
                ? `<i class="fas fa-truck-loading cursor-pointer updateEstagio" data-id="${row.id}" title="Atualizar a Entregue"></i>&nbsp;`
                : ''
              const addPhotoBtn = estagio == statusTransporte
                ? `<i class="fa-solid fa-cloud-arrow-up cursor-pointer novaFoto" data-id="${row.id}" title="Adicionar Foto"></i>&nbsp;`
                : ''
              const approvalBtn = `<i class="fas fa-check text-success cursor-pointer approvalAction" data-id="${row.id}" data-approval="1" title="Aceitar OS"></i>&nbsp;`
              const rejectBtn = `<i class="fas fa-times text-danger cursor-pointer approvalAction" data-id="${row.id}" data-approval="0" title="Recusar OS"></i>&nbsp;`

              const isMotoristaForApproval = row.aprovacao_motorista.length > 0 ? row.aprovacao_motorista[0].usuario_id == currentUser : false
              if (isMotoristaForApproval && estagio == statusEsperandoMotorista) {
                return `${showBtn}${approvalBtn}${rejectBtn}`
              }

              return `${deleteBtn}${editBtn}${showBtn}${updateStatusTransporteBtn}${updateStatusEntregueBtn}${addPhotoBtn}`
            }
          }
        ],
        useDefaultDataTableColumnDefs: false,
        datatableSelector: '#osTbl',
      })
      getTratamentos()

      let tipoEmpresaData = []
      app.api.get('/tipo_empresa').then(response => {
        (response && response.status) && (tipoEmpresaData = response.data)
      }).catch(error => notifyDanger('Falha ao obter dados. Tente novamente'))
     
      // Open Modal New
      $('body').on('click', '#novaOs', function() {
        $('body').on('change', '#input_gerador_id', updateTransportadorFromGerador)
        $('body').on('change', '#input_transportador_id', updateMotoristaFromTransportador)
        $('body').on('click', '.addProdutos', addProdutosModal)
        $('#items').attr('disabled', false)
        $('.addProduto').attr('disabled', false)
        $("#imagensData").val('')
        $('.showFotos').hide()
        $('.addProdutos').attr('disabled', true)
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
        getNotasFiscais()
        if ($.fn.dataTable.isDataTable('#produtosTbl')) {
          $('#produtosTbl').DataTable().clear().draw()
        }
      })

      // Open Modal novaFoto
      $('body').on('click', '.novaFoto', function() {
        const id = $(this).attr('data-id')
        $('#imagensPreview').empty()
        $('#formImagens')[0].reset()
        $('#input_orden_servicio_id').val(id)
        $("#modalFoto").modal("show")
      })

      // Salvar
      $('body').on('click', '#salvarOs', function() {
        const produtosData = $('#produtosTbl').DataTable().data().toArray().map(curr => ({
          id: curr?.id || null,
          peso: formatStringToFloat(curr?.peso),
          observacao: curr?.observacao || null,
          tratamento_id: curr?.tratamento_id,
          produto_id: curr.produto_id,
          numero_de_serie: curr.numero_de_serie,
          data_de_fabricacao: curr.data_de_fabricacao,
          nota_fiscal_item_id: curr.nota_item_id
        }))
        if (!produtosData.length) {
          return notifyDanger('Por favor, adicione os produtos')
        }
        if (!produtosData.every(curr => curr?.peso)) {
          return notifyDanger('Por favor, adicione o peso nos produtos')
        }
        if (!produtosData.every(curr => curr?.tratamento_id)) {
          return notifyDanger('Por favor, adicione o tratamento nos produtos')
        }
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
          notas_fiscais: $("#input_notas_fiscais").val(),
          // cdf_serial: '123456',
          // cdf_ano: '2022',
          // peso_total_os: '1234.21',
          // area_total: '13456.22',
          // peso_de_controle: '23456.2',
          produtos: produtosData
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
      $('body').on('click', '.editAction, .showAction', function() {
        const onlyShow = $(this).hasClass("showAction")
        $('body').off('change', '#input_gerador_id', updateTransportadorFromGerador)
        $('body').off('change', '#input_transportador_id', updateMotoristaFromTransportador)
        $('body').off('click', '.addProdutos', addProdutosModal)
        $('#items').attr('disabled', true)
        $('.addProduto').attr('disabled', true)
        app.stepper()
        const id = $(this).attr('data-id')
        app.api.get(`/os/${id}`).then(response =>  {
          if (response && response.status) {
            $('.showFotos').show()
            getEmpresa(response.data.gerador_id, '#input_gerador_id', null, null, false, false, true)
            getEmpresa(response.data.destinador_id, '#input_destinador_id', null, null, false, false, true)
            getEmpresa(response.data.transportador_id, '#input_transportador_id', null, null, false, false, true)
            getMotorista(response.data.motorista_id, response.data.transportador_id, false, response.data.motorista_id ? true : false)
            getVeiculo(response.data.veiculo_id, response.data.transportador_id, false, response.data.veiculo_id ? true : false)
            getEstagio(response.data.estagio_id, true)
            getNotasFiscais(response.data.notas_fiscais, true, true)
            delFormValidationErrors()
            $('#formOs')[0].reset()
            $("#modalOs").modal("show")
            $('#tituloModal').text("Editar OS")
            $('#input_id').val(response.data.id)
            $("#input_integracao").val(response.data.integracao)
            $("#input_emissao").val(response.data.emissao)
            $("#input_mtr").val(response.data.mtr)
            $("#input_serie").val(response.data.serie)
            $("#input_description").val(response.data.description)
            $("#input_data_estagio").val(response.data.data_estagio)
            $("#input_preenchimento").val(response.data.preenchimento)
            $("#imagensData").val(JSON.stringify(response.data.imagens))
            $('body').on('click', '.addProdutos', function() {
              $("#modalProdutos").modal("show")
              getItems([])
              initProdutoDataTable(response.data.itens.map((item, pos) => {
                return {
                  id: item.id,
                  disabled_buttons: true,
                  position: pos + 1,
                  altura: formatFloatToString(item.produto.altura),
                  codigo: item.produto.codigo,
                  data_de_fabricacao: item.data_de_fabricacao,
                  descricao: item.produto.descricao,
                  ean: item.produto.ean,
                  especie: item.produto.especie,
                  largura: formatFloatToString(item.produto.largura),
                  marca: item.produto.marca,
                  produto_id: item.produto.id,
                  nota_item_id: item.nota_fiscal_item_id,
                  numero_de_serie: item.numero_de_serie,
                  observacao: item.observacao,
                  peso: formatFloatToString(item.peso),
                  profundidade: formatFloatToString(item.produto.profundidade),
                  tratamento: item?.tratamento?.descricao,
                  tratamento_id: item.tratamento_id,
                }
              }))
            })
            if (onlyShow) {
              $("#formOs input").prop("disabled", true)
              $("#salvarOs").hide()
            } else {
              $("#formOs input").prop("disabled", false)
              $("#salvarOs").show()
            }
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
              loadSelect('#input_veiculo_id', response.data, [], value, disabled, mergeVeiculoOption)
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

      function mergetNotasFiscaisOption(value) {
        const optionValue = value.id
        const optionText = `${value.pessoa_juridica} ${value.serie}:${value.folha} - ${value.numero_total}`
        return [optionValue, optionText]
      }

      function getNotasFiscais(value, disabled, all = false) {
        app.api.get(`/nota_fiscais${all ? '?all=1' : ''}`).then(response =>  {
          if (response && response.status) {
            notaFiscalsData = response.data
            loadSelect('#input_notas_fiscais', response.data, [], value, disabled, mergetNotasFiscaisOption)
          }
        })
        .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
      }
      
      function getTratamentos() {
        app.api.get('/tratamento').then(response =>  {
          if (response && response.status) {
            $('#tratamentoData').text(JSON.stringify(response.data || []))
          }
        })
        .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
      }

      function parseProdutos(data) {
        return data.map(curr => {
          return curr.itens.map(item => ({
            nota_id: curr.id,
            nota: `${curr.pessoa_juridica} ${curr.serie}:${curr.folha} - ${curr.numero_total}`,
            data_de_fabricacao: item.data_de_fabricacao,
            numero_de_serie: item.numero_de_serie,
            quantidade: item.quantidade,
            produto_id: item.produto.id,
            nota_item_id: item.id,
            ean: item.produto.ean,
            codigo: item.produto.codigo,
            especie: item.produto.especie,
            marca: item.produto.marca,
            altura: parseFloat(item.produto.altura).toFixed(2),
            largura: parseFloat(item.produto.largura).toFixed(2),
            profundidade: parseFloat(item.produto.profundidade).toFixed(2),
            descricao: item.produto.descricao,
          }))
        }).flat()
      }

      $('body').on('change', '#input_notas_fiscais', function(event) {
        $('.addProdutos').attr('disabled', false)
        const currentIds = [...event.target.selectedOptions].map(o => parseInt(o.value))
        const currentNotaFiscals = notaFiscalsData.filter(curr => currentIds.includes(curr.id))
        $('#produtosData').text(JSON.stringify(currentNotaFiscals || []))
      })

      function addProdutosModal() {
        $("#modalProdutos").modal("show")
        let produtosData = JSON.parse($('#produtosData').text() || '{}')
        let produtosTbl = $.fn.dataTable.isDataTable('#produtosTbl') ? $('#produtosTbl').DataTable().data().toArray() : []
        produtosData = produtosData.map(curr => {
          let currentNota = produtosTbl.filter(c =>  c.nota_id == curr.id)
          if (currentNota.length > 0) {
            return { ...curr, ...{ itens: curr.itens.map(item => ({ ...item, disabled: currentNota.some(i => i.produto_id == item.produto.id) })) } }
          }
          return curr
        })
        produtosTbl = produtosTbl.filter(curr => produtosData.some(c => c.id == curr.nota_id) && produtosData.some(c => c.itens.some(i => i.produto.id == curr.produto_id)))
        getItems(produtosData)
        initProdutoDataTable(produtosTbl)
      }

      $('body').on('click', '.addProdutos', addProdutosModal)

      function getItems(data) {
        data = data.map(curr => {
          return {
            text: `${curr.pessoa_juridica} ${curr.serie}:${curr.folha} - ${curr.numero_total}`,
            children: curr.itens.map(item => ({
              id: `${curr.id}-${item.id}`,
              text: `${item.produto.ean}:${item.produto.codigo} | ${item.produto.marca} | ${item.produto.especie} | ${item.produto.descricao}`,
              disabled: item?.disabled || false
            }))
          }
        })
        if ($('#items').hasClass("select2-hidden-accessible")) {
          $('#items').select2('destroy')
          $('#items').empty().append('<option></option>')
        }
        $('#items').select2({ ...itemsSelectSettings, data: data })
      }

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
                      <span class="d-block">[${row.ean}] ${row.codigo}</span>
                      <small class="d-block">Marca: ${row.marca} - Especie: ${row.especie}</small>
                      <small class="d-block">Serie: ${row.numero_de_serie} (${row.data_de_fabricacao})</small>
                    </div>
                  `
                }
              },
              { data: 'altura' },
              { data: 'largura' },
              { data: 'profundidade' },
              {
                data: 'peso',
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
                targets: [2,3,4,5,6],
                className: 'text-center',
              },
              {
                targets: 8,
                className: 'text-center',
                render: function (data, type, row, meta) {
                  const addWeightBtn = `<i class="fas fa-balance-scale cursor-pointer addWeightAction" data-nota-id="${row.nota_id}" data-nota-item-id="${row.nota_item_id}" title="Adicionar peso"></i>`
                  const addTratamentoBtn = `<i class="fas fa-recycle cursor-pointer addTratamentoAction" data-nota-id="${row.nota_id}" data-nota-item-id="${row.nota_item_id}" title="Adicionar tratamento"></i>`
                  const addObsBtn = `<i class="fas fa-clipboard cursor-pointer addObsAction" data-nota-id="${row.nota_id}" data-nota-item-id="${row.nota_item_id}" title="Adicionar observacao"></i>`

                  return row?.disabled_buttons ? '' : `<div class="d-flex align-items-center justify-content-between">${addWeightBtn}${addTratamentoBtn}${addObsBtn}</div>`
                }
              },
            ],
            footerCallback: function (row, data, start, end, display) {
              const dataTable = this.api().data().toArray()
              const totalPeso = dataTable.reduce((acc, curr) => acc + (formatStringToFloat(curr?.peso) || 0), 0)
              $(this.api().column(5).footer()).html(formatFloatToString(totalPeso.toFixed(2)))
            },
          })
        }
        // $('#produtosTbl').on('draw.dt', function () {
        //     // $('[data-toggle="tooltip"]').tooltip()
        //     $('tbody > * [data-toggle="tooltip"]:not([data-original-title])').tooltip()
        // })
      }

      $('body').on('click', '.addProduto', function() {
        const currentProdutoId = $('#items').val()
        if (!currentProdutoId) {
          return notifyDanger('Selecione um produto')
        }
        const produtosData = JSON.parse($('#produtosData').text() || '[]')
        const data = parseProdutos(produtosData)
        const [notaId, notaItemId] = currentProdutoId.split('-')
        const produto = data.find(curr => curr.nota_id == notaId && curr.nota_item_id == notaItemId)
        $('#produtosTbl').DataTable().row.add(produto).draw(false)
        $('#items').find(`[value=${currentProdutoId}]`).attr('disabled', true)
        $('#items').select2("destroy").select2(itemsSelectSettings)
        $('#items').val(null).trigger('change')
      })

      // Adicionar peso al produto
      $('body').on('click', '.addWeightAction', function() {
        const notaId = $(this).attr('data-nota-id')
        const notaItemId = $(this).attr('data-nota-item-id')
        sweetInput({
          title: 'Adicionar peso ao produto',
          showCancelButton: true,
          input: 'text',
          confirmButtonText: 'Adicionar',
          focusConfirm: false,
          allowOutsideClick: false,
          buttonsStyling: false,
          confirmButtonClass: 'btn btn-primary',
          cancelButtonClass: 'btn btn-danger',
          onOpen: () => maskPeso('input.swal2-input'),
          preConfirm: (value) => !formatStringToFloat(value) ? swal.showValidationError('Por favor, adicione o peso') : value,
          errorCallback: (error) => notifyDanger('Ocorreu um erro ao adicionar el peso, tente novamente'),
          successCallback: (result) => {
            if (result?.dismiss) return
            const dataInTable = $('#produtosTbl').DataTable().data().toArray()
            const produtoIndex = dataInTable.findIndex(curr => curr.nota_id == notaId && curr.nota_item_id == notaItemId)
            $('#produtosTbl').DataTable().row(produtoIndex).data({...dataInTable[produtoIndex], peso: result.value}).draw(false)
          }
        })
      })

      // Adicionar observacao al produto
      $('body').on('click', '.addObsAction', function() {
        const notaId = $(this).attr('data-nota-id')
        const notaItemId = $(this).attr('data-nota-item-id')
        sweetInput({
          title: 'Adicionar observacao al produto',
          showCancelButton: true,
          input: 'textarea',
          confirmButtonText: 'Adicionar',
          focusConfirm: false,
          allowOutsideClick: false,
          buttonsStyling: false,
          confirmButtonClass: 'btn btn-primary',
          cancelButtonClass: 'btn btn-danger',
          preConfirm: (value) => !value ? swal.showValidationError('Por favor, adicione uma observacao') : value,
          errorCallback: (error) => notifyDanger('Ocorreu um erro ao adicionar a observacao, tente novamente'),
          successCallback: (result) => {
            if (result?.dismiss) return
            const dataInTable = $('#produtosTbl').DataTable().data().toArray()
            const produtoIndex = dataInTable.findIndex(curr => curr.nota_id == notaId && curr.nota_item_id == notaItemId)
            $('#produtosTbl').DataTable().row(produtoIndex).data({...dataInTable[produtoIndex], observacao: result.value}).draw(false)
          }
        })
      })

      // Adicionar tratamento al produto
      $('body').on('click', '.addTratamentoAction', function() {
        const tratamentoData = JSON.parse($('#tratamentoData').text() || '[]')
        const notaId = $(this).attr('data-nota-id')
        const notaItemId = $(this).attr('data-nota-item-id')
        sweetInput({
          title: 'Selecione o tratamento al produto',
          html: '<select id="tratamento" data-style="btn-warning text-white" title="Selecione"></select>',
          showCancelButton: true,
          confirmButtonText: 'Adicionar',
          // showLoaderOnConfirm: true,
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
            const produtoIndex = dataInTable.findIndex(curr => curr.nota_id == notaId && curr.nota_item_id == notaItemId)
            $('#produtosTbl').DataTable().row(produtoIndex).data({...dataInTable[produtoIndex], ...{ tratamento_id: result.value.id, tratamento: result.value.text}}).draw(false)
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