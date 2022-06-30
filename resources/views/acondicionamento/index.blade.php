@extends('layouts.app', ['activePage' => 'acondicionamento', 'titlePage' => __('Acondicionamento')])
@section('css')
@endsection
@section('subheaderTitle')
  Administrativo
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoAcondicionamento">+ Novo Acondicionamento</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Administrativo</h4>
              <p class="card-category">Acondicionamentos</p>
            </div>
            <div class="card-body">
              <!-- <div class="table-responsive"> -->
              <div>
                <table class="table" id="acondTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Descrição</th>
                    <th class="text-primary font-weight-bold text-center">Ativo</th>
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
   @include('acondicionamento.modal')
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      let app = new App({
        apiUrl: '/api/acondicionamento',
        apiDataTableColumns: [
           { data: "descricao" },
           { data: "ativo", className: "text-center", render: function (data, type) {
             return data ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'
            }},
        ],
        datatableSelector: '#acondTbl'
      })

      // Open Modal New
      $('body').on('click', '#novoAcondicionamento', function() {
        delFormValidationErrors()
        $("#modalAcondicionamento").modal("show")
        $('#tituloModal').text("Novo Permission")
        $('#inputId').val("")
        $('#formAcondicionamento')[0].reset()
      });

      // Salvar 
      $('body').on('click', '#salvarAcond', function() {
        const JSONRequest = {
          descricao: $("#inputDescricao").val(),
          ativo: $("#checkAtivo").prop("checked") ? 1 : 0
          // name: $("#input_name").val(),
          // guard_name: $("#input_guard_name").val(),
        }
        const id = $('#inputId').val()
        if (id) {
          app.api.put(`/acondicionamento/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalAcondicionamento").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Acondicionamento Atualizado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar a permissão, tente novamente')
          })
        } else {
          app.api.post('/acondicionamento', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalAcondicionamento").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Acondicionamento Criado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao criar permissão, tente novamente')
          })
        }
      });

      // Editar
      $('body').on('click', '.editAction', function() {
        const id = $(this).attr('data-id');
        app.api.get(`/acondicionamento/${id}`).then(response =>  {
          if (response && response.status) {
            delFormValidationErrors()
            $('#formAcondicionamento')[0].reset()
            $("#modalAcondicionamento").modal("show");
            $('#tituloModal').text("Editar Acondicionamento")
            $('#inputId').val(response.data.id);
            $("#inputDescricao").val(response.data.descricao);
            $("#checkAtivo").prop("checked", response.data.ativo)


          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes do acondicionamento. Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction',  function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir a acondicionamento?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/acondicionamento/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('Permissão excluída com sucesso')
            })
            .catch(error => notifyDanger('Falha ao excluir permissão. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      })
    })
  </script>
@endpush