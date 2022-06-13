@extends('layouts.app', ['activePage' => 'profile', 'titlePage' => __('Perfil Usuario')])
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
          <form  autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Editar Perfil') }}</h4>
                <p class="card-category">{{ __('Informação de Usuario') }}</p>
              </div>
              <div class="card-body ">
                @if (session('status'))
                  <div class="row">
                    <div class="col-md-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <fieldset>
                <h4>Documentos</h4>
                <div class="row m-0">
                  <div class="form-group col-md-4">
                    <label class="position-relative mb-0 font-weight-bold col-form-label">{{ __('Nome') }}</label>
                    <div class="form-group{{ $errors->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" required="true" aria-required="true"/>
                      @if ($errors->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                    <label class="position-relative mb-0 font-weight-bold col-form-label">{{ __('Email') }}</label>
                    <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}"  required />
                      @if ($errors->has('email'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                    <label class="position-relative mb-0 font-weight-bold col-form-label">{{ __('Cargo') }}</label>
                    <div class="form-group{{ $errors->has('cargo') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('cargo') ? ' is-invalid' : '' }}" name="cargo" id="input-cargo" type="text" placeholder="{{ __('Cargo') }}"  required />
                      @if ($errors->has('cargo'))
                        <span id="email-error" class="error text-danger" for="input-cargo">{{ $errors->first('cargo') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row m-0">
                  <div class="form-group col-md-6">
                    <label class="position-relative mb-0 font-weight-bold col-form-label">{{ __('CPF') }}</label>
                    <div class="form-group{{ $errors->has('cpf') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('cpf') ? ' is-invalid' : '' }}" name="cpf" id="input-cpf" type="text" placeholder="{{ __('CPF') }}" required="true" aria-required="true"/>
                      @if ($errors->has('cpf'))
                        <span id="cpf-error" class="error text-danger" for="input-cpf">{{ $errors->first('cpf') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group col-md-6">
                    <label class="position-relative mb-0 font-weight-bold col-form-label">{{ __('RG') }}</label>
                    <div class="form-group{{ $errors->has('rg') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('rg') ? ' is-invalid' : '' }}" name="rg" id="input-rg" type="text" placeholder="{{ __('RG') }}"  required />
                      @if ($errors->has('rg'))
                        <span id="rg-error" class="error text-danger" for="input-rg">{{ $errors->first('rg') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                </fieldset>

                <fieldset>
                <h4>Contato</h4>
                <div class="row m-0">
                  <div class="form-group col-md-4">
                    <label class="position-relative mb-0 font-weight-bold col-form-label">{{ __('Celular') }}</label>
                    <div class="form-group{{ $errors->has('celular') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('celular') ? ' is-invalid' : '' }}" name="celular" id="input-celular" type="text" placeholder="{{ __('Celular') }}" required />
                      @if ($errors->has('celular'))
                        <span id="celular-error" class="error text-danger" for="input-celular">{{ $errors->first('celular') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                    <label class="position-relative mb-0 font-weight-bold col-form-label">{{ __('Fixo') }}</label>
                    <div class="form-group{{ $errors->has('fixo') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('fixo') ? ' is-invalid' : '' }}" name="fixo" id="input-fixo" type="text" placeholder="{{ __('Fixo') }}" required />
                      @if ($errors->has('fixo'))
                        <span id="fixo-error" class="error text-danger" for="input-fixo">{{ $errors->first('fixo') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                    <label class="position-relative mb-0 font-weight-bold col-form-label">{{ __('Whatsapp') }}</label>
                    <div class="form-group{{ $errors->has('whats') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('whats') ? ' is-invalid' : '' }}" name="whats" id="input-whats" type="text" placeholder="{{ __('Whats') }}"  required />
                      @if ($errors->has('whats'))
                        <span id="whats-error" class="error text-danger" for="input-whats">{{ $errors->first('whats') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                </fieldset>

                <fieldset>
                <h4>Endereço</h4>
                <div class="row m-0">
                  <div class="form-group col-md-4">
                    <label class="position-relative mb-0 font-weight-bold col-form-label">{{ __('Endereço') }}</label>
                    <div class="form-group{{ $errors->has('endereco') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('endereco') ? ' is-invalid' : '' }}" name="endereco" id="input-endereco" type="text" placeholder="{{ __('Endereço') }}"  required />
                      @if ($errors->has('endereco'))
                        <span id="endereco-error" class="error text-danger" for="input-endereco">{{ $errors->first('endereco') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                    <label class="position-relative mb-0 font-weight-bold col-form-label">{{ __('Número') }}</label>
                    <div class="form-group{{ $errors->has('numero') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('numero') ? ' is-invalid' : '' }}" name="numero" id="input-numero" type="number" placeholder="{{ __('Número') }}"  required />
                      @if ($errors->has('numero'))
                        <span id="numero-error" class="error text-danger" for="input-numero">{{ $errors->first('numero') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                    <label class="position-relative mb-0 font-weight-bold col-form-label">{{ __('Complemento') }}</label>
                    <div class="form-group{{ $errors->has('complemento') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('complemento') ? ' is-invalid' : '' }}" name="complemento" id="input-complemento" type="text" placeholder="{{ __('complemento') }}" required />
                      @if ($errors->has('complemento'))
                        <span id="complemento-error" class="error text-danger" for="input-complemento">{{ $errors->first('complemento') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                
                <div class="row m-0">
                  <div class="form-group col-md-3">
                    <label class="position-relative mb-0 font-weight-bold col-form-label">{{ __('CEP') }}</label>
                    <div class="form-group{{ $errors->has('cep') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('cep') ? ' is-invalid' : '' }}" name="cep" id="input-cep" type="text" placeholder="{{ __('CEP') }}"  required />
                      @if ($errors->has('cep'))
                        <span id="cep-error" class="error text-danger" for="input-cep">{{ $errors->first('cep') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="position-relative mb-0 font-weight-bold col-form-label">{{ __('Bairro') }}</label>
                    <div class="form-group{{ $errors->has('bairro') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('bairro') ? ' is-invalid' : '' }}" name="bairro" id="input-bairro" type="text" placeholder="{{ __('Bairro') }}"  required />
                      @if ($errors->has('bairro'))
                        <span id="bairro-error" class="error text-danger" for="input-bairro">{{ $errors->first('bairro') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="position-relative mb-0 font-weight-bold col-form-label">{{ __('Cidade') }}</label>
                    <div class="form-group{{ $errors->has('cidade') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('cidade') ? ' is-invalid' : '' }}" name="cidade" id="input-cidade" type="text" placeholder="{{ __('Cidade') }}" required />
                      @if ($errors->has('cidade'))
                        <span id="cidade-error" class="error text-danger" for="input-cidade">{{ $errors->first('cidade') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="position-relative mb-0 font-weight-bold col-form-label">{{ __('Estado') }}</label>
                    <div class="form-group{{ $errors->has('estado') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('estado') ? ' is-invalid' : '' }}" name="estado" id="input-estado" type="text" placeholder="{{ __('estado') }}" required />
                      @if ($errors->has('estado'))
                        <span id="estado-error" class="error text-danger" for="input-estado">{{ $errors->first('estado') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                </fieldset>
                <fieldset>
                <h4>Carteira</h4>
                <div class="row m-0">
                  <div class="form-group col-md-3">
                    <label class="position-relative mb-0 font-weight-bold col-form-label">{{ __('Registro Carteira') }}</label>
                    <div class="form-group{{ $errors->has('registro_carteira') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('registro_carteira') ? ' is-invalid' : '' }}" name="registro_carteira" id="input-registro_carteira" type="text" placeholder="{{ __('Registro Carteira') }}" required />
                      @if ($errors->has('celular'))
                        <span id="registro_carteira-error" class="error text-danger" for="input-registro_carteira">{{ $errors->first('registro_carteira') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="position-relative mb-0 font-weight-bold col-form-label">{{ __('Tipo Carteira') }}</label>
                    <div class="form-group{{ $errors->has('tipo_carteira') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('tipo_carteira') ? ' is-invalid' : '' }}" name="tipo_carteira" id="input-tipo_carteira" type="text" placeholder="{{ __('tipo_carteira') }}" required />
                      @if ($errors->has('tipo_carteira'))
                        <span id="tipo_carteira-error" class="error text-danger" for="input-tipo_carteira">{{ $errors->first('tipo_carteira') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="form-group col-md-3">
                    <label class="position-relative mb-0 font-weight-bold col-form-label">{{ __('Validade Carteira') }}</label>
                    <div class="form-group{{ $errors->has('tipo_carteira') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('tipo_carteira') ? ' is-invalid' : '' }}" name="tipo_carteira" id="input-validade_carteira" type="text" placeholder="{{ __('Validade Carteira') }}" required />
                      @if ($errors->has('tipo_carteira'))
                        <span id="tipo_carteira-error" class="error text-danger" for="input-tipo_carteira">{{ $errors->first('tipo_carteira') }}</span>
                      @endif
                    </div>
                  </div>
                  <div class="row m-0">
                  <div class="form-group col-md-3">
                    <label class="position-relative mb-0 font-weight-bold col-form-label">{{ __('Identificador de Celular') }}</label>
                    <div class="form-group{{ $errors->has('identificador_celular') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('identificador_celular') ? ' is-invalid' : '' }}" name="identificador_celular" id="input-identificador_celular" type="text" placeholder="{{ __('Identificador de Celular') }}" required />
                      @if ($errors->has('identificador_celular'))
                        <span id="identificador_celular-error" class="error text-danger" for="input-identificador_celular">{{ $errors->first('identificador_celular') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                </div>
                </fieldset>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="button" class="btn btn-primary" id="salvarProfile">{{ __('Salvar') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.password') }}" class="form-horizontal">
            @csrf
            @method('put')

            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Mudar senha') }}</h4>
                <p class="card-category">{{ __('Senha') }}</p>
              </div>
              <div class="card-body ">
                @if (session('status_password'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status_password') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-current-password">{{ __('Senha atual') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('old_password') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('old_password') ? ' is-invalid' : '' }}" input type="password" name="old_password" id="input-current-password" placeholder="{{ __('Senha Atual') }}" value="" required />
                      @if ($errors->has('old_password'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors->first('old_password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password">{{ __('Nova Senha') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" id="input-password" type="password" placeholder="{{ __('Nova Senha') }}" value="" required />
                      @if ($errors->has('password'))
                        <span id="password-error" class="error text-danger" for="input-password">{{ $errors->first('password') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label" for="input-password-confirmation">{{ __('Confirme a nova senha') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group">
                      <input class="form-control" name="password_confirmation" id="input-password-confirmation" type="password" placeholder="{{ __('Confirme a nova senha') }}" value="" required />
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Mudar senha') }}</button>
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
       const profile_1 ="{{ auth()->user()->id }}";
      //  console.log(profile_1);
       $.ajax({
        type: "GET",
        url: `/api/users/${profile_1}`,
      }).done(function (response) {
        console.log(response);
        if (response && response.data) {
          $('#input-name').val(response.data.name);
          $('#input-email').val(response.data.email);
          $('#input-cargo').val(response.data.cargo);
          $('#input-cpf').val(response.data.cpf);
          $("#input-rg").val(response.data.rg);
          $("#input-celular").val(response.data.celular);
          $("#input-fixo").val(response.data.fixo);
          $("#input-whats").val(response.data.whats);
          $("#input-endereco").val(response.data.endereco);
          $("#input-numero").val(response.data.numero);
          $("#input-complemento").val(response.data.complemento);
          $("#input-cep").val(response.data.cep);
          $("#input-bairro").val(response.data.bairro);
          $("#input-cidade").val(response.data.cidade);
          $("#input-estado").val(response.data.estado);
          $("#input-registro_carteira").val(response.data.registro_carteira);
          $("#input-tipo_carteira").val(response.data.tipo_carteira);
          $("#input-validade_carteira").val(response.data.validade_carteira);
          $("#input-identificador_celular").val(response.data.identificador_celular);
        }
      });
      // Salvar 
      $('body').on('click', '#salvarProfile', function(){
        const JSONRequest = {
          name: $('#input-name').val(),
          email: $('#input-email').val(),
          cpf: $('#input-cpf').val(),
          rg: $("#input-rg").val(),
          cargo: $("#input-cargo").val(),
          celular: $("#input-celular").val(),
          fixo: $("#input-fixo").val(),
          whats: $("#input-whats").val(),
          endereco: $("#input-endereco").val(),
          numero: $("#input-numero").val(),
          complemento: $("#input-complemento").val(),
          cep: $("#input-cep").val(),
          bairro: $("#input-bairro").val(),
          cidade: $("#input-cidade").val(),
          estado: $("#input-estado").val(),
          registro_carteira: $("#input-registro_carteira").val(),
          tipo_carteira: $("#input-tipo_carteira").val(),
          validade_carteira: $("#input-validade_carteira").val(),
          identificador_celular: $("#input-identificador_celular").val()
        }
    
        const profile_id ="{{ auth()->user()->id }}";
        $.ajax({
          type: "PUT",
          url: `/api/users/${profile_id}`,
          data: JSONRequest,
          dataType: "json",
          encode: true,
        }).done(function (response) {
            console.log(response);
          })
      });
  </script>
@endpush
