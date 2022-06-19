@extends('layouts.app', ['activePage' => 'users', 'titlePage' => __('Create Role')])
@section('subheaderTitle')
  Configurações
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 text-right lead">
          <button type="button" class="btn btn-primary" id="novoUser">+ Novo Usuario</button>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Configurações</h4>
              <p class="card-category">Usuarios</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="usersTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">CPF</th>
                    <th class="text-primary font-weight-bold">Nome</th>
                    <th class="text-primary font-weight-bold">Email</th>
                    <th class="text-primary font-weight-bold">Cargo</th>
                    <th class="text-primary font-weight-bold">Funções</th>
                    <th class="text-primary font-weight-bold">Usuario Responsavel</th>
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
  @include('users.modal')
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      let app = new App({
        apiUrl: '/api/users',
        apiDataTableColumns: [
          { data: "cpf" },
          { data: "name" },
          { data: "email" },
          { data: "cargo" },
          { data: "roles_name" },
          { data: "usuario_responsavel_cadastro" }
        ],
        apiDataTableColumnDefs: [
          {
            targets : 4,
            render : function (data, type, row) {
              return row.role_name ? `<span class="badge bg-primary">${row.role_name}</span>` : ''
            }
          }
        ],
        datatableSelector: '#usersTbl'
      })

      // Open Modal New
      $('body').on('click', '#novoUser', function() {
        app.stepper()
        delFormValidationErrors()
        $("#modalFormUser").modal("show")
        $('#modalFormUserTitle').text("Novo Usuario")
        $('#inputId').val("")
        $('#formUser')[0].reset()
        getRoles()
      });

      // Salvar 
      $('body').on('click', '#salvarUser', function() {
        const JSONRequest = {
          cpf: $("#input_cpf").val(),
          rg: $("#input_rg").val(),
          name: $("#input_name").val(),
          email: $("#input_email").val(),
          cargo: $("#input_cargo").val(),
          cep: $("#input_cep").val(),
          endereco: $("#input_endereco").val(),
          numero: $("#input_numero").val(),
          complemento: $("#input_complemento").val(),
          bairro: $("#input_bairro").val(),
          cidade: $("#input_cidade").val(),
          estado: $("#input_estado").val(),
          celular: $("#input_celular").val(),
          fixo: $("#input_fixo").val(),
          whats: $("#input_whats").val(),
          registro_carteira: $("#input_registro_carteira").val(),
          tipo_carteira: $("#input_tipo_carteira").val(),
          validade_carteira: $("#input_validade_carteira").val(),
          identificador_celular: $("#input_identificador_celular").val(),
          role: $("#input_role").val(),
          // usuario_responsable_cadastro_id: 1
        }
        const id = $('#inputId').val()
        if (id) {
          app.api.put(`/users/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalFormUser").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('User updated successfully')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Failed to update user, try again')
          })
        } else {
          app.api.post('/users', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalFormUser").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('User created successfully')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Failed to create user, try again')
          })
        }
      });

      // Editar
      $('body').on('click', '.editAction', function() {
        app.stepper()
        const id = $(this).attr('data-id');
        app.api.get(`/users/${id}`).then(response =>  {
          if (response && response.status) {
            getRoles(response.data.role_id)
            delFormValidationErrors()
            $('#formUser')[0].reset()
            $("#modalFormUser").modal("show")
            $('#modalFormUserTitle').text("Editar Usuario")
            $('#inputId').val(response.data.id)
            $("#input_cpf").val(response.data.cpf)
            $("#input_rg").val(response.data.rg)
            $("#input_name").val(response.data.name)
            $("#input_email").val(response.data.email)
            $("#input_cargo").val(response.data.cargo)
            $("#input_endereco").val(response.data.endereco)
            $("#input_numero").val(response.data.numero)
            $("#input_complemento").val(response.data.complemento)
            $("#input_cep").val(response.data.cep)
            $("#input_bairro").val(response.data.bairro)
            $("#input_cidade").val(response.data.cidade)
            $("#input_estado").val(response.data.estado)
            $("#input_celular").val(response.data.celular)
            $("#input_fixo").val(response.data.fixo)
            $("#input_whats").val(response.data.whats)
            $("#input_registro_carteira").val(response.data.registro_carteira)
            $("#input_tipo_carteira").val(response.data.tipo_carteira)
            $("#input_validade_carteira").val(response.data.validade_carteira)
            $("#input_identificador_celular").val(response.data.identificador_celular)
          }
        })
        .catch(error => notifyDanger('Failed to get user details, try again'))
      })

      // Excluir
      $('body').on('click', '.deleteAction',  function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir a usuario?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/users/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('User deleted successfully')
            })
            .catch(error => notifyDanger('Failed to delete user, try again'))
          }
        }).catch(error => notifyDanger('An error has occurred, try again'))
      })

      function getRoles(value) {
        app.api.get('/roles').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_role', response.data, ['id', 'name'], value)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Failed to get roles, try again')
        })
      }
    })
  </script>
@endpush