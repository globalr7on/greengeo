<div class="modal fade" id="modalMaterial" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left" id="tituloModal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form id="formMaterial">
              <div class="form-row mx-0 mb-4">
                <input type="hidden" class="form-control" id="inputId">
                <div class="col-md-6 text-center">
                  <div class="form-group m-0 p-0">
                    <label for="input_gerador_id" class="display-inherit mb-0">Gerador</label>
                    <select id="input_gerador_id" data-style="btn-warning text-white" title="Single Select" name="gerador_id">
                      <option value="" disabled selected>Seleccione</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-6 text-center">
                  <div class="form-group m-0 p-0">
                    <label for="input_estado_fisico" class="display-inherit mb-0">Estado fisico</label>
                    <select id="input_estado_fisico" data-style="btn-warning text-white" title="Single Select" name="estado_fisico">
                      <option value="" disabled selected>Seleccione</option>
                    </select>
                  </div>
                </div>
              </div>

              <div class="form-row mx-0 mb-4">
                <div class="col-md-6 text-center">
                  <div class="form-group m-0 p-0">
                    <label for="input_tipo_material_id" class="display-inherit mb-0">Tipo Material</label>
                    <select id="input_tipo_material_id" data-style="btn-warning text-white" title="Single Select" name="tipo_material_id">
                      <option value="" disabled selected>Seleccione</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-6 text-center">
                  <div class="form-group m-0 p-0">
                    <label for="input_unidade_id" class="display-inherit mb-0">Tipo Unidade</label>
                    <select id="input_unidade_id" data-style="btn-warning text-white" title="Single Select" name="unidade_id">
                      <option value="" disabled selected>Seleccione</option>
                    </select>
                  </div>
                </div>
              </div>
              
              <div class="form-row mx-0 mb-4">
                <div class="col-md-4 text-center">
                  <div class="form-group m-0 p-0">
                    <label for="input_ibama_id" class="display-inherit mb-0">Código Ibama</label>
                    <select id="input_ibama_id" data-style="btn-warning text-white" title="Single Select" name="ibama_id">
                      <option value="" disabled selected>Seleccione</option>
                    </select>
                  </div>
                </div>
                
                <div class="col-md-8">
                  <div class="form-group">
                    <label for="denominacao">Denominação</label>
                    <textarea class="form-control" id="denominacao" rows="3" disabled></textarea>
                  </div>
                </div>
              </div>

              <div class="form-row mx-0">
                <button type="button" class="btn btn-primary" id="salvarMaterial">Salvar</button>
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
    $('#formMaterial').submit(function(event) {
      event.preventDefault()
    })
  </script>
@endpush