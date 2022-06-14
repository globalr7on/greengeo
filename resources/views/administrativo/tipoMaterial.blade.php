@extends('layouts.app', ['activePage' => 'tipo_material', 'titlePage' => __('Tipo de Materiais')])
@section('css')
@endsection
@section('subheaderTitle')
  Tipo de Materiais
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoTipoMaterial">+ Novo Tipo </button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Administrativo</h4>
              <p class="card-category">Tipo de Materiais</p>
              <span class="card-title">&nbsp;</span>
            </div>
            <div class="card-body">
              <!-- <div class="table-responsive"> -->
              <div>
                <table class="table" id="tipoMateriaisTbl">
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

  <div class="modal fade" id="modalTipoMaterial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModal">Criar Novo Tipo</h5>
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
                    <label for="inputDescricao">Descrição</label>
                    <input type="text" class="form-control" id="inputDescricao">
                  </div>
                </div>
                <button type="button" class="btn btn-primary" id="salvarTipoMaterial">Salvar</button>
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
    $('#tipoMateriaisTbl').DataTable({
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
        url: '/api/tipo_materiais',
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
              <i class="fa fa-trash cursor-pointer excluirTipoM" data-id="${row.id}" title="Excluir" ></i>
              &nbsp;
              <i class="fa fa-pen cursor-pointer editarTipoM" data-id="${row.id}" title="Editar"></i>
            `
          }
        }
      ],
    });

    // Salvar 
    $('body').on('click', '#salvarTipoMaterial', function(){
      const JSONRequest = {
        descricao: $("#inputDescricao").val(),
      
      }
      const id = $('#inputId').val();
      const method = id ? "PUT" : "POST";
      const urlP= id ? `/api/tipo_materiais/${id}` : "/api/tipo_materiais";
      $.ajax({
        type: method,
        url: urlP,
        data: JSONRequest,
        dataType: "json",
        encode: true,
      }).done(function (response) {
        if (response && response.data) {
          $("#modalTipoMaterial").modal("hide");
          $('#tipoMateriaisTbl').DataTable().ajax.reload();
        }
      });
    });

    // Open Modal New
    $('body').on('click', '#novoTipoMaterial', function() {
      $("#modalTipoMaterial").modal("show");
      $('#tituloModal').text("Nova Classe de Sucata");
      $('#inputId').val("");
      $("#inputDescricao").val("");
    
    });

    // Editar
    $('body').on('click', '.editarTipoM', function() {
      const sucata_id = $(this).attr('data-id');
      $.ajax({
        type: "GET",
        url: `/api/tipo_materiais/${sucata_id}`,
      }).done(function (response) {
        if (response && response.data) {
          $("#modalTipoMaterial").modal("show");
          $('#tituloModal').text("Editar Classse de Sucata")
          $('#inputId').val(response.data.id);
          $("#inputDescricao").val(response.data.descricao);
          // $("#checkAtivo").prop("checked", response.data.ativo)
        }
      });
    });

    // Excluir
    $('body').on('click', '.excluirTipoM',  function() {
      const sucata_id = $(this).attr('data-id');
      if (confirm('Aviso! Deseja realmente excluir o acondicionamento?')) {
        $.ajax({
          type: "DELETE",
          url:  `/api/tipo_materiais/${sucata_id}`,
        }).done(function (response) {
          $('#tipoMateriaisTbl').DataTable().ajax.reload();
        });
      }
    });
  });
</script>
@endpush