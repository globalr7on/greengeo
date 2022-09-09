<div class="modal fade" id="modalOs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left" id="tituloModal">Nova OS</h5>
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

          <form id="formOs">
            <div class="bs-stepper-content">
              <!-- your steps content here -->
              <div id="step1" class="content" role="tabpanel" aria-labelledby="step1-trigger">
                <h4 class="text-primary font-weight-bold text-uppercase">Informações Básicas</h4>
                <div class="row mx-0 mb-4">
                  <div class="col-md-4 text-center">
                    <div class="form-group m-0 p-0">
                      <input type="hidden" id="parent_usuario_responsavel_id" value="{{ Auth::user()->usuario_responsavel_cadastro_id }}">
                      <input type="hidden" id="parent_tipo_empresa_id" value="{{ Auth::user()->usuario_responsavel_cadastro && Auth::user()->usuario_responsavel_cadastro->pessoa_juridica ? Auth::user()->usuario_responsavel_cadastro->pessoa_juridica->tipo_empresa_id : null }}">
                      <input type="hidden" id="current_empresa_id" value="{{ Auth::user()->pessoa_juridica_id }}">
                      <input type="hidden" id="input_usuario_responsavel_cadastro_id" value="{{ Auth::user()->id }}">
                      <input type="hidden" id="mtr_link">
                      <input type="hidden" id="cdf_link">
                      <input type="hidden" id="input_acondicionamento_id">
                      <input type="hidden" id="input_id">
                      <label for="input_gerador_id" class="display-inherit mb-0">Gerador</label>
                      <select id="input_gerador_id" data-style="btn-warning text-white" name="input_gerador_id" title="Selecione"></select>
                    </div>
                  </div>

                  <div class="col-md-4 text-center">
                    <div class="form-group m-0 p-0">
                      <label for="input_destinador_id" class="display-inherit mb-0">Destinador</label>
                      <select id="input_destinador_id" data-style="btn btn-warning text-white rounded" name="input_destinador_id" title="Selecione"></select>
                    </div>
                  </div>

                  <div class="col-md-4 text-center">
                    <div class="form-group m-0 p-0">
                      <label for="input_transportador_id" class="display-inherit mb-0">Transportador</label>
                      <select id="input_transportador_id" data-style="btn btn-warning text-white rounded" name="input_transportador_id" title="Selecione"></select>
                    </div>
                  </div>
                </div>

                <div class="row mx-0 mb-4">
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="input_data_estagio">Data Estagio</label>
                      <input type="text" class="form-control datepicker" id="input_data_estagio">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="input_data_emissao">Data Emissao</label>
                      <input type="text" class="form-control datepicker" id="input_data_emissao">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="input_data_preenchimento">Data Preenchimento</label>
                      <input type="text" class="form-control datepicker" id="input_data_preenchimento">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="input_data_integracao">Data Integração</label>
                      <input type="text" class="form-control datepicker" id="input_data_integracao">
                    </div>
                  </div>
                </div>

                <div class="row mx-0 mb-4">
                  <div class="col-md-4 align-self-center">
                    <div class="form-group mb-0">
                      <label for="input_data_inicio_coleta">Data Inicio Coleta</label>
                      <input type="text" class="form-control datetimepicker" id="input_data_inicio_coleta">
                    </div>
                  </div>

                  <div class="col-md-4 align-self-center">
                    <div class="form-group mb-0">
                      <label for="input_data_final_coleta">Data Final Coleta</label>
                      <input type="text" class="form-control datetimepicker" id="input_data_final_coleta">
                    </div>
                  </div>
                </div>

                <div class="row mx-0">
                  <button class="btn btn-default cdfPreview">CDF</button>
                  <button class="btn btn-default mtrPreview">MTR</button>
                  <button class="btn btn-default showFotos">Fotos</button>
                  <button class="btn btn-default addProdutos">Produtos</button>
                  <button class="btn btn-primary stepper-next">Próximo</button>
                </div>
              </div>

              <div id="step2" class="content" role="tabpanel" aria-labelledby="step2-trigger">
                <h4 class="text-primary font-weight-bold text-uppercase">Informações Básicas</h4>
                <div class="row mx-0 mb-4">
                  <div class="col-md-6 text-center">
                    <div class="form-group">
                      <label for="input_motorista_id" class="display-inherit mb-0">Motorista</label>
                      <select id="input_motorista_id" data-style="btn btn-warning text-white rounded" title="Selecione"></select>
                    </div>
                  </div>

                  <div class="col-md-6 text-center">
                    <div class="form-group">
                      <label for="input_veiculo_id" class="display-inherit mb-0">Veiculo</label>
                      <select data-style="btn-warning text-white" id="input_veiculo_id" title="Selecione" data-width="100%"></select>
                    </div>
                  </div>
                </div>

                <div class="row mx-0 mb-4">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="input_description">Descrição</label>
                      <textarea class="form-control" id="input_description" rows="3"></textarea>
                    </div>
                  </div>
                </div>

                <div class="row mx-0">
                  <button class="btn btn-default cdfPreview">CDF</button>
                  <button class="btn btn-default mtrPreview">MTR</button>
                  <button class="btn btn-default showFotos">Fotos</button>
                  <button class="btn btn-default addProdutos">Produtos</button>
                  <button class="btn btn-primary stepper-prev">Anterior</button>
                  <button class="btn btn-success" id="salvarOs">Salvar</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Produtos -->
<div class="modal fade" id="modalProdutos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left">Produtos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body pb-4">
        <!-- <div class="row">
          <div class="col-md-9 align-self-center">
            <div class="form-group">
              <select id="items" style="width: 100%"><option></option></select>
            </div>
          </div>

          <div class="col-md-3 text-center align-self-center">
            <div class="form-group">
              <button class="btn btn-primary addProduto">Adicionar produto</button>
            </div>
          </div>
        </div> -->

        <table class="table" id="produtosTbl">
          <thead>
            <th class="text-primary font-weight-bold text-center" style="width:4%">#</th>
            <th class="text-primary font-weight-bold" style="width:auto">Produto</th>
            <th class="text-primary font-weight-bold text-center" style="width:10%">Peso</th>
            <th class="text-primary font-weight-bold text-center" style="width:10%">Peso Cont. Transp.</th>
            <th class="text-primary font-weight-bold text-center" style="width:10%">Peso Cont. Destin.</th>
            <th class="text-primary font-weight-bold text-center" style="width:12%">Tratamento</th>
            <th class="text-primary font-weight-bold" style="width:12">Observação</th>
            <th class="text-primary font-weight-bold text-center" style="width:6%">Ações</th>
          </thead>
          <tfoot>
            <tr>
              <th>Total:</th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <script type="javascript/json" id="tratamentoData"></script>
</div>


@push('js')
  <script>
    $('#formOs').submit(function(event) {
      event.preventDefault()
    })
  </script>
@endpush