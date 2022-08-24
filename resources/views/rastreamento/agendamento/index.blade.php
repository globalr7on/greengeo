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
  @include('rastreamento.nota.modal')
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      const app = new App({})
      initCalendar()

      // Open Modal New
      $('body').on('click', '#novoAgendamento', function() {
        // delFormValidationErrors()
        // $("#modalNota").modal("show")
        // $('#tituloNota').text("Nova Nota Fiscal")
        // $('#input_id').val("")
        // $('#formNota')[0].reset()
        // getPessoaJuridica()
        // produtoAcabadoTbl && produtoAcabadoTbl.clear().draw()
        // materiaisTbl && materiaisTbl.clear().draw()

        const date = new Date().toISOString()
        addEventToCalendar(date, 'Some title', 'Some description')
      })

      //Salvar 
      // $('body').on('click', '#salvarNotafiscal', function() {
      //   usuarioResponsavelCadastro = $("#input_usuario_responsavel_cadastro_id").val()
      //   var produtoAcabadoData = produtoAcabadoTbl?.rows()?.data()?.toArray()?.map(curr => ({
      //     id: parseInt(curr.id),
      //     producto_id: parseInt(curr.productoId),
      //     quantidade: parseInt(curr.quantidade),
      //     numero_de_serie: curr.numeroSerie,
      //     data_de_fabricacao: curr.dataFabricacao,
      //     usuario_responsavel_cadastro_id: usuarioResponsavelCadastro,
      //   }))
      //   var produtoSegregadoData = materiaisTbl?.rows()?.data()?.toArray()?.map(curr => ({
      //     parentId: parseInt(curr.parentId),
      //     id: parseInt(curr.id),
      //     material_id: parseInt(curr.materialId),
      //     peso_bruto: formatStringToFloat(curr.pesoBruto),
      //     peso_liquido: formatStringToFloat(curr.pesoLiquido),
      //     percentual_composicao: formatStringToFloat(curr.percentualComposicao),
      //     usuario_responsavel_cadastro_id: usuarioResponsavelCadastro,
      //   }))
      //   if (!produtoAcabadoData?.length && !produtoSegregadoData?.length) {
      //     return notifyDanger('Falta adicionar Produtos Acabados/Segregados')
      //   }
      //   const JSONRequest = {
      //     numero_total: $("#input_numero_total").val(),
      //     serie: $("#input_serie").val(),
      //     folha: $("#input_folha").val(),
      //     chave_de_acesso: $("#input_chave_de_acesso").val(),
      //     pessoa_juridica_id: $("#input_pessoa_juridica_id").val(),
      //   }
      //   if (produtoAcabadoData?.length) {
      //     JSONRequest.produtos_acabados = produtoAcabadoData
      //   }
      //   if (produtoSegregadoData?.length) {
      //     JSONRequest.produtos_segregados = produtoSegregadoData
      //   }
      //   const id = $('#input_id').val();
      //   if (id) {
      //     app.api.put(`/nota_fiscais/${id}`, JSONRequest).then(response => {
      //       if (response && response.status) {
      //         $("#modalNota").modal("hide")
      //         app.datatable.ajax.reload()
      //         notifySuccess('Atualizada com sucesso')
      //       }
      //     })
      //     .catch(error => {
      //       addFormValidationErrors(error?.data)
      //       notifyDanger('Falha ao atualizar, tente novamente')
      //     })
      //   } else {
      //     console.log('JSONRequest', JSONRequest)
      //     app.api.post('/nota_fiscais', JSONRequest).then(response => {
      //       if (response && response.status) {
      //         $("#modalNota").modal("hide")
      //         app.datatable.ajax.reload()
      //         notifySuccess('Criado com sucesso')
      //       }
      //     })
      //     .catch(error => {
      //       addFormValidationErrors(error?.data)
      //       notifyDanger('Falha ao criar, tente novamente')
      //     })
      //   }
      // })

      // function getPessoaJuridica(value) {
      //   app.api.get('/pessoa_juridica').then(response =>  {
      //     if (response && response.status) {
      //       loadSelect('#input_pessoa_juridica_id', response.data, ['id', 'razao_social'], value)
      //     }
      //   })
      //   .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
      // }
    })

    function initCalendar() {
      const calendar = $('#fullCalendar')
      today = new Date()
      y = today.getFullYear()
      m = today.getMonth()
      d = today.getDate()

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
        // select: function(start, end) {
        //   // on select we show the Sweet Alert modal with an input
        //   swal({
        //     title: 'Create an Event',
        //     html: '<div class="form-group"><input class="form-control" placeholder="Event Title" id="input-field"></div>',
        //     showCancelButton: true,
        //     confirmButtonClass: 'btn btn-success',
        //     cancelButtonClass: 'btn btn-danger',
        //     buttonsStyling: false
        //   })
        //   .then(function(result) {
        //     var eventData;
        //     event_title = $('#input-field').val();
        //     if (event_title) {
        //       eventData = {
        //         title: event_title,
        //         start: start,
        //         end: end
        //       };
        //       calendar.fullCalendar('renderEvent', eventData, true); // stick? = true
        //     }
        //     calendar.fullCalendar('unselect');
        //   });
        // },
        eventClick: function(calEvent, jsEvent, view) {
          alert('Event: ' + calEvent.title);
          // alert('Coordinates: ' + jsEvent.pageX + ',' + jsEvent.pageY);
          // alert('View: ' + view.name);
          // change the border color just for fun
          // $(this).css('border-color', 'red')
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
        // color classes: [ event-blue | event-azure | event-green | event-orange | event-red ]
        // events: [
        //   {
        //     title: 'All Day Event',
        //     start: new Date(y, m, 1),
        //     className: 'event-green',
        //     description: 'Some description'
        //   },
        //   {
        //     title: 'Meeting',
        //     start: new Date(y, m, d-1, 10, 30),
        //     allDay: false,
        //     className: 'event-green',
        //     description: 'Some description 2'
        //   },
        //   // {
        //   //   title: 'Lunch',
        //   //   start: new Date(y, m, d+7, 12, 0),
        //   //   end: new Date(y, m, d+7, 14, 0),
        //   //   allDay: false,
        //   //   className: 'event-red',
        //   //   description: 'Some description 3'
        //   // },
        //   // {
        //   //   title: 'Nud-pro Launch',
        //   //   start: new Date(y, m, d-2, 12, 0),
        //   //   allDay: true,
        //   //   className: 'event-azure',
        //   //   description: 'Some description 4'
        //   // },
        //   // {
        //   //   title: 'Birthday Party',
        //   //   start: new Date(y, m, d+1, 19, 0),
        //   //   end: new Date(y, m, d+1, 22, 30),
        //   //   allDay: false,
        //   //   className: 'event-azure',
        //   //   description: 'Some description 5'
        //   // },
        //   // {
        //   //   title: 'Click for Creative Tim',
        //   //   start: new Date(y, m, 21),
        //   //   end: new Date(y, m, 22),
        //   //   url: 'http://www.creative-tim.com/',
        //   //   className: 'event-orange',
        //   //   description: 'Some description 6'
        //   // },
        //   // {
        //   //   title: 'Click for Google',
        //   //   start: new Date(y, m, 21),
        //   //   end: new Date(y, m, 22),
        //   //   url: 'http://www.creative-tim.com/',
        //   //   className: 'event-orange',
        //   //   description: 'Some description 7'
        //   // }
        // ]
      })
    }

    function addEventToCalendar(date, title, description) {
      if (!date) return notifyWarning('Missing date')
      if (!title) return notifyWarning('Missing title')
      if (!description) return notifyWarning('Missing description')

      const calendar = $('#fullCalendar')
      const startDate = $.fullCalendar.moment(date)
      const endDate = startDate.add(3, 'hours')
      const eventData = {
        title: title,
        description: description,
        start: startDate,
        end: endDate,
        allDay: false,
        className: 'event-green',
      }
      calendar.fullCalendar('renderEvent', eventData, true)
    }
  </script>
@endpush