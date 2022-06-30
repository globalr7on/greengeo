@extends('layouts.app', ['activePage' => 'estagios', 'titlePage' => __('Estagios OS')])
@section('css')
@endsection
@section('subheaderTitle')
  Administrativo
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoEstagio">+ Novo Clase</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Administrativo</h4>
              <p class="card-category">Estagios OS</p>
            </div>
            <div class="card-body">
              <!-- <div class="table-responsive"> -->
              <div>
                <table class="table" id="estagioTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Descrição</th>
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
   @include('estagio.modal')
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      let app = new App({
        apiUrl: '/api/estagio_os',
        apiDataTableColumns: [
           { data: "descricao" },
        ],
        datatableSelector: '#estagioTbl'
      })
     
      // Open Modal New
      $('body').on('click', '#novoEstagio', function() {
        delFormValidationErrors()
        // $('#formEstagio')[0].reset()
        $("#modalEstagio").modal("show")
         $('#formEstagio')[0].reset()
        $('#tituloModal').text("Novo Estagio")
        $('#inputId').val("")
        // $('#formEstagio')[0].reset()
      });

      // Salvar 
      $('body').on('click', '#salvarEstagio', function() {
        const JSONRequest = {
          descricao: $("#inputDescricao").val(),
         
        }
        const id = $('#inputId').val()
        if (id) {
          app.api.put(`/estagio_os/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalEstagio").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Estagio Atualizado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar o Estagio, tente novamente')
          })
        } else {
          app.api.post('/estagio_os', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalEstagio").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Estagio Criado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao criar Estagio, tente novamente')
          })
        }
      });

      // Editar
      $('body').on('click', '.editAction', function() {
        const id = $(this).attr('data-id');
        app.api.get(`/estagio_os/${id}`).then(response =>  {
          if (response && response.status) {
            delFormValidationErrors()
            // $('#formEstagio')[0].reset()
            $("#modalEstagio").modal("show");
            $('#tituloModal').text("Editar clase")
            $('#inputId').val(response.data.id);
            $("#inputDescricao").val(response.data.descricao);
          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes do Estagio. Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction',  function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir a clase?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/estagio_os/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('Estagio excluído com sucesso')
            })
            .catch(error => notifyDanger('Falha ao excluir Estagio. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      })
    })
  </script>
@endpush