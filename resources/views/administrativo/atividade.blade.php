@extends('layouts.app', ['activePage' => 'atividades', 'titlePage' => __('Atividades')])
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection
@section('subheaderTitle')
  Atividades
@endsection
@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="col-12 text-right">
          <button type="button" class="btn btn-primary" id="novaAtividade">
            + Novo Atividade
          </button>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Atividades</h4>
                <p class="card-category"> Listado de Atividades</p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="atividadeTbl">
                    <thead class=" text-primary">
                      <th>
                        Descrição
                      </th>
                      <th>
                        Ativo
                      </th>
                      <th>
                        Ação
                      </th>
                    </thead>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      <div class="modal fade" id="modalAtividade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
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
                    <input type="hidden" class="form-control" id="inputId">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="inputDescricao" placeholder="Descrição">
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="form-check">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox"  id="checkAtivo" value="">
                          Ativo?
                          <span class="form-check-sign">
                          <span class="check"></span>
                          </span>
                          </label>
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
      </div>

  @endsection

  @push('js')
    <!-- <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->
    <script>
      $(document).ready(function () {
        $('#atividadeTbl').DataTable({
          dom: 'Bfrtip',
                buttons: [
                            {
                              extend: 'copy',
                              text: 'COPIAR',
                              text: '<i class="fa fa-copy fa-2x"></i>',
                              titleAttr: 'Copiar para Área de Transferência',
                              charset: 'UTF-8',
                            },
                            {
                              extend: 'pdf',
                              text: 'PDF',
                              text: '<i class="fa fa-file-pdf fa-2x"></i>',
                              titleAttr: 'Exportar em formato PDF',
                              charset: 'UTF-8',
                              footer: false,
                              pageSize: 'A4'
                            },
                            {
                              extend: 'excel',
                              text: 'EXCEL',
                              text: '<i class="fa fa-file-excel fa-2x"></i>',
                              titleAttr: 'Exportar em formato Excel',
                              charset: 'UTF-8',
                            },
                            {
                              extend: 'csv',
                              text: 'CSV',
                              text: '<i class="fa fa-file-csv fa-2x"></i>',
                              titleAttr: 'Exportar em formato CSV',
                              charset: 'UTF-8',
                            },
                            {
                              extend: 'print',
                              text: 'IMPRIMIR',
                              text: '<i id="nova-pesquisa" class="fa fa-print fa-2x"></i>',
                              titleAttr: 'Imprimir',
                              charset: 'UTF-8',
                              footer: false,
                            },
                ],
          ajax: {
            url: '/api/atividade',
            dataSrc: 'data'
          },
          columns: [
            { "data": "descricao" },
            { "data": "ativo" , render: function (data, type) {
                return data ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'
            } },

          ],
          columnDefs : [
              { 
                  targets : [2],
                  render : function (data, type, row) {
                    return `
                      <i class="fa fa-trash excluirAtividade" data-id="${row.id}" title="Excluir" ></i>
                      &nbsp;
                      <i class="fa fa-pen editarAtividade" data-id="${row.id}" title="Editar"></i>
                    `
                  }
              }
           ],
        });
        //Salvar
        $('body').on('click', '#salvarAtividade', function(){
          const JSONRequest = {
            descricao: $("#inputDescricao").val(),
            ativo: $("#checkAtivo").prop("checked") ? 1 : 0,
          }
          console.log(JSONRequest)
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
            console.log(response);
            if (response && response.data) {
              $("#modalAtividade").modal("hide");
              $('#inputId').val("");
              $('#atividadeTbl').DataTable().ajax.reload();
              $("#inputDescricao").val("");
              $("#checkAtivo").prop("checked", false)
            }
          });
        });
        $('body').on('click', '#novaAtividade',  function(){
          $("#modalAtividade").modal("show");
          $('#tituloModal').text("Nova Atividade");
          $("#inputDescricao").val("");
        });
        //Editar
         $('body').on('click', '.editarAtividade',  function(){
          const atividade_id = $(this).attr('data-id');
          $.ajax({
            type: "GET",
            url: `/api/atividade/${atividade_id}`,
          }).done(function (response) {
            console.log(response);
            if (response && response.data) {
                console.log(response.data)
                $("#modalAtividade").modal("show");
                $('#tituloModal').text("Editar Atividade")
                $('#inputId').val(response.data.id);
                $("#inputDescricao").val(response.data.descricao);
                $("#checkAtivo").prop("checked", response.data.ativo)
                $('#atividadeTbl').DataTable().ajax.reload();
            }
          });
         });
        //Excluir 
        $('body').on('click', '.excluirAtividade',  function(){
          const atividade_id = $(this).attr('data-id');
            if (confirm('Aviso!,Deseja realmente excluir à atividade?')) {
              $.ajax({
                type: "DELETE",
                url:  `/api/atividade/${atividade_id}`,
              }).done(function (response) {
                console.log(response);
                  $('#atividadeTbl').DataTable().ajax.reload();
              });
            }
         });
      });
    </script>
  @endpush