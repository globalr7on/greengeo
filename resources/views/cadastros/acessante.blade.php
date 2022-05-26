@extends('layouts.app', ['activePage' => 'acessante', 'titlePage' => __('Perfil Pessoas')])
@section('css')
@endsection
@section('subheaderTitle')
  Acessantes
@endsection
@section('content')
  <div class="content mt-0">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo">+ Novo Pessoa</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Pessoas</h4>
              <p class="card-category"> Listado de Pessoas</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="pessoaTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Tipo</th>
                    <th class="text-primary font-weight-bold">CPF</th>
                    <th class="text-primary font-weight-bold">Rg</th>
                    <th class="text-primary font-weight-bold">Nome</th>
                    <th class="text-primary font-weight-bold">email</th>
                    <th class="text-primary font-weight-bold">Cargo</th>
                    <th class="text-primary font-weight-bold">Celular</th>
                    <th class="text-primary font-weight-bold">Fixo</th>
                    <th class="text-primary font-weight-bold">Whatsapp</th>
                    <th class="text-primary font-weight-bold">Endereço</th>
                    <th class="text-primary font-weight-bold">Número</th>
                    <th class="text-primary font-weight-bold">Complemento</th>
                    <th class="text-primary font-weight-bold">CEP</th>
                    <th class="text-primary font-weight-bold">Bairro</th>
                    <th class="text-primary font-weight-bold">Cidade</th>
                    <th class="text-primary font-weight-bold">Estado</th>
                    <th class="text-primary font-weight-bold">Registro de Carteira</th>
                    <th class="text-primary font-weight-bold">Tipo de Carteira</th>
                    <th class="text-primary font-weight-bold">Validade de Carteira</th>
                    <th class="text-primary font-weight-bold">Ativo</th>
                    <th class="text-primary font-weight-bold">Identificador Celular</th>
                    <th class="text-primary font-weight-bold">Senha de Acesso</th>
                    <th class="text-primary font-weight-bold">Usuario Responsavel</th>
                    <th class="text-primary font-weight-bold">Ação</th>
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
    <div class="modal-dialog modal-xl" role="document">
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
              <div class="wizard">
                <form>
                  <div class="form-row">
                    <div class="form-group col-md-4 text-center">
                      <select class="selectpicker" data-style="btn btn-primary btn-square" title="Single Select" name="tipo">
                        <option value="" disabled selected>Tipo</option>
                        <option value="fisica">Fisica</option>
                        <option value="juridica">Juridica</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputCpf" placeholder="CPF">
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputRg" placeholder="RG">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputNome" placeholder="Nome">
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputEmail" placeholder="Email">
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputCargo" placeholder="Cargo">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputCelular" placeholder="Celular">
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputFixo" placeholder="fixo">
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputWhats" placeholder="Whats">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputEndereco" placeholder="Endereço">
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputNumero" placeholder="Número">
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputComplemento" placeholder="Complemento">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputCep" placeholder="CEP">
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputBairro" placeholder="Bairro">
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputCidade" placeholder="Cidade">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputEstado" placeholder="Estado">
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputRcarteira" placeholder="Registros Carteira">
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputTcarteira" placeholder="Tipo de Carteira">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputVcarteira" placeholder="Validade de Carteira">
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputUsuarioResponsable" placeholder="Usuario responsable del cadastro">
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputAtivo" placeholder="Ativo">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputIdenticadorCelular" placeholder="Identificador de Celular">
                    </div>
                    <div class="form-group col-md-4">
                      <input type="text" class="form-control" id="inputSenha" placeholder="Senha Acesso">
                    </div>
                    <div class="form-group">
                      <div class="form-check">
                        <label class="form-check-label">
                          <input class="form-check-input" type="checkbox"  id="checkAtivo" value="">
                          Ativo?
                          <span class="form-check-sign"><span class="check"></span></span>
                        </label>
                      </div>
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
      $('#pessoaTbl').DataTable({
        scrollX: '500px',
        dom: 'Bfrtip',
        buttons: [
          {
            extend: 'copyHtml5',
            text: 'Copiar',
            titleAttr: 'Copiar para Área de Transferência',
            className: 'btn-default-light rounded-0 mr-1 py-2 font-weight-bold',
            charset: 'UTF-8',
          },
          {
            extend: 'csv',
            text: 'CSV',
            titleAttr: 'Exportar a CSV',
            className: 'btn-default-light rounded-0 mr-1 py-2 font-weight-bold',
            charset: 'UTF-8',
          },
          {
            extend: 'excel',
            text: 'Excel',
            titleAttr: 'Exportar a Excel',
            className: 'btn-default-light rounded-0 mr-1 py-2 font-weight-bold',
            charset: 'UTF-8',
          },
          {
            extend: 'pdf',
            text: 'PDF',
            titleAttr: 'Exportar a PDF',
            className: 'btn-default-light rounded-0 mr-1 py-2 font-weight-bold',
            charset: 'UTF-8',
          },
          {
            extend: 'print',
            text: 'Imprimir',
            titleAttr: 'Imprimir Documento',
            className: 'btn-default-light rounded-0 mr-1 py-2 font-weight-bold',
            charset: 'UTF-8',
            color: 'black'
          },
        ],
        ajax: {
          url: '/api/acessantes',
          dataSrc: 'data'
        },
        columns: [
          { data: "tipo" },
          { data: "cpf" },
          { data: "rg" },
          { data: "nome" },
          { data: "email" },
          { data: "cargo" },
          { data: "celular" },
          { data: "fixo" },
          { data: "whats" },
          { data: "endereco" },
          { data: "numero" },
          { data: "complemento" },
          { data: "cep" },
          { data: "bairro" },
          { data: "cidade" },
          { data: "estado" },
          { data: "registro_carteira" },
          { data: "tipo_carteira" },
          { data: "validade_carteira" },
          { data: "ativo" },
          { data: "identificador_celular" },
          { data: "senha_acesso" },
          { data: "usuario_responsavel_cadastro_id" }
 
        ],
        columnDefs : [
          { width: "90", targets: [0,1,2,5,6,7,8,10,15,14] },
          { width: "200px", targets: [9,11,16,17,18,19,20,21,22] },
          { width: "110px", targets: [3,4,12,13] },
          { 
            targets : 23,
            render : function (data, type, row) {
              return `
                <i class="fa fa-trash excluirAcond" data-id="${row.id}" title="Excluir" ></i>
                &nbsp;
                <i class="fa fa-pen editarAcond" data-id="${row.id}" data-toggle="modal" data-target="#modalExemplo" title="Editar"></i>
              `
            }
          }
        ],
      });
    });
  </script>
@endpush