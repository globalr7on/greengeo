@extends('layouts.app', ['activePage' => 'create_role', 'titlePage' => __('Create Role')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 text-right lead">
            <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">Adcionar Novo Usuario</a>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Usuarios</h4>
              <p class="card-category"> Gerencie seus usuários aqui</p>
                <div class="mt-2">
                    @include('layouts.messages')
                </div>
            </div>
            <div class="card-body">
              <div>
              <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col" width="1%">#</th>
                <th scope="col" width="15%">Nome</th>
                <th scope="col">Email</th>
                <th scope="col" width="10%">Usuario</th>
                <th scope="col" width="10%">Funções</th>
                <th scope="col" width="1%" colspan="3"></th>    
            </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                    <tr>
                        <th scope="row">{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->username }}</td>
                        <td>
                            @foreach($user->roles as $role)
                                <span class="badge bg-primary">{{ $role->name }}</span>
                            @endforeach
                        </td>
                        <td><a href="{{ route('users.show', $user->id) }}" class="btn btn-warning btn-sm">Mostrar</a></td>
                        <td><a href="{{ route('users.edit', $user->id) }}" class="btn btn-info btn-sm">Editar</a></td>
                        <td>
                            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                            {!! Form::submit('Excluir', ['class' => 'btn btn-danger btn-sm']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table> 
        <div class="d-flex">
            {!! $users->links() !!}
        </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection