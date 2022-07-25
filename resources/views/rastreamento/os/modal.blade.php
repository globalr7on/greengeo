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
              {{-- <div class="line"></div>
              <div class="step" data-target="#step3">
                <button type="button" class="step-trigger" role="tab" aria-controls="step3" id="step3-trigger">
                  <span class="bs-stepper-circle bg-primary">3</span>
                </button>
              </div> --}}
            </div>
            <form id="formOs">
              <div class="bs-stepper-content">
                <!-- your steps content here -->
                <div id="step1" class="content" role="tabpanel" aria-labelledby="step1-trigger">
                  <h4 class="text-primary font-weight-bold text-uppercase">Informações Básicas</h4>
                   <div class="row m-0">
                      <input type="hidden" class="form-control" id="input_usuario_responsavel_cadastro_id"  value="{{  Auth::user()->id  }}">
                    {{-- <div class="form-group col-md-6">
                      
                      <label for="inputId" class="position-relative mb-0 font-weight-bold">Usuario Responsavel</label>
                     
                      <input type="text" class="form-control" value="{{  Auth::user()->name }}" disabled >
                    </div> --}}
                  </div>
                 
                  <div class="row m-0">
                    <div class="form-group col-md-4 text-center">
                       <input type="hidden" id="input_id">
                      <label for="input_gerador_id" class="display-inherit mb-0">Gerador</label>
                      <select id="input_gerador_id" data-style="btn-warning text-white" title="Single Select" name="input_gerador_id" >
                        <option value="" disabled selected>Seleccione</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                       <label for="input_destinador_id" class="display-inherit mb-0">Destinador</label>
                        <select id="input_destinador_id" data-style="btn btn-warning text-white rounded" title="Single Select" name="input_destinador_id">
                          <option value="" disabled selected>Seleccione</option>
                        </select>
                    </div>
                     <div class="form-group col-md-4">
                       <label for="input_transportador_id" class="display-inherit mb-0">Transportador</label>
                        <select id="input_transportador_id" data-style="btn btn-warning text-white rounded" title="Single Select" name="input_transportador_id">
                          <option value="" disabled selected>Seleccione</option>
                        </select>
                    </div>
                    
                  </div>
                  <div class="row m-0">
                      <div class="form-group col-md-3">
                        <label for="input_data_estagio" class="position-relative mb-0 font-weight-bold">Data Estagio</label>
                        <input type="text" class="form-control datepicker" id="input_data_estagio">
                      </div>
                      <div class="form-group col-md-3">
                        <label for="input_emissao" class="position-relative mb-0 font-weight-bold">Data Emissao</label>
                        <input type="text" class="form-control datepicker" id="input_emissao">
                      </div>
                       <div class="form-group col-md-3">
                        <label for="input_preenchimento" class="position-relative mb-0 font-weight-bold">Data Preenchimento</label>
                        <input type="text" class="form-control datepicker" id="input_preenchimento">
                      </div>
                       <div class="form-group col-md-3">
                        <label for="input_integracao" class="position-relative mb-0 font-weight-bold">Data Integração</label>
                        <input type="text" class="form-control datepicker" id="input_integracao">
                      </div>
                  </div>
                  <div class="row m-0">
                     <div class="form-group col-md-4">
                       <label for="input_estagio_id" class="display-inherit mb-0">Estagio</label>
                        <select id="input_estagio_id" data-style="btn btn-warning text-white rounded" title="Single Select" name="input_estagio_id">
                          <option value="" disabled selected>Seleccione</option>
                        </select>
                    </div>
                   <div class="form-group col-md-4">
                        <label for="input_mtr" class="position-relative mb-0 font-weight-bold">MTR</label>
                        <input type="text" class="form-control" id="input_mtr">
                      </div>
                  </div>

                  <button class="btn btn-warning">Gerar MTR</button>
                  <button class="btn btn-warning">Gerar CDF</button>
                  <button class="btn btn-danger">Cancelar MTR</button>
                  <button class="btn btn-primary stepper-next">Próximo</button>
                </div>
                </div>

                <div id="step2" class="content" role="tabpanel" aria-labelledby="step2-trigger">
                  <h4 class="text-primary font-weight-bold text-uppercase">Informações Básicas</h4>

                  <div class="row m-0">
                     <div class="form-group col-md-4">
                       <label for="input_motorista_id" class="display-inherit mb-0">Motorista</label>
                        <select id="input_motorista_id" data-style="btn btn-warning text-white rounded" title="Single Select" name="input_destinador_id">
                        <option value="" disabled selected>Seleccione</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="input_veiculo_id" class="display-inherit mb-0">Veiculo</label>
                      <select data-style="btn-warning text-white" title="Single Select" name="tipo" id="input_veiculo_id">
                        <option value="" disabled selected>Seleccione</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="input_serie" class="position-relative mb-0 font-weight-bold">Serie</label>
                      <input type="text" class="form-control" id="input_serie">
                    </div>
                  </div>
                  <div class="row m-0">
                    <div class="form-group col-md-12">
                      <label for="input_description" class="position-relative mb-0 font-weight-bold">Descrição</label>
                      <input type="text" class="form-control" id="input_description">
                    </div>
                  </div>

                   {{-- <div class="row m-0">
                     <div class="form-group col-md-12">
                        <label class="position-relative mb-0 font-weight-bold">Coordenadas GPS</label>
                     </div>
                   </div>
                  <div class="row m-0">
                    <div class="form-group col-md-6">
                      <label for="input_latitude" class="position-relative mb-0 font-weight-bold">Latitude</label>
                      <input type="text" class="form-control" id="input_latitude">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="input_longitude" class="position-relative mb-0 font-weight-bold">Logintude</label>
                      <input type="text" class="form-control" id="input_longitude">
                    </div>   
                  </div> --}}
                  <button class="btn btn-warning">Gerar MTR</button>
                  <button class="btn btn-warning">Gerar CDF</button>
                  <button class="btn btn-danger">Cancelar MTR</button>
                  <button class="btn btn-danger">Fotos</button>
                  <button class="btn btn-primary stepper-prev">Anterior</button>
                  <button class="btn btn-primary"  id="salvarOs" >Salvar</button>
                </div>

                {{-- <div id="step3" class="content" role="tabpanel" aria-labelledby="step3-trigger">
                  <h4 class="text-primary font-weight-bold text-uppercase">Item</h4>
                   <div class="row m-0">
                    <div class="form-group col-md-6">
                      <label for="input_contato_1" class="position-relative mb-0 font-weight-bold">Item</label>
                      <input type="text" class="form-control" id="input_contato_1">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="input_cargo_contato_1" class="position-relative mb-0 font-weight-bold">Descricão</label>
                      <input type="text" class="form-control" id="input_cargo_contato_1">
                    </div>
                  </div>
                   <div class="row m-0">
                    <div class="form-group col-md-4">
                      <label for="input_tipo_gerador" class="display-inherit mb-0">Peso</label>
                        <select data-style="btn-warning text-white" title="Single Select" name="tipo" id="input_tipo_gerador">
                          <option value="" disabled selected>Seleccione</option>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                       <label for="input_tipo_gerador" class="display-inherit mb-0">Unidade</label>
                        <select data-style="btn-warning text-white" title="Single Select" name="tipo" id="input_tipo_gerador">
                          <option value="" disabled selected>Seleccione</option>
                        </select>
                    </div>
                     <div class="form-group col-md-4">
                       <label for="input_tipo_gerador" class="display-inherit mb-0">Classe</label>
                        <select data-style="btn-warning text-white" title="Single Select" name="tipo" id="input_tipo_gerador">
                          <option value="" disabled selected>Seleccione</option>
                        </select>
                    </div>          
                  </div>

                  <div class="row m-0">
                    <div class="form-group col-md-4">
                      <label for="input_fixo" class="position-relative mb-0 font-weight-bold">Fixo</label>
                      <input type="text" class="form-control" id="input_fixo">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="input_whatsapp" class="position-relative mb-0 font-weight-bold">Whatsapp</label>
                      <input type="text" class="form-control" id="input_whatsapp">
                    </div>
                   
                    <div class="form-group col-md-4">
                      <label for="input_email" class="position-relative mb-0 font-weight-bold">Email</label>
                      <input type="text" class="form-control" id="input_email">
                    </div>
                  </div>
                <div class="row m-0">
                  <div class="form-group col-md-4">
                      <label for="input_capacidade_media_carga" class="position-relative mb-0 font-weight-bold">Capacidade Carga</label>
                      <input type="text" class="form-control" id="input_capacidade_media_carga" placeholder="000000000.00 kg">
                     
                    </div>
                   <div class="form-group col-md-4">
                      <label for="input_identificador_celular" class="position-relative mb-0 font-weight-bold">Identificador Celular</label>
                      <input type="text" class="form-control" id="input_identificador_celular">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="input_senha_acesso" class="position-relative mb-0 font-weight-bold">Senha Acesso</label>
                      <input type="text" class="form-control" id="input_senha_acesso">
                    </div>   
                </div> --}}


                  {{-- <button class="btn btn-warning" >Motorista</button>
                  <button class="btn btn-warning"id="#novoVeiculo">Veiculo</button>
                  <button class="btn btn-primary stepper-prev">Anterior</button> --}}
                 
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
    $('#formOs').submit(function(event) {
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