@extends('layouts.app', ['activePage' => 'empresa', 'titlePage' => __('Empresa')])
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection
@section('subheaderTitle')
  Empresa
@endsection
@section('content')
  <div class="content mt-0">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo">
          Criar Novo Empresa
        </button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Empresas</h4>
              <p class="card-category"> Listado de Empresas</p>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table" id="empresaTbl">
                  <thead class="text-primary">
                    <th>Tipo</th>
                    <th>CNPJ</th>
                    <th>Fantasia</th>
                    <th>Razao Social</th>
                    <th>Email</th>
                    <th>Contato1</th>
                    <th>Cargo Contato1</th>
                    <th>Celular Contato1</th>
                    <th>Contato2</th>
                    <th>Cargo Contato2</th>
                    <th>Celular Contato2</th>
                    <th>Fixo</th>
                    <th>Whatsapp</th>
                    <th>Endereço</th>
                    <th>Número</th>
                    <th>Complemento</th>
                    <th>Cep</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Contrato</th>
                    <th>Identificador</th>
                    <th>Senha Acesso</th>
                    <th>Capacidade Media Carga</th>
                    <th>Ativo</th>
                    <th>Ação</th>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div id="myModal" class="modal">
    <div class="modal-contenido">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.update') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Editar Acessantes') }}</h4>
                <p class="card-category">{{ __('Information de Acessantes') }}</p>
              </div>
              <div class="card-body ">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors ?? ''->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors ?? ''->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required="true" aria-required="true"/>
                      @if ($errors ?? ''->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors ?? ''->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors ?? ''->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors ?? ''->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required />
                      @if ($errors ?? ''->has('email'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors ?? ''->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Criar Novo Pessoas</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <form>
                <div class="form-row">
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputCpf" placeholder="CPF">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputRg" placeholder="RG">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputNome" placeholder="Nome">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputEmail" placeholder="Email">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputCargo" placeholder="Cargo">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputCelular" placeholder="Celular">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputFixo" placeholder="fixo">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputWhats" placeholder="Whats">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputEndereco" placeholder="Endereço">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputNumero" placeholder="Número">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputComplemento" placeholder="Complemento">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputCep" placeholder="CEP">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputBairro" placeholder="Bairro">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputCidade" placeholder="Cidade">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputEstado" placeholder="Estado">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputRcarteira" placeholder="Registros Carteira">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputTcarteira" placeholder="Tipo de Carteira">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputVcarteira" placeholder="Validade de Carteira">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputUsuarioResponsable" placeholder="Usuario responsable del cadastro">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputAtivo" placeholder="Ativo">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputIdenticadorCelular" placeholder="Identificador de Celular">
                  </div>
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputSenha" placeholder="Senha Acesso">
                  </div>
                  <div class="form-group">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" id="gridCheck">
                    </div>
                  </div>
                  <button type="submit" class="btn btn-primary">Salvar</button>
                </form>
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
      console.log('empresaTbl', $('#empresaTbl'))
      $('#empresaTbl').DataTable({
        scrollX: '500px',
        // dom: 'Bfrtip',
        buttons: [
          'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        ajax: {
          url: '/api/pessoa_juridica',
          dataSrc: 'data'
        },
        columns: [
          { data: "tipo" },
          { data: "cnpj" },
          { data: "nome_fantasia" },
          { data: "razao_social" },
          { data: "email" },
          { data: "contato_1" },
          { data: "cargo_contato_1" },
          { data: "celular_contato_1" },
          { data: "contato_2" },
          { data: "cargo_contato_2" },
          { data: "celular_contato_2" },
          { data: "fixo" },
          { data: "whatsapp" },
          { data: "endereco" },
          { data: "numero" },
          { data: "complemento" },
          { data: "cep" },
          { data: "bairro" },
          { data: "cidade" },
          { data: "estado" },
          { data: "latitude" },
          { data: "longitude" },
          { data: "contrato" },
          { data: "identificador_celular" },
          { data: "senha_acesso" },
          { data: "capacidade_media_carga" },
          { 
            data: "ativo",
            render: function (data, type) {
              return data ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'
            }
          }
        ],
        columnDefs : [
          { width: "70px", targets: [0,19,26] },
          { width: "200px", targets: [2,3,4,5,6,7,8,9,10,11,12,13,24,25] },
          { width: "100px", targets: [14,15,16,17,18,20,21,22,23] },
          { 
            targets : 27,
            width: "70px",
            render : function (data, type, row) {
              return `
                <i class="fa fa-trash excluirAcond" data-id="${row.id}" title="Excluir" ></i>
                &nbsp;
                <i class="fa fa-pen editarAcond" data-id="${row.id}" data-toggle="modal" data-target="#modalExemplo" title="Editar"></i>
              `
            }
          }
        ],
        // fixedColumns: true
      });
    });
  </script>
@endpush