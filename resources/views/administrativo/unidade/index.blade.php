@extends('layouts.app', ['activePage' => 'unidade', 'titlePage' => __('Unidades')])
@section('css')
@endsection
@section('subheaderTitle')
  Administrativo
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novaUnidade">+ Nova Unidade</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Administrativo</h4>
              <p class="card-category">Unidades</p>
            </div>
            <div class="card-body">
              <!-- <div class="table-responsive"> -->
              <div>
                <table class="table" id="unidadTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Descrição</th>
                    <th class="text-primary font-weight-bold">Simbolo</th>
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
   @include('administrativo.unidade.modal')
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      let app = new App({
        apiUrl: '/api/unidad',
        apiDataTableColumns: [
           { data: "descricao" },
           { data: "simbolo", className: "text-center" },
           { data: "ativo", className: "text-center", render: function (data, type) {
             return data ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'
            }},
        ],
        datatableSelector: '#unidadTbl'
      })

      // Open Modal New
      $('body').on('click', '#novaUnidade', function() {
        delFormValidationErrors()
        $("#modalUnidade").modal("show")
        $('#tituloModal').text("Nova Unidade")
        $('#inputId').val("")
        $('#formUnidade')[0].reset()
      });

      // Salvar 
      $('body').on('click', '#salvarUnidade', function() {
        const JSONRequest = {
          descricao: $("#inputDescricao").val(),
          simbolo: $("#inputSimbolo").val(),
          ativo: $("#checkAtivo").prop("checked") ? 1 : 0
          // name: $("#input_name").val(),
          // guard_name: $("#input_guard_name").val(),
        }
        const id = $('#inputId').val()
        if (id) {
          app.api.put(`/unidad/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalUnidade").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Atualizado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar, tente novamente')
          })
        } else {
          app.api.post('/unidad', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalUnidade").modal("hide")
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
        app.api.get(`/unidad/${id}`).then(response =>  {
          if (response && response.status) {
            delFormValidationErrors()
            $('#formUnidade')[0].reset()
            $("#modalUnidade").modal("show");
            $('#tituloModal').text("Editar Unidade")
            $('#inputId').val(response.data.id);
            $("#inputDescricao").val(response.data.descricao);
            $("#inputSimbolo").val(response.data.simbolo);
            $("#checkAtivo").prop("checked", response.data.ativo)

          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes. Tente novamente'))
      })

      // Excluir
      // Excluir
      $('body').on('click', '.deleteAction',  function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/unidad/${id}`).then(response =>  {
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