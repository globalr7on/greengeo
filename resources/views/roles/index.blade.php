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
                    <th class="text-primary font-weight-bold">Função</th>
                    <th class="text-primary font-weight-bold">Acesso</th>
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
        removePermissions('#permissions', '#input_permissions')
        getGuardNames()
        delFormValidationErrors()
        $("#modalFormRole").modal("show")
        $('#modalFormRoleTitle').text("Nova Função")
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
              notifySuccess('Função atualizada com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar a função, tente novamente')
          })
        } else {
          app.api.post('/roles', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalFormRole").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Função criada com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao criar função, tente novamente')
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
            $('#modalFormRoleTitle').text("Editar função")
            $('#inputId').val(response.data.id)
            $("#input_name").val(response.data.name)
            setPermissions('#input_permissions', response.data.permissions, response.data.guard_name)
            getGuardNames(response.data.guard_name)
          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes da função. Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction',  function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/roles/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('Função excluída com sucesso')
            })
            .catch(error => notifyDanger('Falha ao excluir a função. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      })

      $('body').on('change', '#input_guard_name',  function(event) {
        const guardName = event.target.value == 'Seleccione' ? null : event.target.value
        const permissionsJSON = JSON.parse($('#input_permissions').val())
        if (guardName) {
          const permissions = permissionsJSON?.guardName == guardName ? permissionsJSON?.permissions : []
          getPermissions(permissions, guardName)
        }
      })

      function getGuardNames(guardValue = null) {
        const data = [
          { id: 'web', name: 'web' },
          { id: 'api', name: 'api' },
        ]
        loadSelect('#input_guard_name', data, ['id', 'name'], guardValue)
        if (!guardValue) {
          removePermissions('#permissions', '#input_permissions')
        }
      }

      function getPermissions(values, guard) {
        app.api.get(`/permissions?guard=${guard}`).then(response => {
          if (response && response.status) {
            addPermissionsCheck('#permissions', response.data, values)
          }
        })
        .catch(error => {
          notifyDanger('Falha ao obter permissões, tente novamente')
          $("#modalFormRole").modal("hide")
        })
      }
     function removePermissions(selector, inputSelector) {
        $(selector).empty()
        $(inputSelector).val("{}")
      }

      function setPermissions(selector, permissions, guardName) {
        $(selector).val(JSON.stringify({permissions, guardName}))
      }
  
      function addPermissionsCheck(selector, data, values = []) {
        $(selector).empty()
        data.map(curr => {
          const isChecked = values.find(val => val == curr.id) ? true : false
          $(selector).append(
            `<div class="form-check col-md-6 my-2">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" value="${curr.id}" name="permissions[${curr.name}]" ${isChecked ? 'checked' : ''}>
                [${curr.guard_name}] ${curr.name}
                <span class="form-check-sign"><span class="check"></span></span>
              </label>
            </div>`
          )
        })
      }
    })
  </script>
@endpush