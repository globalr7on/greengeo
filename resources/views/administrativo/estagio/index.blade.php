@extends('layouts.app', ['activePage' => 'estagios', 'titlePage' => __('Estagios OS')])
@section('subheaderTitle')
  Administrativo
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoEstagio">+ Novo Estagio</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Administrativo</h4>
              <p class="card-category">Estagios OS</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="estagioTbl">
                  <thead>
                    <th class="text-primary font-weight-bold" style="width:auto">Descrição</th>
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
  @include('administrativo.estagio.modal')
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
        $('#formEstagio')[0].reset()
        $("#modalEstagio").modal("show")
        $('#tituloModal').text("Novo Estagio")
        $('#inputId').val("")
      })

      // Salvar 
      $('body').on('click', '#salvarEstagio', function() {
        const JSONRequest = {
          descricao: $("#input_descricao").val(),
        }
        const id = $('#inputId').val()
        if (id) {
          app.api.put(`/estagio_os/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalEstagio").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Atualizado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar, tente novamente')
          })
        } else {
          app.api.post('/estagio_os', JSONRequest).then(response => {
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
        app.api.get(`/estagio_os/${id}`).then(response =>  {
          if (response && response.status) {
            delFormValidationErrors()
            $('#formEstagio')[0].reset()
            $("#modalEstagio").modal("show");
            $('#tituloModal').text("Editar Estagio")
            $('#inputId').val(response.data.id);
            $("#input_descricao").val(response.data.descricao);
          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes. Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction', function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/estagio_os/${id}`).then(response =>  {
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