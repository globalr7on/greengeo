@extends('layouts.app', ['activePage' => 'nota_fiscal', 'titlePage' => __('Notal Fiscal')])
@section('css')
@endsection
@section('subheaderTitle')
  OS E Rastreamento
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddNew">Nova Nota Fiscal</button>
     
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">OS E Rastreamento</h4>
              <p class="card-category">Notas Fiscais</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="nfiscalTbl">
                  <thead>
                    <tr>
                      <th class="text-primary font-weight-bold">Tipo</th>
                      <th class="text-primary font-weight-bold">CNPJ</th>
                      <th class="text-primary font-weight-bold">Número</th>
                      <th class="text-primary font-weight-bold">Série</th>
                      <th class="text-primary font-weight-bold">Folha</th>
                      <th class="text-primary font-weight-bold text-center">Chave de Acesso</th>
                      <th class="text-primary font-weight-bold">Ação</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td class="text-center">P.J</td>
                      <td>{{$cnpj}}</td>
                      <td>000.001.249</td>
                      <td>{{$serie}}</td>
                      <td> 1/1</td>
                      <td class="text-center">4220 1009 3789 2500 0145 5500 2000 0010 4910 0001 0554</td>
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
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                                <tr>
                                    <th> Nota </th>
                                    <th> Serie </th>
                                    <th> Emição </th>
                                    <th> Saida </th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td> {{$nota}} </td>
                                <td> {{$serie}} </td>
                                <td> {{$emicao}} </td>
                                <td> {{$saida}} </td>
                            </tr>
                            <tr>
                                <td> {{$nota}} </td>
                                <td> {{$serie}} </td>
                                <td> {{$emicao}} </td>
                                <td> {{$saida}} </td>
                            </tr>
                            </tbody>

                    </table>
                {{-- <table class="table" id="output" >
                  <thead>
                    <tr>
                      <th>Unidade</th>
                      <th>Usuario</th>
                      <th>EAN</th>
                      <th>Descrição</th>
                      <th>Peso</th>
                      <th>Largura</th>
                      <th>Profundidade</th>
                      <th>Comprimento</th>
                      <th>Quantidade</th>
                      <th>Espécie</th>
                      <th>Marca</th>
                      <th>C/Fabricante</th>
                      <th>N/S</th>
                      <th>D/Fabricação</th>
                    </tr>
                  </thead>
                </table> --}}
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
        // ajax: {
        //   url: '/api/nota_fiscal',
        //   dataSrc: 'data'
        // },
        columns: [
         
          { data: "numero_total" },
          { data: "serie" },
          { data: "folha" },
          { data: "chave_de_acesso" },

          // { data: "ativo" , render: function (data, type) {
          //   return data ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'
          // } },
        ],
        columnDefs: [
          { width: "70px", targets: [0,1,2,3,4,5] },
          // { width: "200px", targets: [2,3,4,5,6,7,8,9,10,11,12,13,24,25] },
          // { width: "100px", targets: [14,15,16,17,18,20,21,22,23] },
          { 
            targets: 6,
            render: function (data, type, row) {
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
      $('body').on('click', '#salvarNfiscal', function() {
        const JSONRequest = {
          descricao: $("#inputDescricao").val(),
          ativo: $("#checkAtivo").prop("checked") ? 1 : 0,
        }
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
          if (response && response.data) {
            $("#modalExemplo").modal("hide");
            $('#nfiscalTbl').DataTable().ajax.reload();
            $("#inputDescricao").val(""),
            $("#checkAtivo").prop("checked", false)
          }
        });
      });

      //Editar
      $('body').on('click', '.editarNfiscal', function() {
        const acond_id = $(this).attr('data-id');
        $.ajax({
          type: "GET",
          url: `/api/nota_fiscal/${acond_id}`,
        }).done(function (response) {
          if (response && response.data) {
            $("#modalExemplo").modal("show");
            $('#inputId').val(response.data.id);
            $("#inputDescricao").val(response.data.descricao);
            $("#checkAtivo").prop("checked", response.data.ativo)
          }
        });
      });

      //Excluir
      $('body').on('click', '.excluirNfiscal', function() {
        const acond_id = $(this).attr('data-id');
        if (confirm('Aviso!,Deseja realmente excluir? ')) {
          $.ajax({
            type: "DELETE",
            url:  `/api/nota_fiscal/${acond_id}`,
          }).done(function (response) {
            $('#nfiscalTbl').DataTable().ajax.reload();
          });
        }
      });

      $('.datetimepicker').datetimepicker({
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

      //openFile will read XML file and input it into text field
      var openFile = function(event) {
        var input = event.target;
      var text = "";
        var reader = new FileReader();
        var onload = function(event) {
          text = reader.result;
          parseFile(text);

        };

        reader.onload = onload;
        reader.readAsText(input.files[0]);

      };

      //this will parse XML file and output it to website
      var parseFile = function(text) {
        var xmlDoc = $.parseXML(text),
          $xml = $(xmlDoc),
          $options = $xml.find("option");

        $.each($options, function() {
          $("#output").append("<li>" + $(this).text() + "</li >");
        });

      };

      //

    function loadSelect(selector, data) {
      $.each(data, function(index, value) {
        $(selector).append(new Option(value.descricao, value.id));
      });
      $(selector).selectpicker()
    }
  });
  
    
  </script>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

@endpush