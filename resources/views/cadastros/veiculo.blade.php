@extends('layouts.app', ['activePage' => 'veiculo', 'titlePage' => __('Veiculo')])
@section('css')
@endsection
@section('subheaderTitle')
  Cadastros
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoVeiculo">+ Novo Veiculo</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Cadastros</h4>
              <p class="card-category">Veiculos</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="veiculoTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Placa</th>
                    <th class="text-primary font-weight-bold">Chassis</th>
                    <th class="text-primary font-weight-bold">Capacidade</th>
                    <th class="text-primary font-weight-bold">Renavam</th>
                    <th class="text-primary font-weight-bold">Combustivel</th>
                    <th class="text-primary font-weight-bold">Modelo</th>
                    <th class="text-primary font-weight-bold">Marca</th>
                    <th class="text-primary font-weight-bold">Acondicionamento</th>
                    <th class="text-primary font-weight-bold">Ativo</th>
                    <th class="text-primary font-weight-bold">Ação</th>
                  </thead>
                </table>
              </div>
            </div>
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
                  <div class="form-group col-md-6 align-self-center">
                    <div class="togglebutton">
                      <label>
                        Ativo?
                        <input type="checkbox" id="checkAtivo">
                        <span class="toggle"></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control" id="inputPlaca" placeholder="Placa">
                  </div>
                </div>
                <div class="form-row ">
                  <input type="hidden" class="form-control" id="inputId">
                  <div class="form-group col-md-4">
                    <select id="iMarca" data-style="btn btn-warning text-white rounded" title="Single Select" name="marca">
                      <option value="" disabled selected>Marca</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <select  id="iModelo" data-style="btn btn-warning text-white rounded " title="Single Select" name="modelo">
                      <option value="" disabled selected>Modelo</option>
                    </select>
                  </div>
                  <div class="form-group col-md-4">
                    <select id="iAcondicionamento" data-style="btn btn-warning text-white rounded" title="Single Select" name="acondicionamento">
                      <option value="" disabled selected>Acondicionamento</option>
                    </select>
                  </div>
                </div>

                <div class="form-row">
                  <div class="form-group col-md-4">
                    <input type="text" class="form-control" id="inputChassis" placeholder="Chassis">
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
                <button type="button" class="btn btn-primary" id="salvarVeiculo">Salvar</button>
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
      $('#veiculoTbl').DataTable({
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
          url: '/api/veiculo',
          dataSrc: 'data'
        },
        columns: [
          { data: "placa" },
          { data: "chassis" },
          { data: "capacidade_media_carga" },
          { data: "renavam" },
          { data: "combustivel" },
          { data: "modelo" },
          { data: "marca" },
          { data: "acondicionamento" },
          { data: "ativo", render: function (data, type) {
              return data ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'
          } },

        ],
        columnDefs: [
          { width: "180px", targets: [0,1,2,3,4,5,6,7,8,9] },
          { 
            targets: 9,
            render: function (data, type, row) {
              return `
                <i class="fa fa-trash excluirVeiculo" data-id="${row.id}" title="Excluir" ></i>
                &nbsp;
                <i class="fa fa-pen editarVeiculo" data-id="${row.id}" title="Editar"></i>
              `
            }
          }
        ],
      });

      $('body').on('click', '#salvarVeiculo', function() {
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
          if (response && response.data) {
            $("#modalVeiculo").modal("hide");
            $('#veiculoTbl').DataTable().ajax.reload();
          }
        });
      });
      
      $('body').on('click', '#novoVeiculo', function() {
        $("#modalVeiculo").modal("show");
        $('#tituloModal').text("Novo Veiculo")
        $("#inputId").val(""),
        $("#inputPlaca").val(""),
        $("#inputChassis").val(""),
        $("#inputCapacidadeMediaCarga").val(""),
        $("#inputRenavam").val(""),
        $("#inputCombustivel").val(""),
        $("#inputModelo").val(""),
        $("#inputMarca").val(""),
        $("#inputAcondicionamento").val(""),
        $("#checkAtivo").prop("checked", false)
      });

      //Editar
      $('body').on('click', '.editarVeiculo', function() {
        const veiculo_id = $(this).attr('data-id');
        $.ajax({
          type: "GET",
          url: `/api/veiculo/${veiculo_id}`,
        }).done(function (response) {
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
          }
        });
      });

      $('body').on('click', '.excluirVeiculo', function() {
        const veiculo_id = $(this).attr('data-id');
        if (confirm('Aviso!,Deseja realmente excluir o veiculo?')) {
          $.ajax({
            type: "DELETE",
            url:  `/api/veiculo/${veiculo_id}`,
          }).done(function (response) {
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
      $.each(data, function(index, value) {
        $(selector).append(new Option(value.descricao, value.id));
      });
      $(selector).selectpicker()
    }
  </script>
@endpush