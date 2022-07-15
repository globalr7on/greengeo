<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-color nav-front bg-primary">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-toggle="collapse" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
    <span class="sr-only">Toggle navigation</span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    <span class="navbar-toggler-icon icon-bar"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end">
      <form class="navbar-form mr-4">
        <div class="input-group no-border">
        <input type="text" value="" class="form-control" placeholder="Pesquisar...">
        <button type="submit" class="btn btn-white btn-round btn-just-icon">
          <i class="material-icons">search</i>
          <div class="ripple-container"></div>
        </button>
        </div>
      </form>
      <ul class="navbar-nav bg-white rounded-circle" style="height: 40px;width: 40px;color: #999;flex-direction: column;">
        <li class="nav-item dropdown">
          <a class="nav-link" href="#pablo" id="navbarDropdownProfile" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="material-icons">person</i>
            <p class="d-lg-none d-md-block">
              {{ __('Account') }}
            </p>
          </a>
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownProfile">
            <a class="dropdown-item" href="{{ route('configuracoes.perfil') }}">
              {{ Auth::user()->pessoa_juridica ? Auth::user()->pessoa_juridica->nome_fantasia.":" : '' }}
              {{ Auth::user()->name }}
              {{ Auth::user()->roles ? "[".Auth::user()->roles->filter(function ($roles) { return $roles->guard_name == 'web'; })->first()->name."]" : '' }}
            </a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Sair') }}</a>
          </div>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="bg-primary pb-5 position-relative">
  <div class="row align-items-center mx-0">
    <h3 class="col col-12 text-white m-0 px-4">
      <strong>@yield('subheaderTitle', 'Confira seu desempenho nos graficos abaixo')</strong>
      <!--@yield('subheaderSubTitle')-->
    </h3>
  </div>
  <div class="row align-items-center mx-0">
    <div class="col col-12 text-right m-0 px-4">
      <img src="{{ asset('material') }}/img/seulogoaqui.png" style="height: 40px;" />
    </div>
  </div>
</div>
