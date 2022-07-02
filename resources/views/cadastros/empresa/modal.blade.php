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
                  <h4 class="text-primary font-weight-bold text-uppercase">Informações Básicas</h4>
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
                      <label for="input_contrato" class="position-relative mb-0 font-weight-bold">Contrato Nro.</label>
                      <input type="text" class="form-control" id="input_contrato">
                      <input type="hidden" class="form-control" id="input_id">
                    </div>
                  </div>

                  <div class="row m-0">
                    <div class="form-group col-md-4 text-center">
                      <label for="input_tipo_empresa_id" class="display-inherit mb-0">Tipo de Empresa</label>
                      <select id="input_tipo_empresa_id" data-style="btn-warning text-white" title="Single Select" name="tipo" >
                        <option value="" disabled selected>Seleccione</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="input_atividade_id" class="display-inherit mb-0">Tipo de Atividade</label>
                      <select id="input_atividade_id" data-style="btn btn-warning text-white rounded" title="Single Select" name="input_atividade_id">
                        <option value="" disabled selected>Atividade</option>
                      </select>
                    </div>
                    <div class="form-group col-md-4">
                      <label for="input_usuario_responsavel_cadastro_id" class="position-relative mb-0 font-weight-bold">Usuario Responsavel</label>
                      <input type="hidden" class="form-control" id="input_usuario_responsavel_cadastro_id"  value="{{  Auth::user()->id  }}">
                      <input type="text" class="form-control" value="{{  Auth::user()->name }}" disabled >
                    </div>
                  </div>

                  <div class="row m-0">
                    <div class="form-group col-md-3">
                      <label for="input_razao_social" class="position-relative mb-0 font-weight-bold">Razão Social</label>
                      <input type="text" class="form-control" id="input_razao_social">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="input_cnpj" class="position-relative mb-0 font-weight-bold " placeholder="00.000.000/0000-00">CNPJ</label>
                      <input type="text" class="form-control maskCnpj" id="input_cnpj">
                    </div>  
                    <div class="form-group col-md-3">
                      <label for="input_nome_fantasia" class="position-relative mb-0 font-weight-bold">Nome de Fantasia</label>
                      <input type="text" class="form-control" id="input_nome_fantasia">
                    </div>  
                   
                  </div>
                  <button class="btn btn-warning">Motorista</button>
                  <button class="btn btn-warning">Veiculo</button>
                  <button class="btn btn-primary stepper-next">Próximo</button>
                </div>

                <div id="step2" class="content" role="tabpanel" aria-labelledby="step2-trigger">
                  <h4 class="text-primary font-weight-bold text-uppercase">Endereço</h4>

                  <div class="row m-0">
                     <div class="form-group col-md-3">
                      <label for="input_cep" class="position-relative mb-0 font-weight-bold">CEP</label>
                      <input type="text" class="form-control maskcep" id="input_cep"  name="input_cep">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="input_endereco" class="position-relative mb-0 font-weight-bold">Endereço</label>
                      <input type="text" class="form-control" id="input_endereco">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="input_numero" class="position-relative mb-0 font-weight-bold">Número</label>
                      <input type="text" class="form-control" id="input_numero">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="input_complemento" class="position-relative mb-0 font-weight-bold">Complemento</label>
                      <input type="text" class="form-control" id="input_complemento">
                    </div>
                   
                  </div>

                  <div class="row m-0">
                    <div class="form-group col-md-4">
                      <label for="input_bairro" class="position-relative mb-0 font-weight-bold">Bairro</label>
                      <input type="text" class="form-control" id="input_bairro">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="input_cidade" class="position-relative mb-0 font-weight-bold">Cidade</label>
                      <input type="text" class="form-control" id="input_cidade">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="input_estado" class="position-relative mb-0 font-weight-bold">Estado</label>
                      <input type="text" class="form-control" id="input_estado">
                    </div>
                  </div>
                   <div class="row m-0">
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
                  </div>
                  <button class="btn btn-warning">Motorista</button>
                  <button class="btn btn-warning">Veiculo</button>
                  <button class="btn btn-primary stepper-prev">Anterior</button>
                  <button class="btn btn-primary stepper-next">Pŕoximo</button>
                </div>

                <div id="step3" class="content" role="tabpanel" aria-labelledby="step3-trigger">
                  <h4 class="text-primary font-weight-bold text-uppercase">Contato</h4>
                   <div class="row m-0">
                    <div class="form-group col-md-4">
                      <label for="input_contato_1" class="position-relative mb-0 font-weight-bold">Responsável nº 1</label>
                      <input type="text" class="form-control" id="input_contato_1">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="input_cargo_contato_1" class="position-relative mb-0 font-weight-bold">Cargo</label>
                      <input type="text" class="form-control" id="input_cargo_contato_1">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="input_celular_contato_1" class="position-relative mb-0 font-weight-bold">Celular</label>
                      <input type="text" class="form-control maskphone1" id="input_celular_contato_1">
                    </div>
                  </div>
                   <div class="row m-0">
                    <div class="form-group col-md-4">
                      <label for="input_cargo_contato_2" class="position-relative mb-0 font-weight-bold">Responsável nº 2</label>
                      <input type="text" class="form-control" id="input_cargo_contato_2">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="input_cargo_contato_2" class="position-relative mb-0 font-weight-bold">Cargo</label>
                      <input type="text" class="form-control" id="input_cargo_contato_2">
                    </div>
                     <div class="form-group col-md-4">
                      <label for="input_celular_contato_2" class="position-relative mb-0 font-weight-bold">Celular</label>
                      <input type="text" class="form-control maskphone2" id="input_celular_contato_2">
                    </div>          
                  </div>

                  <div class="row m-0">
                    <div class="form-group col-md-4">
                      <label for="input_fixo" class="position-relative mb-0 font-weight-bold">Fixo</label>
                      <input type="text" class="form-control maskfixo" id="input_fixo">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="input_whatsapp" class="position-relative mb-0 font-weight-bold">Whatsapp</label>
                      <input type="text" class="form-control maskwhats" id="input_whatsapp">
                    </div>
                   
                    <div class="form-group col-md-4">
                      <label for="input_email" class="position-relative mb-0 font-weight-bold">Email</label>
                      <input type="text" class="form-control" id="input_email">
                    </div>
                  </div>
                <div class="row m-0">
                  <div class="form-group col-md-6">
                      <label for="input_capacidade_media_carga" class="position-relative mb-0 font-weight-bold">Capacidade Carga</label>
                      <input type="text" class="form-control maskpeso" id="input_capacidade_media_carga" placeholder="000000000.00 kg">kg
                    </div>
                   {{-- <div class="form-group col-md-4">
                      <label for="input_identificador_celular" class="position-relative mb-0 font-weight-bold">Identificador Celular</label>
                      <input type="text" class="form-control" id="input_identificador_celular">
                    </div> --}}
                    <div class="form-group col-md-6">
                      <label for="input_senha_acesso" class="position-relative mb-0 font-weight-bold">Senha Acesso</label>
                      <input type="text" class="form-control" id="input_senha_acesso">
                    </div>   
                </div>
                  <button class="btn btn-warning" >Motorista</button>
                  <button class="btn btn-warning"id="#novoVeiculo">Veiculo</button>
                  <button class="btn btn-primary stepper-prev">Anterior</button>
                  <button class="btn btn-primary"  id="salvarEmpresa" >Salvar</button>
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

  </script>
@endpush