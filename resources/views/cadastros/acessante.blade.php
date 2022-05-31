@extends('layouts.app', ['activePage' => 'acessante', 'titlePage' => __('Perfil Usuarios')])
@section('css')
@endsection
@section('subheaderTitle')
  Usuarios
@endsection
@section('content')
  <div class="content mt-0">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalExemplo">+ Novo Pessoa</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title ">Usuarios</h4>
              <p class="card-category"> Usuarios Cadastrados</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="pessoaTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Tipo</th>
                    <th class="text-primary font-weight-bold">CPF</th>
                    <th class="text-primary font-weight-bold">Rg</th>
                    <th class="text-primary font-weight-bold">Nome</th>
                    <th class="text-primary font-weight-bold">email</th>
                    <th class="text-primary font-weight-bold">Cargo</th>
                    <th class="text-primary font-weight-bold">Celular</th>
                    <th class="text-primary font-weight-bold">Fixo</th>
                    <th class="text-primary font-weight-bold">Whatsapp</th>
                    <th class="text-primary font-weight-bold">Endereço</th>
                    <th class="text-primary font-weight-bold">Número</th>
                    <th class="text-primary font-weight-bold">Complemento</th>
                    <th class="text-primary font-weight-bold">CEP</th>
                    <th class="text-primary font-weight-bold">Bairro</th>
                    <th class="text-primary font-weight-bold">Cidade</th>
                    <th class="text-primary font-weight-bold">Estado</th>
                    <th class="text-primary font-weight-bold">Registro de Carteira</th>
                    <th class="text-primary font-weight-bold">Tipo de Carteira</th>
                    <th class="text-primary font-weight-bold">Validade de Carteira</th>
                    <th class="text-primary font-weight-bold">Ativo</th>
                    <th class="text-primary font-weight-bold">Identificador Celular</th>
                    <th class="text-primary font-weight-bold">Senha de Acesso</th>
                    <th class="text-primary font-weight-bold">Usuario Responsavel</th>
                    <th class="text-primary font-weight-bold">Ação</th>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="modalExemplo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
</div> 
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      $('#pessoaTbl').DataTable({
       language: {
            "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
        },
        scrollX: '500px',
        dom: 'Bfrtip',
        buttons: [
          {
            extend: 'copyHtml5',
            text: 'Copiar',
            titleAttr: 'Copiar para Área de Transferência',
            className: 'btn-default-light rounded-0 mr-1 py-2 font-weight-bold',
            charset: 'UTF-8',
          },
          {
            extend: 'csv',
            text: 'CSV',
            titleAttr: 'Exportar a CSV',
            className: 'btn-default-light rounded-0 mr-1 py-2 font-weight-bold',
            charset: 'UTF-8',
          },
          {
            extend: 'excel',
            text: 'Excel',
            titleAttr: 'Exportar a Excel',
            className: 'btn-default-light rounded-0 mr-1 py-2 font-weight-bold',
            charset: 'UTF-8',
          },
          {
            extend: 'pdf',
            text: 'PDF',
            titleAttr: 'Exportar a PDF',
            className: 'btn-default-light rounded-0 mr-1 py-2 font-weight-bold',
            charset: 'UTF-8',
          },
          {
            extend: 'print',
            text: 'Imprimir',
            titleAttr: 'Imprimir Documento',
            className: 'btn-default-light rounded-0 mr-1 py-2 font-weight-bold',
            charset: 'UTF-8',
            color: 'black'
          },
        ],
        ajax: {
          url: '/api/acessantes',
          dataSrc: 'data'
        },
        columns: [
          { data: "pessoa_juridica_id" },
          { data: "cpf" },
          { data: "rg" },
          { data: "nome" },
          { data: "email" },
          { data: "cargo" },
          { data: "celular" },
          { data: "fixo" },
          { data: "whats" },
          { data: "endereco" },
          { data: "numero" },
          { data: "complemento" },
          { data: "cep" },
          { data: "bairro" },
          { data: "cidade" },
          { data: "estado" },
          { data: "registro_carteira" },
          { data: "tipo_carteira" },
          { data: "validade_carteira" },
          { data: "ativo" },
          { data: "identificador_celular" },
          { data: "senha_acesso" },
          { data: "usuario_responsavel_cadastro_id" },
        
 
        ],
        columnDefs : [
          { width: "90", targets: [0,1,2,5,6,7,8,10,15,14] },
          { width: "200px", targets: [9,11,16,17,18,19,20,21,22] },
          { width: "110px", targets: [3,4,12,13] },
          { 
            targets : 23,
            render : function (data, type, row) {
              return `
                <i class="fa fa-trash excluirAcond" data-id="${row.id}" title="Excluir" ></i>
                &nbsp;
                <i class="fa fa-pen editarAcond" data-id="${row.id}" data-toggle="modal" data-target="#modalExemplo" title="Editar"></i>
              `
            }
          }
        ],
      });
     // Stepper
     var stepper = new Stepper($('.bs-stepper')[0])
      $('.stepper-next').on('click', function (e) {
        stepper.next()
      })
      $('.stepper-prev').on('click', function (e) {
        stepper.previous()
      })
      // Stepper
    });
  </script>
@endpush