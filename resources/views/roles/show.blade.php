@extends('layouts.app', ['activePage' => 'create_role', 'titlePage' => __('Create Role')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <div class="text-right">
            <a href="{{ route('roles.edit', $role->id) }}" class="btn btn-warning">Editar</a>
            <a href="{{ route('roles.index') }}" class="btn btn-default">Anterior</a>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">{{ ucfirst($role->name) }} Função</h4>
              <p class="card-category">Permissões atribuídas</p>
            </div>
            <div class="card-body">
              <!-- <div class="table-responsive"> -->
              <div>
                <table class="table table-striped">
                    <thead>
                        <th scope="col" width="20%">Nome</th>
                        <th scope="col" width="1%">Guard</th> 
                    </thead>

                    @foreach($rolePermissions as $permission)
                        <tr>
                            <td>{{ $permission->name }}</td>
                            <td>{{ $permission->guard_name }}</td>
                        </tr>
                    @endforeach
                </table>
               
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection