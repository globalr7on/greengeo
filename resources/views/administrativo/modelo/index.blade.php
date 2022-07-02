@extends('layouts.app', ['activePage' => 'modelo', 'titlePage' => __('Modelo')])
@section('css')
@endsection
@section('subheaderTitle')
  Administrativo
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoModelo">+ Novo Modelo</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Administrativo</h4>
              <p class="card-category">Modelo</p>
            </div>
            <div class="card-body">
              <!-- <div class="table-responsive"> -->
              <div>
                <table class="table" id="modeloTbl">
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
   @include('administrativo.modelo.modal')
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      let app = new App({
        apiUrl: '/api/modelo',
        apiDataTableColumns: [
           { data: "descricao" },
           { data: "ativo", className: "text-center", render: function (data, type) {
             return data ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'
            }},
        ],
        datatableSelector: '#modeloTbl'
      })

      // Open Modal New
      $('body').on('click', '#novoModelo', function() {
        delFormValidationErrors()
        $("#modalModelo").modal("show")
        $('#tituloModal').text("Novo Modelo")
        $('#inputId').val("")
        $('#formModelo')[0].reset()
      });

      // Salvar 
      $('body').on('click', '#salvarModelo', function() {
        const JSONRequest = {
          descricao: $("#inputDescricao").val(),
          ativo: $("#checkAtivo").prop("checked") ? 1 : 0
        }
        const id = $('#inputId').val()
        if (id) {
          app.api.put(`/modelo/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalModelo").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Atualizado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar, tente novamente')
          })
        } else {
          app.api.post('/modelo', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalModelo").modal("hide")
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
        app.api.get(`/modelo/${id}`).then(response =>  {
          if (response && response.status) {
            delFormValidationErrors()
            $('#formModelo')[0].reset()
            $("#modalModelo").modal("show");
            $('#tituloModal').text("Editar Modelo")
            $('#inputId').val(response.data.id);
            $("#inputDescricao").val(response.data.descricao);
            $("#checkAtivo").prop("checked", response.data.ativo)

          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes. Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction',  function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/modelo/${id}`).then(response =>  {
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