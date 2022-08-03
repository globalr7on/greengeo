@extends('layouts.app', ['activePage' => 'permissions', 'titlePage' => __('Permissions')])
@section('subheaderTitle')
  Configurações
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 text-right">
          <button type="button" class="btn btn-primary" id="novaPermission">+ Nova Permissão</button>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Configurações</h4>
              <p class="card-category">Permissões</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="permissionsTbl">
                  <thead>
                    <th class="text-primary font-weight-bold" style="width:auto">Permissão</th>
                    <th class="text-primary font-weight-bold" style="width:10%">Acesso</th>
                    <th class="text-primary font-weight-bold" style="width:5%">Ação</th>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('configuracoes.permissions.modal')
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      let app = new App({
        apiUrl: '/api/permissions',
        apiDataTableColumns: [
          { data: "name" },
          { data: "guard_name" },
        ],
        apiDataTableColumnDefs: [
          {
            targets: 0,
            orderData: [1, 0]
          }
        ],
        datatableSelector: '#permissionsTbl'
      })

      // Open Modal New
      $('body').on('click', '#novaPermission', function() {
        getGuardNames()
        delFormValidationErrors()
        $("#modalFormPermission").modal("show")
        $('#modalFormPermissionTitle').text("Nova Permissão")
        $('#inputId').val("")
        $('#formPermission')[0].reset()
      });

      // Salvar 
      $('body').on('click', '#salvarPermission', function() {
        const JSONRequest = {
          name: $("#input_name").val(),
          guard_name: $("#input_guard_name").val(),
        }
        const id = $('#inputId').val()
        if (id) {
          app.api.put(`/permissions/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalFormPermission").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Permissão atualizada com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar a permissão, tente novamente')
          })
        } else {
          app.api.post('/permissions', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalFormPermission").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Permissão criada com sucesso')
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
        app.api.get(`/permissions/${id}`).then(response =>  {
          if (response && response.status) {
            delFormValidationErrors()
            $('#formPermission')[0].reset()
            $("#modalFormPermission").modal("show")
            $('#modalFormPermissionTitle').text("Editar Permissão")
            $('#inputId').val(response.data.id)
            $("#input_name").val(response.data.name)
            getGuardNames(response.data.guard_name)
          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes. Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction',  function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/permissions/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('Apagado com sucesso')
            })
            .catch(error => notifyDanger('Falha ao excluir. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      })
      
      function getGuardNames(value) {
        const data = [
          { id: 'web', name: 'web' },
          { id: 'api', name: 'api' },
        ]
        loadSelect('#input_guard_name', data, ['id', 'name'], value)
      }
    })
  </script>
@endpush