@extends('layouts.app', ['activePage' => 'agendamento', 'titlePage' => __('Agendamento')])
@section('subheaderTitle')
  OS E Rastreamento
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoAgendamento">
          + Novo agendamento
        </button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">OS E Rastreamento</h4>
              <p class="card-category">Agendamento</p>
            </div>
            <div class="card-body">
              <input type="hidden" id="current_tipo_empresa" value="{{ Auth::user()->pessoa_juridica && Auth::user()->pessoa_juridica->tipo_empresa ? Auth::user()->pessoa_juridica->tipo_empresa->descricao : null }}">
              <div id="fullCalendar"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('rastreamento.agendamento.modal')
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      const currResponsavelId = $('#input_responsavel_id').val()
      const currTipoEmpresa = $('#current_tipo_empresa').val()
      const currEmpresaId = $('#input_pessoa_juridica_id').val()
      const currIsGerador = currTipoEmpresa.toLowerCase() == 'gerador'
      const currIsTransporador = currTipoEmpresa.toLowerCase() == 'transportador'
      !currIsGerador && $('#novoAgendamento').attr('disabled', true)
      const app = new App({})
      getAgendamentos()

      // Open Modal New
      $('body').on('click', '#novoAgendamento', function() {
        app.stepper()
        delFormValidationErrors()
        $("#modalAgenda").modal("show")
        $('#tituloAgenda').text("Novo Agendamento")
        $('#input_id').val("")
        $('#formAgenda')[0].reset()
        $("#formAgenda input").attr("disabled", false)
        $("#produtoDetailDiv").removeClass('d-none')
        $('#motoristaDiv').addClass('d-none')
        $("#addProduto").show()
        maskPeso("#input_peso")
        getTransportador()
        getDestinador()
        getAcondicionamento()
        getUnidade()
        initProdutoDataTable()
      })

      // Adicionar produto
      $('body').on('click', '#addProduto', function() {
        const dataTable = $('#produtosTbl').DataTable()
        const dataInTable = dataTable.data().toArray()
        const newPosition = dataTable.rows(dataInTable.length -1 ).data()[0] ? dataTable.rows(dataInTable.length -1 ).data()[0].position + 1 : 1
        const produto = {
          position: parseInt($('#position').val()) || newPosition,
          id: $('#id').val(),
          produto_id: $('#produto_id').val(),
          codigo: $('#input_codigo').val(),
          descricao: $('#input_descricao').val(),
          quantidade: $('#input_quantidade').val(),
          unidade_id: $('#input_unidade_id').val(),
          unidade: $('select#input_unidade_id option:selected').text(),
          peso: $('#input_peso').val(),
        }
        if (!produto.codigo || !produto.descricao || !produto.quantidade || !produto.unidade || !produto.peso || produto.peso == '0,00') {
          return notifyDanger('Favor, ingrese todos los campos')
        }

        if (dataTable.row(produto.position - 1).data()) {
          dataTable.row(produto.position - 1).data(produto).draw(false)
          $('#addProduto').text('Adicionar')
        } else {
          if (dataInTable.find(c => c.codigo == produto.codigo)) {
            return notifyDanger('Codigo ya agregado, adicione otro')
          }
          dataTable.row.add(produto).draw(false)
        }

        $('#position').val('')
        $('#input_codigo').val('')
        $('#input_descricao').val('')
        $('#input_quantidade').val('')
        $('#input_unidade_id').val(null).trigger('change')
        maskPeso("#input_peso")
      })

      // Delete produto
      $('body').on('click', '.deleteItem', function() {
        $('#produtosTbl').DataTable().row($(this).parents('tr')).remove().draw(false)
      })

      // Editar produto
      $('body').on('click', '.editItem', function() {
        $('#addProduto').text('Salvar')
        const position = $(this).attr('data-position')
        $('#position').val(position)
        const oldData = $('#produtosTbl').DataTable().row(position - 1).data()
        $('#id').val(oldData.id)
        $('#produto_id').val(oldData.produto_id)
        $('#input_codigo').val(oldData.codigo)
        $('#input_descricao').val(oldData.descricao)
        $('#input_quantidade').val(oldData.quantidade)
        $('#input_unidade_id').val(oldData.unidade_id).trigger('change')
        maskPeso("#input_peso", oldData.peso)
      })

      // Salvar
      $('body').on('click', '#salvarAgenda', function() {
        const pessoaJuridicaId = $("#input_gerador_id").val() || $("#input_pessoa_juridica_id").val()
        const produtos = $('#produtosTbl').DataTable().data().toArray().map(produto => {
          return {
            id: produto.id || null,
            produto_id: produto.produto_id || null,
            codigo: produto.codigo,
            descricao: produto.descricao,
            quantidade: produto.quantidade,
            unidade_id: produto.unidade_id,
            peso: formatStringToFloat(produto.peso),
            pessoa_juridica_id: pessoaJuridicaId
          }
        })
        const JSONRequest = {
          responsavel_id: $("#input_responsavel_id").val(),
          gerador_id: pessoaJuridicaId,
          transportador_id: $("#input_transportador_id").val(),
          destinador_id: $("#input_destinador_id").val(),
          acondicionamento_id: $("#input_acondicionamento_id").val(),
          data_inicio_coleta: $("#input_data_inicio_coleta").val(),
          data_final_coleta: $("#input_data_final_coleta").val(),
          veiculo_id: $("#input_veiculo_id").val(),
          motorista_id: $("#input_motorista_id").val(),
          produtos: produtos
        }
        const id = $('#input_id').val()
        if (id) {
          app.api.put(`/os/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalAgenda").modal("hide")
              notifySuccess('Atualizada com sucesso')
              updateEvent(response.data)
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar, tente novamente')
          })
        } else {
          app.api.post('/os', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalAgenda").modal("hide")
              notifySuccess('Criado com sucesso')
              addEventToCalendar(response.data)
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao criar, tente novamente')
          })
        }
      })

      function getTransportador(value, disabled) {
        app.api.get('/tipo_empresa').then(response => {
          if (response && response.status) {
            const tipoEmpresaTransportadorId = response.data.find(curr => curr.descricao.toLowerCase() == 'transportador')?.id
            app.api.get(`/pessoa_juridica?tipo_empresa_id=${tipoEmpresaTransportadorId}&show_current_empresa=false`).then(responseEmpresa =>  {
              if (responseEmpresa && responseEmpresa.status) {
                loadSelect('#input_transportador_id', responseEmpresa.data, ['id', 'razao_social'], value, disabled)
              }
            })
            .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
          } else {
            notifyDanger('Falha ao obter dados de empresa, tente novamente')
          }
        }).catch(error => notifyDanger('Falha ao obter dados. Tente novamente'))
      }

      function getDestinador(value, disabled) {
        app.api.get('/tipo_empresa').then(response => {
          if (response && response.status) {
            const tipoEmpresaDestinadorId = response.data.find(curr => curr.descricao.toLowerCase() == 'destinador')?.id
            app.api.get(`/pessoa_juridica?tipo_empresa_id=${tipoEmpresaDestinadorId}&show_current_empresa=false`).then(responseEmpresa =>  {
              if (responseEmpresa && responseEmpresa.status) {
                loadSelect('#input_destinador_id', responseEmpresa.data, ['id', 'razao_social'], value, disabled)
              }
            })
            .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
          } else {
            notifyDanger('Falha ao obter dados de empresa, tente novamente')
          }
        }).catch(error => notifyDanger('Falha ao obter dados. Tente novamente'))


      }

      function getUnidade() {
        app.api.get('/unidad').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_unidade_id', response.data, ['id', 'simbolo'])
          }
        })
        .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
      }

      function getAcondicionamento(value, disabled) {
        app.api.get('/acondicionamento').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_acondicionamento_id', response.data, ['id', 'descricao'], value, disabled)
          }
        })
        .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
      }

      function getVeiculo(value, empresaId, disabled) {
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

      function getMotorista(value, empresaId, disabled) {
        const empresa = empresaId ? `?pessoa_juridica_id=${empresaId}&funcao=motorista` : ''
        app.api.get(`/users${empresa}`).then(response =>  {
          if (response && response.status) {
            loadSelect('#input_motorista_id', response.data, ['id', 'name'], value, disabled)
          }
        })
        .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
      }

      function initProdutoDataTable(data = []) {
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
              { data: 'codigo' },
              { data: 'descricao' },
              { data: 'unidade' },
              { data: 'quantidade' },
              { data: 'peso' },
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
                targets: [3, 4],
                className: 'text-center'
              },
              {
                targets: 6,
                className: 'text-center',
                render: function (data, type, row, meta) {
                  const deleteBtn = `<i class="fa fa-trash cursor-pointer deleteItem" title="Excluir"></i>`
                  const editBtn = `<i class="fa fa-pen cursor-pointer editItem" data-position="${row.position}" title="Editar"></i>`

                  return `<div class="d-flex align-items-center" style="justify-content:space-evenly;">${deleteBtn}${editBtn}</div>`
                }
              },
            ],
            footerCallback: function (row, data, start, end, display) {
              const dataTable = this.api().data().toArray()
              const totalQuant = dataTable.reduce((acc, curr) => acc + (parseInt(curr?.quantidade) || 0), 0)
              const totalPeso = dataTable.reduce((acc, curr) => acc + (formatStringToFloat(curr?.peso) || 0), 0)
              $(this.api().column(4).footer()).html(totalQuant)
              $(this.api().column(5).footer()).html(formatFloatToString(totalPeso.toFixed(2)))
            },
          })
        }
      }

      function getAgendamentos() {
        app.api.get('/os').then(response =>  {
          if (response && response.status) {
            initCalendar(response.data.map(curr => eventObject(curr)))
          }
        })
        .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
      }

      function editAgendamento(event) {
        const eventEstagio = event.estagio.toLowerCase()
        const emAgendamento = eventEstagio == 'em agendamento'
        const agendada = eventEstagio == 'agendada'
        const allowEdit = emAgendamento && event.gerador_id == currEmpresaId
        const allowAddMoto = emAgendamento && currIsTransporador && event.transportador_id == currEmpresaId
        console.log('EditAgendamento', event)
        app.stepper()
        delFormValidationErrors()
        $("#modalAgenda").modal("show")
        $('#tituloAgenda').text("Editar Agendamento")
        $('#formAgenda')[0].reset()
        $('#input_id').val(event.id)
        $('#input_data_inicio_coleta').val(event.data_inicio_coleta)
        $('#input_data_final_coleta').val(event.data_final_coleta)
        maskPeso("#input_peso")
        $("#input_gerador_id").val(event.gerador_id)
        getTransportador(event.transportador_id, !allowEdit)
        getDestinador(event.destinador_id, !allowEdit)
        getAcondicionamento(event.acondicionamento_id, !allowEdit)
        getUnidade()
        initProdutoDataTable(event.itens.map((item, index) => {
          return {
            position: index + 1,
            id: item.id,
            produto_id: item.produto.id,
            codigo: item.produto.codigo,
            descricao: item.produto.descricao,
            quantidade: item.quantidade,
            unidade_id: item.produto.unidade_id,
            unidade: item.produto.unidade,
            peso: formatFloatToString(item.peso),
          }
        }))

        if (allowEdit) {
          $("#formAgenda input").attr("disabled", false)
          $("#produtoDetailDiv").removeClass('d-none')
          $('#motoristaDiv').addClass('d-none')
          $("#salvarAgenda").show()
        } else {
          $("#formAgenda input").attr("disabled", true)
          $("#addProduto").hide()
          $("#produtoDetailDiv").addClass('d-none')
          $('#motoristaDiv').removeClass('d-none')
          $("#salvarAgenda").hide()
        }
        if (allowAddMoto) {
          $('#motoristaDiv').removeClass('d-none')
          getVeiculo(event.veiculo_id, currEmpresaId)
          getMotorista(event.motorista_id, currEmpresaId)
          $("#input_data_inicio_coleta").attr("disabled", false)
          $("#input_data_final_coleta").attr("disabled", false)
          $("#salvarAgenda").show()
        }
        if (!emAgendamento) {
          $('#motoristaDiv').removeClass('d-none')
          getVeiculo(event.veiculo_id, null, true)
          getMotorista(event.motorista_id, null, true)
        }
      }

      function eventObject(event) {
        const eventClass = event.estagio.toLowerCase() == 'em agendamento'
          ? 'event-red'
          : event.estagio.toLowerCase() == 'esperando motorista'
            ? 'event-orange'
            : 'event-green'
        return {
          title: `[${event.estagio}] Coleta: ${event.gerador} -> ${event.transportador} -> ${event.destinador}`,
          start: $.fullCalendar.moment(event.data_inicio_coleta),
          end: $.fullCalendar.moment(event.data_final_coleta),
          className: [eventClass],
          descr: 'Clique para mais detalhes...',
          ...event
        }
      }
  
      function initCalendar(events) {
        const calendar = $('#fullCalendar')
        const today = new Date()
        calendar.fullCalendar({
          // locale: 'pt-br',
          viewRender: function(view, element) {
            // We make sure that we activate the perfect scrollbar when the view isn't on Month
            if (view.name != 'month') {
              $(element).find('.fc-scroller').perfectScrollbar()
            }
          },
          header: {
            left: 'month,agendaWeek,agendaDay',
            center: 'title',
            right: 'prev,next,today'
          },
          defaultDate: today,
          selectable: false,
          selectHelper: true,
          editable: false,
          eventLimit: true, // allow "more" link when too many events
          views: {
            month: {
              titleFormat: 'MMMM YYYY'
            },
            week: {
              titleFormat: 'MMMM D YYYY'
            },
            day: {
              titleFormat: 'D MMM, YYYY'
            }
          },
          eventClick: function(calEvent, jsEvent, view) {
            editAgendamento(calEvent)
          },
          eventRender: function(eventObj, element) {
            element.popover({
              title: eventObj.title,
              content: eventObj.descr || '',
              trigger: 'hover',
              placement: 'top',
              container: 'body'
            })
          },
          events: events || [],
        })
      }
  
      function addEventToCalendar(event) {
        const calendar = $('#fullCalendar')
        calendar.fullCalendar('renderEvent', eventObject(event), true)
      }
      
      function updateEvent(event) {
        const calendar = $('#fullCalendar')
        const events = calendar.fullCalendar('clientEvents')
        const currEvent = {
          ...(events.find(c => c.id == event.id) || {}),
          ...eventObject(event)
        }
        calendar.fullCalendar('updateEvent', currEvent)
      }
    })
  </script>
@endpush