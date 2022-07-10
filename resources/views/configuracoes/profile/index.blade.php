@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Perfil Usuario')])
@section('subheaderTitle')
  Configurações
@endsection
@section('css')
<style>
  fieldset {
    display: block;
    margin-left: 2px;
    margin-right: 2px;
    padding-top: 0.35em;
    padding-bottom: 0.625em;
    padding-left: 0.75em;
    padding-right: 0.75em;
    border: 1px;
    border-color:black !important;
  }
</style>
@endsection

@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <form id="formProfile" class="form-horizontal">
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Configurações') }}</h4>
                <p class="card-category">{{ __('Perfil') }}</p>
              </div>

              <div class="card-body ">
                <fieldset>
                  <h4 class="text-primary font-weight-bold text-uppercase mb-4">Documentos</h4>
                  <div class="row mx-0 mb-4">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="input_name">{{ __('Nome') }}</label>
                        <input type="text" class="form-control" id="input_name" placeholder="Nome Completo">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="input_email">{{ __('Email') }}</label>
                        <input type="text" class="form-control" id="input_email" placeholder="email@demo.com">
                      </div>
                    </div>
                  </div>

                  <div class="row mx-0 mb-4">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_cargo">{{ __('Cargo') }}</label>
                        <input type="text" class="form-control" id="input_cargo" placeholder="Cargo do usuario">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_cpf">{{ __('CPF') }}</label>
                        <input type="text" class="form-control maskcpf" id="input_cpf" placeholder="123.456.789-10">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_rg">{{ __('RG') }}</label>
                        <input type="text" class="form-control maskrg" id="input_rg" placeholder="A-12345678">
                      </div>
                    </div>
                  </div>
                </fieldset>

                <fieldset>
                  <h4 class="text-primary font-weight-bold text-uppercase mb-4">Contato</h4>
                  <div class="row mx-0 mb-4">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_celular">{{ __('Celular') }}</label>
                        <input type="text" class="form-control maskphone1" id="input_celular" placeholder="+55..">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_fixo">{{ __('Fixo') }}</label>
                        <input type="text" class="form-control maskfixo" id="input_fixo" placeholder="+55..">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_whats">{{ __('Whatsapp') }}</label>
                        <input type="text" class="form-control maskwhats" id="input_whats" placeholder="+55..">
                      </div>
                    </div>
                  </div>
                </fieldset>

                <fieldset>
                  <h4 class="text-primary font-weight-bold text-uppercase mb-4">Endereço</h4>
                  <div class="row mx-0 mb-4">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="input_cep">CEP</label>
                        <input type="text" class="form-control maskcep" id="input_cep" placeholder="123456-789">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="input_numero">Número</label>
                        <input type="text" class="form-control" id="input_numero" placeholder="123...">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="input_complemento">Complemento</label>
                        <input type="text" class="form-control" id="input_complemento" placeholder="Casa nro ...">
                      </div>
                    </div>
                  </div>

                  <div class="row mx-0 mb-4">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="input_endereco">Endereço</label>
                        <input type="text" class="form-control" id="input_endereco" placeholder="Rua agusto ...">
                      </div>
                    </div>
                    
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="input_bairro">Bairro</label>
                        <input type="text" class="form-control" id="input_bairro" placeholder="Nome do bairro">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="input_cidade">Cidade</label>
                        <input type="text" class="form-control" id="input_cidade" placeholder="Nome da cidade">
                      </div>
                    </div>

                    <div class="col-md-1">
                      <div class="form-group">
                        <label for="input_estado">Estado</label>
                        <input type="text" class="form-control" id="input_estado" placeholder="Estado">
                      </div>
                    </div>
                  </div>
                </fieldset>

                <fieldset>
                  <h4 class="text-primary font-weight-bold text-uppercase mb-4">Carteira</h4>
                  <div class="row mx-0 mb-4">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_registro_carteira">Registros Carteira</label>
                        <input type="text" class="form-control" id="input_registro_carteira" placeholder="...">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_tipo_carteira">Tipo de Carteira</label>
                        <input type="text" class="form-control" id="input_tipo_carteira" placeholder="...">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_validade_carteira">Validade de Carteira</label>
                        <input type="text" class="form-control datepicker" id="input_validade_carteira" placeholder="...">
                      </div>
                    </div>
                  </div>
                </fieldset>

                <fieldset>
                  <h4 class="text-primary font-weight-bold text-uppercase mb-2">Funçãos</h4>
                  <div class="row mx-0">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="input_role_web" class="display-inherit mb-0">Função Web</label>
                        <select data-style="btn-warning text-white" title="Select" name="role_web" id="input_role_web"></select>
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="input_role_api" class="display-inherit mb-0">Função Api</label>
                        <select data-style="btn-warning text-white" title="Select" name="role_api" id="input_role_api"></select>
                      </div>
                    </div>
                  </div>
                </fieldset>
              </div>

              <div class="card-footer mx-4">
                <button type="button" class="btn btn-primary" id="salvarProfile">{{ __('Salvar') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>

      <div class="row">
        <div class="col-md-12">
          <form id="formPassword" class="form-horizontal">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Mudar senha') }}</h4>
                <p class="card-category">{{ __('Senha') }}</p>
              </div>

              <div class="card-body mt-4">
                <div class="row m-0">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="input_old_password">{{ __('Senha atual') }}</label>
                      <input type="password" class="form-control" id="input_old_password" name="old_password" placeholder="*********">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="input_password">{{ __('Nova Senha') }}</label>
                      <input type="password" class="form-control" id="input_password" name="password" placeholder="*********">
                    </div>
                  </div>
                  
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="input_password_confirmation">{{ __('Confirme a nova senha') }}</label>
                      <input type="password" class="form-control" id="input_password_confirmation" name="password_confirmation" placeholder="*********">
                    </div>
                  </div>
                </div>
              </div>

              <div class="card-footer mx-4">
                <button type="button" class="btn btn-primary" id="salvarPassword">{{ __('Mudar senha') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      let app = new App({})
      $('#salvarProfile').attr('disabled', true)

      $('#formProfile').submit(function(event) {
        event.preventDefault()
      })

      $('#formPassword').submit(function(event) {
        event.preventDefault()
      })

      function getRoles(value, guard) {
        app.api.get(`/roles?guard=${guard}`).then(response =>  {
          if (response && response.status) {
            loadSelect(`#input_role_${guard}`, response.data, ['id', 'name'], value)
          }
        })
        .catch(error => notifyDanger('Falha ao obter funções, tente novamente'))
      }

      // Get profile
      app.api.get('/profile/me').then(response =>  {
        if (response && response.status) {
          $('#input_name').val(response.data.name);
          $('#input_email').val(response.data.email);
          $('#input_cargo').val(response.data.cargo);
          $('#input_cpf').val(response.data.cpf);
          $("#input_rg").val(response.data.rg);
          $("#input_celular").val(response.data.celular);
          $("#input_fixo").val(response.data.fixo);
          $("#input_whats").val(response.data.whats);
          $("#input_endereco").val(response.data.endereco);
          $("#input_numero").val(response.data.numero);
          $("#input_complemento").val(response.data.complemento);
          $("#input_cep").val(response.data.cep);
          $("#input_bairro").val(response.data.bairro);
          $("#input_cidade").val(response.data.cidade);
          $("#input_estado").val(response.data.estado);
          $("#input_registro_carteira").val(response.data.registro_carteira);
          $("#input_tipo_carteira").val(response.data.tipo_carteira);
          $("#input_validade_carteira").val(response.data.validade_carteira);
          $("#input_identificador_celular").val(response.data.identificador_celular);
          getRoles(response.data.role_web, 'web');
          getRoles(response.data.role_api, 'api');
          $('#salvarProfile').attr('disabled', false)
        }
      });

      $('body').on('blur', '#input_cep , #input_numero', function() {
        var cep = $('#input_cep').val()
        var numero = $('#input_numero').val()
        if(cep && numero) {
          app.api.get(`/geo?cep=${cep}&numero=${numero}`).then(response =>  {
            if (response.status) {
              $('#input_endereco').val(response.data.endereco)
              $('#input_bairro').val(response.data.bairro)
              $('#input_cidade').val(response.data.cidade)
              $('#input_estado').val(response.data.estado)
            } else {
              notifyDanger(response.data)
            }
          })
          .catch(error => notifyDanger('Falha ao obter dados de endereço, tente novamente'))
        }
      })

      // Salvar 
      $('body').on('click', '#salvarProfile', function() {
        const JSONRequest = {
          name: $('#input_name').val(),
          email: $('#input_email').val(),
          cpf: $('#input_cpf').val(),
          rg: $("#input_rg").val(),
          cargo: $("#input_cargo").val(),
          celular: $("#input_celular").val(),
          fixo: $("#input_fixo").val(),
          whats: $("#input_whats").val(),
          endereco: $("#input_endereco").val(),
          numero: $("#input_numero").val(),
          complemento: $("#input_complemento").val(),
          cep: $("#input_cep").val(),
          bairro: $("#input_bairro").val(),
          cidade: $("#input_cidade").val(),
          estado: $("#input_estado").val(),
          registro_carteira: $("#input_registro_carteira").val(),
          tipo_carteira: $("#input_tipo_carteira").val(),
          validade_carteira: $("#input_validade_carteira").val(),
          identificador_celular: '123456',
          role_web: $("#input_role_web").val(),
          role_api: $("#input_role_api").val(),
        }

        app.api.put('/profile', JSONRequest).then(response => {
          if (response && response.status) {
            delFormValidationErrors()
            notifySuccess('Atualizado com sucesso')
          }
        })
        .catch(error => {
          addFormValidationErrors(error?.data)
          notifyDanger('Falha ao atualizar, tente novamente')
        })
      });

      // Update password 
      $('body').on('click', '#salvarPassword', function() {
        const JSONRequest = {
          old_password: $('#input_old_password').val(),
          password: $('#input_password').val(),
          password_confirmation: $('#input_password_confirmation').val()
        }

        app.api.put('/profile/password', JSONRequest).then(response => {
          if (response && response.status) {
            delFormValidationErrors()
            $('#formPassword')[0].reset()
            notifySuccess('Atualizado com sucesso')
          }
        })
        .catch(error => {
          addFormValidationErrors(error?.data)
          notifyDanger('Falha ao atualizar, tente novamente')
        })
      });
    });
  </script>
@endpush