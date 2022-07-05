<div class="modal fade" id="modalMaterial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left" id="tituloModal">Nova Material</h5>
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
            <div class="line"></div>
            <div class="step" data-target="#step3">
              <button type="button" class="step-trigger" role="tab" aria-controls="step3" id="step3-trigger">
                <span class="bs-stepper-circle bg-primary">3</span>
              </button>
            </div>
          </div>

          <form id="formMaterial">
            <div class="bs-stepper-content">
              <!-- your steps content here -->
              <div id="step1" class="content" role="tabpanel" aria-labelledby="step1-trigger">
                <div class="row m-0">
                  <div class="form-group col-md-6 align-self-center">
                    <div class="togglebutton">
                      <label>
                        Ativo?
                        <input type="checkbox" id="checkAtivo">
                        <span class="toggle"></span>
                      </label>
                    </div>
                  </div>
                    <div class="form-group col-md-6">
                    <label for="input_usuario_responsavel_cadastro_id" class="position-relative mb-0 font-weight-bold">Responsavel</label>
                    <input type="hidden" class="form-control" id="input_usuario_responsavel_cadastro_id"  value="{{  Auth::user()->id  }}">
                    <input type="text" class="form-control" value="{{  Auth::user()->name }}" disabled >
                  </div>
                </div>

                <div class="row m-0">
                  <div class="form-group col-md-4">
                    <label for="input_ean" class="position-relative mb-0 font-weight-bold">EAN</label>
                    <input type="text" class="form-control" id="input_ean">
                    <input type="hidden" class="form-control" id="input_id">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="input_ibama" class="position-relative mb-0 font-weight-bold">Ibama</label>
                    <input type="text" class="form-control" id="input_ibama">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="input_denominacao_ibama" class="position-relative mb-0 font-weight-bold">Denominação Ibama</label>
                    <input type="text" class="form-control" id="input_peso_liquido">
                  </div>
                </div>

                <div class="row m-0">
                  <div class="form-group col-md-4">
                    <label for="input_peso_bruto" class="position-relative mb-0 font-weight-bold">Peso Bruto</label>
                    <input type="text" class="form-control" id="input_peso_bruto">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="input_peso_liquido" class="position-relative mb-0 font-weight-bold">Peso Liquido</label>
                    <input type="text" class="form-control" id="input_peso_liquido">
                  </div>  
                  <div class="form-group col-md-4">
                    <label for="input_estado_fisico" class="position-relative mb-0 font-weight-bold">Estado Físico</label>
                    <input type="text" class="form-control" id="input_estado_fisico">
                  </div>  
                </div>

                <div class="row m-0">
                  <button class="btn btn-warning">Itens</button>
                  <button class="btn btn-primary stepper-next">Próximo</button>
                </div>
              </div>

              <div id="step2" class="content" role="tabpanel" aria-labelledby="step2-trigger">
                <div class="row m-0">
                  <div class="form-group col-md-3">
                    <label for="input_percenteual_composicao" class="position-relative mb-0 font-weight-bold">Composição Percentual</label>
                    <input type="text" class="form-control" id="input_percenteual_composicao">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="input_dimensoes" class="position-relative mb-0 font-weight-bold">Dimensões</label>
                    <input type="text" class="form-control" id="input_dimensoes">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="input_largura" class="position-relative mb-0 font-weight-bold">Largura</label>
                    <input type="text" class="form-control" id="input_largura">
                  </div>
                  <div class="form-group col-md-3">
                    <label for="input_profundidade" class="position-relative mb-0 font-weight-bold">Profundidade</label>
                    <input type="text" class="form-control" id="input_profundidade">
                  </div>
                </div>

                <div class="row m-0">
                  <div class="form-group col-md-6">
                    <label for="input_comprimento" class="position-relative mb-0 font-weight-bold">Comprimento</label>
                    <input type="text" class="form-control" id="input_comprimento">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="input_nome_no_fabricante" class="position-relative mb-0 font-weight-bold">Nome Fabricante</label>
                    <input type="text" class="form-control" id="input_nome_no_fabricante">
                  </div>
                </div>

                <div class="row m-0">
                  <button class="btn btn-warning">Itens</button>
                  <button class="btn btn-primary stepper-prev">Anterior</button>
                  <button class="btn btn-primary stepper-next">Próximo</button>
                </div>
              </div>

              <div id="step3" class="content" role="tabpanel" aria-labelledby="step3-trigger">
                <div class="row m-0">
                  <div class="form-group col-md-4">
                    <label for="input_especie" class="position-relative mb-0 font-weight-bold">Especie</label>
                    <input type="text" class="form-control" id="input_especie">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="input_marca" class="position-relative mb-0 font-weight-bold">Marca</label>
                    <input type="text" class="form-control" id="input_marca">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="input_gerador_id" class="position-relative mb-0 font-weight-bold">Gerador</label>
                    <input type="text" class="form-control" id="input_gerador_id">
                  </div>
                </div>

                <div class="row m-0">
                  <div class="form-group col-md-4">
                    <label for="input_tipo_material_id" class="position-relative mb-0 font-weight-bold">Tipo Material</label>
                    <input type="text" class="form-control" id="input_tipo_material_id">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="input_unidade_id" class="position-relative mb-0 font-weight-bold">Unidade</label>
                    <input type="text" class="form-control" id="input_unidade_id">
                  </div>
                    <div class="form-group col-md-4">
                    <label for="input_nota_fiscal_iten_id" class="position-relative mb-0 font-weight-bold">Nota Fiscal Iten ID</label>
                    <input type="text" class="form-control" id="input_nota_fiscal_iten_id">
                  </div>
                </div>

                <div class="row m-0">
                  <button class="btn btn-warning">Itens</button>
                  <button class="btn btn-primary stepper-prev">Anterior</button>
                  <button class="btn btn-primary"  id="salvarEmpresa" >Salvar</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

@push('js')
  <script>
    $('#formMaterial').submit(function(event) {
      event.preventDefault()
    })
  </script>
@endpush