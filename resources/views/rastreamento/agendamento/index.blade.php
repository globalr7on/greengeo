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
        // const date = $("#input_data_coleta").val()
        // let transportadora = $("#input_transportadora_id option:selected").text()
        // let acondicionamento = $("#input_acondicionamento_id").val()
        // let ordem = $("#input_ordem_servico_id option:selected").text()
        // addEventToCalendar(date, ordem, transportadora)
      
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
            $("#modalEmpresa").modal("hide")
            app.datatable.ajax.reload()
            notifySuccess('Criado com sucesso')
          }
        })
        .catch(error => {
          addFormValidationErrors(error?.data)
          notifyDanger('Falha ao criar, tente novamente')
        })
        $("#modalAgenda").modal("hide")
        document.location.reload()
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
            initCalendar(response.data.map(curr => {
              return {
                title: `Coleta de sucata: OS ${curr.ordem_servico}`,
                start: $.fullCalendar.moment(curr.coleta),
                end: $.fullCalendar.moment(curr.coleta).add(2, 'hours'),
                allDay: false,
                className: 'event-green',
                description: 'Clique para mais detalhes...',
                ...curr
              }
            }))
          }
        })
        .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
      }
    })

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
              <span class="d-block text-left px-4 py-2"><b>Gerador:</b> ${calEvent.gerador}</span>
              <span class="d-block text-left px-4 py-2"><b>Transportadora:</b> ${calEvent.transportadora}</span>
              <span class="d-block text-left px-4 py-2"><b>Veículo ideal:</b> ${calEvent.acondicionamento}</span>
              <small class="d-block text-right px-4 py-2"><b>Cadastrado por:</b> ${calEvent.usuario}</small>
            </div>
          `
          sweetInput({
            title: `Ordem Servico: ${calEvent.ordem_servico}`,
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

    // function addEventToCalendar(date, title, description) {
    //   if (!date) return notifyWarning('Missing date')
    //   if (!title) return notifyWarning('Missing title')
    //   if (!description) return notifyWarning('Missing description')

    //   const calendar = $('#fullCalendar')
    //   const startDate = $.fullCalendar.moment(date)
    //   const endDate = startDate.add(3, 'hours')
    //   const eventData = {
    //     title: title,
    //     description: description,
    //     start: startDate,
    //     end: endDate,
    //     allDay: false,
    //     className: 'event-green',
    //   }
    //   calendar.fullCalendar('renderEvent', eventData, true)
    // }
  </script>
@endpush