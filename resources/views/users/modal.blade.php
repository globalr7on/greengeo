<div class="modal fade" id="modalFormUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFormUserTitle"></h5>
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
                <h4 class="text-primary font-weight-bold text-uppercase">Informações Básicas</h4>
                <div class="row m-0">
                  <div class="form-group col-md-6">
                    <input type="hidden" class="form-control" id="inputId">
                    <input type="hidden" class="form-control" id="input_usuario_responsavel_cadastro_id"  value="{{  Auth::user()->id  }}">
                    <label for="input_cpf" class="position-relative mb-0 font-weight-bold">CPF</label>
                    <input type="text" class="form-control maskcpf" id="input_cpf" placeholder="123.456.789-10">
                  </div>

                  <div class="form-group col-md-6">
                    <label for="input_rg" class="position-relative mb-0 font-weight-bold">RG</label>
                    <input type="text" class="form-control maskrg" id="input_rg" placeholder="A-12345678">
                  </div>
                </div>

                <div class="row m-0">
                  <div class="form-group col-md-6"> 
                    <label for="input_name" class="position-relative mb-0 font-weight-bold">Nome</label>
                    <input type="text" class="form-control" id="input_name" placeholder="Nome Completo">
                  </div>
                  
                  <div class="form-group col-md-6">
                    <label for="input_email" class="position-relative mb-0 font-weight-bold">Email</label>
                    <input type="text" class="form-control" id="input_email" placeholder="email@demo.com">
                  </div>
                </div>

                <div class="row m-0">
                  <div class="form-group col-md-4">
                    <label for="input_cargo" class="position-relative mb-0 font-weight-bold">Cargo</label>
                    <input type="text" class="form-control" id="input_cargo" placeholder="Cargo do usuario">
                  </div>

                  <div class="form-group col-md-4 text-center">
                    <label for="input_role_web" class="display-inherit mb-0">Permissão Web</label>
                    <select data-style="btn-warning text-white" title="Select" name="role_web" id="input_role_web"></select>
                  </div>

                  <div class="form-group col-md-4 text-center">
                    <label for="input_role_api" class="display-inherit mb-0">Permissão Api</label>
                    <select data-style="btn-warning text-white" title="Select" name="role_api" id="input_role_api"></select>
                  </div>
                </div>

                <div class="row m-0">
                  <button class="btn btn-primary stepper-next">Próximo</button>
                </div>
              </div>

              <div id="step2" class="content" role="tabpanel" aria-labelledby="step2-trigger">
                <h4 class="text-primary font-weight-bold text-uppercase">Endereço</h4>
                <div class="row m-0">
                  <div class="form-group col-md-6">
                    <label for="input_cep" class="position-relative mb-0 font-weight-bold">CEP</label>
                    <input type="text" class="form-control input_cep" id="input_cep" placeholder="123456-789">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="input_numero" class="position-relative mb-0 font-weight-bold">Número</label>
                    <input type="text" class="form-control" id="input_numero" placeholder="123...">
                  </div>
                </div>

                <div class="row m-0">
                  <div class="form-group col-md-12">
                    <label for="input_complemento" class="position-relative mb-0 font-weight-bold">Complemento</label>
                    <input type="text" class="form-control" id="input_complemento" placeholder="Casa nro ...">
                  </div>
                </div>

                <div class="row m-0">
                   <div class="form-group col-md-6">
                    <label for="input_endereco" class="position-relative mb-0 font-weight-bold">Endereço</label>
                    <input type="text" class="form-control" id="input_endereco" placeholder="Rua agusto ...">
                  </div>
                  
                  <div class="form-group col-md-6">
                    <label for="input_bairro" class="position-relative mb-0 font-weight-bold">Bairro</label>
                    <input type="text" class="form-control" id="input_bairro" placeholder="Nome do bairro">
                  </div>
                </div>

                <div class="row m-0">
                  <div class="form-group col-md-6">
                    <label for="input_cidade" class="position-relative mb-0 font-weight-bold">Cidade</label>
                    <input type="text" class="form-control" id="input_cidade" placeholder="Nome da cidade">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="input_estado" class="position-relative mb-0 font-weight-bold">Estado</label>
                    <input type="text" class="form-control" id="input_estado" placeholder="No do Estado">
                  </div>
                </div>

                <div class="row m-0">
                  <button class="btn btn-primary stepper-prev">Anterior</button>
                  <button class="btn btn-primary stepper-next">Próximo</button>
                </div>
              </div>

              <div id="step3" class="content" role="tabpanel" aria-labelledby="step3-trigger">
                <h4 class="text-primary font-weight-bold text-uppercase">Contato</h4>
                <div class="row m-0">
                  <div class="form-group col-md-4">
                    <label for="input_celular" class="position-relative mb-0 font-weight-bold">Celular</label>
                    <input type="text" class="form-control maskphone1" id="input_celular" placeholder="+55..">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="input_fixo" class="position-relative mb-0 font-weight-bold">Fixo</label>
                    <input type="text" class="form-control maskfixo" id="input_fixo" placeholder="+55..">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="input_whats" class="position-relative mb-0 font-weight-bold">Whatsapp</label>
                    <input type="text" class="form-control maskwhats" id="input_whats" placeholder="+55..">
                  </div>
                </div>

                <div class="row m-0">    
                  <div class="form-group col-md-4">
                    <label for="input_registro_carteira" class="position-relative mb-0 font-weight-bold">Registros Carteira</label>
                    <input type="text" class="form-control" id="input_registro_carteira" placeholder="...">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="input_tipo_carteira" class="position-relative mb-0 font-weight-bold">Tipo de Carteira</label>
                    <input type="text" class="form-control" id="input_tipo_carteira" placeholder="...">
                  </div>
                  <div class="form-group col-md-4">
                    <label for="input_validade_carteira" class="position-relative mb-0 font-weight-bold">Validade de Carteira</label>
                    <input type="text" class="form-control datepicker" id="input_validade_carteira" placeholder="...">
                  </div>
                </div>
                <div class="row m-0">
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