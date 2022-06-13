@extends('layouts.app', ['activePage' => 'create_role', 'titlePage' => __('Create Role')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Mostrar Usuario</h4>
              <p class="card-category">Usuario</p>
            </div>
            <div class="card-body">
              <div>
                <div class="container mt-12">
                    <div>
                        Nome: {{ $user->name }}
                    </div>
                    <div>
                        Email: {{ $user->email }}
                    </div>
                    <div>
                        CPF: {{ $user->cpf }}
                    </div>
                    <div>
                        RG: {{ $user->rg }}
                    </div>
                    <div>
                        Cargo: {{ $user->cargo }}
                    </div>
                    <div>
                        Celular: {{ $user->celular }}
                    </div>
                    <div>
                        Fixo: {{ $user->fixo }}
                    </div>
                    <div>
                        Whatsapp: {{ $user->whats }}
                    </div>
                    <div>
                        Endereço: {{ $user->endereco }}
                    </div>
                    <div>
                        Número: {{ $user->numero }}
                    </div>
                    <div>
                        Complemento: {{ $user->complemento }}
                    </div>
                    <div>
                        CEP: {{ $user->cep }}
                    </div>
                    <div>
                        Bairro: {{ $user->bairro }}
                    </div>
                    <div>
                        Cidade: {{ $user->cidade }}
                    </div>
                    <div>
                        Estado: {{ $user->estado }}
                    </div>

                </div>
                <div class="mt-4">
                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning">Editar</a>
                    <a href="{{ route('users.index') }}" class="btn btn-default">Anterior</a>
                </div>
                <!-- <table class="table" id="atividadeTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Descrição</th>
                    <th class="text-primary font-weight-bold text-center">Ativo</th>
                    <th class="text-primary font-weight-bold text-center">Ação</th>
                  </thead>
                </table> -->
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
   
@endsection