@extends('layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'title' => __('GreenBeat')])

@section('content')
<div class="container" style="height: auto;">
  <div class="row align-items-center">
    <div class="col-md-6 ml-auto mr-auto mb-3 text-center">
      <h1 class ="text-left">{{ __('Bem-vindo ao sistema de descarte de produtos.') }} </h1>
    </div>
    <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
      <form class="form" method="POST" action="{{ route('login') }}">
        @csrf

        <div class="card card-login card-hidden mb-3">
          <div class="card-header card-header-primary text-center">
            <h4 class="card-title"><strong>{{ __('Login') }}</strong></h4>
          </div>
          <div class="card-body">
            <p class="card-description text-center">{{ __('Entre com seus dados') }}</p>

            <div class="bmd-form-group{{ $errors->has('cnpj') ? ' has-danger' : '' }}">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                  <i class="fas fa-id-card"></i>
                  </span>
                </div>
                <input type="text" name="cpf" class="form-control" placeholder="{{ __('CPF...') }}" value="" required>
              </div>
              @if ($errors->has('cpf'))
                <div id="cpf-error" class="error text-danger pl-3" for="cpf" style="display: block;">
                  <strong>{{ $errors->first('cpf') }}</strong>
                </div>
              @endif
            </div>

            <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
              <div class="input-group">
                <div class="input-group-prepend">
                  <span class="input-group-text">
                    <!-- <i class="material-icons">lock_outline</i> -->
                    <i class="fas fa-lock"></i>
                  </span>
                </div>
                <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Senha...') }}" value="" required>
              </div>
              @if ($errors->has('password'))
                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                  <strong>{{ $errors->first('password') }}</strong>
                </div>
              @endif
            </div>

            <div class="form-check mr-auto ml-3 mt-3">
              <label class="form-check-label">
                <input class="form-check-input" type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Lembre-me') }}
                <span class="form-check-sign">
                  <span class="check"></span>
                </span>
              </label>
            </div>
          </div>
          <div class="card-footer justify-content-center">
            <button type="submit" class="btn btn-primary btn-lg">{{ __('Entrar') }}</button>
          </div>
        </div>
      </form>
      <div class="row">
        <div class="col-6">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-light">
                    <small>{{ __('Esqueceu sua senha?') }}</small>
                </a>
            @endif
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
