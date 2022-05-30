@extends('layouts.app', ['activePage' => 'classe_sucata', 'titlePage' => __('Classes de Sucatas')])
@section('css')
  <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> -->
@endsection
@section('subheaderTitle')
  Classes de Sucatas 
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novaClasseSucata">+ Nova Classe de Sucata</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Classes de Sucatas</h4>
              <p class="card-category">Sucatas Cadastradas</p>
              <span class="card-title">&nbsp;</span>
            </div>
            <div class="card-body">
              <!-- <div class="table-responsive"> -->
              <div>
                <table class="table" id="sucataTbl">
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

  <div class="modal fade" id="modalSucata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModal">Criar Nova Classe</h5>
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
                    <input type="hidden" class="form-control" id="inputId">
                    <input type="text" class="form-control" id="inputDescricao" placeholder="Descrição">
                  </div>
                </div>
                <button type="button" class="btn btn-primary" id="salvarSucata">Salvar</button>
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
    $('#sucataTbl').DataTable({
      language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        },
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
        url: '/api/classe_sucata',
        dataSrc: 'data'
      },
      columns: [
        { data: "descricao" },
        // { data: "ativo", className: "text-center", render: function (data, type) {
        //   return data ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'
        // } },
      ],
      columnDefs: [
        { targets: 1, orderable: false },
        { 
          targets: 1,
          className: "text-center",
          render: function (data, type, row) {
            return `
              <i class="fa fa-trash cursor-pointer excluirSucata" data-id="${row.id}" title="Excluir" ></i>
              &nbsp;
              <i class="fa fa-pen cursor-pointer editarSucata" data-id="${row.id}" title="Editar"></i>
            `
          }
        }
      ],
    });

    // Salvar 
    $('body').on('click', '#salvarSucata', function(){
      const JSONRequest = {
        descricao: $("#inputDescricao").val(),
        // ativo: $("#checkAtivo").prop("checked") ? 1 : 0
      }
      const id = $('#inputId').val();
      const method = id ? "PUT" : "POST";
      const urlP= id ? `/api/classe_sucata/${id}` : "/api/classe_sucata";
      $.ajax({
        type: method,
        url: urlP,
        data: JSONRequest,
        dataType: "json",
        encode: true,
      }).done(function (response) {
        if (response && response.data) {
          $("#modalSucata").modal("hide");
          $('#sucataTbl').DataTable().ajax.reload();
        }
      });
    });

    // Open Modal New
    $('body').on('click', '#novaClasseSucata', function() {
      $("#modalSucata").modal("show");
      $('#tituloModal').text("Nova Classe de Sucata");
      $('#inputId').val("");
      $("#inputDescricao").val("");
      // $("#checkAtivo").prop("checked", false)
    });

    // Editar
    $('body').on('click', '.editarSucata', function() {
      const sucata_id = $(this).attr('data-id');
      $.ajax({
        type: "GET",
        url: `/api/classe_sucata/${sucata_id}`,
      }).done(function (response) {
        if (response && response.data) {
          $("#modalSucata").modal("show");
          $('#tituloModal').text("Editar Classse de Sucata")
          $('#inputId').val(response.data.id);
          $("#inputDescricao").val(response.data.descricao);
          // $("#checkAtivo").prop("checked", response.data.ativo)
        }
      });
    });

    // Excluir
    $('body').on('click', '.excluirSucata',  function() {
      const sucata_id = $(this).attr('data-id');
      if (confirm('Aviso! Deseja realmente excluir o acondicionamento?')) {
        $.ajax({
          type: "DELETE",
          url:  `/api/classe_sucata/${sucata_id}`,
        }).done(function (response) {
          $('#sucataTbl').DataTable().ajax.reload();
        });
      }
    });
  });
</script>
@endpush