@extends('layouts.app', ['activePage' => 'edit_permission', 'titlePage' => __('Edit Permission')])

@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoAcondicionamento">+ Novo Acondicionamento</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Editar permissão</h4>
              <p class="card-category">Permissão de edição.</p>
            </div>
            <div class="card-body">
              <!-- <div class="table-responsive"> -->
              <div>
              <form method="POST" action="{{ route('permissions.update', $permission->id) }}">
                @method('patch')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nome</label>
                    <input value="{{ $permission->name }}" 
                        type="text" 
                        class="form-control" 
                        name="name" 
                        placeholder="Nome" required>

                    @if ($errors->has('name'))
                        <span class="text-danger text-left">{{ $errors->first('name') }}</span>
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Salvar permissão</button>
                <a href="{{ route('permissions.index') }}" class="btn btn-default">Alterar</a>
            </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection