<div class="modal fade" id="modalFormUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left" id="modalFormUserTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body p-2">
        <form id="formUser">
          <div class="bs-stepper">
            <div class="bs-stepper-header" role="tablist">
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
              
            <div class="bs-stepper-content">
              <div id="step1" class="content" role="tabpanel" aria-labelledby="step1-trigger">
                <h4 class="text-primary font-weight-bold text-uppercase mb-4">Informações Básicas</h4>
                <div class="row mx-0 mb-4">
                  <div class="col-md-6 text-center">
                    <div class="form-group">
                      <label for="input_tipo_empresa_id" class="display-inherit mb-0">Tipo de Empresa</label>
                      <select id="input_tipo_empresa_id" data-style="btn-warning text-white" title="Single Select" name="tipo_empresa" >
                        <option value="" disabled selected>Seleccione</option>
                      </select>
                    </div>
                  </div>

                  <div class="col-md-6 text-center">
                    <div class="form-group">
                      <label for="input_pessoa_juridica_id" class="display-inherit mb-0">Empresa</label>
                      <select id="input_pessoa_juridica_id" data-style="btn-warning text-white" title="Single Select" name="empresa" >
                        <option value="" disabled selected>Seleccione</option>
                      </select>
                    </div>
                  </div>
                </div>

                <div class="row mx-0 mb-4">
                  <div class="col-md-6">
                    <div class="form-group">
                      <input type="hidden" class="form-control" id="inputId">
                      <input type="hidden" class="form-control" id="input_usuario_responsavel_cadastro_id"  value="{{  Auth::user()->id  }}">
                      <label for="input_cpf">CPF</label>
                      <input type="text" class="form-control maskcpf" id="input_cpf" placeholder="123.456.789-10">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="input_rg">RG</label>
                      <input type="text" class="form-control maskrg" id="input_rg" placeholder="A-12345678">
                    </div>
                  </div>
                </div>

                <div class="row mx-0 mb-4">
                  <div class="col-md-6"> 
                    <div class="form-group"> 
                      <label for="input_name">Nome</label>
                      <input type="text" class="form-control" id="input_name" placeholder="Nome Completo">
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="input_email">Email</label>
                      <input type="text" class="form-control" id="input_email" placeholder="email@demo.com">
                    </div>
                  </div>
                </div>

                <div class="row mx-0 mb-4">
                  <div class="col-md-4 align-self-center">
                    <div class="form-group">
                      <label for="input_cargo">Cargo</label>
                      <input type="text" class="form-control" id="input_cargo" placeholder="Cargo do usuario">
                    </div>
                  </div>

                  <div class="col-md-4 text-center">
                    <div class="form-group">
                      <label for="input_role_web" class="display-inherit mb-0 text-left">Função Web</label>
                      <select data-style="btn-warning text-white" title="Select" name="role_web" id="input_role_web"></select>
                    </div>
                  </div>

                  <div class="col-md-4 text-center">
                    <div class="form-group">
                      <label for="input_role_api" class="display-inherit mb-0 text-left">Função Api</label>
                      <select data-style="btn-warning text-white" title="Select" name="role_api" id="input_role_api"></select>
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
                      <input type="text" class="form-control maskcep" id="input_cep" placeholder="123456-789">
                    </div>
                  </div>

                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="input_numero">Número</label>
                      <input type="text" class="form-control" id="input_numero" placeholder="123...">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="input_complemento">Complemento</label>
                      <input type="text" class="form-control" id="input_complemento" placeholder="Casa nro ...">
                    </div>
                  </div>
                </div>

                <div class="row mx-0 mb-4">
                   <div class="col-md-6">
                    <div class="form-group">
                      <label for="input_endereco">Endereço</label>
                      <input type="text" class="form-control" id="input_endereco" placeholder="Rua agusto ...">
                    </div>
                  </div>
                  
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="input_bairro">Bairro</label>
                      <input type="text" class="form-control" id="input_bairro" placeholder="Nome do bairro">
                    </div>
                  </div>
                </div>

                <div class="row mx-0 mb-4">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="input_cidade">Cidade</label>
                      <input type="text" class="form-control" id="input_cidade" placeholder="Nome da cidade">
                    </div>
                  </div>

                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="input_estado">Estado</label>
                      <input type="text" class="form-control" id="input_estado" placeholder="No do Estado">
                    </div>
                  </div>
                </div>

                <div class="row mx-0">
                  <button class="btn btn-primary stepper-prev">Anterior</button>
                  <button class="btn btn-primary stepper-next">Próximo</button>
                </div>
              </div>

              <div id="step3" class="content" role="tabpanel" aria-labelledby="step3-trigger">
                <h4 class="text-primary font-weight-bold text-uppercase mb-4">Contato</h4>
                <div class="row mx-0 mb-4">
                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="input_celular">Celular</label>
                      <input type="text" class="form-control maskphone1" id="input_celular" placeholder="+55..">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="input_fixo">Fixo</label>
                      <input type="text" class="form-control maskfixo" id="input_fixo" placeholder="+55..">
                    </div>
                  </div>

                  <div class="col-md-4">
                    <div class="form-group">
                      <label for="input_whats">Whatsapp</label>
                      <input type="text" class="form-control maskwhats" id="input_whats" placeholder="+55..">
                    </div>
                  </div>
                </div>

       
                <div class="row mx-0 mb-4" id="motorista">
                  <div class="col-md-4 text-center" >
                  <div class="form-group m-0 p-0">
                    <label for="input_tipo_carteira" class="display-inherit mb-0">Tipo de Carteira</label>
                    <select id="input_tipo_carteira" data-style="btn-warning text-white" title="Single Select" name="tipo_carteira">
                      <option value="" disabled selected>Seleccione</option>
                    </select>
                  </div>
                </div>

                  <div class="col-md-4 align-self-center ">
                    <div class="form-group">
                      <label for="input_registro_carteira">Registros Carteira</label>
                      <input type="text" class="form-control maskcarteira" id="input_registro_carteira" placeholder="...">
                    </div>
                  </div>

                  <div class="col-md-4 align-self-center  ">
                    <div class="form-group">
                      <label for="input_validade_carteira">Validade de Carteira</label>
                      <input type="text" class="form-control datepicker" id="input_validade_carteira" placeholder="...">
                    </div>
                  </div>
                </div>

                <div class="row mx-0">
                  <button class="btn btn-primary stepper-prev">Anterior</button>
                  <button class="btn btn-primary stepper-next" id="salvarUser">Salvar</button>
                </div>
              </div>
            </div>  
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('js')
  <script>
    $('#formUser').submit(function(event) {
      event.preventDefault()
    })
  </script>
@endpush