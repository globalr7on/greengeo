<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Criar Novo Usuario</h5>
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
                  <div class="form-group col-md-6 text-center">
                  <label for="inputTipo" class="display-inherit mb-0">Tipo de Usuario</label>
                    <select class="selectpicker" data-style="btn-warning text-white" title="Single Select" name="tipo">
                      <option value="" disabled selected>Tipo</option>
                      <option value="usuario">Usario </option>
                      <option value="operador">Operador</option>
                      <option value="motorista">Motorista</option>

                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputCpf" class="position-relative mb-0 font-weight-bold">CPF</label>
                    <input type="text" class="form-control" id="inputCpf" placeholder="123.456.789-10">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputRg" class="position-relative mb-0 font-weight-bold">CPF</label>
                    <input type="text" class="form-control" id="inputRg" placeholder="A-12345678">
                  </div>
                  <div class="form-group col-md-6"> 
                    <label for="inputNome" class="position-relative mb-0 font-weight-bold">Nome</label>
                    <input type="text" class="form-control" id="inputNome" placeholder="Nome Completo">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputEmail" class="position-relative mb-0 font-weight-bold">Email</label>
                    <input type="text" class="form-control" id="inputEmail" placeholder="email@demo.com">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputCargo" class="position-relative mb-0 font-weight-bold">Cargo</label>
                    <input type="text" class="form-control" id="inputCargo" placeholder="Cargo do usuario">
                  </div> 
                </div>  
                <!-- <button class="btn btn-warning">Motorista</button>
                <button class="btn btn-warning">Veiculo</button> -->
                <button class="btn btn-primary stepper-next">Próximo</button>
            </div>
            <div id="step2" class="content" role="tabpanel" aria-labelledby="step2-trigger">
              <h4 class="text-primary font-weight-bold text-uppercase">Endereço</h4>
                <div class="row m-0">
                  <div class="form-group col-md-6">
                    <label for="inputEndereco" class="position-relative mb-0 font-weight-bold">Endereço</label>
                    <input type="text" class="form-control" id="inputEndereco" placeholder="Rua agusto ...">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputNumero" class="position-relative mb-0 font-weight-bold">Número</label>
                    <input type="text" class="form-control" id="inputNumero" placeholder="123...">
                  </div>
                  <div class="form-group col-md-12">
                    <label for="inputComplemento" class="position-relative mb-0 font-weight-bold">Complemento</label>
                    <input type="text" class="form-control" id="inputComplemento" placeholder="Casa nro ...">
                  </div>
                </div>
                <div class="row m-0">
                  <div class="form-group col-md-6">
                    <label for="inputCep" class="position-relative mb-0 font-weight-bold">CEP</label>
                    <input type="text" class="form-control" id="inputCep" placeholder="123456-789">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputBairro" class="position-relative mb-0 font-weight-bold">Bairro</label>
                    <input type="text" class="form-control" id="inputBairro" placeholder="Nome do bairro">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputCidade" class="position-relative mb-0 font-weight-bold">Cidade</label>
                    <input type="text" class="form-control" id="inputCidade" placeholder="Nome da cidade">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputEstado" class="position-relative mb-0 font-weight-bold">Estado</label>
                    <input type="text" class="form-control" id="inputEstado" placeholder="No do Estado">
                  </div>
                </div>
                <!-- <button class="btn btn-warning">Motorista</button>
                <button class="btn btn-warning">Veiculo</button> -->
                <button class="btn btn-primary stepper-prev">Anterior</button>
                <button class="btn btn-primary stepper-next">Próximo</button>
            </div>

            <div id="step3" class="content" role="tabpanel" aria-labelledby="step3-trigger">
                <h4 class="text-primary font-weight-bold text-uppercase">Contato</h4>
                <div class="row m-0">
                    <div class="form-group col-md-4">
                      <label for="inputCelular" class="position-relative mb-0 font-weight-bold">Celular</label>
                      <input type="text" class="form-control" id="inputCelular" placeholder="+55..">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputFixo" class="position-relative mb-0 font-weight-bold">Fixo</label>
                      <input type="text" class="form-control" id="inputFixo" placeholder="+55..">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="inputWhats" class="position-relative mb-0 font-weight-bold">Whatsapp</label>
                      <input type="text" class="form-control" id="inputWhats" placeholder="+55..">
                    </div>
                  </div>
                <div class="row m-0">    
                  <div class="form-group col-md-6">
                    <label for="inputRcarteira" class="position-relative mb-0 font-weight-bold">Registros Carteira</label>
                    <input type="text" class="form-control" id="inputRcarteira" placeholder="...">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputTcarteira" class="position-relative mb-0 font-weight-bold">Tipo de Carteira</label>
                    <input type="text" class="form-control" id="inputTcarteira" placeholder="...">
                  </div>
                </div>
                <div class="row m-0">
                  <div class="form-group col-md-6">
                    <label for="inputVcarteira" class="position-relative mb-0 font-weight-bold">Validade de Carteira</label>
                    <input type="text" class="form-control" id="inputVcarteira" placeholder="...">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputUsuarioResponsavel" class="position-relative mb-0 font-weight-bold">Usuario responsable </label>
                    <input type="text" class="form-control" id="inputUsuarioResponsavel" placeholder="...">
                  </div>
                </div>
                <div class="row m-0">
                  <div class="form-group col-md-6">
                    <label for="inputIdenticadorCelular" class="position-relative mb-0 font-weight-bold">Identificador de Celular</label>
                    <input type="text" class="form-control" id="inputIdenticadorCelular" placeholder="...">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputSenha" class="position-relative mb-0 font-weight-bold">Senha Acesso</label>
                    <input type="text" class="form-control" id="inputSenha" placeholder="********">
                  </div>
                  <!-- <button class="btn btn-warning">Motorista</button>
                  <button class="btn btn-warning">Veiculo</button> -->
                  <button class="btn btn-primary stepper-prev">Anterior</button>
                  <button class="btn btn-primary stepper-next">Enviar</button>
                </div>
              </div>
            </div>  
          </div>
        </div>
      </div>
    </div>
  </div>


@push('js')
<script>
  $(document).ready(function () {
    // Stepper
    var stepper = new Stepper($('.bs-stepper')[0])
    $('.stepper-next').on('click', function (e) {
      stepper.next()
    })
    $('.stepper-prev').on('click', function (e) {
      stepper.previous()
    })
    // Stepper
  })
</script>

@endpush