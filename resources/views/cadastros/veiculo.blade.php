@extends('layouts.app', ['activePage' => 'veiculo', 'titlePage' => __('Veiculo')])
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection
@section('subheaderTitle')
 Veiculo
@endsection
@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="col-12 text-right">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo">
            Criar Novo Veiculo
          </button>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <h4 class="card-title ">Veiculo</h4>
                <p class="card-category"> Listado de Veiculo</p>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="veiculoTbl">
                    <thead class=" text-primary">
                      <th>
                        Placa
                      </th>
                      <th>
                        Chassis
                      </th>
                      <th>
                        Capacidade
                      </th>
                      <th>
                        Renavam
                      </th>
                      <th>
                        Combustivel
                      </th>
                      <th>
                        Modelo
                      </th>
                      <th>
                        Marca
                      </th>
                      <th>
                        Acondicionamento
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
              <h5 class="modal-title" id="exampleModalLabel">Criar Novo Veiculo</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
          <div class="modal-body">
            <div class="row">
              <div class="col-md-12">
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <div class="col-lg-5 col-md-4 col-sm-3">
                                <select class="selectpicker" data-style="btn btn-primary btn-square" title="Single Select" name="unidad">
                                    <option value="" disabled selected>Marca</option>
                                    <!-- <option value="2">Exempleo 1</option>
                                    <option value="3">Exempleo 2</option>
                                    <option value="4">Exempleo 3</option>
                                    <option value="5">Exempleo 4</option>
                                    <option value="6">Exempleo 5</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="col-lg-5 col-md-6 col-sm-3">
                                <select class="selectpicker" data-style="btn btn-primary btn-square" title="Single Select" name="unidad">
                                    <option value="" disabled selected>Modelo</option>
                                    <!-- <option value="2">Exempleo 1</option>
                                    <option value="3">Exempleo 2</option>
                                    <option value="4">Exempleo 3</option>
                                    <option value="5">Exempleo 4</option>
                                    <option value="6">Exempleo 5</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="col-lg-5 col-md-6 col-sm-3">
                                <select class="selectpicker" data-style="btn btn-primary btn-square" title="Single Select" name="usuario">
                                    <option value="" disabled selected>Acondicionamento</option>
                                    <!-- <option value="2">Hugo Ramirez</option>
                                    <option value="3">User 1</option>
                                    <option value="4">User 2</option>
                                    <option value="5">User 3</option>
                                    <option value="6">User 4</option> -->
                                </select>
                            </div>
                        </div>
                    </div>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="inputChassis" placeholder="Chassis">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="inputPlaca" placeholder="Placa">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="inputCapacidade" placeholder="Capacidade">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="inputRenavam" placeholder="Renavam">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="inputCombustivel" placeholder="Combustivel">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="inputDescricao" placeholder="Descrição">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                        <input type="text" class="form-control" id="inputDescricao" placeholder="Descrição">
                    </div>
                  </div>
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
                    <button type="button" class="btn btn-primary" id="salvarMarca">Salvar</button>
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
        $('#veiculoTbl').DataTable({
          dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ],
          ajax: {
            url: '/api/veiculo',
            dataSrc: 'data'
          },
          columns: [
            { "data": "placa" },
            { "data": "chassis" },
            { "data": "capacidade_media_carga" },
            { "data": "renavam" },
            { "data": "combustivel" },
            { "data": "modelo" },
            { "data": "marca" },
            { "data": "acondicionamento" },
            { "data": "ativo" , render: function (data, type) {
                return data ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'
            } },

          ],
          columnDefs : [
              { 
                  targets : [9],
                  render : function (data, type, row) {
                    return `
                      <i class="fa fa-trash excluirMarca" data-id="${row.id}" title="Excluir" ></i>
                      &nbsp;
                      <i class="fa fa-pen editarDevice" data-id="${row.id}" data-toggle="modal" data-target="#devicesModal" title="Editar"></i>
                    `
                  }
              }
           ],
        });
        $('body').on('click', '#salvarVeiculo', function(){
          const JSONRequest = {
            descricao: $("#inputDescricao").val(),
            ativo: $("#checkAtivo").prop("checked") ? 1 : 0,
          }
          console.log(JSONRequest)
          $.ajax({
            type: "POST",
            url: "/api/veiculo",
            data: JSONRequest,
            dataType: "json",
            encode: true,
          }).done(function (response) {
            console.log(response);
            if (response && response.data) {
              $("#modalExemplo").modal("hide");
              $('#marcaTbl').DataTable().ajax.reload();
              $("#inputDescricao").val(""),
              $("#checkAtivo").prop("checked", false)
            }
          });
        });
        $('body').on('click', '.excluirMarca',  function(){
          const veiculo_id = $(this).attr('data-id');
            if (confirm('Aviso!,Deseja realmente excluir o device?')) {
              $.ajax({
                type: "DELETE",
                url:  `/api/veiculo/${veiculo_id}`,
              }).done(function (response) {
                console.log(response);
                  $('#veiculoTbl').DataTable().ajax.reload();
              });
            }
         });
      });
    </script>
  @endpush