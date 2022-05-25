@extends('layouts.app', ['activePage' => 'estagios', 'titlePage' => __('Estagios OS')])
@section('css')
  <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> -->
@endsection
@section('subheaderTitle')
  Estagio OS
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoEstagioOs">+ Novo Estagio</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <!-- <h4 class="card-title">Acondicionamento</h4> -->
              <!-- <p class="card-category">Listado de Acondicionamento</p> -->
              <span class="card-title">&nbsp;</span>
            </div>
            <div class="card-body">
              <!-- <div class="table-responsive"> -->
              <div>
                <table class="table" id="estagioOsTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Descrição</th>
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

  <div class="modal fade" id="modalEstagioOs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModal">Criar Novo Estagio Os</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <form>
                <div class="form-row">
                <div class="form-group col-md-6">
                  <div class="togglebutton">
                    <label>
                      <input type="checkbox" checked="" id="checkAtivo">
                        <span class="toggle"></span>
                        Ativo?
                    </label>
                  </div>
                </div>
                  <div class="form-group col-md-6">
                    <input type="hidden" class="form-control" id="inputId">
                    <input type="text" class="form-control" id="inputDescricao" placeholder="Descrição">
                  </div>
                </div>
                <button type="button" class="btn btn-primary" id="salvarAcond">Salvar</button>
              </form>
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
    $('#estagioOsTbl').DataTable({
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
        url: '/api/estagio_os',
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
              <i class="fa fa-trash cursor-pointer excluirEstagioOs" data-id="${row.id}" title="Excluir" ></i>
              &nbsp;
              <i class="fa fa-pen cursor-pointer editarEstagioOs" data-id="${row.id}" title="Editar"></i>
            `
          }
        }
      ],
    });

    // Salvar 
    $('body').on('click', '#salvarEstagioOs', function(){
      const JSONRequest = {
        descricao: $("#inputDescricao").val(),
        ativo: $("#checkAtivo").prop("checked") ? 1 : 0
      }
      const id = $('#inputId').val();
      const method = id ? "PUT" : "POST";
      const urlP= id ? `/api/estagio_os/${id}` : "/api/estagio_os";
      $.ajax({
        type: method,
        url: urlP,
        data: JSONRequest,
        dataType: "json",
        encode: true,
      }).done(function (response) {
        if (response && response.data) {
          $("#modalEstagioOs").modal("hide");
          $('#estagioOsTbl').DataTable().ajax.reload();
        }
      });
    });

    // Open Modal New
    $('body').on('click', '#novoEstagioOs', function() {
      $("#modalEstagioOs").modal("show");
      $('#tituloModal').text("Nova Estagio OS");
      $('#inputId').val("");
      $("#inputDescricao").val("");
      $("#checkAtivo").prop("checked", false)
    });

    // Editar
    $('body').on('click', '.editarEstagioOs', function() {
      const estagios_id = $(this).attr('data-id');
      $.ajax({
        type: "GET",
        url: `/api/estagio_os/${estagios_id}`,
      }).done(function (response) {
        if (response && response.data) {
          $("#modalEstagioOs").modal("show");
          $('#tituloModal').text("Editar Estagio Os")
          $('#inputId').val(response.data.id);
          $("#inputDescricao").val(response.data.descricao);
        }
      });
    });

    // Excluir
    $('body').on('click', '.excluirEstagioOs',  function() {
      const estagios_id = $(this).attr('data-id');
      if (confirm('Aviso! Deseja realmente excluir o Estagios OS?')) {
        $.ajax({
          type: "DELETE",
          url:  `/api/estagio_os/${estagios_id}`,
        }).done(function (response) {
          $('#estagioOsTbl').DataTable().ajax.reload();
        });
      }
    });
  });
</script>
@endpush