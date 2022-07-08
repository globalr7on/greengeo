<div class="modal fade" id="modalVeiculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form id="formVeiculo">
              <div class="form-row mx-0 my-2">
                <input type="hidden" class="form-control" id="inputId">
                <div class="form-group col-md-4 align-self-center text-center">
                  <div class="togglebutton">
                    <label>
                      Ativo?
                      <input type="checkbox" id="checkAtivo">
                      <span class="toggle"></span>
                    </label>
                  </div>
                </div>

                <div class="col-md-4 text-center">
                  <div class="form-group m-0 p-0">
                    <label for="input_pessoa_juridica_id" class="display-inherit mb-0">Empresa</label>
                    <select id="input_pessoa_juridica_id" data-style="btn-warning text-white" title="Single Select" name="empresa">
                      <option value="" disabled selected>Seleccione</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-4 align-self-center">
                  <div class="form-group">
                    <label for="input_placa">Placa</label>
                    <input type="text" class="form-control" id="input_placa">
                  </div>
                </div>
              </div>
                
              <div class="form-row mx-0 my-2">
                <div class="col-md-4 text-center">
                  <div class="form-group m-0 p-0">
                    <label for="input_modelo_id" class="display-inherit mb-0">Modelo</label>
                    <select id="input_modelo_id" data-style="btn-warning text-white" title="Single Select" name="modelo">
                      <option value="" disabled selected>Seleccione</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-4 text-center">
                  <div class="form-group m-0 p-0">
                    <label for="input_marca_id" class="display-inherit mb-0">Marca</label>
                    <select id="input_marca_id" data-style="btn-warning text-white" title="Single Select" name="marca">
                      <option value="" disabled selected>Seleccione</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-4 text-center">
                  <div class="form-group m-0 p-0">
                    <label for="input_acondicionamento_id" class="display-inherit mb-0">Acondicionamento</label>
                    <select id="input_acondicionamento_id" data-style="btn-warning text-white" title="Single Select" name="acondicionamento">
                      <option value="" disabled selected>Seleccione</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-row mx-0 my-2">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="input_chassis">Chassis</label>
                    <input type="text" class="form-control" id="input_chassis">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group show-label">
                    <label for="input_capacidade_media_carga">Capacidade</label>
                    <input type="text" class="form-control" id="input_capacidade_media_carga">
                    <span class="form-control-feedback">Kg</span>
                  </div>
                </div>
              </div>

              <div class="form-row mx-0 my-2">
                <div class="col-md-6 align-self-center">
                  <div class="form-group">
                    <label for="input_renavam">Renavam</label>
                    <input type="text" class="form-control" id="input_renavam">
                  </div>
                </div>

                <div class="col-md-6 text-center">
                  <div class="form-group m-0 p-0">
                    <label for="input_combustivel" class="display-inherit mb-0">Combustivel</label>
                    <select id="input_combustivel" data-style="btn-warning text-white" title="Single Select" name="combustivel">
                      <option value="" disabled selected>Seleccione</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-row mx-0 my-2">
                <button type="button" class="btn btn-primary" id="salvarVeiculo">Salvar</button>
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
    $('#formVeiculo').submit(function(event) {
      event.preventDefault()
    })

  </script>
@endpush