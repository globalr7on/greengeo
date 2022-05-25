@extends('layouts.app', ['activePage' => 'unidad', 'titlePage' => __('Unidad')])
@section('css')
  <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> -->
@endsection
@section('subheaderTitle')
  Unidade
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novaUnidad">+ Novo Unidad</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <!-- <h4 class="card-title">Unidades</h4> -->
              <!-- <p class="card-category">Listado de Unidades</p> -->
              <span class="card-title">&nbsp;</span>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="unidadTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Descrição</th>
                    <th class="text-primary font-weight-bold text-center">Simbolo</th>
                    <th class="text-primary font-weight-bold text-center">Ativo</th>
                    <th class="text-primary font-weight-bold text-center">Ação</th>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade" id="modalUnidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModal">Novo Unidad</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <form>
                <div class="form-row">
                  <input type="hidden" class="form-control" id="inputId">
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control" id="inputDescricao" placeholder="Descrição">
                  </div>
                </div>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <input type="text" class="form-control" id="inputSimbolo" placeholder="Simbolo">
                  </div>
                </div>
                <div class="form-group">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox"  id="checkAtivo" value="">
                      Ativo? <span class="form-check-sign"><span class="check"></span></span>
                    </label>
                  </div>
                </div>
                <button type="button" class="btn btn-primary" id="salvarUnidad">Salvar</button>
              </form>
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
    $('#unidadTbl').DataTable({
      dom: 'Bfrtip',
      buttons: [
                {
                  extend: 'copy',
                  text: 'Copiar',
                  titleAttr: 'Copiar para Área de Transferência',
                  className: 'btn-secondary',
                  charset: 'UTF-8',
                },
                {
                  extend: 'csv',
                  text: 'CSV',
                  titleAttr: 'Exportar a CSV',
                  className: 'btn-secondary',
                  charset: 'UTF-8',
                },
                {
                  extend: 'excel',
                  text: 'Excel',
                  titleAttr: 'Exportar a Excel',
                  className: 'btn-secondary',
                  charset: 'UTF-8',
                },
                {
                  extend: 'pdf',
                  text: 'PDF',
                  titleAttr: 'Exportar a PDF',
                  className: 'btn-secondary',
                  charset: 'UTF-8',
                },
                {
                  extend: 'print',
                  text: 'Imprimir',
                  titleAttr: 'Imprimir Documento',
                  className: 'btn-secondary',
                  charset: 'UTF-8',
                  color: 'black'
                },
      ],
      ajax: {
        url: '/api/unidad',
        dataSrc: 'data'
      },
      columns: [
        { data: "descricao" },
        { data: "simbolo", className: "text-center" },
        { data: "ativo", className: "text-center", render: function (data, type) {
          return data ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'
        } },
      ],
      columnDefs: [
        { targets: 2, orderable: false },
        { 
          targets: 3,
          className: "text-center",
          render: function (data, type, row) {
            return `
              <i class="fa fa-trash excluirUnidad cursor-pointer" data-id="${row.id}" title="Excluir" ></i>
              &nbsp;
              <i class="fa fa-pen editarUnidade cursor-pointer" data-id="${row.id}" title="Editar"></i>
            `
          }
        }
      ],
    });

    // Salvar
    $('body').on('click', '#salvarUnidad', function() {
      const JSONRequest = {
        descricao: $("#inputDescricao").val(),
        simbolo: $("#inputSimbolo").val(),
        ativo: $("#checkAtivo").prop("checked") ? 1 : 0,
      }
      const id = $('#inputId').val();
      const method = id ? "PUT" : "POST";
      const urlP = id ? `/api/unidad/${id}` : "/api/unidad";
      $.ajax({
        type: method,
        url: urlP,
        data: JSONRequest,
        dataType: "json",
        encode: true,
      }).done(function (response) {
        if (response && response.data) {
          $("#modalUnidad").modal("hide");
          $('#unidadTbl').DataTable().ajax.reload();
        }
      });
    });

    // Open Modal New
    $('body').on('click', '#novaUnidad', function() {
      $("#modalUnidad").modal("show");
      $('#tituloModal').text("Nova Unidade");
      $('#inputId').val("");
      $("#inputDescricao").val("");
      $("#inputSimbolo").val("");
      $("#checkAtivo").prop("checked", false)
    });

    //Editar
    $('body').on('click', '.editarUnidade', function() {
      const unidad_id = $(this).attr('data-id');
      $.ajax({
        type: "GET",
        url: `/api/unidad/${unidad_id}`,
      }).done(function (response) {
        if (response && response.data) {
          $("#modalUnidad").modal("show");
          $('#tituloModal').text("Editar Unidade")
          $('#inputId').val(response.data.id);
          $("#inputDescricao").val(response.data.descricao);
          $("#inputSimbolo").val(response.data.simbolo),
          $("#checkAtivo").prop("checked", response.data.ativo)
        }
      });
    });

    // Excluir
    $('body').on('click', '.excluirUnidad', function() {
      const unidad_id = $(this).attr('data-id');
      if (confirm('Aviso! Deseja realmente excluir o unidad?')) {
        $.ajax({
          type: "DELETE",
          url:  `/api/unidad/${unidad_id}`,
        }).done(function (response) {
          $('#unidadTbl').DataTable().ajax.reload();
        });
      }
    });
  });
</script>
@endpush