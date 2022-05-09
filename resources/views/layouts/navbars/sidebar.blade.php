<div class="sidebar" data-color="green" data-background-color="black" >
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="#" class="simple-text logo-normal">
      {{ __('GreenBeat') }}
    </a>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item{{ $activePage == 'dashboard' ? ' active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
            <p>{{ __('Dashboard') }}</p>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#registerTab" aria-expanded="false">
          <i class="fa-solid fa-address-card"></i>
          <p>{{ __('Cadastros') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="registerTab">
          <ul class="nav">
            <li class="nav-item {{ $activePage == 'Pessoas' ? ' active' : '' }}">
              <a class="nav-link" href="/acessantes">
                <i class="fa-solid fa-users"></i>
                <span class="sidebar-normal">{{ __('Pessoas') }} </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
              <i class="fa-solid fa-building"></i>
                <span class="sidebar-normal">{{ __('Empresas') }} </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
              <i class="fa-solid fa-users"></i>
                <span class="sidebar-normal">{{ __('Motoristas') }} </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <i class="fa-solid fa-truck"></i>
                <span class="sidebar-normal">{{ __('Veiculo') }} </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
              <i class="fa-solid fa-boxes-stacked"></i>
                <span class="sidebar-normal">{{ __('Itens de Estoque') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#l2" aria-expanded="true">
          <i class="fa-solid fa-folder-tree"></i>
          <p>{{ __('Administrativo') }}
            <b class="caret"></b>
          </p>
        </a>  
        <div class="collapse show" id="l2">
          <ul class="nav">
          <li class="nav-item">
              <a class="nav-link" href="/acessantes">
                <i class="fa-solid fa-users"></i>
                <span class="sidebar-normal">{{ __('Pessoas') }} </span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
              <i class="fa-solid fa-building"></i>
                <span class="sidebar-normal">{{ __('Empresas') }} </span>
              </a>
            </li>
          </ul>
      </div>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#rasTab" aria-expanded="true">
        <i class="fa-solid fa-satellite-dish"></i>
          <p>{{ __('OS e Rastreamento') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="rasTab">
          <ul class="nav">
            <li class="nav-item">
            <a class="nav-link" href="{{ route('map') }}">
              <i class="material-icons">location_ons</i>
                <p>{{ __('Rastreamento') }}</p>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">
             <i class="fa-solid fa-file-lines"></i>
                <p>{{ __('OS') }}</p>
            </a>
          </li>
        </ul>

      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#settingTab" aria-expanded="true">
          <i class="fa-solid fa-gear"></i>
          <p>{{ __('Configurações') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="settingTab">
          <ul class="nav">
          <li class="nav-item">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <i class="fa-solid fa-user"></i>
                <span class="sidebar-normal">{{ __('Perfil de Usuario') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
    </ul>
  </div>
  
        
</div>
