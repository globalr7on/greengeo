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
          </div>
          <form id="formMaterial">
            <div class="bs-stepper-content">
              <!-- your steps content here -->
              <div id="step1" class="content" role="tabpanel" aria-labelledby="step1-trigger">
                <div class="row m-0">
                   <div class="form-group  col-md-6">
                        <label for="input_ibama" class="display-inherit mb-0 text-left">Código Ibama</label>
                        <select id="input_ibama" data-style="btn btn-warning text-white" name="atividade_id">
                          <option value="" disabled selected>Código Ibama</option>
                        </select> 
                       </div>
                      <div class="form-group col-md-6">
                    <label for="input_estado_fisico" class="display-inherit mb-0 text-left">Estado fisico</label>
                      <select id="input_estado_fisico" data-style="btn btn-warning text-white" name="input_estado_fisico">
                        <option value="" disabled selected>Estado Fisico</option>
                      </select>
                    </div>  
                  </div>
                 <div class="row m-0">
                  <div class="form-group col-md-6">
                    <label for="input_tipo_material_id" class="display-inherit mb-0 text-left">Tipo Material</label>
                    <select id="input_tipo_material_id" data-style="btn btn-warning text-white" name="tipo_material_id">
                      <option value="" disabled selected>Tipo Material</option>
                    </select>
                    <input type="hidden" class="form-control" id="input_gerador_id">
                  </div>
                  <div class="form-group col-md-6">
                     <label for="input_unidade_id" class="display-inherit mb-0 text-left">Tipo Unidade</label>
                        <select id="input_unidade_id" data-style="btn btn-warning text-white" name="input_unidade_id">
                          <option value="" disabled selected>Tipo Unidade</option>
                        </select>
                  </div>
                </div> 
                <div class="row m-0">
                  <button class="btn btn-primary stepper-next" id="salvarMaterial">Salvar</button>
                </div>
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