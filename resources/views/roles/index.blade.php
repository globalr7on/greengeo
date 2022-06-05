@extends('layouts.app', ['activePage' => 'create_role', 'titlePage' => __('Create Role')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 text-right">
            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm float-right">Adicionar Função</a>
        </div>
        <div class="mt-2">
                @include('layouts.messages')
        </div>
        <div class="col-md-12">
        
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Funções</h4>
              <p class="card-category"> Gerencie suas funções aqui.</p>
            </div>
            <div class="card-body">
              <!-- <div class="table-responsive"> -->
              <div>
                <table class="table table-bordered">
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
                </table>
                <div class="d-flex">
                    {!! $roles->links() !!}
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

    <div class="bg-light p-4 rounded">
        <h1>Funções</h1>
        <div class="lead">
            Gerencie suas funções aqui.
            <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm float-right">Add role</a>
        </div>
        
        <div class="mt-2">
            @include('layouts.messages')
        </div>

        

        <div class="d-flex">
            {!! $roles->links() !!}
        </div>

    </div>
@endsection