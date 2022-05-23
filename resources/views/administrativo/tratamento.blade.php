@extends('layouts.app', ['activePage' => 'tratamentos', 'titlePage' => __('Tratamentos')])
@section('css')
  <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> -->
@endsection
@section('subheaderTitle')
  Tratamento
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoTratamento">+ Novo Tratamento</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <!-- <h4 class="card-title ">Tratamento</h4> -->
              <!-- <p class="card-category"> Listado de Tratamentos</p> -->
              <span class="card-title">&nbsp;</span>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="tratamentoTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Descrição</th>
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

  <div class="modal fade" id="modalTratamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModal">Criar Novo Tratamento</h5>
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
                <div class="form-group">
                  <div class="form-check">
                    <label class="form-check-label">
                      <input class="form-check-input" type="checkbox"  id="checkAtivo" value="">
                      Ativo? <span class="form-check-sign"><span class="check"></span></span>
                    </label>
                  </div>
                </div>
                <button type="button" class="btn btn-primary" id="salvarTratamento">Salvar</button>
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
    $('#tratamentoTbl').DataTable({
      dom: 'Bfrtip',
      buttons: [
        {
          extend: 'copy',
          text: '<i class="fa fa-copy fa-2x"></i>',
          titleAttr: 'Copiar para Área de Transferência',
          className: 'btn-default',
          charset: 'UTF-8',
        },
        {
          extend: 'pdf',
          text: '<i class="fa fa-file-pdf fa-2x"></i>',
          titleAttr: 'Exportar em formato PDF',
          className: 'btn-default',
          charset: 'UTF-8',
          footer: false,
          pageSize: 'A4'
        },
        {
          extend: 'excel',
          text: '<i class="fa fa-file-excel fa-2x"></i>',
          titleAttr: 'Exportar em formato Excel',
          className: 'btn-default',
          charset: 'UTF-8',
        },
        {
          extend: 'csv',
          text: '<i class="fa fa-file-csv fa-2x"></i>',
          titleAttr: 'Exportar em formato CSV',
          className: 'btn-default',
          charset: 'UTF-8',
        },
        {
          extend: 'print',
          text: '<i id="nova-pesquisa" class="fa fa-print fa-2x"></i>',
          titleAttr: 'Imprimir',
          className: 'btn-default',
          charset: 'UTF-8',
          footer: false,
        },
      ],
      ajax: {
        url: '/api/tratamento',
        dataSrc: 'data'
      },
      columns: [
        { data: "descricao" },
        { data: "ativo", className: "text-center", render: function (data, type) {
          return data ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'
        } },
      ],
      columnDefs: [
        { targets: 1, orderable: false },
        { 
          targets: 2,
          className: "text-center",
          render: function (data, type, row) {
            return `
              <i class="fa fa-trash excluirTratamento cursor-pointer" data-id="${row.id}" title="Excluir" ></i>
              &nbsp;
              <i class="fa fa-pen editarTratamento cursor-pointer" data-id="${row.id}" title="Editar"></i>
            `
          }
        }
      ],
    });

    // Salvar
    $('body').on('click', '#salvarTratamento', function() {
      const JSONRequest = {
        descricao: $("#inputDescricao").val(),
        ativo: $("#checkAtivo").prop("checked") ? 1 : 0,
      }
      const id = $('#inputId').val();
      const method = id ? "PUT" : "POST";
      const urlP= id ? `/api/tratamento/${id}` : "/api/tratamento";
      $.ajax({
        type: method,
        url: urlP,
        data: JSONRequest,
        dataType: "json",
        encode: true,
      }).done(function (response) {
        if (response && response.data) {
          $("#modalTratamento").modal("hide");
          $('#tratamentoTbl').DataTable().ajax.reload();
        }
      });
    });

    // Open Modal New
    $('body').on('click', '#novoTratamento', function() {
      $("#modalTratamento").modal("show");
      $('#tituloModal').text("Novo Tratamento");
      $('#inputId').val("");
      $("#inputDescricao").val("");
      $("#checkAtivo").prop("checked", false)
    });

    // Editar
    $('body').on('click', '.editarTratamento', function() {
      const tratamento_id = $(this).attr('data-id');
      $.ajax({
        type: "GET",
        url: `/api/tratamento/${tratamento_id}`,
      }).done(function (response) {
        if (response && response.data) {
          $("#modalTratamento").modal("show");
          $('#tituloModal').text("Editar Tratamento")
          $('#inputId').val(response.data.id);
          $("#inputDescricao").val(response.data.descricao);
          $("#checkAtivo").prop("checked", response.data.ativo)
        }
      });
    });

    // Excluir
    $('body').on('click', '.excluirTratamento', function() {
      const tratamento_id = $(this).attr('data-id');
      if (confirm('Aviso! Deseja realmente excluir o tratamento?')) {
        $.ajax({
          type: "DELETE",
          url:  `/api/tratamento/${tratamento_id}`,
        }).done(function (response) {
          $('#tratamentoTbl').DataTable().ajax.reload();
        });
      }
    });
  });
</script>
@endpush