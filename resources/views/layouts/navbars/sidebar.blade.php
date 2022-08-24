<div class="sidebar" data-color="purple" data-background-color="white">
  <div class="logo pb-0 pt-2">
    <a href="/" class="text-center logo-normal">
      <img src="{{ asset('material') }}/img/seulogoaqui.png" style="height: 40px;" />
    </a>
    <div class="text-center text-muted small font-italic">PARA UM CONTROLE INTELIGENTE</div>
  </div>
  <div class="sidebar-wrapper">
    <ul class="nav">
      @can('home')
      <li class="nav-item {{ $activePage == 'dashboard' ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('home') }}">
          <i class="material-icons">dashboard</i>
          <p>{{ __('Painel') }}</p>
        </a>
      </li>
      @endcan

      @canany(['cadastros.empresa', 'cadastros.material', 'cadastros.produto', 'cadastros.veiculo'])
      <li class="nav-item {{ in_array($activePage, array('empresa', 'material', 'produto', 'veiculo')) ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#cadastrosTab" aria-expanded="{{ in_array($activePage, array('empresa', 'produto', 'veiculo')) ? 'true' : 'false' }}">
          <i class="fa-solid fa-address-card"></i>
          <p>{{ __('Cadastros') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ in_array($activePage, array('empresa', 'material', 'produto', 'veiculo')) ? 'show' : '' }}" id="cadastrosTab">
          <ul class="nav">
            @can('cadastros.empresa')
            <li class="nav-item ml-4 {{ $activePage == 'empresa' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('cadastros.empresa') }}">
                <i class="fa-solid fa-building"></i>
                <span class="sidebar-normal text-left" >{{ __('Empresas') }}</span>
              </a>
            </li>
            @endcan
            @can('cadastros.material')
            <li class="nav-item ml-4 {{ $activePage == 'material' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('cadastros.material') }}">
                <i class="fa-solid fa-recycle"></i>
                <span class="sidebar-normal">{{ __('Material') }}</span>
              </a>
            </li>
            @endcan
            @can('cadastros.produto')
            <li class="nav-item ml-4 {{ $activePage == 'produto' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('cadastros.produto') }}">
                <i class="fa-solid fa-box-archive"></i>
                <span class="sidebar-normal">{{ __('Produto') }}</span>
              </a>
            </li>
            @endcan
            @can('cadastros.veiculo')
            <li class="nav-item ml-4 {{ $activePage == 'veiculo' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('cadastros.veiculo') }}">
                <i class="fa-solid fa-truck"></i>
                <span class="sidebar-normal">{{ __('Veiculo') }}</span>
              </a>
            </li>
            @endcan
          </ul>
        </div>
      </li>
      @endcanany

      @canany([
        'administrativo.tipoEmpresa', 'administrativo.acondicionamento', 'administrativo.tratamento',
        'administrativo.classeSucata', 'administrativo.unidad', 'administrativo.modelo', 'administrativo.marca',
        'administrativo.estagiosOs', 'administrativo.tipoMaterial', 'administrativo.atividade'
      ])
      <li class="nav-item {{ in_array($activePage, array('tipo_empresa','acondicionamento','tratamento','sucata','unidade','modelo','marca','estagios','tipo_material','atividade', 'ibama')) ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#l2" aria-expanded="{{ in_array($activePage, array('tipo_empresa','acondicionamento','tratamento','sucata','unidade','modelo','marca','estagios','tipo_material','atividade')) ? 'true' : 'false' }}">
          <i class="fa-solid fa-folder-tree"></i>
          <p>{{ __('Administrativo') }}
            <b class="caret"></b>
          </p>
        </a>  
        <div class="collapse {{ in_array($activePage, array('tipo_empresa','acondicionamento','tratamento','sucata','unidade','modelo','marca','estagios','tipo_material','atividade', 'ibama')) ? 'show' : '' }}" id="l2">
          <ul class="nav">
            @can('administrativo.tipoEmpresa')
            <li class="nav-item ml-4 {{ $activePage == 'tipo_empresa' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.tipoEmpresa') }}">
                <i class="fa-solid fa-building"></i>
                <span class="sidebar-normal">{{ __('Tipo Empresa') }}</span>
              </a>  
            </li>
            @endcan

            @can('administrativo.acondicionamento')
            <li class="nav-item ml-4 {{ $activePage == 'acondicionamento' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.acondicionamento') }}">
                <i class="fa-solid fa-dumpster"></i>
                <span class="sidebar-normal">{{ __('Acondicionamento') }}</span>
              </a>  
            </li>
            @endcan

            @can('administrativo.tratamento')
            <li class="nav-item ml-4 {{ $activePage == 'tratamento' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.tratamento') }}">
                <i class="fa-solid fa-radiation"></i>
                <span class="sidebar-normal">{{ __('Tratamento') }}</span>
              </a>
            </li>
            @endcan

            @can('administrativo.classeSucata')
            <li class="nav-item ml-4 {{ $activePage == 'sucata' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.classeSucata') }}">
                <i class="fa-solid fa-recycle"></i>
                <span class="sidebar-normal">{{ __('Classes de Sucata') }}</span>
              </a>
            </li>
            @endcan

            @can('administrativo.unidad')
            <li class="nav-item ml-4 {{ $activePage == 'unidade' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.unidad') }}">
                <i class="fa-solid fa-weight-scale"></i>
                <span class="sidebar-normal">{{ __('Unidade') }}</span>
              </a>
            </li>
            @endcan

            @can('administrativo.modelo')
            <li class="nav-item ml-4 {{ $activePage == 'modelo' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.modelo') }}">
                <i class="fa-solid fa-shuffle"></i>
                <span class="sidebar-normal">{{ __('Modelo Veiculos') }}</span>
              </a>
            </li>
            @endcan

            @can('administrativo.marca')
            <li class="nav-item ml-4 {{ $activePage == 'marca' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.marca') }}">
                <i class="fa-solid fa-shuffle"></i>
                <span class="sidebar-normal">{{ __('Marcas Veiculos') }}</span>
              </a>
            </li>
            @endcan

            @can('administrativo.estagiosOs')
            <li class="nav-item ml-4 {{ $activePage == 'estagios' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.estagiosOs') }}">
                <i class="fa-regular fa-clipboard"></i>
                <span class="sidebar-normal">{{ __('Estágios de OS') }}</span>
              </a>
            </li>
            @endcan

            @can('administrativo.tipoMaterial')
            <li class="nav-item ml-4 {{ $activePage == 'tipo_material' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.tipoMaterial') }}">
                <i class="fa-regular fa-clipboard"></i>
                <span class="sidebar-normal">{{ __('Tipo de Material') }}</span>
              </a>
            </li>
            @endcan

            @can('administrativo.atividade')
            <li class="nav-item ml-4 {{ $activePage == 'atividade' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.atividade') }}">
                <i class="fa-solid fa-square-caret-right"></i>
                <span class="sidebar-normal">{{ __('Atividade') }}</span>
              </a>
            </li>
            @endcan

              @can('administrativo.ibama')
            <li class="nav-item ml-4 {{ $activePage == 'ibama' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('administrativo.ibama') }}">
                <i class="fa-solid fa-square-caret-right"></i>
                <span class="sidebar-normal">{{ __('Ibama') }}</span>
              </a>
            </li>
            @endcan
          </ul>
        </div>
      </li>
      @endcanany

      @canany(['rastreamento.agendamento', 'rastreamento.notaFiscal', 'rastreamento.os', 'rastreamento.rastreamento'])
      <li class="nav-item {{ in_array($activePage, array('agendamento', 'nota_fiscal', 'os', 'rastreamento')) ? 'active' : '' }}">
        <a class="nav-link" data-toggle="collapse" href="#rasTab" aria-expanded="{{ in_array($activePage, array('agendamento', 'nota_fiscal', 'os', 'rastreamento')) ? 'true' : 'false' }}">
          <i class="fa-solid fa-satellite-dish"></i>
          <p>{{ __('OS e Rastreamento') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ in_array($activePage, array('agendamento', 'nota_fiscal', 'os', 'rastreamento')) ? 'show' : '' }}" id="rasTab">
          <ul class="nav">
            @can('rastreamento.agendamento')
            <li class="nav-item ml-4 {{ $activePage == 'agendamento' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('rastreamento.agendamento') }}">
                <i class="fas fa-calendar-alt"></i>
                <span class="sidebar-normal">{{ __('Agendamento') }}</span>
              </a>
            </li>
            @endcan
            
            @can('rastreamento.notaFiscal')
            <li class="nav-item ml-4 {{ $activePage == 'nota_fiscal' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('rastreamento.notaFiscal') }}">
                <i class="fa-solid fa-file-circle-check"></i>
                <span class="sidebar-normal">{{ __('Nota Fiscal') }}</span>
              </a>
            </li>
            @endcan

            @can('rastreamento.os')
            <li class="nav-item ml-4 {{ $activePage == 'os' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('rastreamento.os') }}">
                <i class="fa-solid fa-file-lines"></i>
                <span class="sidebar-normal">{{ __('Ordem de Serviço') }}</span>
              </a>
            </li>
            @endcan

            @can('rastreamento.rastreamento')
            <li class="nav-item ml-4 {{ $activePage == 'rastreamento' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('rastreamento.rastreamento') }}">
                <i class="fas fa-map-marker-alt"></i>
                <span class="sidebar-normal">{{ __('Rastreamento') }}</span>
              </a>
            </li>
            @endcan
          </ul>
        </div>
      </li>
      @endcanany

      @canany(['configuracoes.perfil', 'configuracoes.usuarios', 'configuracoes.funcoes', 'configuracoes.permissoes'])
      <li class="nav-item {{ in_array($activePage, array('profile', 'users', 'funcoes', 'permissions')) ? 'active' : ''}}">
        <a class="nav-link" data-toggle="collapse" href="#settingTab" aria-expanded="{{ in_array($activePage, array('profile', 'users', 'funcoes', 'permissions')) ? 'true' : 'false' }}">
          <i class="fa-solid fa-gear"></i>
          <p>{{ __('Configurações') }}
            <b class="caret"></b>
          </p>
        </a>
        <div class="collapse {{ in_array($activePage, array('profile', 'users', 'funcoes', 'permissions'))  ? 'show' : '' }}" id="settingTab">
          <ul class="nav">
            @can('configuracoes.perfil')
            <li class="nav-item ml-4 {{ $activePage == 'profile' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('configuracoes.perfil') }}">
                <i class="fa-solid fa-user"></i>
                <span class="sidebar-normal">{{ __('Perfil') }}</span>
              </a>
            </li>
            @endcan
            
            @can('configuracoes.usuarios')            
            <li class="nav-item ml-4 {{ $activePage == 'users' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('configuracoes.usuarios') }}">
              <i class="fa-solid fa-users"></i>
                <span class="sidebar-normal">{{ __('Usuarios') }}</span>
              </a>
            </li>
            @endcan
            
            @can('configuracoes.funcoes')
            <li class="nav-item ml-4 {{ $activePage == 'funcoes' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('configuracoes.funcoes') }}">
                <i class="fa-solid fa-user-lock"></i>
                <span class="sidebar-normal">{{ __('Funções') }}</span>
              </a>
            </li>
            @endcan

            @can('configuracoes.permissoes')
            <li class="nav-item ml-4 {{ $activePage == 'permissions' ? 'active' : '' }}">
              <a class="nav-link" href="{{ route('configuracoes.permissoes') }}">
              <i class="fa-solid fa-user-shield"></i>
                <span class="sidebar-normal">{{ __('Permissões') }}</span>
              </a>
            </li>
            @endcan
          </ul>
        </div> 
      </li>
      @endcanany

      @can('logout')
      <li class="nav-item">
        <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
          <i class="fa-solid fa-right-from-bracket"></i>
          <p>{{ __('Sair') }}</p>
        </a>
      </li>
      @endcan
    </ul>
    <div class="sidebar-footer-logo">
      <img src="{{ asset('material') }}/img/greenbeat.png" style="width: 150px;height: 40px;" />
    </div>
  </div>
</div>
