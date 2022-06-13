@extends('layouts.app', ['activePage' => 'create_role', 'titlePage' => __('Create Role')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Adicionar novo usuário</h4>
              <p class="card-category">  Adicione um novo usuário e atribua uma função.</p>
            </div>
            <div class="card-body">
              <!-- <div class="table-responsive"> -->
                  
                    <form method="POST" action="">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name" class="position-relative mb-0 font-weight-bold">Nome</label>
                                <input value="{{ old('name') }}" 
                                    type="text" 
                                    class="form-control" 
                                    name="name" 
                                    required>

                                @if ($errors->has('name'))
                                    <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email" class="position-relative mb-0 font-weight-bold">Email</label>
                                <input value="{{ old('email') }}"
                                    type="email" 
                                    class="form-control" 
                                    name="email" 
                                    required>
                                @if ($errors->has('email'))
                                    <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="cpf" class="position-relative mb-0 font-weight-bold">CPF</label>
                                <input value="{{ old('cpf') }}"
                                    type="text" 
                                    class="form-control" 
                                    name="cpf" 
                                    required>
                                @if ($errors->has('cpf'))
                                    <span class="text-danger text-left">{{ $errors->first('cpf') }}</span>
                                @endif
                            </div>
                            <div class="form-group col-md-6">
                                <label for="cpf" class="position-relative mb-0 font-weight-bold">RG</label>
                                <input value="{{ old('rg') }}"
                                    type="text" 
                                    class="form-control" 
                                    name="rg" 
                                    required>
                                @if ($errors->has('rg'))
                                    <span class="text-danger text-left">{{ $errors->first('rg') }}</span>
                                @endif
                            </div>
                        </div>
                    <div class= text-right>
                        <button type="submit" class="btn btn-primary">Salvar Usuario </button>
                        <a href="{{ route('users.index') }}" class="btn btn-default">Anterior</a>
                    </div>
                    </form>
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection