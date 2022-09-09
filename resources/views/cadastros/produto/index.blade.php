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
                    <th class="text-primary font-weight-bold" style="width:10%">Fabricante</th>
                    <th class="text-primary font-weight-bold" style="width:auto">Nome Fabricante</th>
                    <th class="text-primary font-weight-bold" style="width:8%">EAN</th>
                    <th class="text-primary font-weight-bold" style="width:8%">Largura</th>
                    <th class="text-primary font-weight-bold" style="width:10%">Profundidade</th>
                    <th class="text-primary font-weight-bold" style="width:10%">Comprimento</th>
                    <th class="text-primary font-weight-bold" style="width:8%">Especie</th>
                    <th class="text-primary font-weight-bold" style="width:8%">Marca</th>
                    <th class="text-primary font-weight-bold" style="width:5%">Ativo</th>
                    <th class="text-primary font-weight-bold" style="width:5%">Ação</th>
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
      let materiaisTbl
      let app = new App({
        apiUrl: '/api/produto',
        apiDataTableColumns: [
          { data: "codigo" },
          { data: "pessoa_juridica" },
          { data: "ean" },
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
        apiDataTableColumnsDefs: [
          { targets: 1, orderable: false },
        ],
        datatableSelector: '#produtoTbl'
      })
     
      // Open Modal New
      $('body').on('click', '#novoProduto', function() {
        app.stepper()
        delFormValidationErrors()
        $("#modalProduto").modal("show")
        $('#tituloProduto').text("Novo Produto")
        $('#input_id').val("")
        $('#formProduto')[0].reset()
        getEmpresa(empresaId, empresaId ?  true : false)
        maskPeso("#input_altura")
        maskPeso("#input_largura")
        maskPeso("#input_profundidade")
        maskPeso("#input_comprimento")
        materiaisTbl && materiaisTbl.clear().draw()
      })

      // Salvar
      $('body').on('click', '#salvarProduto', function() {
        var materiaisData = materiaisTbl?.rows()?.data()?.toArray()?.map(curr => ({
          material_id: parseInt(curr.materialId),
          peso_bruto: formatStringToFloat(curr.pesoBruto),
          peso_liquido: formatStringToFloat(curr.pesoLiquido),
          percentual_composicao: formatStringToFloat(curr.percentualComposicao),
        }))
        if (!materiaisData?.length) {
          return notifyDanger('Falta adicionar materiais')
        }
        const JSONRequest = {
          pessoa_juridica_id: $("#input_pessoa_juridica_id").val(),
          ean: $("#input_ean").val(),
          codigo: $("#input_codigo").val(),
          altura: formatStringToFloat($("#input_altura").val()),
          largura: formatStringToFloat($("#input_largura").val()),
          profundidade: formatStringToFloat($("#input_profundidade").val()),
          comprimento: formatStringToFloat($("#input_comprimento").val()),
          especie: $("#input_especie").val(),
          marca: $("#input_marca").val(),
          descricao: $("#input_descricao").val(),
          materiais: materiaisData
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
        materiaisTbl && materiaisTbl.clear().draw()
        const id = $(this).attr('data-id');
        app.api.get(`/produto/${id}`).then(response =>  {
          if (response && response.status) {
            delFormValidationErrors()
            $('#formProduto')[0].reset()
            $("#modalProduto").modal("show");
            $('#tituloProduto').text("Editar Produto")
            $("#input_id").val(response.data.id)
            $("#input_ean").val(response.data.ean)
            $("#input_codigo").val(response.data.codigo)
            $("#input_especie").val(response.data.especie)
            $("#input_marca").val(response.data.marca)
            $("#input_descricao").val(response.data.descricao)
            getEmpresa(response.data.pessoa_juridica_id, true)
            maskPeso("#input_altura", formatFloatToString(response.data.altura))
            maskPeso("#input_largura", formatFloatToString(response.data.largura))
            maskPeso("#input_profundidade", formatFloatToString(response.data.profundidade))
            maskPeso("#input_comprimento", formatFloatToString(response.data.comprimento))
            initMaterialDataTable()
            getMateriais().then(() => {
              loadSavedMaterials(response.data.materiais)
            })
          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes do empresa. Tente novamente'))
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
        .catch(error => notifyDanger('Falha ao obter funções, tente novamente'))
      }

      // Changes Status 
      $('body').on('click', '.changeStatus', function() {
        sweetConfirm('Deseja realmente atualizar?').then(confirmed => {
          if (confirmed) {
            const id = $(this).attr('data-id')
            const valueOld = $(this).attr('data-value-old')
            app.api.put(`/produto/${id}/status`, { ativo: parseInt(valueOld) ? 0 : 1 }).then(response =>  {
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

      function loadSavedMaterials(data) {
        data.map(curr => {
          $('#materiais').val(curr.material_id)
          $('#materiais').trigger('change')
          maskPeso("#input_peso_bruto", curr.peso_bruto)
          maskPeso("#input_peso_liquido", curr.peso_liquido)
          maskPeso("#input_percentual_composicao", curr.percentual_composicao)
          $('#addMaterial').trigger('click')
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
                  dropdownParent: $('#modalProdutoMaterials'),
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

      function setMaterialPesos() {
        maskPeso("#input_peso_bruto")
        maskPeso("#input_peso_liquido")
        maskPeso("#input_percentual_composicao")
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

      // Open Materials Modal
      $('body').on('click', '#addMaterials', function() {
        $("#modalProdutoMaterials").modal("show")
        initMaterialDataTable()
        getMateriais()
        setMaterialPesos()
      })

      $('#materiais').on('select2:clear', function(e) {
        $('#addMaterial').text('Novo material')
        $('#input_position').val('')
        setMaterialPesos()
      })

      $('body').on('click', '#addMaterial', function(event) {
        const dataInTable = materiaisTbl.rows().data().toArray()
        const newMaterial = {
          position: parseInt($('#input_position').val()) || (materiaisTbl.rows(dataInTable.length -1 ).data()[0] ? materiaisTbl.rows(dataInTable.length -1 ).data()[0].position + 1 : 1),
          material: $('#materiais option:selected').text(),
          materialId: $('#materiais option:selected').val(),
          pesoBruto: $('#input_peso_bruto').val(),
          pesoLiquido: $('#input_peso_liquido').val(),
          percentualComposicao: $('#input_percentual_composicao').val()
        }
        if (!newMaterial.material) {
          return notifyDanger('Você tem que selecionar um material')
        }
        if (newMaterial.pesoBruto == '0,00' || newMaterial.pesoLiquido == '0,00' || newMaterial.percentualComposicao == '0,00') {
          return notifyDanger('Você tem que adicionar os pesos')
        }
        if (materiaisTbl.row(newMaterial.position - 1).data()) {
          materiaisTbl.row(newMaterial.position - 1).data(newMaterial).draw(false)
          $('#addMaterial').text('Novo material')
        } else {
          materiaisTbl.row.add(newMaterial).draw(false)
        }
        $('#input_position').val('')
        setMaterialPesos()
        $('#materiais').val(null).trigger('change')
      })

      $('body').on('click', '.deleteItem', function() {
        materiaisTbl.row($(this).parents('tr')).remove().draw(false)
      })

      $('body').on('click', '.editItem', function() {
        $('#addMaterial').text('Salvar material')
        const position = $(this).attr('data-position')
        $('#input_position').val(position)
        const oldData = materiaisTbl.row(position - 1).data()
        $('#materiais').val(oldData.materialId).trigger('change')
        maskPeso("#input_peso_bruto", oldData.pesoBruto)
        maskPeso("#input_peso_liquido", oldData.pesoLiquido)
        maskPeso("#input_percentual_composicao", oldData.percentualComposicao)
      })

      $('body').on('click', '#salvarMateriais', function() {
        $("#modalProdutoMaterials").modal("hide")
      })
    })
  </script>
@endpush