<div class="modal fade" id="modalAgenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left" id="tituloAgenda"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body p-2">
          <form id="formAgenda" class="mb-0">
                <div class="row mx-0 mb-4">
                  <div class="col-md-4 text-center">
                    <div class="form-group m-0 p-0">
                      <input type="hidden" id="input_responsavel_id" value="{{ Auth::user()->id }}">
                      <input type="hidden" id="input_pessoa_juridica_id" value="{{ Auth::user()->pessoa_juridica_id }}">
                      <input type="hidden" id="input_gerador_id">
                      <input type="hidden" id="input_id">
                      <label for="input_transportador_id" class="display-inherit mb-0">Transportador</label>
                      <select id="input_transportador_id" data-style="btn-warning text-white" title="Selecione"></select>
                    </div>
                  </div>

                  <div class="col-md-4 text-center">
                    <div class="form-group m-0 p-0">
                    <label for="input_destinador_id" class="display-inherit mb-0">Destinador</label>
                      <select id="input_destinador_id" data-style="btn-warning text-white" title="Selecione"></select>
                    </div>
                  </div>
                  <div class="col-md-4 text-center">
                    <div class="form-group m-0 p-0">
                      <label for="input_acondicionamento_id" class="display-inherit mb-0">Acondicionamento</label>
                      <select id="input_acondicionamento_id" data-style="btn-warning text-white" title="Selecione"></select>
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
                <div class="row mx-0 mb-4 d-none" id="motoristaDiv">
                  <div class="col-md-4 text-center">
                    <div class="form-group m-0 p-0">
                      <label for="input_veiculo_id" class="display-inherit mb-0">Veiculo</label>
                      <select id="input_veiculo_id" data-style="btn-warning text-white" title="Selecione"></select>
                    </div>
                  </div>
                  <div class="col-md-4 text-center">
                    <div class="form-group m-0 p-0">
                      <label for="input_motorista_id" class="display-inherit mb-0">Motorista</label>
                      <select id="input_motorista_id" data-style="btn-warning text-white" title="Selecione"></select>
                    </div>
                  </div>
                </div>
                <h5 class="text-primary text-uppercase"><strong>Adicionar Produtos</string></h5>
                <div id="produtoDetailDiv">
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
                  <div class="row mx-0 mb-4">
                    <!-- <div class="col-md-3">
                      <div class="form-group mb-0">
                        <label for="input_codigo">Codigo</label>
                        <input type="text" class="form-control" id="input_codigo">
                        <input type="hidden" id="position">
                        <input type="hidden" id="id">
                        <input type="hidden" id="produto_id">
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group mb-0">
                        <label for="input_descricao">Descricão</label>
                        <input type="text" class="form-control" id="input_descricao">
                      </div>
                    </div> -->

                    <div class="col-md-3 align-self-center">
                      <div class="form-group mb-0">
                        <label for="input_peso">Peso</label>
                        <input type="text" class="form-control" id="input_peso">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group mb-0">
                        <label for="input_quantidade">Quantidade</label>
                        <input type="number" class="form-control" id="input_quantidade">
                      </div>
                    </div>
                    <div class="col-md-3 text-center">
                      <div class="form-group m-0 p-0">
                        <label for="input_unidade_id" class="display-inherit mb-0">Unidade</label>
                        <select id="input_unidade_id" data-style="btn-warning text-white" title="Selecione"></select>
                      </div>
                    </div>
                  </div>
                </div>
                  <div class="row mx-0 mb-4">
                   
                    <div class="col-md-6 align-self-center text-center">
                      <button type="button" class="btn btn-primary" id="addProduto">Adicionar</button>
                    </div>
                  </div>
                </div>
                <div class="row mx-0 mb-4">
                  <div class="col-md-12">
                    <table class="table" id="produtosTbl">
                      <thead>
                        <th class="text-primary font-weight-bold text-center" style="width:6%">#</th>
                        <th class="text-primary font-weight-bold text-center" style="width:8%">Codigo</th>
                        <th class="text-primary font-weight-bold" style="width:auto">Descricão</th>
                        <th class="text-primary font-weight-bold text-center" style="width:6%">Unid.</th>
                        <th class="text-primary font-weight-bold text-center" style="width:6%">Quant.</th>
                        <th class="text-primary font-weight-bold text-center" style="width:6%">Peso</th>
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
                        </tr>
                      </tfoot>
                    </table>
                  </div>
                </div>

                <div class="row mx-0">
                  <button type="button" class="btn btn-success" id="salvarAgenda">Salvar</button>
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
    $('#formAgenda').submit(function(event) {
      event.preventDefault()
    })

    $('.datetimepicker').datetimepicker({
      locale: 'pt-br',
      format: 'YYYY-MM-DD HH:mm:ss',
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
