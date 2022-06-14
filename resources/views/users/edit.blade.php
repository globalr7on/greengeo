@extends('layouts.app', ['activePage' => 'create_role', 'titlePage' => __('Create Role')])

@section('content')
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Atualizar Usuario</h4>
                    </div>
                <div class="card-body">
                    <form method="post" action="{{ route('users.update', $user->id) }}">
                        @method('patch')
                        @csrf
                        <div class="form-group col-md-4">
                            <label for="name" class="form-label">Nome</label>
                            <input value="{{ $user->name }}" 
                                type="text" 
                                class="form-control" 
                                name="name" 
                                placeholder="Name" required>

                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group col-md-4">
                            <label for="email" class="form-label">Email</label>
                            <input value="{{ $user->email }}"
                                type="email" 
                                class="form-control" 
                                name="email" 
                                placeholder="Email address" required>
                            @if ($errors->has('email'))
                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <!-- <div class="mb-3">
                            <label for="username" class="form-label">Usuario</label>
                            <input value="{{ $user->username }}"
                                type="text" 
                                class="form-control" 
                                name="username" 
                                required>
                            @if ($errors->has('username'))
                                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                            @endif
                        </div> -->
                        <div class="form-group col-md-4">
                        <label for="" class="">Funções</label>
                            <select class="selectpicker form-control" data-style="btn btn-warning text-white rounded" 
                                name="role" required>
                                <option value="">Selecionar função</option>
                                @foreach($roles as $role)
                                    <option value="{{ $role->id }}"
                                        {{ in_array($role->name, $userRole) 
                                            ? 'selected'
                                            : '' }}>{{ $role->name }}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('role'))
                                <span class="text-danger text-left">{{ $errors->first('role') }}</span>
                            @endif
                        </div>
                        <div class= text-right>
                            <button type="submit" class="btn btn-primary">Atualizar usuário</button>
                            <a href="{{ route('users.index') }}" class="btn btn-default">Cancelar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
   
@endsection
@push('js')
<script>
     $('.selectpicker').selectpicker();
</script>

@endpush