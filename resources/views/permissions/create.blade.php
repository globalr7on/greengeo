@extends('layouts.app', ['activePage' => 'create_permission', 'titlePage' => __('Create Permission')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-6">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Adicionar nova permissão</h4>
            </div>
            <div class="card-body">
              <!-- <div class="table-responsive"> -->
              <div>
                <form method="POST" action="{{ route('permissions.store') }}">
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

                    <button type="submit" class="btn btn-primary">Salvar permissão</button>
                    <a href="{{ route('permissions.index') }}" class="btn btn-default">Anterior</a>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
    <div class="bg-light p-4 rounded">
        <h2>Add new permission</h2>
        <div class="lead">
            Add new permission.
        </div>

        <div class="container mt-4">

           
        </div>

    </div>
@endsection