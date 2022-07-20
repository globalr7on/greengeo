@extends('layouts.app', ['activePage' => 'nota_fiscal', 'titlePage' => __('Ordem de Serviço')])
@section('css')
@endsection
@section('subheaderTitle')
  Administrativo
@endsection
@section('content')
<div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novaNota">Nova Nota Fiscal</button>
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
                      <th class="text-primary font-weight-bold">Número</th>
                      <th class="text-primary font-weight-bold">Série</th>
                      <th class="text-primary font-weight-bold">Folha</th>
                      <th class="text-primary font-weight-bold">Ação</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  @include('rastreamento.nota.modal')
  @endsection

@push('js')
  <script>
    $(document).ready(function () {
      let app = new App({
        //notas
        apiUrl: '/api/nota_fiscais',
        apiDataTableColumns: [
          { data: "numero_total" },
          { data: "serie" },
          { data: "folha" },
          
        ],
        apiDataTableColumnsDefs : [
          // { targets: 1, orderable: false },
          // { width: "70px", targets: [0,19,26] },
          // { width: "200px", targets: [2,3,4,5,6,7,8,9,10,11,12,13,24,25] },
          // { width: "100px", targets: [14,15,16,17,18,20,21,22,23] },
          { 
            targets : 3,
            className: "text-center",
            render : function (data, type, row) {
              return `
                <i class="fa fa-trash cursor-pointer excluirEmpresa" data-id="${row.id}" title="Excluir" ></i>
                &nbsp;
                <i class="fa fa-pen cursor-pointer editarEmpresa" data-id="${row.id}"  title="Editar"></i>
              `
            }
          }
        ],
        datatableSelector: '#nfiscalTbl',

      }) 

       // Open Modal New
      $('body').on('click', '#novaNota', function() {
        // app.stepper()
        delFormValidationErrors()
        $("#modalNota").modal("show")
        $('#tituloModal').text("Nova Nota")
        $('#input_id').val("")
        $('#formNota')[0].reset()
        getPessoaJuridica()
        getUnidade()
        // getVeiculo()
        // getMotorista()
        // getEstagio()
      });

      //Salvar 
      $('body').on('click', '#salvarNfiscal', function() {
        const JSONRequest = {
          numero_total:$("#input_numero_total").val(),
          serie:$("#input_serie").val(),
          folha:$("#input_folha").val(),
          chave_de_acesso:$("#input_chave_de_acesso").val(),
          pessoa_juridica_id:$("#input_pessoa_juridica_id").val(),
        }       
        const id = $('#input_id').val();
        if (id) {
            app.api.put(`/nota_fiscais/${id}`, JSONRequest).then(response => {
              if (response && response.status) {
                $("#modalNota").modal("hide")
                app.datatable.ajax.reload()
                notifySuccess('Atualizada com sucesso')
              }
            })
            .catch(error => {
              addFormValidationErrors(error?.data)
              notifyDanger('Falha ao atualizar, tente novamente')
            })
          } else {
            app.api.post('/nota_fiscais', JSONRequest).then(response => {
              if (response && response.status) {
                $("#modalNota").modal("hide")
                app.datatable.ajax.reload()
                notifySuccess('Criado com sucesso')
              }
            })
            .catch(error => {
              addFormValidationErrors(error?.data)
              notifyDanger('Falha ao criar, tente novamente')
            })
          }
        });

        // Editar
        $('body').on('click', '.editAction', function() {
          const id = $(this).attr('data-id');
          app.api.get(`/nota_fiscais/${id}`).then(response =>  {
            if (response && response.status) {
              getPessoaJuridica(response.data.pessoa_juridica_id)
              delFormValidationErrors()
              $('#formNota')[0].reset()
              $("#modalNota").modal("show");
              $('#tituloModal').text("Editar Nota")
              $("#input_numero_total").val(response.data.numero_total),
              $("#input_serie").val(response.data.serie),
              $("#input_folha").val(response.data.folha),
              $("#input_chave_de_acesso").val(response.data.chave_de_acesso),
              $('#input_id').val(response.data.id);
              
            
            }
          })
          .catch(error => notifyDanger('Falha ao obter detalhes. Tente novamente'))
        })

         // Excluir
      $('body').on('click', '.deleteAction',  function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/nota_fiscais/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('excluído com sucesso')
            })
            .catch(error => notifyDanger('Falha ao excluir. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
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

      var dataTableConfig = {
        columns: [
          { data: "ean" },
          { data: "descricao" },
          { data: "peso" },
          { data: "largura" },
          { data: "codigoFabricante" },
          { data: "numeroSeria" },
          { data: "dataFabricacao" },

        ],
        language: {
          "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        },

        ordering: false ,
      }
      var itemsDataTable = $('#itemTbl').DataTable(dataTableConfig)
      
      $('body').on('click', '#submitAddItem', function() {
        itemsDataTable.row.add(
          {
          'unidad':$('#formAddItem select[name="unidad"]').val(),
          'ean':$('#formAddItem input[name="ean"]').val(),
          'descricao':$('#formAddItem input[name="descricao"]').val(),
          'peso':$('#formAddItem input[name="peso"]').val(),
          'largura':$('#formAddItem input[name="largura"]').val(),
          'profundidade':$('#formAddItem input[name="profundidade"]').val(),
          'comprimento':$('#formAddItem input[name="comprimento"]').val(),
          'quantidade':$('#formAddItem input[name="quantidade"]').val(),
          'especie':$('#formAddItem input[name="especie"]').val(),
          'marca':$('#formAddItem input[name="marca"]').val(),
          'codigoFabricante':$('#formAddItem input[name="codigoFabricante"]').val(),
          'numeroSeria':$('#formAddItem input[name="numeroSeria"]').val(),
          'dataFabricacao':$('#formAddItem input[name="dataFabricacao"]').val(),
          }
        ).draw(false);
        $('#formAddItem')[0].reset()
        $('#modalAddItem').modal('hide')
        $('#formAddItem select[name="unidad"]').val('')
        $('#formAddItem select[name="usuario"]').val('')
      })

      function getUnidade(value) {
        app.api.get('/unidad').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_unidade_id', response.data, ['id', 'descricao'], value)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter marca, tente novamente')
        })
      }

      $.ajax({
        type: "GET",
        url: "/api/unidad",
      }).done(function (response) {
        if (response && response.data) {
          loadSelect('#formAddItem select[name="unidad"]', response.data)
        }
      });

    //   //openFile will read XML file and input it into text field
    //   var openFile = function(event) {
    //     var input = event.target;
    //   var text = "";
    //     var reader = new FileReader();
    //     var onload = function(event) {
    //       text = reader.result;
    //       parseFile(text);

    //     };

    //     reader.onload = onload;
    //     reader.readAsText(input.files[0]);

    //   };

    //   //this will parse XML file and output it to website
    //   var parseFile = function(text) {
    //     var xmlDoc = $.parseXML(text),
    //       $xml = $(xmlDoc),
    //       $options = $xml.find("option");

    //     $.each($options, function() {
    //       $("#output").append("<li>" + $(this).text() + "</li >");
    //     });

    //   };

    //   //

    // function loadSelect(selector, data) {
    //   $.each(data, function(index, value) {
    //     $(selector).append(new Option(value.descricao, value.id));
    //   });
    //   $(selector).selectpicker()
    // }

    function getPessoaJuridica(value) {
        app.api.get('/pessoa_juridica').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_pessoa_juridica_id', response.data, ['id', 'razao_social'], value)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter dados, tente novamente')
        })
      }
  });
  </script>

  @endpush