@extends('layouts.app', ['activePage' => 'nota_fiscal', 'titlePage' => __('Ordem de Serviço')])
@section('subheaderTitle')
  Administrativo
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novaNota">
          + Nova Nota Fiscal
        </button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">OS E Rastreamento</h4>
              <p class="card-category">Notas Fiscais</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="nfiscalTbl">
                  <thead>
                    <tr>
                      <th class="text-primary font-weight-bold">Empresa</th>
                      <th class="text-primary font-weight-bold">Número</th>
                      <th class="text-primary font-weight-bold">Série</th>
                      <th class="text-primary font-weight-bold">Folha</th>
                      <th class="text-primary font-weight-bold">Numero Total</th>
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
      let produtoAcabadoTbl, materiaisTbl
      let app = new App({
        apiUrl: '/api/nota_fiscais',
        apiDataTableColumns: [
          { data: "pessoa_juridica" },
          { data: "numero_total" },
          { data: "serie" },
          { data: "folha" },
          { data: "numero_total" },
        ],
        datatableSelector: '#nfiscalTbl',
      }) 

      // Open Modal New
      $('body').on('click', '#novaNota', function() {
        delFormValidationErrors()
        $("#modalNota").modal("show")
        $('#tituloNota').text("Nota Fiscal")
        $('#input_id').val("")
        $('#formNota')[0].reset()
        getPessoaJuridica()
        produtoAcabadoTbl && produtoAcabadoTbl.clear().draw()
        materiaisTbl && materiaisTbl.clear().draw()
      })

      //Salvar 
      $('body').on('click', '#salvarNotafiscal', function() {
        usuarioResponsavelCadastro = $("#input_usuario_responsavel_cadastro_id").val()
        var produtoAcabadoData = produtoAcabadoTbl?.rows()?.data()?.toArray()?.map(curr => ({
          id: parseInt(curr.id),
          producto_id: parseInt(curr.productoId),
          quantidade: parseInt(curr.quantidade),
          numero_de_serie: curr.numeroSerie,
          data_de_fabricacao: curr.dataFabricacao,
          usuario_responsavel_cadastro_id: usuarioResponsavelCadastro,
        }))
        var produtoSegregadoData = materiaisTbl?.rows()?.data()?.toArray()?.map(curr => ({
          parentId: parseInt(curr.parentId),
          id: parseInt(curr.id),
          material_id: parseInt(curr.materialId),
          peso_bruto: formatStringToFloat(curr.pesoBruto),
          peso_liquido: formatStringToFloat(curr.pesoLiquido),
          percentual_composicao: formatStringToFloat(curr.percentualComposicao),
          usuario_responsavel_cadastro_id: usuarioResponsavelCadastro,
        }))
        if (!produtoAcabadoData?.length && !produtoSegregadoData?.length) {
          return notifyDanger('Falta adicionar Produtos Acabados/Segregados')
        }
        const JSONRequest = {
          numero_total: $("#input_numero_total").val(),
          serie: $("#input_serie").val(),
          folha: $("#input_folha").val(),
          chave_de_acesso: $("#input_chave_de_acesso").val(),
          pessoa_juridica_id: $("#input_pessoa_juridica_id").val(),
        }
        if (produtoAcabadoData?.length) {
          JSONRequest.produtos_acabados = produtoAcabadoData
        }
        if (produtoSegregadoData?.length) {
          JSONRequest.produtos_segregados = produtoSegregadoData
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
          console.log('JSONRequest', JSONRequest)
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
      })

      // Editar
      $('body').on('click', '.editAction', function() {
        produtoAcabadoTbl && produtoAcabadoTbl.clear().draw()
        materiaisTbl && materiaisTbl.clear().draw()
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
            initProdutAcabadoDataTable()
            getProdutosAcabados().then(() => {
              loadSavedProducts(response.data.itens.filter(curr => curr.numero_de_serie))
            })
            initMaterialDataTable()
            getMateriais().then(() => {
              loadSavedMaterials(response.data.itens.filter(curr => !curr.numero_de_serie))
            })
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

      function getPessoaJuridica(value) {
        app.api.get('/pessoa_juridica').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_pessoa_juridica_id', response.data, ['id', 'razao_social'], value)
          }
        })
        .catch(error => notifyDanger('Falha ao obter dados, tente novamente'))
      }

      // Produto acabado
      function loadSavedProducts(data) {
        data.map(curr => {
          $('#produtosAcabados').val(curr.produto.id)
          $('#produtosAcabados').trigger('change')
          $('#produtoAcabadoId').val(curr.id)
          $('#produtoAcabadoQuantidade').val(curr.quantidade)
          $('#produtoAcabadoNumeroSerie').val(curr.numero_de_serie)
          $('#produtoAcabadoDataFabricacao').val(curr.data_de_fabricacao)
          $('#addProduto').trigger('click')
        })
      }

      function getProdutosAcabados() {
        return new Promise(resolve => {
          if (!$('#produtosAcabados').hasClass("select2-hidden-accessible")) {
            app.api.get('/produto').then(response =>  {
              if (response && response.status) {
                const data = response.data.map(curr => ({
                  id: curr.id,
                  text: `[${curr.ean}:${curr.codigo}]${curr.marca} - ${curr.especie} (${curr.altura} A x ${curr.largura} L x ${curr.profundidade} P x ${curr.comprimento} C)`
                }))
                $('#produtosAcabados').select2({
                  dropdownParent: $('#modalProdutoAcabado'),
                  placeholder: 'Pesquisar um produto acabado',
                  allowClear: true,
                  width: 'resolve',
                  data: data
                })
              }
              resolve()
            })
            .catch(error => {
              notifyDanger('Falha ao obter produtos acabados, tente novamente')
              resolve()
            })
          } else {
            resolve()
          }
        })
      }

      function initProdutAcabadoDataTable() {
        if (!$.fn.dataTable.isDataTable('#produtoAcabadoTbl')) {
          produtoAcabadoTbl = $('#produtoAcabadoTbl').DataTable({
            language: app.dataTableConfig.language,
            autoWidth: false,
            pageLength: 5,
            ordering: false,
            info: false,
            lengthChange: false,
            columns: [
              { data: 'position' },
              { data: 'producto' },
              { data: 'quantidade' },
              { data: 'numeroSerie' },
              { data: 'dataFabricacao' },
            ],
            columnDefs: [
              {
                targets: [0,2,3,4],
                className: 'text-center',
              },
              {
                targets: 5,
                className: 'text-center',
                render: function (data, type, row) {
                  return `<i class="fa fa-trash cursor-pointer deleteProductoAcabadoItem" title="Excluir"></i>&nbsp;<i class="fa fa-pen cursor-pointer editProductoAcabadoItem" data-position="${row.position}" title="Editar"></i>`
                }
              }
            ],
          })
        }
      }

      $('body').on('click', '#addProdutoAcabado', function() {
        $("#modalProdutoAcabado").modal("show")
        initProdutAcabadoDataTable()
        getProdutosAcabados()
      })

      $('body').on('click', '#salvarProdutoAcabado', function() {
        $("#modalProdutoAcabado").modal("hide")
      })

      $('#produtosAcabados').on('select2:clear', function(e) {
        $('#addProduto').text('Novo produto')
        $('#produtoAcabadoId').val('')
        $('#produtoAcabadoPosition').val('')
        $('#produtoAcabadoQuantidade').val('')
        $('#produtoAcabadoNumeroSerie').val('')
        $('#produtoAcabadoDataFabricacao').val('')
      })

      $('body').on('click', '#addProduto', function(event) {
        const dataInTable = produtoAcabadoTbl.rows().data().toArray()
        const newPosition = produtoAcabadoTbl.rows(dataInTable.length -1 ).data()[0] ? produtoAcabadoTbl.rows(dataInTable.length -1 ).data()[0].position + 1 : 1
        const newProducto = {
          id: $('#produtoAcabadoId').val(),
          position: parseInt($('#produtoAcabadoPosition').val()) || newPosition,
          producto: $('#produtosAcabados option:selected').text().split(']')[0]+']',
          productoId: $('#produtosAcabados option:selected').val(),
          quantidade: $('#produtoAcabadoQuantidade').val(),
          numeroSerie: $('#produtoAcabadoNumeroSerie').val(),
          dataFabricacao: $('#produtoAcabadoDataFabricacao').val()
        }
        if (!newProducto.producto) {
          return notifyDanger('Você tem que selecionar um produto acabado')
        }
        if (!newProducto.quantidade || !newProducto.numeroSerie || !newProducto.dataFabricacao) {
          return notifyDanger('Você tem que adicionar os campos faltantes')
        }
        if (produtoAcabadoTbl.row(newProducto.position - 1).data()) {
          produtoAcabadoTbl.row(newProducto.position - 1).data(newProducto).draw(false)
          $('#addProduto').text('Novo produto')
        } else {
          produtoAcabadoTbl.row.add(newProducto).draw(false)
        }
        $('#produtoAcabadoId').val('')
        $('#produtoAcabadoPosition').val('')
        $('#produtosAcabados').val(null).trigger('change')
        $('#produtoAcabadoQuantidade').val('')
        $('#produtoAcabadoNumeroSerie').val('')
        $('#produtoAcabadoDataFabricacao').val('')
      })

      $('body').on('click', '.deleteProductoAcabadoItem', function() {
        produtoAcabadoTbl.row($(this).parents('tr')).remove().draw(false)
      })

      $('body').on('click', '.editProductoAcabadoItem', function() {
        $('#addProduto').text('Salvar produto')
        const position = $(this).attr('data-position')
        $('#produtoAcabadoPosition').val(position)
        const oldData = produtoAcabadoTbl.row(position - 1).data()
        $('#produtosAcabados').val(oldData.productoId).trigger('change')
        $('#produtoAcabadoId').val(oldData.id)
        $('#produtoAcabadoQuantidade').val(oldData.quantidade)
        $('#produtoAcabadoNumeroSerie').val(oldData.numeroSerie)
        $('#produtoAcabadoDataFabricacao').val(oldData.dataFabricacao)
      })
      // Produto acabado

      // Produto segregado
      function loadSavedMaterials(data) {
        data.map(curr => {
          $('#segregadosParentId').val(curr.id)
          $('#segregadosId').val(curr.produto.id)
          $('#materiais').val(curr.produto.material_id)
          $('#materiais').trigger('change')
          maskPeso("#segregadosPesoBruto", curr.produto.peso_bruto)
          maskPeso("#segregadosPesoLiquido", curr.produto.peso_liquido)
          maskPeso("#segregadosPercentualComposicao", curr.produto.percentual_composicao)
          $('#addSegregados').trigger('click')
        })
      }

      function getMateriais() {
        return new Promise(resolve => {
          if (!$('#materiais').hasClass("select2-hidden-accessible")) {
            app.api.get('/material').then(response =>  {
              if (response && response.status) {
                const data = response.data.map(curr => ({
                  id: curr.id,
                  text: `[${curr.ibama}] ${curr.tipo_material}: ${curr.estado_fisico} (${curr.unidade})`
                }))
                $('#materiais').select2({
                  dropdownParent: $('#modalSegregados'),
                  placeholder: 'Pesquisar um material',
                  allowClear: true,
                  width: 'resolve',
                  data: data
                })
              }
              resolve()
            })
            .catch(error => {
              notifyDanger('Falha ao obter materiais, tente novamente')
              resolve()
            })
          } else {
            resolve()
          }
        })
      }

      function setSegregadosPesos() {
        maskPeso("#segregadosPesoBruto")
        maskPeso("#segregadosPesoLiquido")
        maskPeso("#segregadosPercentualComposicao")
      }

      function initMaterialDataTable() {
        if (!$.fn.dataTable.isDataTable('#materiaisTbl')) {
          materiaisTbl = $('#materiaisTbl').DataTable({
            language: app.dataTableConfig.language,
            autoWidth: false,
            pageLength: 5,
            ordering: false,
            info: false,
            lengthChange: false,
            columns: [
              { data: 'position' },
              { data: 'material' },
              { data: 'pesoBruto' },
              { data: 'pesoLiquido' },
              { data: 'percentualComposicao' },
            ],
            columnDefs: [
              {
                targets: [0,2,3,4],
                className: 'text-center',
              },
              {
                targets: 5,
                className: 'text-center',
                render: function (data, type, row) {
                  return `<i class="fa fa-trash cursor-pointer deleteItem" title="Excluir"></i>&nbsp;<i class="fa fa-pen cursor-pointer editItem" data-position="${row.position}" title="Editar"></i>`
                }
              }
            ],
          })
        }
      }

      $('body').on('click', '#addProdutoSegregado', function() {
        $("#modalSegregados").modal("show")
        initMaterialDataTable()
        getMateriais()
        setSegregadosPesos()
      })

      $('body').on('click', '#salvarSegregados', function() {
        $("#modalSegregados").modal("hide")
      })

      $('#materiais').on('select2:clear', function(e) {
        $('#addSegregados').text('Novo material')
        $('#segregadosParentId').val('')
        $('#segregadosId').val('')
        $('#segregadosPosition').val('')
        setSegregadosPesos()
      })

      $('body').on('click', '#addSegregados', function(event) {
        const dataInTable = materiaisTbl.rows().data().toArray()
        const newPosition = materiaisTbl.rows(dataInTable.length -1 ).data()[0] ? materiaisTbl.rows(dataInTable.length -1 ).data()[0].position + 1 : 1
        const newMaterial = {
          parentId: $('#segregadosParentId').val(),
          id: $('#segregadosId').val(),
          position: parseInt($('#segregadosPosition').val()) || newPosition,
          material: $('#materiais option:selected').text(),
          materialId: $('#materiais option:selected').val(),
          pesoBruto: $('#segregadosPesoBruto').val(),
          pesoLiquido: $('#segregadosPesoLiquido').val(),
          percentualComposicao: $('#segregadosPercentualComposicao').val()
        }
        if (!newMaterial.material) {
          return notifyDanger('Você tem que selecionar um material')
        }
        if (newMaterial.pesoBruto == '0,00' || newMaterial.pesoLiquido == '0,00' || newMaterial.percentualComposicao == '0,00') {
          return notifyDanger('Você tem que adicionar os pesos')
        }
        if (materiaisTbl.row(newMaterial.position - 1).data()) {
          materiaisTbl.row(newMaterial.position - 1).data(newMaterial).draw(false)
          $('#addSegregados').text('Novo material')
        } else {
          materiaisTbl.row.add(newMaterial).draw(false)
        }
        $('#segregadosParentId').val('')
        $('#segregadosId').val('')
        $('#segregadosPosition').val('')
        setSegregadosPesos()
        $('#materiais').val(null).trigger('change')
      })

      $('body').on('click', '.deleteItem', function() {
        materiaisTbl.row($(this).parents('tr')).remove().draw(false)
      })

      $('body').on('click', '.editItem', function() {
        $('#addSegregados').text('Salvar material')
        const position = $(this).attr('data-position')
        $('#segregadosPosition').val(position)
        const oldData = materiaisTbl.row(position - 1).data()
        $('#materiais').val(oldData.materialId).trigger('change')
        $('#segregadosParentId').val(oldData.parentId)
        $('#segregadosId').val(oldData.id)
        maskPeso("#segregadosPesoBruto", oldData.pesoBruto)
        maskPeso("#segregadosPesoLiquido", oldData.pesoLiquido)
        maskPeso("#segregadosPercentualComposicao", oldData.percentualComposicao)
      })
      // Produto segregado
    })
  </script>
@endpush