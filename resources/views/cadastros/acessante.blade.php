@extends('layouts.app', ['activePage' => 'acessante', 'titlePage' => __('Perfil Pessoas')])
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
    <div class="col-12 text-right">
    <div class="form-group col-md-6">
        <input type="text" class="form-control" id="inputCpf" placeholder="Nome ou CPF">
    </div>

        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo">
              Criar Novo Pessoa
        </button>

    </div>
      <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Pessoas</h4>
            <p class="card-category"> Listado de Pessoas</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table" id="pessoaTbl">
                <thead class=" text-primary">
                  <th>
                    CPF
                  </th>
                  <th>
                    Rg
                  </th>
                  <th>
                    Nome
                  </th>
                  <th>
                    email
                  </th>
                  <th> 
                    Cargo
                  </th>
                  <th>
                    Ação
                  </th>
                </thead>
                <!-- <tbody>
                  <tr>
                    <td>
                      709.413.992-65
                    </td>
                    <td>
                     F2838827
                    </td>
                    <td>
                      HUgo Ramirez
                    </td>
                    <td>
                      emanuelsert@gmail.com
                    </td>
                    <td>
                      Programador
                    </td>
                  </tr>
                  <tr>
                    <td>
                      949.413.992-65
                    </td>
                    <td>
                     G3878827
                    </td>
                    <td>
                      Marcos Robles
                    </td>
                    <td>
                      marro@gmail.com
                    </td>
                    <td>
                      Financiero
                    </td>
                  </tr>
                </tbody> -->
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
  <!-- <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->
  <script>
    $(document).ready(function () {
      $('#pessoaTbl').DataTable({
        ajax: {
          url: '/api/acessantes',
          dataSrc: 'data'
        },
        columns: [
          { "data": "cpf" },
          { "data": "rg" },
          { "data": "nome" },
          { "data": "email" },
          { "data": "cargo" }
        ]
      });
    });
  </script>
@endpush