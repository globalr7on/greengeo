<div class="modal fade" id="modalProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left" id="tituloProduto"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body p-2">
        <div class="bs-stepper">
          <div class="bs-stepper-header" role="tablist">
            <!-- your steps here -->
            <div class="step" data-target="#step1">
              <button type="button" class="step-trigger" role="tab" aria-controls="step1" id="step1-trigger">
                <span class="bs-stepper-circle bg-primary">1</span>
              </button>
            </div>
            <div class="line"></div>
            <div class="step" data-target="#step2">
              <button type="button" class="step-trigger" role="tab" aria-controls="step2" id="step2-trigger">
                <span class="bs-stepper-circle bg-primary">2</span>
              </button>
            </div>
          </div>

          <form id="formProduto">
            <div class="bs-stepper-content">
              <!-- your steps content here -->
              <div id="step1" class="content" role="tabpanel" aria-labelledby="step1-trigger">
                <div class="row mx-0 mb-4">
                  <div class="col-md-4 align-self-center">
                    <div class="form-group">
                      <input type="hidden" id="input_id">
                      <input type="hidden" class="form-control" id="input_usuario_responsavel_cadastro_id" value="{{ Auth::user()->id }}">
                      <label for="input_ean">EAN</label>
                      <input type="text" class="form-control" id="input_ean">
                    </div>
                  </div>

                  <div class="col-md-4 align-self-center">
                    <div class="form-group">
                      <label for="input_codigo">Código Fabricante</label>
                      <input type="text" class="form-control" id="input_codigo">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="input_gerador_id" class="display-inherit mb-0">Nome Fabricante</label>
                      <select id="input_pessoa_juridica_id" data-style="btn btn-warning text-white" name="input_pessoa_juridica_id" title="Selecione"></select>
                    </div>
                  </div>
                </div>

                <div class="row mx-0 mb-4">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="input_descricao">Descricao</label>
                      <textarea class="form-control" id="input_descricao" rows="3"></textarea>
                    </div>

                  </div>
                </div>

                <div class="row mx-0">
                  <button class="btn btn-primary stepper-next">Próximo</button>
                </div>
              </div>

              <div id="step2" class="content" role="tabpanel" aria-labelledby="step2-trigger">
                <div class="row mx-0 mb-4">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="input_dimensoes">Dimensões</label>
                      <input type="text" class="form-control" id="input_dimensoes">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="input_altura">Altura</label>
                      <input type="text" class="form-control" id="input_altura">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="input_largura">Largura</label>
                      <input type="text" class="form-control" id="input_largura">
                    </div>
                  </div>
                </div>  

                <div class="row mx-0 mb-4">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="input_profundidade">Profundidade</label>
                      <input type="text" class="form-control" id="input_profundidade">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="input_comprimento">Comprimento</label>
                      <input type="text" class="form-control" id="input_comprimento">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="input_especie">Especie</label>
                      <input type="text" class="form-control" id="input_especie">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="input_marca">Marca</label>
                      <input type="text" class="form-control" id="input_marca">
                    </div>
                  </div>
                </div>

                <div class="row mx-0">
                  <button class="btn btn-warning" id="addMaterials">Materiais</button>
                  <button class="btn btn-primary stepper-prev">Anterior</button>
                  <button class="btn btn-primary" id="salvarProduto">Salvar</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalProdutoMaterials" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left">Materiais</h5>
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
                    <input type="hidden" id="input_position">
                    <select name="materiais" id="materiais" style="width: 100%">
                      <option></option>
                    </select>
                  </div>
                </div>
              </div>
              
              <div class="form-row mx-0 mb-4">
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="input_peso_bruto">Peso Bruto</label>
                    <input type="text" class="form-control" id="input_peso_bruto">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="input_peso_liquido">Peso Liquido</label>
                    <input type="text" class="form-control" id="input_peso_liquido">
                  </div>
                </div>

                <div class="col-md-3">
                  <div class="form-group">
                    <label for="input_percentual_composicao">Percentual Composicao</label>
                    <input type="text" class="form-control" id="input_percentual_composicao">
                  </div>
                </div>

                <div class="col-md-3 text-center">
                  <button type="button" class="btn btn-primary" id="addMaterial">Novo material</button>
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
                <button type="button" class="btn btn-primary" id="salvarMateriais">Salvar</button>
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
    $('#formProduto').submit(function(event) {
      event.preventDefault()
    })
    $('#formMaterials').submit(function(event) {
      event.preventDefault()
    })
  </script>
@endpush