@extends('layouts.app', ['activePage' => 'map', 'titlePage' => __('Rastreamento')])

@section('subheaderTitle')
  Rastreamento
@endsection
@section('content')

<div class="content">
    <div class="container-fluid">
    <form>
      <div class="row">
        <div class="col">
          <input type="text" class="form-control" placeholder="ID OS">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="Transportadora">
        </div>
       
      </div>
      <div class="row">
        <div class="col">
          <input type="text" class="form-control" placeholder="CNPJ">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="OS">
        </div>
      </div>
      <div class="row">
        <div class="col">
          <input type="text" class="form-control" placeholder="MTR">
        </div>
        <div class="col">
          <input type="text" class="form-control" placeholder="CELULAR">
        </div>
      </div>
    </form>
    <div class="col-12 text-right">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#">
         Pesquisar
      </button>
      <div class="col-12">
        <iframe src="http://localhost:3650/api/maps/streets" width=1500 height=800 />
      </div>
    </div>
  </div>
</div>
@endsection

@push('js')
<script>
  $(document).ready(function() {
    // Javascript method's body can be found in assets/js/demos.js
    demo.initGoogleMaps();
  });
</script>
@endpush