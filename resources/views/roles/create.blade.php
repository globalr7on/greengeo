@extends('layouts.app', ['activePage' => 'create_role', 'titlePage' => __('Create Role')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="submit" class="btn btn-primary">Salvar Nova Função</button>
        <a href="{{ route('users.index') }}" class="btn btn-default">Anterior</a>
        <!-- <button type="button" class="btn btn-primary" id="novoAcondicionamento">+ Novo Acondicionamento</button> -->
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Adicionar nova função</h4>
              <p class="card-category">Adicione uma nova função e atribua permissões.</p>
            </div>
            <div class="card-body">
              <!-- <div class="table-responsive"> -->
              <div>
              @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                    </ul>
                </div>
            @endif

                <form method="POST" action="{{ route('roles.store') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Nome</label>
                        <input value="{{ old('name') }}" 
                            type="text" 
                            class="form-control" 
                            name="name" 
                            placeholder="Usuario, Motorista, Transportadora, Destinador, etc..." required>
                    </div>
                    
                    <label for="permissions" class="form-label">Atribuir permissões</label>

                    <table class="table table-striped">
                        <thead>
                            <th scope="col" width="1%"><input type="checkbox" name="all_permission"></th>
                            <th scope="col" width="20%">Nome</th>
                            <th scope="col" width="1%">Guarda</th> 
                        </thead>

                        @foreach($permissions as $permission)
                            <tr>
                                <td>
                                    <input type="checkbox" 
                                    name="permission[{{ $permission->name }}]"
                                    value="{{ $permission->name }}"
                                    class='permission'>
                                </td>
                                <td>{{ $permission->name }}</td>
                                <td>{{ $permission->guard_name }}</td>
                            </tr>
                        @endforeach
                    </table>

                    <!-- <button type="submit" class="btn btn-primary">Salvar Nova Função</button>
                    <a href="{{ route('users.index') }}" class="btn btn-default">Anterior</a> -->
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function() {
            $('[name="all_permission"]').on('click', function() {

                if($(this).is(':checked')) {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',true);
                    });
                } else {
                    $.each($('.permission'), function() {
                        $(this).prop('checked',false);
                    });
                }
                
            });
        });
    </script>
@endsection
