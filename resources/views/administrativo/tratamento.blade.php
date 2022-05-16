@extends('layouts.app', ['activePage' => 'tratamentos', 'titlePage' => __('Tratamentos')])
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection
@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="col-12 text-right">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo">
            Criar Novo Tratamento
          </button>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Tratamento</h4>
                <p class="card-category"> Listado de Tratamentos</p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="tratamentoTbl">
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
      <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Criar Novo Tratamento</h5>
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
                    <button type="button" class="btn btn-primary" id="salvarTratamento">Salvar</button>
                  </form>
                </div>
              </div>
            </div>
           </div>
          </div>
        </div>
        <div class="text-center">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo">
          <i class="fa-solid fa-file-pdf"></i>
          </button>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo">
          <i class="fa-solid fa-file-excel"></i>
          </button>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo">
          <i class="fa-solid fa-file-csv"></i>
          </button>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo">
          <i class="fa-solid fa-print"></i>
          </button>
        </div>
      </div>

  @endsection

  @push('js')
    <!-- <script src="//cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->
    <script>
      $(document).ready(function () {
        $('#tratamentoTbl').DataTable({
          ajax: {
            url: '/api/tratamento',
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
                      <i class="fa fa-trash excluirTratamento" data-id="${row.id}" title="Excluir" ></i>
                      &nbsp;
                      <i class="fa fa-pen excluirTratamento" data-id="${row.id}" data-toggle="modal" data-target="#devicesModal" title="Editar"></i>
                    `
                  }
              }
           ],
        });
        $('body').on('click', '#salvarTratamento', function(){
          const JSONRequest = {
            descricao: $("#inputDescricao").val(),
            ativo: $("#checkAtivo").prop("checked") ? 1 : 0,
          }
          console.log(JSONRequest)
          $.ajax({
            type: "POST",
            url: "/api/tratamento",
            data: JSONRequest,
            dataType: "json",
            encode: true,
          }).done(function (response) {
            console.log(response);
            if (response && response.data) {
              $("#modalExemplo").modal("hide");
              $('#tratamentoTbl').DataTable().ajax.reload();
              $("#inputDescricao").val(""),
              $("#checkAtivo").prop("checked", false)
            }
          });
        });
        $('body').on('click', '.excluirTratamento',  function(){
          const tratamento_id = $(this).attr('data-id');
            if (confirm('Aviso!,Deseja realmente excluir o device?')) {
              $.ajax({
                type: "DELETE",
                url:  `/api/tratamento/${tratamento_id}`,
              }).done(function (response) {
                console.log(response);
                  $('#tratamentoTbl').DataTable().ajax.reload();
              });
            }
         });
      });
    </script>
  @endpush