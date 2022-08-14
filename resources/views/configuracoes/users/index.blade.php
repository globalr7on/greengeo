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
                    <th class="text-primary font-weight-bold" style="width:10%">CPF</th>
                    <th class="text-primary font-weight-bold" style="width:auto">Nome</th>
                    <th class="text-primary font-weight-bold" style="width:auto">Email</th>
                    <th class="text-primary font-weight-bold" style="width:10%">Cargo</th>
                    <th class="text-primary font-weight-bold" style="width:20%">Funções</th>
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
  @include('configuracoes.users.modal')
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      const id = {{ Auth::user()->id }}
      const tipoEmpresaId = "{{ Auth::user()->pessoa_juridica ? Auth::user()->pessoa_juridica->tipo_empresa_id : null }}" || null
      const tipoEmpresa = tipoEmpresaId ? "{{ Auth::user()->pessoa_juridica ? Auth::user()->pessoa_juridica->tipo_empresa->descricao : null }}" : null
      const isGerador = !tipoEmpresa || tipoEmpresa.toLowerCase() == 'gerador' ? true : false
      const empresaId = isGerador ? null : "{{ Auth::user()->pessoa_juridica_id }}"
      let app = new App({
        apiUrl: `/api/users${id ? '?usuario_responsavel_cadastro_id='+id : ''}`,
        apiDataTableColumns: [
          { data: "cpf" },
          { data: "name" },
          { data: "email" },
          { data: "cargo" },
          { data: "roles_name" },
        ],
        apiDataTableColumnDefs: [
          {
            targets: 4,
            render: function (data, type, row) {
              const roleWeb = row.role_name_web ? `<span class="badge bg-primary">[Web] ${row.role_name_web}</span>` : ''
              const roleApi = row.role_name_api ? `<span class="badge bg-danger">[Api] ${row.role_name_api}</span>` : ''

              return `${roleWeb} ${roleApi}`
            }
          }
        ],
        datatableSelector: '#usersTbl'
      })

      // Open Modal New
      $('body').on('click', '#novoUser', function() {
        app.stepper()
        if (isGerador) {
          $('body').on('change', '#input_tipo_empresa_id', updateEmpresaFromTipo)
        }
        delFormValidationErrors()
        $("#modalFormUser").modal("show")
        $('#modalFormUserTitle').text("Novo Usuario")
        $('#inputId').val("")
        $('#formUser')[0].reset()
        getRoles(null, 'web')
        getRoles(null, 'api')
        getTipoEmpresa(isGerador ? null : tipoEmpresaId, !isGerador)
        getEmpresa(!isGerador ? empresaId : null, isGerador ? null : tipoEmpresaId, true, !isGerador)
        getTipoCarteira()
        $('#motorista').hide()
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
          pessoa_juridica_id: $("#input_pessoa_juridica_id").val(),
          usuario_responsavel_cadastro_id: $("#input_usuario_responsavel_cadastro_id").val(),
          identificador_celular: '123456',
          role_web: $("#input_role_web").val(),
          role_api: $("#input_role_api").val(),
        }
        const id = $('#inputId').val()
        if (id) {
          app.api.put(`/users/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalFormUser").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Usuário atualizado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar o usuário, tente novamente')
          })
        } else {
          app.api.post('/users', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalFormUser").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Usuário criado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao criar usuário, tente novamente')
          })
        }
      });

      // Editar
      $('body').on('click', '.editAction', function() {
        app.stepper()
        $('body').off('change', '#input_tipo_empresa_id', updateEmpresaFromTipo)
        const id = $(this).attr('data-id');
        app.api.get(`/users/${id}`).then(response =>  {
          if (response && response.status) {
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
            $("#input_validade_carteira").val(response.data.validade_carteira)
            $("#input_identificador_celular").val(response.data.identificador_celular)
            getTipoEmpresa(response.data.tipo_empresa_id, true)
            getEmpresa(response.data.pessoa_juridica_id, null, true, true)
            getRoles(response.data.role_web, 'web')
            getRoles(response.data.role_api, 'api')
            getTipoCarteira(response.data.tipo_carteira, true)
            $('#motorista').hide()
          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes do usuário, tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction',  function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir a usuario?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/users/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('Usuário excluído com sucesso')
            })
            .catch(error => notifyDanger('Falha ao excluir usuário, tente novamente'))
          }
        })
        .catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      })

      function getRoles(value, guard) {
        app.api.get(`/roles?guard=${guard}`).then(response =>  {
          if (response && response.status) {
            loadSelect(`#input_role_${guard}`, response.data, ['id', 'name'], value)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter funções, tente novamente')
        })
      }

      $('body').on('change', '#input_role_web', function(event) {
        let role = event.target.options[event.target.options.selectedIndex].text
        if (role == "motorista") {
          $('#motorista').show()
        } else {
          $('#motorista').hide()
        }
        syncRoleApi(role)
      })

      $('body').on('blur', '#input_cep , #input_numero', function() {
        let cep = $('#input_cep').val()
        let numero = $('#input_numero').val()
        if(cep && numero) {
          delFormValidationErrors()
          app.api.get(`/geo?cep=${cep}&numero=${numero}`).then(response =>  {
            if (response.status) {
              $('#input_endereco').val(response.data.endereco)
              $('#input_bairro').val(response.data.bairro)
              $('#input_cidade').val(response.data.cidade)
              $('#input_estado').val(response.data.estado)
              $('#salvarUser').attr('disabled', false)
            } else {
              notifyDanger(response.data)
            }
          })
          .catch(error => {
            notifyDanger(error.data)
            addInputError('input_cep', error.data)
            $('#salvarUser').attr('disabled', true)
          })
        }
      })
      
      function getEmpresa(value, tipoEmpresaId, showCurrentEmpresa, disabled) {
        app.api.get(`/pessoa_juridica?show_current_empresa=${showCurrentEmpresa}${tipoEmpresaId ? '&tipo_empresa_id='+tipoEmpresaId : ''}`).then(response =>  {
          if (response && response.status) {
            loadSelect('#input_pessoa_juridica_id', response.data, ['id', 'razao_social'], value, disabled)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter empresa, tente novamente')
        })
      }

      function getTipoEmpresa(value, disabled) {
        app.api.get(`/tipo_empresa${value ? '?id='+value : ''}`).then(response =>  {
          if (response && response.status) {
            loadSelect('#input_tipo_empresa_id', response.data, ['id', 'descricao'], value, disabled)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter tipo empresa, tente novamente')
        })
      }

      function getTipoCarteira(value) {
        const data = [
          { id: 1, descricao: 'A - Motos e triciclos' },
          { id: 2, descricao: 'B - Carros de Passeio' },
          { id: 3, descricao: 'C - Veiculos de Carga Acima 3,5 ton' },
          { id: 4, descricao: 'D - Veiculos com + de 8 Passageiros' },
          { id: 5, descricao: 'E - Veiculos com unidade acoplada Acima de 6 ton' }
        ]
        loadSelect('#input_tipo_carteira', data, ['id', 'descricao'], value)
      }      

      function updateEmpresaFromTipo(event) {
        let currentTipoEmpresa = event.target.options[event.target.options.selectedIndex].text
        getEmpresa(null, event.target.value, tipoEmpresa == currentTipoEmpresa)
      }

      function syncRoleApi(value) {
        $('#input_role_api').find('option').each(function () {
          if ($(this).text() == value) {
            $('#input_role_api').selectpicker('val', $(this).val())
          }
        })
      }
    })
  </script>
@endpush