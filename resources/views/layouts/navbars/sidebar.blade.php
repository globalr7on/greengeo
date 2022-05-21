<div class="sidebar" data-color="orange" data-background-color="white" >
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo">
    <a href="/" class="text-center logo-normal">
      <!-- {{ __('GreenBeat') }} -->
      <img src="{{ asset('material') }}/img/greenbeat.png" style="width: 150px;height: 40px;" />
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
            <li class="nav-item ml-4">
              <a class="nav-link" href="/empresa">
              <i class="fa-solid fa-building"></i>
                <span class="sidebar-normal text-left" >{{ __('Empresas') }} </span>
              </a>
            </li>
            <li class="nav-item ml-4">
              <a class="nav-link" href="#">
              <i class="fa-solid fa-users"></i>
                <span class="sidebar-normal">{{ __('Motoristas') }} </span>
              </a>
            </li>
            <li class="nav-item ml-4">
              <a class="nav-link" href="/veiculo">
               <i class="fa-solid fa-truck"></i>
                <span class="sidebar-normal">{{ __('Veiculo') }} </span>
              </a>
            </li>
            <!-- <li class="nav-item ml-4">
              <a class="nav-link" href="#">
              <i class="fa-solid fa-boxes-stacked"></i>
                <span class="sidebar-normal">{{ __('Itens de Estoque') }} </span>
              </a>
            </li> -->
            <li class="nav-item ml-4">
              <a class="nav-link" href="/nota_fiscal">
              <i class="fa-solid fa-file-circle-check"></i>
                <span class="sidebar-normal">{{ __('Nota Fiscal') }} </span>
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
            <li class="nav-item ml-4">
              <a class="nav-link" href="{{ route('administrativo.acondicionamento') }}">
              <i class="fa-solid fa-dumpster"></i>
                <span class="sidebar-normal">{{ __('Tipos de Acondicionamiento') }} </span>
              </a>
            </li>
            <li class="nav-item ml-4">
              <a class="nav-link" href="/tratamento">
              <i class="fa-solid fa-radiation"></i>
                <span class="sidebar-normal">{{ __('Tratamientos') }} </span>
              </a>
            </li>
            <li class="nav-item ml-4">
              <a class="nav-link" href="#">
              <i class="fa-solid fa-recycle"></i>
                <span class="sidebar-normal">{{ __('Classes de Sucata') }} </span>
              </a>
            </li>
            <li class="nav-item ml-4">
              <a class="nav-link" href="/unidad">
              <i class="fa-solid fa-weight-scale"></i>
                <span class="sidebar-normal">{{ __('Unidades') }} </span>
              </a>
            </li>
            <li class="nav-item ml-4">
              <a class="nav-link" href="/modelo">
              <i class="fa-solid fa-shuffle"></i>
                <span class="sidebar-normal">{{ __('Modelo de Veiculos') }} </span>
              </a>
            </li>
            <li class="nav-item ml-4">
              <a class="nav-link" href="/marca">
              <i class="fa-solid fa-shuffle"></i>
                <span class="sidebar-normal">{{ __('Marcas de Veiculos') }} </span>
              </a>
            </li>
            <li class="nav-item ml-4">
              <a class="nav-link" href="#">
              <i class="fa-regular fa-clipboard"></i>
                <span class="sidebar-normal">{{ __('Estágios de OS') }} </span>
              </a>
            </li>
            <li class="nav-item ml-4">
              <a class="nav-link" href="/atividade">
              <i class="fa-solid fa-square-caret-right"></i>
                <span class="sidebar-normal">{{ __('Atividade') }} </span>
              </a>
            </li>
            <li class="nav-item ml-4">
              <a class="nav-link" href="/acessantes">
              <i class="fa-solid fa-users"></i>
                <span class="sidebar-normal">{{ __('Accesantes') }} </span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="collapse" href="#rasTab" aria-expanded="true">
        <i class="fa-solid fa-satellite-dish"></i>
          <p>{{ __('OS e Rastreamento') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse show" id="rasTab">
          <ul class="nav">
            <li class="nav-item ml-4">
              <a class="nav-link" href="{{ route('map') }}">
                <i class="material-icons">location_ons</i>
                  <p>{{ __('Rastreamento') }}</p>
              </a>
            </li>
            <li class="nav-item ml-4">
              <a class="nav-link" href="#">
              <i class="fa-solid fa-file-lines"></i>
                  <p>{{ __('OS') }}</p>
              </a>
            </li>
          </ul>
        </div>
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
            <li class="nav-item ml-4">
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
