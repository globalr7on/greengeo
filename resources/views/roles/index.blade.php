@extends('layouts.app', ['activePage' => 'funcoes', 'titlePage' => __('Create Role')])
@section('subheaderTitle')
  Configurações
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 text-right">
          <!-- <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm float-right">Adicionar Função</a> -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo">+ Novo Função</button>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Configurações</h4>
              <p class="card-category">Funções</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="rolesTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Name</th>
                    <th class="text-primary font-weight-bold">Guard</th>
                    <th class="text-primary font-weight-bold">Ação</th>
                  </thead>
                </table>

                <!-- <table class="table table-bordered">
                  <tr>
                    <th width="1%">No</th>
                    <th>Nome</th>
                    <th width="3%" colspan="3">Ação</th>
                  </tr>
                  @foreach ($roles as $key => $role)
                    <tr>
                      <td>{{ $role->id }}</td>
                      <td>{{ $role->name }}</td>
                      <td>
                        <a class="btn btn-warning btn-sm" href="{{ route('roles.show', $role->id) }}">Mostrar</a>
                      </td>
                      <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}">Editar</a>
                      </td>
                      <td>
                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Excluir', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                      </td>
                    </tr>
                  @endforeach
                </table> -->
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
      let app = new App({
        apiUrl: '/api/roles',
        apiDataTableColumns: [
          { data: "name" },
          { data: "guard_name" },
        ],
        datatableSelector: '#rolesTbl'
      })
    });
  </script>
@endpush