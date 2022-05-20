@extends('layouts.app', ['activePage' => 'nota_fiscal', 'titlePage' => __('Notal Fiscal')])
@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
@endsection
@section('subheaderTitle')
  Nota Fiscal
@endsection
@section('content')
    <div class="content">
      <div class="container-fluid">
        <div class="col-12 text-right">
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddNew">
            Criar Novo Fiscal
          </button>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header card-header-primary">
                <!-- <h4 class="card-title ">Fiscal</h4>
                <p class="card-category"> Notas Fiscais</p> -->
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table" id="nfiscalTbl">
                    <thead>
                      <tr>
                        <th class="text-center">#</th>
                        <th>Numero</th>
                        <th>Serie</th>
                        <th>Folha</th>
                        <th> Chave de Acesso</th>
                        <!-- <th class="text-right">Salary</th> -->
                        <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">1</td>
                        <td>Andrew Mike</td>
                        <td>Develop</td>
                        <td>2013</td>
                        <td> 99,225</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td class="text-center">2</td>
                        <td>John Doe</td>
                        <td>Design</td>
                        <td>2012</td>
                        <td> 89,241</td>
                        <td></td>
                      </tr>
                      <tr>
                        <td class="text-center">3</td>
                        <td>Alex Mike</td>
                        <td>Design</td>
                        <td>2010</td>
                        <td> 89,241</td>
                        <td></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Add new modal -->
      <div class="modal fade" id="modalAddNew" tabindex="-1" role="dialog" aria-labelledby="modalAddNew" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
          <div class="modal-content">
            <div class="card card-nav-tabs card-plain">
              <div class="card-header card-header-primary">
                  <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
                <div class="nav-tabs-navigation">
                  <div class="nav-tabs-wrapper">
                    <ul class="nav nav-tabs" data-tabs="tabs">
                      <li class="nav-item">
                        <a class="nav-link active" href="#nota" data-toggle="tab">Nota Fiscal</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="#items" data-toggle="tab">Items</a>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="card-body m-4">
                <div class="tab-content text-center">
                  <div class="tab-pane active" id="nota">
                    <form>
                      <div class="form-row">
                        <div class="form-group col-md-6 px-4">
                          <input type="text" class="form-control" id="inputNumeroTotal" placeholder="Numero Total">
                        </div>
                        <div class="form-group col-md-6 px-4">
                          <input type="text" class="form-control" id="inputSerie" placeholder="Serie">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-6 px-4">
                          <input type="text" class="form-control" id="inputFolha" placeholder="Folha">
                        </div>
                        <div class="form-group col-md-6 px-4">
                          <input type="text" class="form-control" id="inputEmpresa" placeholder="Empresa" value="Electrolux">
                        </div>
                      </div>
                      <div class="form-row">
                        <div class="form-group col-md-12 px-4">
                          <input type="text" class="form-control" id="inputFolha" placeholder="Chave de Acesso">
                        </div>
                      </div>
                    </form>
                  </div>
                  <div class="tab-pane px-1" id="items">
                    <div class="col-12 text-right">
                      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddItem">
                        Adicionar Item
                      </button>
                      <!-- <button type="button" class="btn btn-primary"  id="addItems">Adicionar Item</button> -->
                    </div>
                    <table class="table" id="itemTbl" >
                      <thead>
                        <tr>
                          <th>Unidad</th>
                          <th>Usuario</th>
                          <th>EAN</th>
                          <th>Descrição</th>
                          <th>Peso</th>
                          <th>Largura</th>
                          <th>Profundidade</th>
                          <th>Comprimento</th>
                          <th>Quantidade</th>
                          <th>Especie</th>
                          <th>Marca</th>
                          <th>C/Fabricante</th>
                          <th>N/S</th>
                          <th>D/Fabricação</th>
                        </tr>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>
              <div class="form-group col-md-6 px-4">
                  <button type="button" class="btn btn-primary" id="salvarAcond">Salvar</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Item modal -->
    <div class="modal fade" id="modalAddItem" tabindex="-1" role="dialog" aria-labelledby="modalAddItem" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="card-body ">
            <!-- <h5 class="modal-title" id="exampleModalLabel">Adicionar Items </h5> -->
            <form id="formAddItem">
              <div class="form-row">
                <div class="form-group col-md-6">
                  <div class="col-lg-5 col-md-6 col-sm-3">
                    <select data-style="btn btn-primary btn-round" title="Single Select" name="unidad">
                      <option value="" disabled selected>Unidad</option>
                      <!-- <option value="2">Exempleo 1</option>
                      <option value="3">Exempleo 2</option>
                      <option value="4">Exempleo 3</option>
                      <option value="5">Exempleo 4</option>
                      <option value="6">Exempleo 5</option> -->
                    </select>
                  </div>
                </div>
                <div class="form-group col-md-6">
                  <div class="col-lg-5 col-md-6 col-sm-3">
                    <select class="selectpicker" data-style="btn btn-primary btn-round" title="Single Select" name="usuario">
                      <option value="" disabled selected>Usuario</option>
                      <option value="2">Hugo Ramirez</option>
                      <option value="3">User 1</option>
                      <option value="4">User 2</option>
                      <option value="5">User 3</option>
                      <option value="6">User 4</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="inputEan" name="ean" placeholder="EAN">
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="inputDescicao" name="descricao" placeholder="Descrição">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="inputPeso" name="peso" placeholder="Peso">
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="inputLargura" name="largura" placeholder="Largura">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="inputProfundidade" name="profundidade" placeholder="Profundidade">
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="inputComprimento" name="comprimento" placeholder="Comprimento">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="inputQuantidade" name="quantidade" placeholder="Quantidade">
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="inputEspecie" name="especie" placeholder="Especie">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="inputMarca" name="marca" placeholder="Marca">
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="inputCodigoFabricante" name="codigoFabricante" placeholder="Codigo de Fabricante">
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <input type="text" class="form-control" id="inputNumeroSeria" name="numeroSeria" placeholder="Numero de Serie">
                </div>
                <div class="form-group col-md-6">
                  <input type="text" class="form-control datetimepicker" name="dataFabricacao" placeholder="Data de Fabricação" />
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <button type="button" class="btn btn-primary" id="submitAddItem">Salvar</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  @endsection

  @push('js')
    <script>
      $(document).ready(function () {
        $('#nfiscalTbl').DataTable({
          // ajax: {
          //   url: '/api/nota_fiscal',
          //   dataSrc: 'data'
          // },
          columns: [
            { "data": "descricao" },
            { "data": "ativo" , render: function (data, type) {
                return data ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'
              }
            },
          ],
          columnDefs : [
            { 
              targets : [5],
              render : function (data, type, row) {
                return `
                  <i class="fa fa-trash excluirNfiscal" data-id="${row.id}" title="Excluir" ></i>
                  &nbsp;
                  <i class="fa fa-pen editarNfiscal" data-id="${row.id}" data-toggle="modal" data-target="#modalExemplo" title="Editar"></i>
                `
              }
            }
          ],
        });
        //Salvar 
        $('body').on('click', '#salvarNfiscal', function(){
          const JSONRequest = {
            descricao: $("#inputDescricao").val(),
            ativo: $("#checkAtivo").prop("checked") ? 1 : 0,
          }
          console.log(JSONRequest)
          const id = $('#inputId').val();
          const method = id ? "PUT" : "POST";
          const urlP= id ? `/api/nota_fiscal/${id}` : "/api/nota_fiscal";
          $.ajax({
            type: method,
            url: urlP,
            data: JSONRequest,
            dataType: "json",
            encode: true,
          }).done(function (response) {
            console.log(response);
            if (response && response.data) {
              $("#modalExemplo").modal("hide");
              $('#nfiscalTbl').DataTable().ajax.reload();
              $("#inputDescricao").val(""),
              $("#checkAtivo").prop("checked", false)
            }
          });
        });
        //Editar
        $('body').on('click', '.editarNfiscal',  function(){
          const acond_id = $(this).attr('data-id');
          $.ajax({
            type: "GET",
            url: `/api/nota_fiscal/${acond_id}`,
          }).done(function (response) {
            console.log(response);
            if (response && response.data) {
              console.log(response.data)
              $("#modalExemplo").modal("show");
              $('#inputId').val(response.data.id);
              $("#inputDescricao").val(response.data.descricao);
              $("#checkAtivo").prop("checked", response.data.ativo)
            }
          });
         });
        //Excluir
        $('body').on('click', '.excluirNfiscal',  function(){
          const acond_id = $(this).attr('data-id');
          if (confirm('Aviso!,Deseja realmente excluir o device?')) {
            $.ajax({
              type: "DELETE",
              url:  `/api/nota_fiscal/${acond_id}`,
            }).done(function (response) {
              console.log(response);
              $('#nfiscalTbl').DataTable().ajax.reload();
            });
          }
        });
        $('.datetimepicker').datetimepicker({
          // defaultDate: true,
          format: "DD/MM/YYYY",
          icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
          }
        });

        var itemsDataTable = $('#itemTbl').DataTable()
        $('body').on('click', '#submitAddItem', function() {
          itemsDataTable.row.add([
            $('#formAddItem select[name="unidad"]').val(),
            $('#formAddItem select[name="usuario"]').val(),
            $('#formAddItem input[name="ean"]').val(),
            $('#formAddItem input[name="descricao"]').val(),
            $('#formAddItem input[name="peso"]').val(),
            $('#formAddItem input[name="largura"]').val(),
            $('#formAddItem input[name="profundidade"]').val(),
            $('#formAddItem input[name="comprimento"]').val(),
            $('#formAddItem input[name="quantidade"]').val(),
            $('#formAddItem input[name="especie"]').val(),
            $('#formAddItem input[name="marca"]').val(),
            $('#formAddItem input[name="codigoFabricante"]').val(),
            $('#formAddItem input[name="numeroSeria"]').val(),
            $('#formAddItem input[name="dataFabricacao"]').val()
          ]).draw(false);
          $('#formAddItem')[0].reset()
          $('#modalAddItem').modal('hide')
          $('#formAddItem select[name="unidad"]').val('')
          $('#formAddItem select[name="usuario"]').val('')
        })

        $.ajax({
          type: "GET",
          url: "/api/unidad",
        }).done(function (response) {
          if (response && response.data) {
            loadSelect('#formAddItem select[name="unidad"]', response.data)
          }
        });

        // $.ajax({
        //   type: "GET",
        //   url: "/api/user",
        // }).done(function (response) {
        //   if (response && response.data) {
        //     loadSelect('#formAddItem select[name="usuario"]', response.data)
        //   }
        // });
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