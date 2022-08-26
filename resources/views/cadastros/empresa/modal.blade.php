<div class="modal fade" id="modalEmpresa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-left" id="tituloModal">Nova Empresa</h5>
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
            <form id="formEmpresa">
              <div class="bs-stepper-content">
                <!-- your steps content here -->
                <div id="step1" class="content" role="tabpanel" aria-labelledby="step1-trigger">
                  <h4 class="text-primary font-weight-bold text-uppercase mb-4">Informações Básicas</h4>
                  <div class="row mx-0 mb-4">
                    <div class="col-md-4 align-self-center">
                      <div class="form-group pb-0">
                        <input type="hidden" id="input_id">
                        <label for="input_contrato">Contrato Nro.</label>
                        <input type="text" class="form-control" id="input_contrato">
                      </div>
                    </div>

                    <div class="col-md-4 text-center">
                      <div class="form-group">
                        <label for="input_tipo_empresa_id" class="display-inherit mb-0 text-left">Tipo de Empresa</label>
                        <select id="input_tipo_empresa_id" data-style="btn-warning text-white" name="tipo_empresa_id" title="Selecione"></select>
                      </div>
                    </div>
  
                    <div class="col-md-4 text-center">
                      <div class="form-group">
                        <label for="input_atividade_id" class="display-inherit mb-0 text-left">Tipo de Atividade</label>
                        <select id="input_atividade_id" data-style="btn btn-warning text-white" name="atividade_id" title="Selecione"></select>
                      </div>
                    </div>
                  </div>

                  <div class="row mx-0 mb-4">
                    <div class="col-md-4">
                      <div class="form-group pb-0">
                        <input type="hidden" id="input_usuario_responsavel_cadastro_id" value="{{ Auth::user()->id }}">
                        <label for="input_razao_social">Razão Social</label>
                        <input type="text" class="form-control" id="input_razao_social">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_cnpj">CNPJ</label>
                        <input type="text" class="form-control maskCnpj" id="input_cnpj">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_nome_fantasia">Nome de Fantasia</label>
                        <input type="text" class="form-control" id="input_nome_fantasia">
                      </div>
                    </div>
                  </div>

                  <div class="row mx-0">
                    <button class="btn btn-primary stepper-next">Próximo</button>
                  </div>
                </div>

                <div id="step2" class="content" role="tabpanel" aria-labelledby="step2-trigger">
                  <h4 class="text-primary font-weight-bold text-uppercase mb-4">Endereço</h4>
                  <div class="row mx-0 mb-4">
                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="input_cep">CEP</label>
                        <input type="text" class="form-control maskcep" id="input_cep" name="cep">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="input_numero">Número</label>
                        <input type="text" class="form-control" id="input_numero">
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="input_complemento">Complemento</label>
                        <input type="text" class="form-control" id="input_complemento">
                      </div>
                    </div>
                  </div>

                  <div class="row mx-0 mb-4">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_endereco">Endereço</label>
                        <input type="text" class="form-control" id="input_endereco">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="input_bairro">Bairro</label>
                        <input type="text" class="form-control" id="input_bairro">
                      </div>
                    </div>

                    <div class="col-md-3">
                      <div class="form-group">
                        <label for="input_cidade">Cidade</label>
                        <input type="text" class="form-control" id="input_cidade">
                      </div>
                    </div>

                    <div class="col-md-2">
                      <div class="form-group">
                        <label for="input_estado">Estado</label>
                        <input type="text" class="form-control" id="input_estado">
                      </div>
                    </div>
                  </div>

                  <div class="row mx-0">
                    <div class="form-group col-md-12">
                      <label class="font-weight-bold mb-0">Coordenadas GPS</label>
                    </div>
                  </div>

                  <div class="row mx-0 mb-4">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="input_latitude">Latitude</label>
                        <input type="text" class="form-control" id="input_latitude">
                      </div>
                    </div>

                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="input_longitude">Logintude</label>
                        <input type="text" class="form-control" id="input_longitude">
                      </div>
                    </div>

                    <div class="form-group col-md-2 text-center align-self-center">
                      <a href="#" target="_blank" class="btn btn-link" id="seeMap" data-toggle="tooltip" data-placement="top" title="Veja seu endereço no mapa">
                        <i class="fas fa-map-marked-alt"></i>
                      </a>
                    </div>
                  </div>

                  <div class="row mx-0">
                    <button class="btn btn-primary stepper-prev">Anterior</button>
                    <button class="btn btn-primary stepper-next">Pŕoximo</button>
                  </div>
                </div>

                <div id="step3" class="content" role="tabpanel" aria-labelledby="step3-trigger">
                  <h4 class="text-primary font-weight-bold text-uppercase mb-4">Contato</h4>
                  <div class="row mx-0 mb-4">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_contato_1">Responsável nº 1</label>
                        <input type="text" class="form-control" id="input_contato_1">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_cargo_contato_1">Cargo</label>
                        <input type="text" class="form-control" id="input_cargo_contato_1">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_celular_contato_1">Celular</label>
                        <input type="text" class="form-control maskphone1" id="input_celular_contato_1">
                      </div>
                    </div>
                  </div>

                  <div class="row mx-0 mb-4">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_contato_2">Responsável nº 2</label>
                        <input type="text" class="form-control" id="input_contato_2">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_cargo_contato_2">Cargo</label>
                        <input type="text" class="form-control" id="input_cargo_contato_2">
                      </div>
                    </div>

                     <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_celular_contato_2">Celular</label>
                        <input type="text" class="form-control maskphone2" id="input_celular_contato_2">
                      </div>
                    </div>
                  </div>

                  <div class="row mx-0 mb-4">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_fixo">Fixo</label>
                        <input type="text" class="form-control maskfixo" id="input_fixo">
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_whatsapp">Whatsapp</label>
                        <input type="text" class="form-control maskwhats" id="input_whatsapp">
                      </div>
                    </div>
                   
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="input_email">Email</label>
                        <input type="text" class="form-control" id="input_email">
                      </div>
                    </div>
                  </div>

                  <div class="row mx-0 mb-4">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="input_senha_acesso">Senha Acesso</label>
                        <input type="text" class="form-control" id="input_senha_acesso">
                      </div>
                    </div>

                    <div class="col-md-6" id="capacidadeDiv">
                      <div class="form-group show-label">
                        <label for="capacidade_media_carga">Capacidade Media Carga</label>
                        <input maxlength="12" type="text" class="form-control" id="capacidade_media_carga" disabled>
                        <span class="form-control-feedback">Kg</span>
                      </div>
                    </div>
                  </div>

                  <div class="row m-0">
                    <button class="btn btn-primary stepper-prev">Anterior</button>
                    <button class="btn btn-primary" id="salvarEmpresa" >Salvar</button>
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
    $('#formEmpresa').submit(function(event) {
      event.preventDefault()
    })

    $('body').on('click', '#seeMap', function() {
      const urlMapBase = 'https://www.google.com/maps/search/?api=1'
      const lat = $('#input_latitude').val()
      const lng = $('#input_longitude').val()
      const urlMap = (lat && lng) ? `${urlMapBase}&query=${lat}%2C${lng}` : urlMapBase
      window.open(urlMap, '_blank').focus();
    })
    
    $('body').on('blur', '#input_cnpj', function(event) {
      const isValid = validarCNPJ(event.target.value)
      delFormValidationErrors()
      if (!isValid) {
        const msg = 'CNPJ Invalido!'
        notifyDanger(msg)
        addInputError('input_cnpj', msg)
      }
      $('#salvarEmpresa').attr('disabled', !isValid)
    })
  </script>
@endpush