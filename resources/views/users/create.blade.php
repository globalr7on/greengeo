@extends('layouts.app', ['activePage' => 'create_role', 'titlePage' => __('Create Role')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Adicionar novo usuário</h4>
              <p class="card-category">  Adicione um novo usuário e atribua uma função.</p>
            </div>
            <div class="card-body">
              <!-- <div class="table-responsive"> -->
                    <form method="POST" action="">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Nome</label>
                            <input value="{{ old('name') }}" 
                                type="text" 
                                class="form-control" 
                                name="name" 
                                required>

                            @if ($errors->has('name'))
                                <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input value="{{ old('email') }}"
                                type="email" 
                                class="form-control" 
                                name="email" 
                                required>
                            @if ($errors->has('email'))
                                <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <!-- <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input value="{{ old('username') }}"
                                type="text" 
                                class="form-control" 
                                name="username" 
                                placeholder="Username" required>
                            @if ($errors->has('username'))
                                <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                            @endif
                        </div> -->
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


    <div class="bg-light p-4 rounded">
        <h1>Adicionar novo usuário</h1>
        <div class="lead">
            Adicione um novo usuário e atribua uma função.
        </div>

        <div class="container mt-4">
            <form method="POST" action="">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input value="{{ old('name') }}" 
                        type="text" 
                        class="form-control" 
                        name="name" 
                        required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input value="{{ old('email') }}"
                        type="email" 
                        class="form-control" 
                        name="email" 
                        required>
                    @if ($errors->has('email'))
                        <span class="text-danger text-left">{{ $errors->first('email') }}</span>
                    @endif
                </div>
                <!-- <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input value="{{ old('username') }}"
                        type="text" 
                        class="form-control" 
                        name="username" 
                        placeholder="Username" required>
                    @if ($errors->has('username'))
                        <span class="text-danger text-left">{{ $errors->first('username') }}</span>
                    @endif
                </div> -->

                <button type="submit" class="btn btn-primary">Salvar Usuario </button>
                <a href="{{ route('users.index') }}" class="btn btn-default">Anterior</a>
            </form>
        </div>

    </div>
@endsection