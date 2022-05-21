@extends('layouts.app', ['activePage' => 'unidad', 'titlePage' => __('Unidad')])
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection
@section('subheaderTitle')
  Unidade
@endsection
@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="col-12 text-right">
          <button type="button" class="btn btn-primary" id="novaUnidad">
            Criar Novo Unidad
          </button>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Unidades</h4>
                <p class="card-category"> Listado de Unidades</p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="unidadTbl">
                    <thead class=" text-primary">
                      <th>
                        Descrição
                      </th>
                      <th>
                        Simbolo
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
      <div class="modal fade" id="modalUnidad" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="tituloModal"> Novo Unidad</h5>
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
                          Ativo?
                          <span class="form-check-sign">
                          <span class="check"></span>
                          </span>
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
      </div>

  @endsection

  @push('js')
    <!-- <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->
    <script>
      $(document).ready(function () {
        $('#unidadTbl').DataTable({
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
            url: '/api/unidad',
            dataSrc: 'data'
          },
          columns: [
            { "data": "descricao" },
            { "data": "simbolo" },
            { "data": "ativo" , render: function (data, type) {
                return data ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'
            } },

          ],
          columnDefs : [
              { 
                  targets : [3],
                  render : function (data, type, row) {
                    return `
                      <i class="fa fa-trash excluirUnidad" data-id="${row.id}" title="Excluir" ></i>
                      &nbsp;
                      <i class="fa fa-pen editarUnidade" data-id="${row.id}" title="Editar"></i>
                    `
                  }
              }
           ],
        });
        $('body').on('click', '#salvarUnidad', function(){
          const JSONRequest = {
            descricao: $("#inputDescricao").val(),
            simbolo: $("#inputSimbolo").val(),
            ativo: $("#checkAtivo").prop("checked") ? 1 : 0,
          }
          console.log(JSONRequest)
          const id = $('#inputId').val();
          const method = id ? "PUT" : "POST";
          const urlP= id ? `/api/unidad/${id}` : "/api/unidad";
         
          $.ajax({
            type: method,
            url: urlP,
            data: JSONRequest,
            dataType: "json",
            encode: true,
          }).done(function (response) {
            console.log(response);
            if (response && response.data) {
              $("#modalUnidade").modal("hide");
              $('#inputId').val("");
              $('#unidadTbl').DataTable().ajax.reload();
              $("#inputDescricao").val(""),
              $("#inputSimbolo").val(""),
              $("#checkAtivo").prop("checked", false)
            }
          });
        });
        $('body').on('click', '#novaUnidad',  function(){
          $("#modalUnidad").modal("show");
          $('#tituloModal').text("Nova Unidade");
          $("#inputDescricao").val("");
          $("#inputSimbolo").val("");
        });
        //Editar
         $('body').on('click', '.editarUnidade',  function(){
          const unidad_id = $(this).attr('data-id');
          $.ajax({
            type: "GET",
            url: `/api/unidad/${unidad_id}`,
          }).done(function (response) {
            console.log(response);
            if (response && response.data) {
                console.log(response.data)
                $("#modalUnidad").modal("show");
                $('#tituloModal').text("Editar Unidade")
                $('#inputId').val(response.data.id);
                $('#unidadTbl').DataTable().ajax.reload();
                $("#inputDescricao").val(response.data.descricao);
                $("#inputSimbolo").val(response.data.simbolo),
                $("#checkAtivo").prop("checked", response.data.ativo)
              
            }
          });
         });
         //DELETE
        $('body').on('click', '.excluirUnidad',  function(){
          const unidad_id = $(this).attr('data-id');
            if (confirm('Aviso!,Deseja realmente excluir o device?')) {
              $.ajax({
                type: "DELETE",
                url:  `/api/unidad/${unidad_id}`,
              }).done(function (response) {
                console.log(response);
                  $('#unidadTbl').DataTable().ajax.reload();
              });
            }
         });
      });
    </script>
  @endpush