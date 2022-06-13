@extends('layouts.app', ['activePage' => 'funcoes', 'titlePage' => __('Create Role')])
@section('subheaderTitle')
  Configurações
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12 text-right">
          <!-- <a href="{{ route('roles.create') }}" class="btn btn-primary btn-sm float-right">Adicionar Função</a> -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo">+ Novo Função</button>
        </div>
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Configurações</h4>
              <p class="card-category">Funções</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="rolesTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Name</th>
                    <th class="text-primary font-weight-bold">Guard</th>
                    <th class="text-primary font-weight-bold">Ação</th>
                  </thead>
                </table>

                <!-- <table class="table table-bordered">
                  <tr>
                    <th width="1%">No</th>
                    <th>Nome</th>
                    <th width="3%" colspan="3">Ação</th>
                  </tr>
                  @foreach ($roles as $key => $role)
                    <tr>
                      <td>{{ $role->id }}</td>
                      <td>{{ $role->name }}</td>
                      <td>
                        <a class="btn btn-warning btn-sm" href="{{ route('roles.show', $role->id) }}">Mostrar</a>
                      </td>
                      <td>
                        <a class="btn btn-primary btn-sm" href="{{ route('roles.edit', $role->id) }}">Editar</a>
                      </td>
                      <td>
                        {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline']) !!}
                        {!! Form::submit('Excluir', ['class' => 'btn btn-danger btn-sm']) !!}
                        {!! Form::close() !!}
                      </td>
                    </tr>
                  @endforeach
                </table> -->
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
      $('#rolesTbl').DataTable({
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
          url: '/api/roles',
          dataSrc: 'data'
        },
        columns: [
          { data: "name" },
          { data: "guard_name" }
        ],
        columnDefs : [
          {
            targets : 2,
            render : function (data, type, row) {
              return `
                <i class="fa fa-trash excluirUser cursor-pointer" data-id="${row.id}" title="Excluir"></i>
                &nbsp;
                <i class="fa fa-pen editarUser cursor-pointer" data-id="${row.id}" data-toggle="modal" data-target="#modalRole" title="Editar"></i>
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