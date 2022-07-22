<div class="modal fade" id="modalNota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left" id="tituloNota"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form id="formNota">
              <div class="row mx-0 mb-4">
                <div class="col-md-6 text-center">
                  <div class="form-group m-0 p-0">
                    <input type="hidden" id="input_id">
                    <input type="hidden" id="input_usuario_responsavel_cadastro_id" value="{{ Auth::user()->id }}">
                    <label for="input_pessoa_juridica_id" class="display-inherit mb-0">Empresa</label>
                    <select id="input_pessoa_juridica_id" data-style="btn-warning text-white" name="input_pessoa_juridica_id">
                      <option value="" disabled selected>Seleccione</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group mb-0">
                    <label for="input_numero_total">Numero Total</label>
                    <input type="text" class="form-control" id="input_numero_total">
                  </div>
                </div>
              </div>
              
              <div class="row mx-0 mb-4">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="input_serie">Serie</label>
                    <input type="text" class="form-control" id="input_serie">
                  </div>
                </div>
  
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="input_folha">Folha</label>
                    <input type="number" class="form-control" id="input_folha">
                  </div>
                </div>
  
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="input_chave_de_acesso">Chave de Acesso</label>
                    <input type="text" class="form-control" id="input_chave_de_acesso">
                  </div>
                </div>
              </div>

              <div class="row mx-0">
                <button type="button" class="btn btn-primary" id="addProdutoAcabado">Produto Acabado</button>
                <button type="button" class="btn btn-primary" id="addProdutoSegregado">Produto Segregado</button>
                <button type="button" class="btn btn-primary" id="salvarNotafiscal">Salvar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Item Produto Acabado -->
<div class="modal fade" id="modalProdutoAcabado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left">Produtos Acabados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form id="formProdutoAcabado" class="mb-0">
              <div class="form-row mx-0 mb-4">
                <div class="col-md-12">
                  <div class="form-group">
                    <input type="hidden" id="produtoAcabadoPosition">
                    <select name="produtosAcabados" id="produtosAcabados" style="width: 100%">
                      <option></option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-row mx-0 mb-4">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="produtoAcabadoQuantidade">Quantidade</label>
                    <input type="number" class="form-control" id="produtoAcabadoQuantidade">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="produtoAcabadoNumeroSerie">Numero de serie</label>
                    <input type="text" class="form-control" id="produtoAcabadoNumeroSerie">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="produtoAcabadoDataFabricacao">Data de Fabricação</label>
                    <input type="text" class="form-control datepicker" id="produtoAcabadoDataFabricacao">
                  </div>
                </div>

                <div class="col-md-3 text-center">
                  <button type="button" class="btn btn-primary" id="addProduto">Novo producto</button>
                </div>
              </div>

              <div class="form-row mx-0 mb-4">
                <div class="col-md-12">
                  <div class="form-group m-0 p-0">
                    <table class="table" id="produtoAcabadoTbl">
                      <thead>
                        <th class="text-primary font-weight-bold text-center">#</th>
                        <th class="text-primary font-weight-bold text-center">Produto</th>
                        <th class="text-primary font-weight-bold text-center">Quantidade</th>
                        <th class="text-primary font-weight-bold text-center">Numero Serie</th>
                        <th class="text-primary font-weight-bold text-center">Data Fabricação</th>
                        <th class="text-primary font-weight-bold text-center">Ação</th>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>

              <div class="form-row mx-0">
                <button type="button" class="btn btn-primary" id="salvarProdutoAcabado">Salvar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Item Segregados -->
<div class="modal fade" id="modalSegregados" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left">Produtos Segregados</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form id="formMaterials" class="mb-0">
              <div class="form-row mx-0 mb-4">
                <div class="col-md-12">
                  <div class="form-group">
                    <input type="hidden" id="segregadosPosition">
                    <select name="materiais" id="materiais" style="width: 100%">
                      <option></option>
                    </select>
                  </div>
                </div>
              </div>
              
              <div class="form-row mx-0 mb-4">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="segregadosPesoBruto">Peso Bruto</label>
                    <input type="text" class="form-control" id="segregadosPesoBruto">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="segregadosPesoLiquido">Peso Liquido</label>
                    <input type="text" class="form-control" id="segregadosPesoLiquido">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="segregadosPercentualComposicao">Percentual Composicao</label>
                    <input type="text" class="form-control" id="segregadosPercentualComposicao">
                  </div>
                </div>

                <div class="col-md-3 text-center">
                  <button type="button" class="btn btn-primary" id="addSegregados">Novo material</button>
                </div>
              </div>

              <div class="form-row mx-0 mb-4">
                <div class="col-md-12">
                  <div class="form-group m-0 p-0">
                    <table class="table" id="materiaisTbl">
                      <thead>
                        <th class="text-primary font-weight-bold text-center">#</th>
                        <th class="text-primary font-weight-bold">Material</th>
                        <th class="text-primary font-weight-bold text-center">P. Bruto</th>
                        <th class="text-primary font-weight-bold text-center">P. Liquido</th>
                        <th class="text-primary font-weight-bold text-center">Percentual Comp.</th>
                        <th class="text-primary font-weight-bold text-center">Ação</th>
                      </thead>
                    </table>
                  </div>
                </div>
              </div>

              <div class="form-row mx-0">
                <button type="button" class="btn btn-primary" id="salvarSegregados">Salvar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('js')
  <script>
    $('#formNota').submit(function(event) {
      event.preventDefault()
    })
    $('#formProdutoAcabado').submit(function(event) {
      event.preventDefault()
    })

    $('.datepicker').datetimepicker({
      format: "YYYY-MM-DD",
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
    })
  </script>
@endpush