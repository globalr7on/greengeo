@extends('layouts.app', ['activePage' => 'users', 'titlePage' => __('Create Role')])
@section('subheaderTitle')
  Configurações
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 text-right lead">
          <!-- <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">+ Novo Usuario</a> -->
          <button type="button" class="btn btn-primary" id="modalFormUser" >+ Novo Pessoa</button>
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

                @include('users.modal')
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
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
              return row.roles_name.reduce((acc, curr) => acc + `<span class="badge bg-primary">${curr}</span>`, '')
            }
          }
        ],
        datatableSelector: '#usersTbl'
      })
        // Open Modal New
      $('body').on('click', '#novoAcondicionamento', function() {
        $("#modalFormUser").modal("show");
        $('#tituloModal').text("Nova Acondicionamento");
        $('#inputId').val("");
        $("#inputDescricao").val("");
        $("#checkAtivo").prop("checked", false)
      });

      // Editar
      $('body').on('click', '.editAction', function() {
        const users_id = $(this).attr('data-id');
        app.api.get(`/users/${users_id}`).then(response =>  {
          if (response && response.data) {
            $("#modalFormUser").modal("show");
            $('#tituloModal').text("Editar Acondicionamento")
            $('#inputId').val(response.data.id);
            $("#inputDescricao").val(response.data.descricao);
            $("#checkAtivo").prop("checked", response.data.ativo)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
        })
      });

      // Excluir
      $('body').on('click', '.deleteAction',  function() {
        const users_id = $(this).attr('data-id');
        if (confirm('Aviso! Deseja realmente excluir o acondicionamento?')) {
          app.api.delete(`/users/${users_id}`).then(response =>  {
            $('#usersTbl').DataTable().ajax.reload();
          })
          .catch(error => {
            console.log('app.api.delete error', error)
          })
        }
      });
    });
    
  </script>
@endpush