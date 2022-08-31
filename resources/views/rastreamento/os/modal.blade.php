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
                      <input type="hidden" id="input_usuario_responsavel_cadastro_id" value="{{ Auth::user()->id }}">
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
                      <label for="input_emissao">Data Emissao</label>
                      <input type="text" class="form-control datepicker" id="input_emissao">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="input_preenchimento">Data Preenchimento</label>
                      <input type="text" class="form-control datepicker" id="input_preenchimento">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="input_integracao">Data Integração</label>
                      <input type="text" class="form-control datepicker" id="input_integracao">
                    </div>
                  </div>
                </div>

                <div class="row mx-0 mb-4">
                  <div class="col-md-4 text-center">
                    <div class="form-group">
                      <label for="input_estagio_id" class="display-inherit mb-0">Estagio</label>
                      <select id="input_estagio_id" data-style="btn btn-warning text-white rounded" name="input_estagio_id" title="Selecione"></select>
                    </div>
                  </div>

                  <div class="col-md-4 align-self-center">
                    <div class="form-group">
                      <label for="input_mtr">MTR</label>
                      <input type="text" class="form-control" id="input_mtr">
                    </div>
                  </div>

                  <div class="col-md-4 text-center">
                    <div class="form-group">
                      <label for="input_notas_fiscais" class="display-inherit mb-0">Notas Fiscais</label>
                      <select id="input_notas_fiscais" data-style="btn btn-warning text-white rounded" multiple data-selected-text-format="count" data-count-selected-text="{0} Notas selecionadas" title="Selecione um ou mais"></select>
                    </div>
                  </div>
                </div>

                <div class="row mx-0">
                  <!-- <button class="btn btn-warning">Gerar MTR</button> -->
                  <!-- <button class="btn btn-warning">Gerar CDF</button> -->
                  <!-- <button class="btn btn-danger">Cancelar MTR</button> -->
                  <button class="btn btn-default addProdutos">Produtos</button>
                  <button class="btn btn-default showFotos">Fotos</button>
                  <button class="btn btn-primary stepper-next">Próximo</button>
                </div>
              </div>

              <div id="step2" class="content" role="tabpanel" aria-labelledby="step2-trigger">
                <h4 class="text-primary font-weight-bold text-uppercase">Informações Básicas</h4>
                <div class="row mx-0 mb-4">
                  <div class="col-md-4 text-center">
                    <div class="form-group">
                      <label for="input_motorista_id" class="display-inherit mb-0">Motorista</label>
                      <select id="input_motorista_id" data-style="btn btn-warning text-white rounded" name="input_motorista_id" title="Selecione"></select>
                    </div>
                  </div>

                  <div class="col-md-4 text-center">
                    <div class="form-group">
                      <label for="input_veiculo_id" class="display-inherit mb-0">Veiculo</label>
                      <select data-style="btn-warning text-white" name="tipo" id="input_veiculo_id" title="Selecione"></select>
                    </div>
                  </div>

                  <div class="col-md-4 align-self-center">
                    <div class="form-group">
                      <label for="input_serie">Serie</label>
                      <input type="text" class="form-control" id="input_serie">
                    </div>
                  </div>
                </div>

                <div class="row mx-0 mb-4">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="input_description">Descrição</label>
                      <input type="text" class="form-control" id="input_description">
                    </div>
                  </div>
                </div>

                <div class="row mx-0">
                  <!-- <button class="btn btn-warning">Gerar MTR</button> -->
                  <!-- <button class="btn btn-warning">Gerar CDF</button> -->
                  <!-- <button class="btn btn-danger">Cancelar MTR</button> -->
                  <button class="btn btn-default addProdutos">Produtos</button>
                  <button class="btn btn-default showFotos">Fotos</button>
                  <button class="btn btn-primary stepper-prev">Anterior</button>
                  <button class="btn btn-primary" id="salvarOs" >Salvar</button>
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
        <div class="row">
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
        </div>

        <table class="table" id="produtosTbl">
          <thead>
            <th class="text-primary font-weight-bold text-center" style="width:5%">#</th>
            <th class="text-primary font-weight-bold" style="width:auto">Produto</th>
            <th class="text-primary font-weight-bold text-center" style="width:6%">Alt.</th>
            <th class="text-primary font-weight-bold text-center" style="width:6%">Larg.</th>
            <th class="text-primary font-weight-bold text-center" style="width:6%">Prof.</th>
            <th class="text-primary font-weight-bold text-center" style="width:6%">Peso</th>
            <th class="text-primary font-weight-bold text-center" style="width:8%">Tratamento</th>
            <th class="text-primary font-weight-bold text-center" style="width:12">Observacao</th>
            <th class="text-primary font-weight-bold text-center" style="width:6%">Actions</th>
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
              <th></th>
            </tr>
          </tfoot>
        </table>
      </div>
    </div>
  </div>
  <script type="javascript/json" id="produtosData"></script>
  <script type="javascript/json" id="tratamentoData"></script>
</div>


@push('js')
  <script>
    $('#formOs').submit(function(event) {
      event.preventDefault()
    })

    // $('.datepicker').datetimepicker({
    //   format: "YYYY-MM-DD",
    //   icons: {
    //     time: "fa fa-clock-o",
    //     date: "fa fa-calendar",
    //     up: "fa fa-chevron-up",
    //     down: "fa fa-chevron-down",
    //     previous: 'fa fa-chevron-left',
    //     next: 'fa fa-chevron-right',
    //     today: 'fa fa-screenshot',
    //     clear: 'fa fa-trash',
    //     close: 'fa fa-remove'
    //   }
    // })
  </script>
@endpush