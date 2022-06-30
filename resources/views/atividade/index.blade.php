@extends('layouts.app', ['activePage' => 'atividade', 'titlePage' => __('Atividade')])
@section('css')
@endsection
@section('subheaderTitle')
  Administrativo
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novaAtividade">+ Nova Atividade</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Administrativo</h4>
              <p class="card-category">Atividade</p>
            </div>
            <div class="card-body">
              <!-- <div class="table-responsive"> -->
              <div>
                <table class="table" id="atividadeTbl">
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
   @include('atividade.modal')
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      let app = new App({
        apiUrl: '/api/atividade',
        apiDataTableColumns: [
           { data: "descricao" },
           { data: "ativo", className: "text-center", render: function (data, type) {
             return data ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'
            }},
        ],
        datatableSelector: '#atividadeTbl'
      })

      // Open Modal New
      $('body').on('click', '#novaAtividade', function() {
        delFormValidationErrors()
        $("#modalAtividade").modal("show")
        $('#tituloModal').text("Novo Atividade")
        $('#inputId').val("")
        $('#formAtividade')[0].reset()
      });

      // Salvar 
      $('body').on('click', '#salvarTratamento', function() {
        const JSONRequest = {
          descricao: $("#inputDescricao").val(),
          ativo: $("#checkAtivo").prop("checked") ? 1 : 0
          // name: $("#input_name").val(),
          // guard_name: $("#input_guard_name").val(),
        }
        const id = $('#inputId').val()
        if (id) {
          app.api.put(`/atividade/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalAtividade").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Atividade Atualizado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar o atividade, tente novamente')
          })
        } else {
          app.api.post('/atividade', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalAtividade").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Atividade Criado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao criar atividade, tente novamente')
          })
        }
      });

      // Editar
      $('body').on('click', '.editAction', function() {
        const id = $(this).attr('data-id');
        app.api.get(`/atividade/${id}`).then(response =>  {
          if (response && response.status) {
            delFormValidationErrors()
            $('#formAtividade')[0].reset()
            $("#modalAtividade").modal("show");
            $('#tituloModal').text("Editar Atividade")
            $('#inputId').val(response.data.id);
            $("#inputDescricao").val(response.data.descricao);
            $("#checkAtivo").prop("checked", response.data.ativo)


          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes do atividade. Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction',  function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir a atividade?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/atividade/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('Atividade excluído com sucesso')
            })
            .catch(error => notifyDanger('Falha ao excluir atividade. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      })
    })
  </script>
@endpush