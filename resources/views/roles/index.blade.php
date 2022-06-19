@extends('layouts.app', ['activePage' => 'funcoes', 'titlePage' => __('Roles')])
@section('subheaderTitle')
  Configurações
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 text-right">
          <button type="button" class="btn btn-primary" id="novaFuncao">+ Nova Função</button>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Configurações</h4>
              <p class="card-category">Funções</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="rolesTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Name</th>
                    <th class="text-primary font-weight-bold">Guard</th>
                    <th class="text-primary font-weight-bold">Ação</th>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('roles.modal')
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      let app = new App({
        apiUrl: '/api/roles',
        apiDataTableColumns: [
          { data: "name" },
          { data: "guard_name" },
        ],
        datatableSelector: '#rolesTbl'
      })

      // Open Modal New
      $('body').on('click', '#novaFuncao', function() {
        getPermissions()
        delFormValidationErrors()
        $("#modalFormRole").modal("show")
        $('#modalFormRoleTitle').text("Novo Role")
        $('#inputId').val("")
        $('#formRole')[0].reset()
      });

      // Salvar 
      $('body').on('click', '#salvarRole', function() {
        const permissions = []
        $('#permissions input:checkbox:checked').each(function () { permissions.push(parseInt($(this).val())) })
        const JSONRequest = {
          name: $("#input_name").val(),
          guard_name: $("#input_guard_name").val(),
          permissions: permissions,
        }
        const id = $('#inputId').val()
        if (id) {
          app.api.put(`/roles/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalFormRole").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Role updated successfully')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Failed to update role, try again')
          })
        } else {
          app.api.post('/roles', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalFormRole").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Role created successfully')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Failed to create role, try again')
          })
        }
      });

      // Editar
      $('body').on('click', '.editAction', function() {
        const id = $(this).attr('data-id');
        app.api.get(`/roles/${id}`).then(response =>  {
          if (response && response.status) {
            delFormValidationErrors()
            $('#formRole')[0].reset()
            $("#modalFormRole").modal("show")
            $('#modalFormRoleTitle').text("Editar Role")
            $('#inputId').val(response.data.id)
            $("#input_name").val(response.data.name)
            $("#input_guard_name").val(response.data.guard_name)
            getPermissions(response.data.permissions)
          }
        })
        .catch(error => notifyDanger('Failed to get role details, try again'))
      })

      // Excluir
      $('body').on('click', '.deleteAction',  function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir a role?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/roles/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('Role deleted successfully')
            })
            .catch(error => notifyDanger('Failed to delete role, try again'))
          }
        }).catch(error => notifyDanger('An error has occurred, try again'))
      })

      function getPermissions(values) {
        app.api.get('/permissions').then(response => {
          if (response && response.status) {
            addPermissionsCheck('#permissions', response.data, values)
          }
        })
        .catch(error => {
          notifyDanger('Failed to get permissions, try again')
          $("#modalFormRole").modal("hide")
        })
      }
    })

    function addPermissionsCheck(selector, data, values = []) {
      $(selector).empty()
      data.map(curr => {
        const isChecked = values.find(val => val == curr.id) ? true : false
        $(selector).append(
          `<div class="form-check col-md-6">
            <label class="form-check-label">
              <input class="form-check-input" type="checkbox" value="${curr.id}" name="permissions[${curr.name}]" ${isChecked ? 'checked' : ''}>
              [${curr.guard_name}] ${curr.name}
              <span class="form-check-sign"><span class="check"></span></span>
            </label>
          </div>`
        )
      })
      // for show validation error
      $(selector).append('<div class="form-group"><input type="hidden" class="form-control" id="input_permissions"></div>')
    }
  </script>
@endpush