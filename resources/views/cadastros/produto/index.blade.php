@extends('layouts.app', ['activePage' => 'produto', 'titlePage' => __('Produto Acabado')])
@section('css')
@endsection
@section('subheaderTitle')
  Cadastros
@endsection
@section('content')
   <div class="content mt-0">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoProduto">
         + Novo Produto
        </button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Cadastros</h4>
              <p class="card-category">Produto</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="produtoTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Fabricante</th>
                    <th class="text-primary font-weight-bold">Peso bruto</th>
                    <th class="text-primary font-weight-bold">Peso liquido</th>
                    <th class="text-primary font-weight-bold">Dimensões</th>
                    <th class="text-primary font-weight-bold">Altura</th>
                    <th class="text-primary font-weight-bold">Largura</th>
                    <th class="text-primary font-weight-bold">Profundidade</th>
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
   @include('cadastros.produto.modal')
  
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      
      let app = new App({
        apiUrl: '/api/produto',
        apiDataTableColumns: [
          { data: "nome_fabricante" },
          { data: "peso_bruto" },
          { data: "peso_liquido" },
          { data: "dimensoes" },
          { data: "altura" },
          { data: "largura" },
          { data: "profundidade" },
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
        datatableSelector: '#produtoTbl'
      })
     
      // Open Modal New
      $('body').on('click', '#novoProduto', function() {
       
        app.stepper()
        delFormValidationErrors()
        $("#modalProduto").modal("show")
        $('#tituloModal').text("Novo Produto")
        $('#input_id').val("")
        $('#formProduto')[0].reset()
        // getTipoEmpresa()
        // getAtividade()
      });

      // Salvar ''
      $('body').on('click', '#salvarProduto', function() {
        const JSONRequest = {
          nome_fabricante: $("#input_nome_fabricante").val(),
          peso_bruto: $("#input_peso_bruto").val(),
          peso_liquido: $("#input_peso_liquido").val(),
          dimensoes: $("#input_dimensoes").val(),
          altura: $("#input_altura").val(),
          largura: $("#input_largura").val(),
          profundidade: $("#input_profundidade").val(),
          comprimento: $("#input_comprimento").val(),
          especie: $("#input_especie").val(),
          marca: $("#input_marca").val(),
          pessoa_juridica_id: $("#input_pessoa_juridica_id").val(),
          material_id: $("#input_material_id").val(),
          ativo: $("#checkAtivo").prop("checked") ? 1 : 0
        }
        const id = $('#input_id').val()
        if (id) {
          app.api.put(`/produto/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalProduto").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Atualizado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar, tente novamente')
          })
        } else {
          app.api.post('/produto', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalProduto").modal("hide")
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
        app.api.get(`/produto/${id}`).then(response =>  {
          if (response && response.status) {
            // getTipoEmpresa(response.data.tipo_empresa_id)
            // getAtividade(response.data.atividade_id)
            delFormValidationErrors()
            $('#formProduto')[0].reset()
            $("#modalProduto").modal("show");
            $('#tituloModal').text("Editar Produto")
            $("#input_nome_fabricante").val(response.data.nome_fabricante),
            $("#input_peso_bruto").val(response.data.peso_bruto),
            $("#input_peso_liquido").val(response.data.peso_liquido),
            $("#input_dimensoes").val(response.data.dimensoes),
            $("#input_altura").val(response.data.altura),
            $("#input_largura").val(response.data.altura),
            $("#input_profundidade").val(response.data.profundidade),
            $("#input_comprimento").val(response.data.comprimento),
            $("#input_especie").val(response.data.especie),
            $("#input_marca").val(response.data.marca),
            $("#input_pessoa_juridica_id").val(response.data.pessoa_juridica_id),
            $("#input_material_id").val(response.data.material_id),
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
            app.api.delete(`/produto/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('empresa excluída com sucesso')
            })
            .catch(error => notifyDanger('Falha ao excluir empresa. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      });

      // function getTipoEmpresa(value) {
      //   app.api.get('/tipo_empresa').then(response =>  {
      //     if (response && response.status) {
      //       loadSelect('#input_tipo_empresa_id', response.data, ['id', 'descricao'], value)
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