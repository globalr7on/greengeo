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
      // const empresaId = "{{ Auth::user()->pessoa_juridica_id }}" || null
      const app = new App({})
      getAgendamentos()

      // Open Modal New
      $('body').on('click', '#novoAgendamento', function() {
        delFormValidationErrors()
        $("#modalAgenda").modal("show")
        $('#tituloAgenda').text("Novo Agendamento")
        $('#input_id').val("")
        $('#formAgenda')[0].reset()
        // getTransportadora(empresaId, empresaId ? true : false)
        getTransportadora()
        getAcondicionamento()
        getOrdemServico()
      })

      // Enviar agendamento 
      $('body').on('click', '#enviarAgendamento', function() {
        // Salvar Evento
        const JSONRequest = {
          usuario_id: $("#input_usuario_responsavel_cadastro_id").val(),
          transportadora_id: $("#input_transportadora_id").val(),
          ordem_servico_id: $("#input_ordem_servico_id").val(),
          acondicionamento_id: $("#input_acondicionamento_id").val(),
          coleta: $("#input_data_coleta").val(),
        }
        const id = $('#input_id').val()
        app.api.post('/agendamento', JSONRequest).then(response => {
          if (response && response.status) {
            $("#modalAgenda").modal("hide")
            app.datatable.ajax.reload()
            notifySuccess('Criado com sucesso')
            addEventToCalendar(response.data)
          }
        })
        .catch(error => {
          addFormValidationErrors(error?.data)
          notifyDanger('Falha ao criar, tente novamente')
        })
      })

      function getTransportadora(value) {
        app.api.get('/pessoa_juridica').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_transportadora_id', response.data, ['id', 'razao_social'], value)
          }
        })
        .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
      }

      function getOrdemServico() {
        app.api.get('/os').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_ordem_servico_id', response.data, ['id', 'codigo'])
          }
        })
        .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
      }

      function getAcondicionamento() {
        app.api.get('/acondicionamento').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_acondicionamento_id', response.data, ['id', 'descricao'])
          }
        })
        .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
      }

      function getAgendamentos() {
        app.api.get('/agendamento').then(response =>  {
          if (response && response.status) {
            console.log('agendamento', response)
            initCalendar(response.data.map(curr => eventObject(curr)))
          }
        })
        .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
      }
    })

    function eventObject(event) {
      return {
        title: `Coleta de sucata: OS ${event.ordem_servico.codigo}`,
        start: $.fullCalendar.moment(event.coleta),
        end: $.fullCalendar.moment(event.coleta).add(2, 'hours'),
        allDay: false,
        className: 'event-green',
        description: 'Clique para mais detalhes...',
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
          const content = `
            <div>
              <div class="row px-4 py-2">
                <div class="col-5 text-left"><i class="fas fa-home" title="Gerador"></i> ${calEvent.gerador}</div>
                <div class="col-2"><b>&#8594;</b></div>
                <div class="col-5 text-right"><i class="fas fa-truck-moving"></i> ${calEvent.transportadora}</div>
              </div>

              <div class="row px-4 py-2">
                <div class="col-6 text-left"><i class="fas fa-trailer"></i> ${calEvent.acondicionamento}</div>
                <div class="col-6 text-right"><i class="fas fa-balance-scale"></i> ${calEvent.ordem_servico.peso_total} Kg</div>
              </div>

              <div class="row px-4 py-2">
                <div class="col-12 text-left"><i class="fas fa-list"></i> Produtos:</div>
                ${calEvent.ordem_servico.itens.reduce((acc, item) => {
                  return acc + `
                    <div class="col-1 pr-0">&bull;</div>
                    <div class="col-6 pl-0 text-left align-self-center" style="font-size:14px"><i class="fas fa-barcode"></i> ${item.produto.ean}</div>
                    <div class="col-5 pl-0 text-left align-self-center" style="font-size:14px"><i class="fas fa-ruler-combined"></i> ${parseFloat(item.produto.altura).toFixed(2)}A x ${parseFloat(item.produto.largura).toFixed(2)}L x ${parseFloat(item.produto.profundidade).toFixed(2)}P</div>
                  `
                }, '')}
              </div>

              <div class="row px-4 pt-4">
                <div class="col-12 text-right"><small><i class="fas fa-user-edit"></i> ${calEvent.usuario}</small></div>
              </div>
            </div>
          `
          sweetInput({
            title: `Ordem Servico: ${calEvent.ordem_servico.codigo}`,
            html: content,
            confirmButtonText: 'Ok',
            focusConfirm: false,
            buttonsStyling: false,
            confirmButtonClass: 'btn btn-primary',
          })
        },
        eventRender: function(eventObj, element) {
          element.popover({
            title: eventObj.title,
            content: eventObj.description || '',
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
  </script>
@endpush