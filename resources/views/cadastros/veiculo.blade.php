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
          <button type="button" class="btn btn-primary" id="novoVeiculo" >
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
      <div class="modal fade" id="modalVeiculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
                 <h5 class="modal-title" id="tituloModal">Criar Novo Veiculo</h5>
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
                        <div class="form-group col-md-4">
                            <div class="col-lg-5 col-md-4 col-sm-3">
                                <select  id="iMarca" data-style="btn btn-primary btn-square" title="Single Select" name="marca">
                                    <option value="" disabled selected>Marca</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="col-lg-5 col-md-6 col-sm-3">
                                <select  id="iModelo" data-style="btn btn-primary btn-square" title="Single Select" name="modelo">
                                    <option value="" disabled selected>Modelo</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-4">
                            <div class="col-lg-5 col-md-6 col-sm-3">
                                <select  id="iAcondicionamento" data-style="btn btn-primary btn-square" title="Single Select" name="acondicionamento">
                                    <option value="" disabled selected>Acondicionamento</option>
                                </select>
                            </div>
                        </div>
                    </div>
                  <div class="form-row">
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="inputChassis" placeholder="Chassis">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="inputPlaca" placeholder="Placa">
                    </div>
                    <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="inputCapacidade" placeholder="Capacidade">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="inputRenavam" placeholder="Renavam">
                    </div>
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" id="inputCombustivel" placeholder="Combustivel">
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
                    <button type="button" class="btn btn-primary" id="salvarVeiculo">Salvar</button>
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
              // { width: "110px", targets: [4,5] },
              { width: "180px", targets: [0,1,2,3,4,5,6,7,8,9] },
            // { width: "100px", targets: [14,15,16,17,18,20,21,22,23] },
              { 
                  targets : [9],
                  render : function (data, type, row) {
                    return `
                      <i class="fa fa-trash excluirVeiculo" data-id="${row.id}" title="Excluir" ></i>
                      &nbsp;
                      <i class="fa fa-pen editarVeiculo" data-id="${row.id}" title="Editar"></i>
                    `
                  }
              }
           ],
        });
        $('body').on('click', '#salvarVeiculo', function(){
          const JSONRequest = {
            pessoa_juridicas_id: 1,
            placa: $("#inputPlaca").val(),
            chassis: $("#inputChassis").val(),
            capacidade_media_carga: $("#inputCapacidade").val(),
            renavam: $("#inputRenavam").val(),
            combustivel: $("#inputCombustivel").val(),
            modelos_id: $("#iModelo").val(),
            marcas_id: $("#iMarca").val(),
            acondicionamento_id: $("#iAcondicionamento").val(),
            ativo: $("#checkAtivo").prop("checked") ? 1 : 0,
          }
          console.log(JSONRequest)
          const id = $('#inputId').val();
          const method = id ? "PUT" : "POST";
          const urlP= id ? `/api/veiculo/${id}` : "/api/veiculo";
          $.ajax({
            type: method,
            url: urlP,
            data: JSONRequest,
            dataType: "json",
            encode: true,
          }).done(function (response) {
            console.log(response);
            if (response && response.data) {
              $("#modalVeiculo").modal("hide");
              $('#veiculoTbl').DataTable().ajax.reload();
              $("#inputPlaca").val(""),
              $("#inputChassis").val(""),
              $("#inputCapacidadeMediaCarga").val(""),
              $("#inputRenavam").val(""),
              $("#inputCombustivel").val(""),
              $("#inputModelo").val(""),
              $("#inputMarca").val(""),
              $("#inputAcondicionamento").val(""),
              $("#checkAtivo").prop("checked", false)
            }
          });
        });

        $('body').on('click', '#novoVeiculo',  function(){
          $("#modalVeiculo").modal("show");
          $('#tituloModal').text("Novo Veiculo")
        });
         //Editar
        $('body').on('click', '.editarVeiculo',  function(){
          const veiculo_id = $(this).attr('data-id');
          $.ajax({
            type: "GET",
            url: `/api/veiculo/${veiculo_id}`,
          }).done(function (response) {
            console.log(response);
            if (response && response.data) {
              $("#modalVeiculo").modal("show");
              $('#tituloModal').text("Editar Veiculo")
              $('#inputId').val(response.data.id);
              $("#inputPlaca").val(response.data.placa),
              $("#inputChassis").val(response.data.chassis),
              $("#inputCapacidade").val(response.data.capacidade_media_carga),
              $("#inputRenavam").val(response.data.renavam),
              $("#inputCombustivel").val(response.data.combustivel),
              $("#iModelo").val(response.data.modelos_id).selectpicker('refresh'),
              $("#iMarca").val(response.data.marcas_id).selectpicker('refresh'),
              $("#iAcondicionamento").val(response.data.acondicionamento_id).selectpicker('refresh'),
              $("#checkAtivo").prop("checked", response.data.ativo)
              $('#veiculoTbl').DataTable().ajax.reload();
            }
          });
        });
        $('body').on('click', '.excluirVeiculo',  function(){
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
         $.ajax({
          type: "GET",
          url: "/api/marca",
        }).done(function (response) {
          if (response && response.data) {
            loadSelect('#iMarca', response.data)
          }
        });
        $.ajax({
          type: "GET",
          url: "/api/modelo",
        }).done(function (response) {
          if (response && response.data) {
            loadSelect('#iModelo', response.data)
          }
        });
        $.ajax({
          type: "GET",
          url: "/api/acondicionamento",
        }).done(function (response) {
          if (response && response.data) {
            loadSelect('#iAcondicionamento', response.data)
          }
        });
      });
      function loadSelect(selector, data) {
        console.log('loadSelect', selector, data)
        $.each(data, function(index, value) {
          console.log('loadSelect each', index, value)
          $(selector).append(new Option(value.descricao, value.id));
          // $(selector).append($('<option>', {
          //   value: value.id,
          //   text: value.descricao
          // }))
        });
        $(selector).selectpicker()
      }
    </script>
  @endpush