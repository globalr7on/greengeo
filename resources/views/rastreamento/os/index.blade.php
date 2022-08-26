@extends('layouts.app', ['activePage' => 'os', 'titlePage' => __('Ordem de Serviço')])
@section('subheaderTitle')
  OS E Rastreamento
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
              <h4 class="card-title">OS E Rastreamento</h4>
              <p class="card-category">Ordem de Serviço</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="osTbl">
                  <thead>
                    <th class="text-primary font-weight-bold text-center" style="width:10%">Codigo</th>
                    <th class="text-primary font-weight-bold" style="width:7%">Emissão</th>
                    <th class="text-primary font-weight-bold" style="width:9%">Integração</th>
                    <th class="text-primary font-weight-bold" style="width:auto">Gerador</th>
                    <th class="text-primary font-weight-bold" style="width:auto">Transportador</th>
                    <th class="text-primary font-weight-bold" style="width:auto">Destinador</th>
                    <th class="text-primary font-weight-bold" style="width:7%">MTR</th>
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
      const currentUser = parseInt($('#input_usuario_responsavel_cadastro_id').val())
      let notaFiscalsData = []
      let app = new App({
        apiUrl: '/api/os',
        apiDataTableColumns: [
          { data: 'codigo'},
          { data: "emissao" },
          { data: "integracao" },
          { data: "gerador" },
          { data: "transportador" },
          { data: "destinador" },
          { data: "mtr" },
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
              if (isMotoristaForApproval && estagio == 'Esperando Motorista') {
                return `${showBtn}${approvalBtn}${rejectBtn}`
              }

              return `${deleteBtn}${editBtn}${showBtn}${updateStatusTransporteBtn}${updateStatusEntregueBtn}${addPhotoBtn}`
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
          nota_fiscal_id: $("#input_nota_fiscal").val(),
          cdf_serial: '123456',
          cdf_ano: '2022',
          peso_total_os: '1234.21',
          area_total: '13456.22',
          peso_de_controle: '23456.2',
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
        app.stepper()
        const id = $(this).attr('data-id');
        app.api.get(`/os/${id}`).then(response =>  {
          if (response && response.status) {
            $('.showFotos').show()
            getEmpresa(response.data.gerador_id, '#input_gerador_id', null, null, false, false, true)
            getEmpresa(response.data.destinador_id, '#input_destinador_id', null, null, false, false, true)
            getEmpresa(response.data.transportador_id, '#input_transportador_id', null, null, false, false, true)
            getMotorista(response.data.motorista_id, response.data.transportador_id, false, response.data.motorista_id ? true : false)
            getVeiculo(response.data.veiculo_id, response.data.transportador_id, false, response.data.veiculo_id ? true : false)
            getEstagio(response.data.estagio_id, true)
            getNotasFiscais(response.data.nota_fiscal_id, true, true)
            delFormValidationErrors()
            $('#formOs')[0].reset()
            $("#modalOs").modal("show");
            $('#tituloModal').text("Editar OS")
            $('#input_id').val(response.data.id);
            $("#input_integracao").val(response.data.integracao)
            $("#input_emissao").val(response.data.emissao)
            $("#input_mtr").val(response.data.mtr)
            $("#input_serie").val(response.data.serie)
            $("#input_description").val(response.data.description)
            $("#input_data_estagio").val(response.data.data_estagio)
            $("#input_preenchimento").val(response.data.preenchimento)
            $("#imagensData").val(JSON.stringify(response.data.imagens))
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
            loadSelect('#input_nota_fiscal', response.data, [], value, disabled, mergetNotasFiscaisOption)
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
            produto_id: item.id,
            produto: `${item.produto.ean}:${item.produto.codigo}`,
            especie: item.produto.especie,
            marca: item.produto.marca,
            altura: parseFloat(item.produto.altura).toFixed(2),
            largura: parseFloat(item.produto.largura).toFixed(2),
            profundidade: parseFloat(item.produto.profundidade).toFixed(2),
            descricao: item.produto.descricao,
          }))
        }).flat()
      }

      $('body').on('change', '#input_nota_fiscal', function(event) {
        $('.addProdutos').attr('disabled', false)
        const currentIds = [...event.target.selectedOptions].map(o => parseInt(o.value))
        const currentNotaFiscals = notaFiscalsData.filter(curr => currentIds.includes(curr.id))
        $('#produtosData').text(JSON.stringify(currentNotaFiscals || []))
      })

      $('body').on('click', '.addProdutos', function() {
        $("#modalSegregados").modal("show")
        const produtosData = JSON.parse($('#produtosData').text() || '{}')
        const data = parseProdutos(produtosData)
        getItems(data)
        initProdutoDataTable([])
      })

      function getItems(data) {
        loadSelect('#items', data, [], null, false, function(value) {
          const optionValue = `${value.nota_id}-${value.produto_id}`
          const optionText = `${value.produto} | ${value.marca} | ${value.especie} | ${value.descricao}`
          return [optionValue, optionText]
        })
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
              { data: 'produto' },
              { data: 'quantidade' },
              { data: 'altura' },
              { data: 'largura' },
              { data: 'profundidade' },
            ],
            columnDefs: [
              {
                targets: 0,
                className: 'text-center',
                render: function (data, type, row, meta) {
                  return meta.row + 1;
                }
              },
              {
                targets: [2,3,4,5],
                className: 'text-center',
              },
            ],
            // rowGroup: {
            //   dataSrc: function(row) {
            //     return row.produto ? row.produto : 'Segregados'
            //   },
            // },
            // footerCallback: function (row, data, start, end, display) {
            //   const api = this.api()
            //   totalPesoBruto = api.column(7).data().reduce((a, b) => parseFloat(a) + parseFloat(b), 0)
            //   totalPesoLiquido = api.column(8).data().reduce((a, b) => parseFloat(a) + parseFloat(b), 0)
            //   $(api.column(7).footer()).html(totalPesoBruto.toFixed(2))
            //   $(api.column(8).footer()).html(totalPesoLiquido.toFixed(2))
            // },
          })
        }
      }

      $('body').on('click', '.addProduto', function() {
        const produtosData = JSON.parse($('#produtosData').text() || '{}')
        const data = parseProdutos(produtosData)
        const currentProdutoId = $('#items').selectpicker('val')
        const [notaId, produtoId] = currentProdutoId.split('-')
        const produto = data.find(curr => curr.nota_id == notaId && curr.produto_id == produtoId)
        $('#produtosTbl').DataTable().row.add(produto).draw(false)
        $('#items').find(`[value=${currentProdutoId}]`).remove()
        $('#items').selectpicker('refresh').selectpicker('val', null)
      })

      // Approval/Reject OS by motorista
      $('body').on('click', '.approvalAction', function() {
        const isApproval = parseInt($(this).attr('data-approval'))
        sweetConfirm(`Deseja realmente ${isApproval ? 'aceitar' : 'recusar'} la OS?`).then(confirmed => {
          if (confirmed) {
            const id = $(this).attr('data-id')
            app.api.put(`/os/${id}/aceitar/${isApproval}`).then(response => {
              if (response && response.status) {
                app.datatable.ajax.reload()
                notifySuccess('Atualizada com sucesso')
              }
            })
            .catch(error => notifyDanger('Falha ao atualizar, tente novamente'))
          }
        })
      })
    })
  </script>
@endpush