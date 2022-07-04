@extends('layouts.app', ['activePage' => 'material', 'titlePage' => __('Materiais')])
@section('css')
@endsection
@section('subheaderTitle')
  Cadastros
@endsection
@section('content')
   <div class="content mt-0">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoMaterial">
         + Novo Material
        </button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Cadastros</h4>
              <p class="card-category">Material</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="materialTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Ean</th>
                    <th class="text-primary font-weight-bold">Ibama</th>
                    <th class="text-primary font-weight-bold">Denominação Ibama</th>
                    <th class="text-primary font-weight-bold">Peso bruto</th>
                    <th class="text-primary font-weight-bold">Peso Liquido</th>
                    <th class="text-primary font-weight-bold">Estado Físico</th>
                    <th class="text-primary font-weight-bold">Composição Percentual</th>
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
   @include('cadastros.material.modal')
  
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      
      let app = new App({
        apiUrl: '/api/material',
        apiDataTableColumns: [
          { data: "ean" },
          { data: "ibama" },
          { data: "denominacao_ibama" },
          { data: "peso_bruto" },
          { data: "peso_liquido" },
          { data: "estado_fisico" },
          { data: "percentual_composicao" },
          { 
            data: "ativo", className: "text-center", render: function (data, type) {
              return data ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'
            }
          }
        ],
        apiDataTableColumnsDefs : [
          { targets: 1, orderable: false },
        
          { 
            targets : 8,
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
        datatableSelector: '#materialTbl'
      })
     
      // Open Modal New
      $('body').on('click', '#novoMaterial', function() {
       
        app.stepper()
        delFormValidationErrors()
        $("#modalMaterial").modal("show")
        $('#tituloModal').text("Novo Material")
        $('#input_id').val("")
        $('#formMaterial')[0].reset()
        //  getEmpresa()
        // getAtividade()
      });

      // Salvar ''
      $('body').on('click', '#salvarMaterial', function() {
        const JSONRequest = {
          ean: $("#input_ean").val(),
          ibama: $("#input_ibama").val(),
          denominacao_ibama: $("#input_denominacao_ibama").val(),
          peso_bruto: $("#input_peso_bruto").val(),
          peso_liquido: $("#input_peso_liquido").val(),
          estado_fisico: $("#input_estado_fisico").val(),
          percenteual_composicao: $("#input_percenteual_composicao").val(),
          dimensoes: $("#input_dimensoes").val(),
          largura: $("#input_largura").val(),
          profundidade: $("#input_profundidade").val(),
          comprimento: $("#input_comprimento").val(),
          nome_no_fabricante: $("#input_nome_no_fabricante").val(),
          especie: $("#input_especie").val(),
          marca: $("#input_marca").val(),
          gerador_id: $("#input_gerador_id").val(),
          tipo_material_id: $("#input_tipo_material_id").val(),
          clase_material_id: $("#input_clase_material_id").val(),
          unidade_id: $("#input_unidade_id").val(),
          nota_fiscal_iten_id: $("#input_nota_fiscal_iten_id").val(),
          ativo: $("#checkAtivo").prop("checked") ? 1 : 0
        }
        const id = $('#input_id').val()
        if (id) {
          app.api.put(`/material/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalMaterial").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Atualizado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar, tente novamente')
          })
        } else {
          app.api.post('/material', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalMaterial").modal("hide")
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
        app.stepper()
        const id = $(this).attr('data-id');
        app.api.get(`/material/${id}`).then(response =>  {
          if (response && response.status) {
            // getEmpresa(response.data.gerador_id)
            // getAtividade(response.data.atividade_id)
            delFormValidationErrors()
            $('#formProduto')[0].reset()
            $("#modalProduto").modal("show");
            $('#tituloModal').text("Editar Produto")
            $("#input_ean").val(response.data.ean),
            $("#input_ibama").val(response.data.ibama),
            $("#input_denominacao_ibama").val(response.data.denominacao_ibama),
            $("#input_peso_bruto").val(response.data.peso_bruto),
            $("#input_peso_liquido").val(response.data.peso_liquido),
            $("#input_estado_fisico").val(response.data.estado_fisico),
            $("#input_percentual_composicao").val(response.data.percenteual_composicao),
            $("#input_dimensoes").val(response.data.dimensoes),
            $("#input_largura").val(response.data.largura),
            $("#input_profundidade").val(response.data.profundidade),
            $("#input_comprimento").val(response.data.comprimento),
            $("#input_nome_no_fabricante").val(response.data.nome_no_fabricante),
            $("#input_especie").val(response.data.especie),
            $("#input_marca").val(response.data.marca),
            $("#input_gerador_id").val(response.data.gerador_id),
            $("#input_tipo_material_id").val(response.data.tipo_material_id),
            $("#input_classe_material_id").val(response.data.clase_material_id),
            $("#input_unidade_id").val(response.data.unidade_id),
            $("#input_nota_fiscal_iten_id").val(response.data.nota_fiscal_iten_id),
            $("#checkAtivo").prop("checked", response.data.ativo)
          }
        })
        .catch(error => console.log(error) && notifyDanger('Falha ao obter detalhes do empresa. Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction',  function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir a clase?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/material/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('Excluída com sucesso')
            })
            .catch(error => notifyDanger('Falha ao excluir. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      });

      // function getEmpresa(value) {
      //   app.api.get('/pessoa_juridica').then(response =>  {
      //     if (response && response.status) {
      //       loadSelect('#input_gerador_id', response.data, ['id', 'descricao'], value)
      //     }
      //   })
      //   .catch(error => {
      //     console.log('app.api.get error', error)
      //     notifyDanger('Falha ao obter funções, tente novamente')
      //   })
      // }

      // function getAtividade(value) {
      //   app.api.get('/atividade').then(response =>  {
      //     if (response && response.status) {
      //       loadSelect('#input_atividade_id', response.data, ['id', 'descricao'], value)
      //     }
      //   })
      //   .catch(error => {
      //     console.log('app.api.get error', error)
      //     notifyDanger('Falha ao obter funções, tente novamente')
      //   })
      // }
   
     });
  </script>
@endpush