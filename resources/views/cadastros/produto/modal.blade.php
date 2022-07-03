<div class="modal fade" id="modalProduto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-left" id="tituloModal">Nova Produto</h5>
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
            <form id="formProduto">
              <div class="bs-stepper-content">
                <!-- your steps content here -->
                <div id="step1" class="content" role="tabpanel" aria-labelledby="step1-trigger">
                  {{-- <h4 class="text-primary font-weight-bold text-uppercase">Informações Básicas</h4> --}}
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
                      <label for="input_usuario_responsavel_cadastro_id" class="position-relative mb-0 font-weight-bold">Responsavel</label>
                      <input type="hidden" class="form-control" id="input_usuario_responsavel_cadastro_id"  value="{{  Auth::user()->id  }}">
                      <input type="text" class="form-control" value="{{  Auth::user()->name }}" disabled >
                    </div>
                    
                  </div>

                  <div class="row m-0">
                   <div class="form-group col-md-4">
                      <label for="input_nome_fabricante" class="position-relative mb-0 font-weight-bold">Nome de Fabricante</label>
                      <input type="text" class="form-control" id="input_nome_fabricante">
                      <input type="hidden" class="form-control" id="input_id">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="input_peso_bruto" class="position-relative mb-0 font-weight-bold">Peso Bruto</label>
                      <input type="text" class="form-control" id="input_peso_bruto">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="input_peso_liquido" class="position-relative mb-0 font-weight-bold">Peso Liquido</label>
                      <input type="text" class="form-control" id="input_peso_liquido">
                    </div>
                    
                  </div>

                  <div class="row m-0">
                    <div class="form-group col-md-4">
                      <label for="input_dimensoes" class="position-relative mb-0 font-weight-bold">Dimensões</label>
                      <input type="text" class="form-control" id="input_dimensoes">
                    </div>
                    <div class="form-group col-md-4">
                      <label for="input_altura" class="position-relative mb-0 font-weight-bold">Altura</label>
                      <input type="text" class="form-control" id="input_altura">
                    </div>  
                    <div class="form-group col-md-4">
                      <label for="input_largura" class="position-relative mb-0 font-weight-bold">Largura</label>
                      <input type="text" class="form-control" id="input_largura">
                    </div>  
                   
                  </div>
                  <button class="btn btn-warning">Itens</button>
                  <button class="btn btn-primary stepper-next">Próximo</button>
                </div>

                <div id="step2" class="content" role="tabpanel" aria-labelledby="step2-trigger">
                  <div class="row m-0">
                     <div class="form-group col-md-3">
                      <label for="input_profundidade" class="position-relative mb-0 font-weight-bold">Profundidade</label>
                      <input type="text" class="form-control" id="input_profundidade">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="input_comprimento" class="position-relative mb-0 font-weight-bold">Comprimento</label>
                      <input type="text" class="form-control" id="input_comprimento">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="input_especie" class="position-relative mb-0 font-weight-bold">Especie</label>
                      <input type="text" class="form-control" id="input_especie">
                    </div>
                    <div class="form-group col-md-3">
                      <label for="input_marca" class="position-relative mb-0 font-weight-bold">Marca</label>
                      <input type="text" class="form-control" id="input_marca">
                    </div>
                  </div>

                  <div class="row m-0">
                    <div class="form-group col-md-6">
                      <label for="input_pessoa_juridica_id" class="position-relative mb-0 font-weight-bold">Empresa</label>
                      <input type="text" class="form-control" id="input_pessoa_juridica_id">
                    </div>
                    <div class="form-group col-md-6">
                      <label for="input_material_id" class="position-relative mb-0 font-weight-bold">Material</label>
                      <input type="text" class="form-control" id="input_material_id">
                    </div>
                  </div>

                  <button class="btn btn-warning">Itens</button>
                  <button class="btn btn-primary stepper-prev">Anterior</button>
                  <button class="btn btn-primary"  id="salvarProduto" >Salvar</button>
                </div>

                {{-- <div id="step3" class="content" role="tabpanel" aria-labelledby="step3-trigger">
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
                      <input type="text" class="form-control" id="input_celular_contato_1">
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
                      <input type="text" class="form-control" id="input_celular_contato_2">
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
                </div>


                  <button class="btn btn-warning" >Motorista</button>
                  <button class="btn btn-warning"id="#novoVeiculo">Veiculo</button>
                  <button class="btn btn-primary stepper-prev">Anterior</button>
                  <button class="btn btn-primary"  id="salvarEmpresa" >Salvar</button> --}}
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
    $('#formProduto').submit(function(event) {
      event.preventDefault()
    })
  </script>
@endpush