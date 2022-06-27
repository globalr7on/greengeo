<div class="sidebar" data-color="purple" data-background-color="white">
  <!--
      Tip 1: You can change the color of the sidebar using: data-color="purple | azure | green | orange | danger"

      Tip 2: you can also add an image using data-image tag
  -->
  <div class="logo pb-0 pt-2">
    <a href="/" class="text-center logo-normal">
      <img src="{{ asset('material') }}/img/electrolux.png" style="height: 40px;" />
    </a>
    <div class="text-center text-muted small font-italic">PARA UM CONTROLE INTELIGENTE</div>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      <li class="nav-item {{ $activePage == 'dashboard' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
          <p>{{ __('Painel') }}</p>
        </a>
      </li>
      <li class="nav-item {{ in_array($activePage, array('empresa', 'veiculo')) ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#cadastrosTab" aria-expanded="{{ in_array($activePage, array('empresa', 'veiculo')) ? 'true' : 'false' }}">
          <i class="fa-solid fa-address-card"></i>
          <p>{{ __('Cadastros') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ in_array($activePage, array('empresa', 'veiculo')) ? 'show' : '' }}" id="cadastrosTab">
          <ul class="nav">
            <li class="nav-item ml-4 {{ $activePage == 'empresa' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('cadastros.empresa') }}">
                <i class="fa-solid fa-building"></i>
                <span class="sidebar-normal text-left" >{{ __('Empresas') }}</span>
              </a>
            </li>
            {{-- <li class="nav-item ml-4 {{ $activePage == 'motoristas' ? 'active' : '' }}">
              <a class="nav-link" href="/acessantes">
                <i class="fa-solid fa-users"></i>
                <span class="sidebar-normal">{{ __('Motoristas') }}</span>
              </a>
            </li> --}}
            <li class="nav-item ml-4 {{ $activePage == 'veiculo' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('cadastros.veiculo') }}">
                <i class="fa-solid fa-truck"></i>
                <span class="sidebar-normal">{{ __('Veiculo') }}</span>
              </a>
            </li>
            <!-- <li class="nav-item ml-4">
              <a class="nav-link" href="#">
                <i class="fa-solid fa-boxes-stacked"></i>
                <span class="sidebar-normal">{{ __('Itens de Estoque') }}</span>
              </a>
            </li> -->
          </ul>
        </div>
      </li>
      <li class="nav-item {{ in_array($activePage, array('tipo_empresa','acondicionamento', 'tratamento', 'sucata', 'unidade', 'modelo', 'marca', 'estagios', 'tipo_material', 'atividade')) ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#l2" aria-expanded="{{ in_array($activePage, array('tipo_empresa','acondicionamento', 'tratamento', 'sucata', 'unidade', 'modelo', 'marca', 'estagios', 'tipo_material', 'atividade')) ? 'true' : 'false' }}">
          <i class="fa-solid fa-folder-tree"></i>
          <p>{{ __('Administrativo') }}
            <b class="caret"></b>
          </p>
        </a>  
        <div class="collapse {{ in_array($activePage, array('tipo_empresa','acondicionamento', 'tratamento', 'sucata', 'unidade', 'modelo', 'marca', 'estagios', 'tipo_material', 'atividade')) ? 'show' : '' }}" id="l2">
          <ul class="nav">
            <li class="nav-item ml-4 {{ $activePage == 'tipo_empresa' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.tipoEmpresa') }}">
                <i class="fa-solid fa-building"></i>
                <span class="sidebar-normal">{{ __('Tipo Empresa') }}</span>
              </a>  
            </li>
            <li class="nav-item ml-4 {{ $activePage == 'acondicionamento' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.acondicionamento') }}">
                <i class="fa-solid fa-dumpster"></i>
                <span class="sidebar-normal">{{ __('Acondicionamento') }}</span>
              </a>  
            </li>
            <li class="nav-item ml-4 {{ $activePage == 'tratamento' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.tratamento') }}">
                <i class="fa-solid fa-radiation"></i>
                <span class="sidebar-normal">{{ __('Tratamento') }}</span>
              </a>
            </li>
            <li class="nav-item ml-4 {{ $activePage == 'sucata' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.classeSucata') }}">
                <i class="fa-solid fa-recycle"></i>
                <span class="sidebar-normal">{{ __('Classes de Sucata') }}</span>
              </a>
            </li>
            <li class="nav-item ml-4 {{ $activePage == 'unidade' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.unidad') }}">
                <i class="fa-solid fa-weight-scale"></i>
                <span class="sidebar-normal">{{ __('Unidade') }}</span>
              </a>
            </li>
            <li class="nav-item ml-4 {{ $activePage == 'modelo' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.modelo') }}">
                <i class="fa-solid fa-shuffle"></i>
                <span class="sidebar-normal">{{ __('Modelo de Veiculos') }}</span>
              </a>
            </li>
            <li class="nav-item ml-4 {{ $activePage == 'marca' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.marca') }}">
                <i class="fa-solid fa-shuffle"></i>
                <span class="sidebar-normal">{{ __('Marcas de Veiculos') }}</span>
              </a>
            </li>
            <li class="nav-item ml-4 {{ $activePage == 'estagios' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.estagiosOs') }}">
                <i class="fa-regular fa-clipboard"></i>
                <span class="sidebar-normal">{{ __('Estágios de OS') }}</span>
              </a>
            </li>
            <li class="nav-item ml-4 {{ $activePage == 'tipo_material' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.tipoMaterial') }}">
                <i class="fa-regular fa-clipboard"></i>
                <span class="sidebar-normal">{{ __('Tipo de Material') }}</span>
              </a>
            </li>
            <li class="nav-item ml-4 {{ $activePage == 'atividade' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.atividade') }}">
                <i class="fa-solid fa-square-caret-right"></i>
                <span class="sidebar-normal">{{ __('Atividade') }}</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ in_array($activePage, array('rastreamento', 'os', 'nota_fiscal')) ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#rasTab" aria-expanded="{{ in_array($activePage, array('rastreamento', 'os', 'nota_fiscal')) ? 'true' : 'false' }}">
          <i class="fa-solid fa-satellite-dish"></i>
          <p>{{ __('OS e Rastreamento') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ in_array($activePage, array('rastreamento', 'os', 'nota_fiscal')) ? 'show' : '' }}" id="rasTab">
          <ul class="nav">
            <li class="nav-item ml-4 {{ $activePage == 'rastreamento' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('rastreamento.rastreamento') }}">
                <i class="fas fa-map-marker-alt"></i>
                <span class="sidebar-normal">{{ __('Rastreamento') }}</span>
              </a>
            </li>
            <li class="nav-item ml-4 {{ $activePage == 'os' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('rastreamento.os') }}">
                <i class="fa-solid fa-file-lines"></i>
                <span class="sidebar-normal">{{ __('Ordem de Serviço') }}</span>
              </a>
            </li>
            <li class="nav-item ml-4 {{ $activePage == 'nota_fiscal' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('rastreamento.notaFiscal') }}">
                <i class="fa-solid fa-file-circle-check"></i>
                <span class="sidebar-normal">{{ __('Nota Fiscal') }}</span>
              </a>
            </li>
          </ul>
        </div>
      </li>
      <li class="nav-item {{ in_array($activePage, array('profile', 'users', 'funcoes', 'permissions')) ? 'active' : ''}}">
        <a class="nav-link" data-toggle="collapse" href="#settingTab" aria-expanded="{{ in_array($activePage, array('profile', 'users', 'funcoes', 'permissions')) ? 'true' : 'false' }}">
          <i class="fa-solid fa-gear"></i>
          <p>{{ __('Configurações') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ in_array($activePage, array('profile', 'users', 'funcoes', 'permissions'))  ? 'show' : '' }}" id="settingTab">
          <ul class="nav">
            <li class="nav-item ml-4 {{ $activePage == 'profile' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('profile.edit') }}">
                <i class="fa-solid fa-user"></i>
                <span class="sidebar-normal">{{ __('Perfil') }}</span>
              </a>
            </li>
            <!-- <li class="nav-item ml-4 {{ $activePage == 'acessantes' ? 'active' : '' }}">
              <a class="nav-link" href="/acessantes">
              <i class="fa-solid fa-address-card"></i>
                <span class="sidebar-normal">{{ __('Perfil') }}</span>
              </a>
            </li> -->
            @role('admin')
              <li class="nav-item ml-4 {{ $activePage == 'users' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('configuracoes.users') }}">
                <i class="fa-solid fa-users"></i>
                  <span class="sidebar-normal">{{ __('Usuarios') }}</span>
                </a>
              </li>
              <li class="nav-item ml-4 {{ $activePage == 'funcoes' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('configuracoes.roles') }}">
                 <i class="fa-solid fa-user-lock"></i>
                  <span class="sidebar-normal">{{ __('Funções') }}</span>
                </a>
              </li>
              <li class="nav-item ml-4 {{ $activePage == 'permissions' ? 'active' : '' }}">
                <a class="nav-link" href="{{ route('configuracoes.permissions') }}">
                <i class="fa-solid fa-user-shield"></i>
                  <span class="sidebar-normal">{{ __('Permissões') }}</span>
                </a>
              </li>
            @endrole
          </ul>
        </div>
      </li>
    </ul>
    <div class="sidebar-footer-logo">
      <img src="{{ asset('material') }}/img/greenbeat.png" style="width: 150px;height: 40px;" />
    </div>
  </div>
</div>
