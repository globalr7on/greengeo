@extends('layouts.app', ['activePage' => 'ibama', 'titlePage' => __('Codigos Ibama')])
@section('css')
@endsection
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
              <!-- <div class="table-responsive"> -->
              <div>
                <table class="table" id="ibamaTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Código</th>
                    <th class="text-primary font-weight-bold">Denominação</th>
                    <th class="text-primary font-weight-bold text-center">Ação</th>
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
           { data: "code_ibama" },
           { data: "denominacao_ibama" },
        ],
        datatableSelector: '#ibamaTbl'
      })
     
      // Open Modal New
      $('body').on('click', '#novoIbama', function() {
        delFormValidationErrors()
        // $('#formEstagio')[0].reset()
        $("#modalIbama").modal("show")
        $('#formIbama')[0].reset()
        $('#tituloModal').text("Novo Ibamna")
        $('#input_id').val("")
      });

      // Salvar 
      $('body').on('click', '#salvarIbama', function() {
        const JSONRequest = {
          code_ibama: $("#input_code_ibama").val(),
          denominacao_ibama: $("#input_denominacao_ibama").val(),
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
              $("#modalEstagio").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Criado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao criar, tente novamente')
          })
        }
      });

      // Editar
      $('body').on('click', '.editAction', function() {
        const id = $(this).attr('data-id');
        app.api.get(`/ibama/${id}`).then(response =>  {
          if (response && response.status) {
            delFormValidationErrors()
            
            $("#modalIbama").modal("show");
            $('#tituloModal').text("Editar Ibama")
            $('#input_id').val(response.data.id);
            $("#input_code_ibama").val(response.data.code_ibama);
            $("#input_denominacao_ibama").val(response.data.denominacao_ibama);
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
    })
  </script>
@endpush