@extends('layouts.app', ['activePage' => 'marca', 'titlePage' => __('Marca')])
@section('css')
  <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> -->
@endsection
@section('subheaderTitle')
  Marca de Veiculo
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novaMarca">+ Novo Marca</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <!-- <h4 class="card-title ">Marcas</h4> -->
              <!-- <p class="card-category"> Listado de Marcas</p> -->
              <span class="card-title">&nbsp;</span>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="marcaTbl">
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

  <div class="modal fade" id="modalMarca" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModal">Criar Novo Marca</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <form>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <div class="togglebutton">
                      <label>
                        <input type="checkbox" checked="" id="checkAtivo">
                          <span class="toggle"></span>
                          Ativo?
                      </label>
                    </div>
                  </div>
                  <input type="hidden" class="form-control" id="inputId">
                  <div class="form-group col-md-6">
                    <input type="text" class="form-control" id="inputDescricao" placeholder="Descrição">
                  </div>
                </div>
                <button type="button" class="btn btn-primary" id="salvarMarca">Salvar</button>
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
    $('#marcaTbl').DataTable({
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
        url: '/api/marca',
        dataSrc: 'data'
      },
      columns: [
        { "data": "descricao" },
        { "data": "ativo", className: "text-center", render: function (data, type) {
          return data ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'
        } },
      ],
      columnDefs: [
        { targets: 1, orderable: false },
        { 
          targets: [2],
          className: "text-center",
          render : function (data, type, row) {
            return `
              <i class="fa fa-trash excluirMarca cursor-pointer" data-id="${row.id}" title="Excluir" ></i>
              &nbsp;
              <i class="fa fa-pen editarMarca cursor-pointer" data-id="${row.id}" title="Editar"></i>
            `
          }
        }
      ],
    });

    // Salvar
    $('body').on('click', '#salvarMarca', function() {
      const JSONRequest = {
        descricao: $("#inputDescricao").val(),
        ativo: $("#checkAtivo").prop("checked") ? 1 : 0,
      }
      const id = $('#inputId').val();
      const method = id ? "PUT" : "POST";
      const urlP= id ? `/api/marca/${id}` : "/api/marca";
      $.ajax({
        type: method,
        url: urlP,
        data: JSONRequest,
        dataType: "json",
        encode: true,
      }).done(function (response) {
        if (response && response.data) {
          $("#modalMarca").modal("hide");
          $('#marcaTbl').DataTable().ajax.reload();
        }
      });
    });

    // Open Modal New
    $('body').on('click', '#novaMarca', function() {
      $("#modalMarca").modal("show");
      $('#tituloModal').text("Nova marca");
      $('#inputId').val("");
      $("#inputDescricao").val(""),
      $("#checkAtivo").prop("checked", false)
    });

    //Editar
    $('body').on('click', '.editarMarca', function() {
      const marca_id = $(this).attr('data-id');
      $.ajax({
        type: "GET",
        url: `/api/marca/${marca_id}`,
      }).done(function (response) {
        if (response && response.data) {
          $("#modalMarca").modal("show");
          $('#tituloModal').text("Editar Marca")
          $('#inputId').val(response.data.id);
          $("#inputDescricao").val(response.data.descricao);
          $("#checkAtivo").prop("checked", response.data.ativo)
        }
      });
    });

    //Delete
    $('body').on('click', '.excluirMarca', function() {
      const marca_id = $(this).attr('data-id');
      if (confirm('Aviso!,Deseja realmente excluir o marca?')) {
        $.ajax({
          type: "DELETE",
          url:  `/api/marca/${marca_id}`,
        }).done(function (response) {
          $('#marcaTbl').DataTable().ajax.reload();
        });
      }
    });
  });
</script>
@endpush