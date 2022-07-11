@extends('layouts.app', ['activePage' => 'produto', 'titlePage' => __('Produto Acabado')])
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
                    <th class="text-primary font-weight-bold">Código Fabricante</th>
                    <th class="text-primary font-weight-bold">Nome Fabricante</th>
                    <th class="text-primary font-weight-bold">EAN</th>
                    <th class="text-primary font-weight-bold">Dimensões</th>
                    <th class="text-primary font-weight-bold">Largura</th>
                    <th class="text-primary font-weight-bold">Profundidade</th>
                    <th class="text-primary font-weight-bold">Comprimento</th>
                    <th class="text-primary font-weight-bold">Especie</th>
                    <th class="text-primary font-weight-bold">Marca</th>
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
      const empresaId = "{{ Auth::user()->pessoa_juridica_id }}" || null
      let app = new App({
        apiUrl: '/api/produto',
        apiDataTableColumns: [
          { data: "codigo" },  
          { data: "pessoa_juridica" },
          { data: "ean" },
          { data: "dimensoes" },
          { data: "largura" },
          { data: "profundidade" },
          { data: "comprimento" },
          { data: "especie" },
          { data: "marca" },
          {
            data: "ativo",
            className: "text-center",
            orderable: false,
            render: function (data, type, row) {
              return `<i class="fas fa-${data ? 'check' : 'times'} cursor-pointer changeStatus" data-id="${row.id}" data-value-old="${data}" title="Deseja atualizar o status?"></i>`
            }
          }
        ],
        apiDataTableColumnsDefs : [
          { targets: 1, orderable: false },
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
        getEmpresa(empresaId, empresaId ?  true : false)
        maskPeso("#input_altura")
        maskPeso("#input_largura")
        maskPeso("#input_profundidade")
        maskPeso("#input_comprimento")
      })

      // Salvar
      $('body').on('click', '#salvarProduto', function() {
        const JSONRequest = {
          pessoa_juridica_id: $("#input_pessoa_juridica_id").val(),
          ean: $("#input_ean").val(),
          codigo: $("#input_codigo").val(),
          dimensoes: $("#input_dimensoes").val(),
          altura: formatStringToFloat($("#input_altura").val()),
          largura: formatStringToFloat($("#input_largura").val()),
          profundidade: formatStringToFloat($("#input_profundidade").val()),
          comprimento: formatStringToFloat($("#input_comprimento").val()),
          especie: $("#input_especie").val(),
          marca: $("#input_marca").val(),
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
      })

      // Editar
      $('body').on('click', '.editAction', function() {
        app.stepper()
        const id = $(this).attr('data-id');
        app.api.get(`/produto/${id}`).then(response =>  {
          if (response && response.status) {
            delFormValidationErrors()
            $('#formProduto')[0].reset()
            $("#modalProduto").modal("show");
            $('#tituloModal').text("Editar Produto")
            $("#input_id").val(response.data.id)
            $("#input_ean").val(response.data.ean)
            $("#input_codigo").val(response.data.codigo)
            $("#input_dimensoes").val(response.data.dimensoes)
            $("#input_especie").val(response.data.especie)
            $("#input_marca").val(response.data.marca)
            getEmpresa(response.data.pessoa_juridica_id, true)
            maskPeso("#input_altura", formatFloatToString(response.data.altura))
            maskPeso("#input_largura", formatFloatToString(response.data.largura))
            maskPeso("#input_profundidade", formatFloatToString(response.data.profundidade))
            maskPeso("#input_comprimento", formatFloatToString(response.data.comprimento))
          }
        })
        .catch(error => console.log(error) && notifyDanger('Falha ao obter detalhes do empresa. Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction', function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/produto/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('empresa excluída com sucesso')
            })
            .catch(error => notifyDanger('Falha ao excluir. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      })

      function getEmpresa(value, disabled) {
        app.api.get('/pessoa_juridica').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_pessoa_juridica_id', response.data, ['id', 'razao_social'], value, disabled)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter funções, tente novamente')
        })
      }

      // Changes Status 
      $('body').on('click', '.changeStatus', function() {
        sweetConfirm('Deseja realmente atualizar?').then(confirmed => {
          if (confirmed) {
            const id = $(this).attr('data-id')
            const valueOld = $(this).attr('data-value-old')
            app.api.put(`/material/${id}/status`, { ativo: parseInt(valueOld) ? 0 : 1 }).then(response =>  {
              if (response && response.status) {
                app.datatable.ajax.reload()
                notifySuccess('Atualizada com sucesso')
              } else {
                notifySuccess('Não foi possível atualizar, tente novamente')
              }
            })
            .catch(error => notifyDanger('Falha ao atualizar. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      })
    })
  </script>
@endpush