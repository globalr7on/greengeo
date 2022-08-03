@extends('layouts.app', ['activePage' => 'ibama', 'titlePage' => __('Codigos Ibama')])
@section('subheaderTitle')
  Administrativo
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoIbama">+ Novo Código Ibama</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Administrativo</h4>
              <p class="card-category">Ibama</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="ibamaTbl">
                  <thead>
                    <th class="text-primary font-weight-bold" style="width:8%">Código</th>
                    <th class="text-primary font-weight-bold" style="width:auto">Denominação</th>
                    <th class="text-primary font-weight-bold" style="width:12%">Classe Sucata</th>
                    <th class="text-primary font-weight-bold text-center" style="width:5%">Ação</th>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('administrativo.ibama.modal')
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      let app = new App({
        apiUrl: '/api/ibama',
        apiDataTableColumns: [
          { data: "codigo", className: "text-center" },
          { data: "denominacao" },
          { data: "classe_sucata" },
        ],
        datatableSelector: '#ibamaTbl'
      })
     
      // Open Modal New
      $('body').on('click', '#novoIbama', function() {
        delFormValidationErrors()
        $("#modalIbama").modal("show")
        $('#formIbama')[0].reset()
        $('#tituloModal').text("Novo Ibamna")
        $('#input_id').val("")
        getClaseSucata()
      })

      // Salvar 
      $('body').on('click', '#salvarIbama', function() {
        const JSONRequest = {
          codigo: $("#input_codigo").val(),
          denominacao: $("#input_denominacao").val(),
          classe_sucata_id: $("#input_classe_sucata_id").val(),
        }
        const id = $('#input_id').val()
        if (id) {
          app.api.put(`/ibama/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalIbama").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Atualizado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar, tente novamente')
          })
        } else {
          app.api.post('/ibama', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalIbama").modal("hide")
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
        const id = $(this).attr('data-id');
        app.api.get(`/ibama/${id}`).then(response =>  {
          if (response && response.status) {
            delFormValidationErrors()
            $("#modalIbama").modal("show");
            $('#tituloModal').text("Editar Ibama")
            $('#input_id').val(response.data.id)
            $("#input_codigo").val(response.data.codigo)
            $("#input_denominacao").val(response.data.denominacao)
            getClaseSucata(response.data.classe_sucata_id)
          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes. Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction',  function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/ibama/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('Excluído com sucesso')
            })
            .catch(error => notifyDanger('Falha ao excluir. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      })

      function getClaseSucata(value) {
        app.api.get('/classe_sucata').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_classe_sucata_id', response.data, ['id', 'descricao'], value)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter dados de classe de sucata, tente novamente')
        })
      }
    })
  </script>
@endpush