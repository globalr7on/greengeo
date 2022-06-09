@extends('layouts.app', ['activePage' => 'users', 'titlePage' => __('Create Role')])
@section('subheaderTitle')
  Configurações
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 text-right lead">
          <!-- <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">+ Novo Usuario</a> -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalEdit">+ Novo Pessoa</button>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Configurações</h4>
              <p class="card-category">Usuarios</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="usersTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">CPF</th>
                    <th class="text-primary font-weight-bold">Nome</th>
                    <th class="text-primary font-weight-bold">Email</th>
                    <th class="text-primary font-weight-bold">Cargo</th>
                    <th class="text-primary font-weight-bold">Funções</th>
                    <th class="text-primary font-weight-bold">Usuario Responsavel</th>
                    <th class="text-primary font-weight-bold">Ação</th>
                  </thead>
                </table>

                @include('users.modal')
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      $('#usersTbl').DataTable({
        language: {
          "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        },
        // scrollX: '500px',
        dom: 'Bfrtip',
        buttons: [
          {
            extend: 'copyHtml5',
            text: 'Copiar',
            titleAttr: 'Copiar para Área de Transferência',
            className: 'btn-default-light rounded-0 mr-1 py-2 font-weight-bold',
            charset: 'UTF-8',
          },
          {
            extend: 'csv',
            text: 'CSV',
            titleAttr: 'Exportar a CSV',
            className: 'btn-default-light rounded-0 mr-1 py-2 font-weight-bold',
            charset: 'UTF-8',
          },
          {
            extend: 'excel',
            text: 'Excel',
            titleAttr: 'Exportar a Excel',
            className: 'btn-default-light rounded-0 mr-1 py-2 font-weight-bold',
            charset: 'UTF-8',
          },
          {
            extend: 'pdf',
            text: 'PDF',
            titleAttr: 'Exportar a PDF',
            className: 'btn-default-light rounded-0 mr-1 py-2 font-weight-bold',
            charset: 'UTF-8',
          },
          {
            extend: 'print',
            text: 'Imprimir',
            titleAttr: 'Imprimir Documento',
            className: 'btn-default-light rounded-0 mr-1 py-2 font-weight-bold',
            charset: 'UTF-8',
            color: 'black'
          },
        ],
        ajax: {
          url: '/api/users',
          dataSrc: 'data'
        },
        columns: [
          { data: "cpf" },
          { data: "name" },
          { data: "email" },
          { data: "cargo" },
          { data: "roles_name" },
          { data: "usuario_responsavel_cadastro" }
        ],
        columnDefs : [
          // { width: "90", targets: [0,1,2,5,6,7,8,10,15,14] },
          // { width: "200px", targets: [9,11,16,17,18,19,20,21,22] },
          // { width: "110px", targets: [3,4,12,13] },
          {
            targets : 4,
            render : function (data, type, row) {
              return row.roles_name.reduce((acc, curr) => acc + `<span class="badge bg-primary">${curr}</span>`, '')
            }
          },
          {
            targets : 6,
            render : function (data, type, row) {
              return `
                <i class="fa fa-trash excluirUser cursor-pointer" data-id="${row.id}" title="Excluir"></i>
                &nbsp;
                <i class="fa fa-pen editarUser cursor-pointer" data-id="${row.id}" data-toggle="modal" data-target="#modalUser" title="Editar"></i>
              `
            }
          }
        ],
      });

      // Stepper
      // var stepper = new Stepper($('.bs-stepper')[0])
      // $('.stepper-next').on('click', function (e) {
      //   stepper.next()
      // })
      // $('.stepper-prev').on('click', function (e) {
      //   stepper.previous()
      // })
      // Stepper
    });
  </script>
@endpush