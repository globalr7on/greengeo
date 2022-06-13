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
                            
                            <div class="row m-0">
                                <div class="form-group col-md-6">
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
                                <div class="form-group col-md-6">
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
                            </div>
                            <div class="row m-0">
                                <div class="form-group col-md-6">
                                    <label for="cpf" class="form-label">CPF</label>
                                    <input value="{{ $user->cpf }}"
                                        type="text" 
                                        class="form-control" 
                                        name="cpf" 
                                        required>
                                    @if ($errors->has('cpf'))
                                        <span class="text-danger text-left">{{ $errors->first('cpf') }}</span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="cpf" class="form-label">RG</label>
                                    <input value="{{ $user->rg }}"
                                        type="text" 
                                        class="form-control" 
                                        name="rg" 
                                        required>
                                    @if ($errors->has('rg'))
                                        <span class="text-danger text-left">{{ $errors->first('rg') }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
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