@extends('layouts.app', ['activePage' => 'permissions', 'titlePage' => __('Permissions')])

@section('content')    
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 text-right">
             <a href="{{ route('permissions.create') }}" class="btn btn-primary btn-sm float-right">Adicionar permissões</a>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Permissões</h4>
              <p class="card-category">Gerencie suas permissões aqui.</p>
            </div>
            <div class="mt-2">
                @include('layouts.messages')
            </div>

            <div class="card-body">
              <!-- <div class="table-responsive"> -->
              <div>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col" width="15%">Nome</th>
                        <th scope="col">Guarda</th> 
                        <th scope="col" colspan="3" width="1%"></th> 
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($permissions as $permission)
                            <tr>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->guard_name }}</td>
                                <td><a href="{{ route('permissions.edit', $permission->id) }}" class="btn btn-warning btn-sm">Editar</a></td>
                                <td>
                                    {!! Form::open(['method' => 'DELETE','route' => ['permissions.destroy', $permission->id],'style'=>'display:inline']) !!}
                                    {!! Form::submit('Excluir', ['class' => 'btn btn-danger btn-sm']) !!}
                                    {!! Form::close() !!}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection