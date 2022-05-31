@extends('layouts.app', ['activePage' => 'atividades', 'titlePage' => __('Atividades')])
@section('css')
  <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> -->
@endsection
@section('subheaderTitle')
  Atividades
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novaAtividade">+ Novo Atividade</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <!-- <h4 class="card-title ">Atividades</h4> -->
              <!-- <p class="card-category"> Listado de Atividades</p> -->
              <span class="card-title">&nbsp;</span>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="atividadeTbl">
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

  <div class="modal fade" id="modalAtividade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModal"> Nova Atividade</h5>
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
                    <label>Ativo?
                      <input type="checkbox" checked="" id="checkAtivo">
                        <span class="toggle"></span>
                    </label>
                  </div>
                </div>
                <div class="form-group col-md-12">
                  <input type="hidden" class="form-control" id="inputId">
                  <div class="form-group col-md-12">
                    <label for="inputDescricao">Descrição</label>
                    <input type="text" class="form-control" id="inputDescricao">
                  </div>
                </div>
                <button type="button" class="btn btn-primary" id="salvarAtividade">Salvar</button>
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
    $('#atividadeTbl').DataTable({
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
        url: '/api/atividade',
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
          targets : [2],
          className: "text-center",
          render : function (data, type, row) {
            return `
              <i class="fa fa-trash excluirAtividade cursor-pointer" data-id="${row.id}" title="Excluir" ></i>
              &nbsp;
              <i class="fa fa-pen editarAtividade cursor-pointer" data-id="${row.id}" title="Editar"></i>
            `
          }
        }
      ],
    });

    //Salvar
    $('body').on('click', '#salvarAtividade', function() {
      const JSONRequest = {
        descricao: $("#inputDescricao").val(),
        ativo: $("#checkAtivo").prop("checked") ? 1 : 0,
      }
      const id = $('#inputId').val();
      const method = id ? "PUT" : "POST";
      const urlP= id ? `/api/atividade/${id}` : "/api/atividade";
      $.ajax({
        type: method,
        url: urlP,
        data: JSONRequest,
        dataType: "json",
        encode: true,
      }).done(function (response) {
        if (response && response.data) {
          // eliminar label de error si existe
          $("#descricaoError").remove();
          $("#modalAtividade").modal("hide");
          $('#atividadeTbl').DataTable().ajax.reload();
        } else {
          // nombre del campo devuelto por el api
          if (response.descricao) {
            $('#inputDescricao').after(`<label id="descricaoError" class="error">${response.descricao}</label>`);
          }
        }
      });
    });
    
    // Open Modal New
    $('body').on('click', '#novaAtividade', function() {
      $("#modalAtividade").modal("show");
      $('#tituloModal').text("Nova Atividade");
      $('#inputId').val("");
      $("#inputDescricao").val("");
      $("#checkAtivo").prop("checked", false)
    });

    //Editar
    $('body').on('click', '.editarAtividade', function() {
      const atividade_id = $(this).attr('data-id');
      $.ajax({
        type: "GET",
        url: `/api/atividade/${atividade_id}`,
      }).done(function (response) {
        if (response && response.data) {
          $("#modalAtividade").modal("show");
          $('#tituloModal').text("Editar Atividade")
          $('#inputId').val(response.data.id);
          $("#inputDescricao").val(response.data.descricao);
          $("#checkAtivo").prop("checked", response.data.ativo)
        }
      });
    });

    //Excluir 
    $('body').on('click', '.excluirAtividade', function() {
      const atividade_id = $(this).attr('data-id');
      if (confirm('Aviso!,Deseja realmente excluir à atividade?')) {
        $.ajax({
          type: "DELETE",
          url:  `/api/atividade/${atividade_id}`,
        }).done(function (response) {
          $('#atividadeTbl').DataTable().ajax.reload();
        });
      }
    });
  });
</script>
@endpush