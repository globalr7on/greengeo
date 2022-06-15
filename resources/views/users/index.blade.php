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
          <button type="button" class="btn btn-primary" id="novoFormUser">+ Novo Pessoa</button>
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
      app.stepper()
         // Open Modal New
      $('body').on('click', '#novoFormUser', function() {
        $("#modalFormUser").modal("show");
        $('#tituloModal').text("Novo Usuario");
        $('#inputId').val("");
        $('#formUser')[0].reset();
        $("#checkAtivo").prop("checked", false)
      });

      // Salvar 
      $('body').on('click', '#salvarUser', function() {
        const JSONRequest = {
          cpf:$("#inputCpf").val(),
          rg:$("#inputRg").val(),
          name:$("#inputNome").val(),
          email:$("#inputEmail").val(),
          cargo:$("#inputCargo").val(),
          cep:$("#inputCep").val(),
          endereco:$("#inputEndereco").val(),
          numero:$("#inputNumero").val(),
          complemento:$("#inputComplemento").val(),
          bairro:$("#inputBairro").val(),
          cidade:$("#inputCidade").val(),
          estado:$("#inputEstado").val(),
          celular:$("#inputCelular").val(),
          fixo:$("#inputFixo").val(),
          whats:$("#inputWhats").val(),
          registro_carteira:$("#inputRcarteira").val(),
          tipo_carteira:$("#inputTcarteira").val(),
          validade_carteira:$("#inputVcarteira").val(),
          identificador_celular:$("#inputIdenticadorCelular").val(),
          // usuario_responsable_cadastro_id:$("#inputUsuarioResponsavel").val(),
          // password:$("#inputPassword").val(),
          ativo:$("#checkAtivo").prop("checked") ? 1 : 0
        }
        const id = $('#inputId').val();
        
        if (id) {
          console.log('if');
          app.api.put(`/users/${id}`, JSONRequest).then(response =>  {
            if (response && response.data) {
              $("#modalFormUser").modal("hide");
              app.datatable.ajax.reload();
            }
          })
          .catch(error => {
            console.log('app.api.put error', error)
          })
        } else {
          app.api.post('/users', JSONRequest).then(response =>  {
            if (response && response.data ) {
              $("#modalFormUser").modal("hide");
              app.datatable.ajax.reload();
            } 
            // else {
            //   let message = ''
            //   Object.keys(response.data).map(key => {
            //     message += `${key}: ${response.data[key].join('\n')}\n\n`
            //   })
            //   alert(message);
            // } 
          })
          .catch(error => {
            console.log('app.api.post error', error)
          })
        }
      });

      // Editar
      $('body').on('click', '.editAction', function() {
        const users_id = $(this).attr('data-id');
        app.api.get(`/users/${users_id}`).then(response =>  {
          if (response && response.data) {
            $("#modalFormUser").modal("show");
            $('#tituloModal').text("Editar Acondicionamento")
            $('#inputId').val(response.data.id);
            $("#inputCpf").val(response.data.cpf);
            $("#inputRg").val(response.data.rg);
            $("#inputNome").val(response.data.name);
            $("#inputEmail").val(response.data.email);
            $("#inputCargo").val(response.data.cargo);
            $("#inputEndereco").val(response.data.endereco);
            $("#inputNumero").val(response.data.numero);
            $("#inputComplemento").val(response.data.complemento);
            $("#inputBairro").val(response.data.bairro);
            $("#inputCidade").val(response.data.cidade);
            $("#inputEstado").val(response.data.estado);
            $("#inputCelular").val(response.data.celular);
            $("#inputFixo").val(response.data.fixo);
            $("#inputWhats").val(response.data.whats);
            $("#inputRcarteira").val(response.data.registro_carteira);
            $("#inputTcarteira").val(response.data.tipo_carteira);
            $("#inputVcarteira").val(response.data.validade_carteira);
            // $("#inputUsuarioResponsavel").val(response.data.usuario_responsable_cadastro_id);
            // $("#inputPassword").val(response.data.password);
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
            app.datatable.ajax.reload();
          })
          .catch(error => {
            console.log('app.api.delete error', error)
          })
        }
      });
    });
  </script>
@endpush