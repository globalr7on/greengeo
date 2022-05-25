@extends('layouts.app', ['activePage' => 'empresa', 'titlePage' => __('Empresa')])
@section('css')
    <!-- <link rel="stylesheet" href="//cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> -->
@endsection
@section('subheaderTitle')
  Empresa
@endsection
@section('content')
  <div class="content mt-0">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novaEmpresa">
         + Nova Empresa
        </button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Empresas</h4>
              <p class="card-category"> Empresas Cadastradas</p>
            </div>
            <div class="card-body">
              <!-- <div class="table-responsive"> -->
              <div>
                <table class="table" id="empresaTbl">
                  <thead class="text-primary">
                    <th>Tipo</th>
                    <th>CNPJ</th>
                    <th>Fantasia</th>
                    <th>Razao Social</th>
                    <th>Email</th>
                    <th>Contato1</th>
                    <th>Cargo Contato1</th>
                    <th>Celular Contato1</th>
                    <th>Contato2</th>
                    <th>Cargo Contato2</th>
                    <th>Celular Contato2</th>
                    <th>Fixo</th>
                    <th>Whatsapp</th>
                    <th>Endereço</th>
                    <th>Número</th>
                    <th>Complemento</th>
                    <th>Cep</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>Latitude</th>
                    <th>Longitude</th>
                    <th>Contrato</th>
                    <th>Identificador</th>
                    <th>Senha Acesso</th>
                    <th>Capacidade Media Carga</th>
                    <th>Ativo</th>
                    <th>Ação</th>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- <div id="myModal" class="modal">
    <div class="modal-contenido">
      <div class="row">
        <div class="col-md-12">
          <form method="post" action="{{ route('profile.update') }}" autocomplete="off" class="form-horizontal">
            @csrf
            @method('put')
            <div class="card ">
              <div class="card-header card-header-primary">
                <h4 class="card-title">{{ __('Editar Acessantes') }}</h4>
                <p class="card-category">{{ __('Information de Acessantes') }}</p>
              </div>
              <div class="card-body ">
                @if (session('status'))
                  <div class="row">
                    <div class="col-sm-12">
                      <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <i class="material-icons">close</i>
                        </button>
                        <span>{{ session('status') }}</span>
                      </div>
                    </div>
                  </div>
                @endif
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors ?? ''->has('name') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors ?? ''->has('name') ? ' is-invalid' : '' }}" name="name" id="input-name" type="text" placeholder="{{ __('Name') }}" value="{{ old('name', auth()->user()->name) }}" required="true" aria-required="true"/>
                      @if ($errors ?? ''->has('name'))
                        <span id="name-error" class="error text-danger" for="input-name">{{ $errors ?? ''->first('name') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
                <div class="row">
                  <label class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                  <div class="col-sm-7">
                    <div class="form-group{{ $errors ?? ''->has('email') ? ' has-danger' : '' }}">
                      <input class="form-control{{ $errors ?? ''->has('email') ? ' is-invalid' : '' }}" name="email" id="input-email" type="email" placeholder="{{ __('Email') }}" value="{{ old('email', auth()->user()->email) }}" required />
                      @if ($errors ?? ''->has('email'))
                        <span id="email-error" class="error text-danger" for="input-email">{{ $errors ?? ''->first('email') }}</span>
                      @endif
                    </div>
                  </div>
                </div>
              </div>
              <div class="card-footer ml-auto mr-auto">
                <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> -->

  <!-- Modal -->
  <div class="modal fade" id="modalEmpresa" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModal">Criar Nova Empresa</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <section class="signup-step-container">
            <div class="container">
              <div class="row d-flex">
                <div class="col-md-12">
                  <div class="wizard">
                    <div class="wizard-inner">
                      <div class="connecting-line"></div>
                      <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active">
                          <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" aria-expanded="true">
                            <span class="round-tab">1</span>
                          </a>
                        </li>
                        <li role="presentation" class="disabled">
                          <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" aria-expanded="false">
                            <span class="round-tab">2</span>
                          </a>
                        </li>
                        <li role="presentation" class="disabled">
                          <a href="#step3" data-toggle="tab" aria-controls="step3" role="tab">
                            <span class="round-tab">3</span>
                          </a>
                        </li>
                        <li role="presentation" class="disabled">
                          <a href="#step4" data-toggle="tab" aria-controls="step4" role="tab">
                            <span class="round-tab">4</span>
                          </a>
                        </li>
                      </ul>
                    </div>
                    
                    <form>
                      <div class="tab-content" id="main_form">
                        <div class="tab-pane active" role="tabpanel" id="step1">
                          <h4 class="text-center">Informações Básicas</h4>
                          <div class="row">
                            <div class="form-group col-md-6">
                              <div class="togglebutton">
                                <label>
                                  <input type="checkbox" checked="" id="checkAtivo">
                                  <span class="toggle"></span>
                                  Ativo?
                                </label>
                              </div>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="inputContrato">Contrato Nro.</label>
                              <input type="text" class="form-control" id="inputContrato">
                            </div>
                            <div class="form-group col-md-6 text-center">
                              <label for="inputTipo">Tipo de Empresa</label>
                              <select class="selectpicker" data-style="btn btn-primary btn-circle" title="Single Select" name="tipo">
                                <option value="" disabled selected>Tipo</option>
                                <option value="gerador">Gerador</option>
                                <option value="transportador">Transportador</option>
                                <option value="destinador">Destinador</option>
                              </select>
                            </div>
                            <div class="form-group col-md-6">
                              <label for="inputTipo">ID Pessoa Juridica</label>
                              <input type="text" class="form-control" id="inputId">
                            </div> 
                            <div class="form-group col-md-6">
                              <label for="inputTipo">Razão Social</label>
                              <input type="text" class="form-control" id="inputRazaoSocial">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="inputTipo">CNPJ</label>
                              <input type="text" class="form-control" id="inputNomeFantasia">
                            </div>   
                          </div>
                          <ul class="list-inline pull-right">
                            <li>
                              <button type="button" class="default-btn next-step">Continue to next step</button>
                            </li>
                          </ul>
                        </div>

                        <div class="tab-pane active" role="tabpanel" id="step2">
                          <div>
                            <h4 class="text-center">Endereço</h4>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-6">
                              <label for="inputTipo">Lougradouro</label>
                              <input type="text" class="form-control" id="inputEndereco">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="inputTipo">Número</label>
                              <input type="text" class="form-control" id="inputNumero">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-6">
                              <label for="inputTipo">Complemento</label>
                              <input type="text" class="form-control" id="inputComplemento">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="inputTipo">CEP</label>
                              <input type="text" class="form-control" id="inputCep">
                              </div>
                            </div>
                          <div class="row">
                            <div class="form-group col-md-6">
                              <label for="inputTipo">BAIRRO</label>
                              <input type="text" class="form-control" id="inputBairro">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="inputTipo">CIDADE</label>
                              <input type="text" class="form-control" id="inputCidade">
                            </div>
                          </div>
                          <div class="row">
                            <div class="form-group col-md-6">
                              <label for="inputTipo">Estado</label>
                              <input type="text" class="form-control" id="inputEstado">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="inputTipo">Latitude</label>
                              <input type="text" class="form-control" id="inputLatitude">
                            </div>
                            <div class="form-group col-md-6">
                              <label for="inputTipo">Logintude</label>
                              <input type="text" class="form-control" id="inputLogitude">
                            </div>   
                          </div>
                          <ul class="list-inline pull-right">
                            <li>
                              <button type="button" class="default-btn prev-step">Back</button>
                            </li>
                            <li>
                              <button type="button" class="default-btn next-step skip-btn">Skip</button>
                            </li>
                            <li>
                              <button type="button" class="default-btn next-step">Continue</button>
                            </li>
                          </ul>
                        </div>

                        <div class="tab-pane active" role="tabpanel" id="step3">
                          <div>
                            <h4 class="text-center">Contato</h4>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <input type="text" class="form-control" id="inputCargoContato1" placeholder="Cargo Contato 1">
                            </div>
                            <div class="form-group col-md-6">
                              <input type="text" class="form-control" id="inputContato2" placeholder="Contato 2">
                            </div>
                            <div class="form-group col-md-6">
                              <input type="text" class="form-control" id="inputCargoContato2" placeholder="Cargo Contato 2">
                            </div>
                            <div class="form-group col-md-6">
                              <input type="text" class="form-control" id="inputCelularContato1" placeholder="Celular Contato 1">
                            </div>
                            <div class="form-group col-md-6">
                              <input type="text" class="form-control" id="inputCelularContato2" placeholder="Celular Contato 2">
                            </div>
                            <div class="form-group col-md-6">
                              <input type="text" class="form-control" id="inputFixo" placeholder="Fixo">
                            </div>
                            <div class="form-group col-md-6">
                              <input type="text" class="form-control" id="inputWhats" placeholder="Whatsapp">
                            </div>
                          </div>
                          <ul class="list-inline pull-right">
                          <li>
                              <button type="button" class="default-btn prev-step">Back</button>
                            </li>
                            <li>
                              <button type="button" class="default-btn next-step skip-btn">Skip</button>
                            </li>
                            <li>
                              <button type="button" class="default-btn next-step">Continue</button>
                            </li>
                          </ul>
                        </div>

                        <div class="tab-pane active" role="tabpanel" id="step4">
                          <div>
                            <h4 class="text-center">informação adicional</h4>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="inputTipo">Email</label>
                              <input type="text" class="form-control" id="inputEmail" placeholder="Email">
                            </div>
                            <div class="form-group col-md-6">
                              <input type="text" class="form-control" id="inputContato1" placeholder="Contato 1">
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-6">
                              <label for="inputTipo">Nome Fantasia</label>
                              <input type="text" class="form-control" id="inputNomeFantasia">
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-4">
                              <input type="text" class="form-control" id="inputIdentidicadorCelular" placeholder="Identidicador Celular">
                            </div>
                          </div>
                          <div class="form-row">
                            <div class="form-group col-md-4">
                              <input type="text" class="form-control" id="inputSenhaAcesso" placeholder="Senha Acesso">
                            </div>
                            <div class="form-group col-md-4">
                              <input type="text" class="form-control" id="inputCapacidadeMediaCarga" placeholder="Capacidade">
                            </div>
                            <div class="form-group col-md-4">
                              <input type="text" class="form-control" id="inputUsuarioResponsable" placeholder="Usuario Responsable">
                            </div>
                          </div>
                          <ul class="list-inline pull-right">
                            <li>
                              <button type="button" class="default-btn prev-step">Back</button>
                            </li>
                            <li>
                              <button type="button" class="default-btn next-step">Finish</button>
                            </li>
                          </ul>
                        </div>

                        <!-- <div class="form-group col-md-6">
                          <button type="submit" class="btn btn-primary">Salvar</button>
                        </div> -->
                        <div class="clearfix"></div>
                      </div>
                    </form> 
                  </div>
                </div>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      console.log('empresaTbl', $('#empresaTbl'))
      $('#empresaTbl').DataTable({
        scrollX: '500px',
        // dom: 'Bfrtip',
        dom: 'Bfrtip',
        buttons: [
                  {
                    extend: 'copy',
                    text: 'Copiar',
                    titleAttr: 'Copiar para Área de Transferência',
                    className: 'btn-secondary',
                    charset: 'UTF-8',
                  },
                  {
                    extend: 'csv',
                    text: 'CSV',
                    titleAttr: 'Exportar a CSV',
                    className: 'btn-secondary',
                    charset: 'UTF-8',
                  },
                  {
                    extend: 'excel',
                    text: 'Excel',
                    titleAttr: 'Exportar a Excel',
                    className: 'btn-secondary',
                    charset: 'UTF-8',
                  },
                  {
                    extend: 'pdf',
                    text: 'PDF',
                    titleAttr: 'Exportar a PDF',
                    className: 'btn-secondary',
                    charset: 'UTF-8',
                  },
                  {
                    extend: 'print',
                    text: 'Imprimir',
                    titleAttr: 'Imprimir Documento',
                    className: 'btn-secondary',
                    charset: 'UTF-8',
                    color: 'black'
                  },
        ],
        ajax: {
          url: '/api/pessoa_juridica',
          dataSrc: 'data'
        },
        columns: [
          { data: "tipo" },
          { data: "cnpj" },
          { data: "nome_fantasia" },
          { data: "razao_social" },
          { data: "email" },
          { data: "contato_1" },
          { data: "cargo_contato_1" },
          { data: "celular_contato_1" },
          { data: "contato_2" },
          { data: "cargo_contato_2" },
          { data: "celular_contato_2" },
          { data: "fixo" },
          { data: "whatsapp" },
          { data: "endereco" },
          { data: "numero" },
          { data: "complemento" },
          { data: "cep" },
          { data: "bairro" },
          { data: "cidade" },
          { data: "estado" },
          { data: "latitude" },
          { data: "longitude" },
          { data: "contrato" },
          { data: "identificador_celular" },
          { data: "senha_acesso" },
          { data: "capacidade_media_carga" },
          { 
            data: "ativo", className: "text-center", render: function (data, type) {
              return data ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'
            }
          }
        ],
        columnDefs : [
          { targets: 1, orderable: false },
          { width: "70px", targets: [0,19,26] },
          { width: "200px", targets: [2,3,4,5,6,7,8,9,10,11,12,13,24,25] },
          { width: "100px", targets: [14,15,16,17,18,20,21,22,23] },
          { 
            targets : 27,
            className: "text-center",
            // width: "70px",
            render : function (data, type, row) {
              return `
                <i class="fa fa-trash cursor-pointer excluirEmpresa" data-id="${row.id}" title="Excluir" ></i>
                &nbsp;
                <i class="fa fa-pen cursor-pointer editarEmpresa" data-id="${row.id}"  title="Editar"></i>
              `
            }
          }
        ],
        // fixedColumns: true
      });
        // Salvar 
    $('body').on('click', '#salvarEmpresa', function(){
      const JSONRequest = {
        tipo: $("#inputTipo").val(),
        cpnj: $("#inputCnpj").val(),
        nome_fantasia: $("#inputNomeFantasia").val(),
        razao_social: $("#inputRazaoSocial").val(),
        email: $("#inputEmail").val(),
        contanto_1: $("#inputContato1").val(),
        cargo_contato_1: $("#inputCargoContato1").val(),
        contato2: $("#inputCargoContato2").val(),
        celular_contato_1: $("#inputCelularContato1").val(),
        celular_contato_2: $("#inputCelularContato2").val(),
        fixo: $("#inputFixo").val(),
        whatsapp: $("#inputWhatsapp").val(),
        endereco: $("#inputEndereco").val(),
        numero: $("#inputNumero").val(),
        complemento: $("#inputComplemento").val(),
        cep: $("#inputCep").val(),
        bairro: $("#inputBairro").val(),
        cidade: $("#inputCidade").val(),
        estado: $("#inputEstado").val(),
        latitude: $("#inputLatitude").val(),
        longitude: $("#inputLongitude").val(),
        contrato: $("#inputContrato").val(),
        identificador_celular: $("#inputIdentificadorCelular").val(),
        senha_acesso: $("#inputSenhaAcesso").val(),
        capacidade_media_carga: $("#inputCapacidadeMediaCarga").val(),
        usuario_responsavel_cadastro_id: $("#inputUsuarioResponsable")
        // ativo: $("#checkAtivo").prop("checked") ? 1 : 0
      }
      const id = $('#inputId').val();
      const method = id ? "PUT" : "POST";
      const urlP= id ? `/api/pessoa_juridica/${id}` : "/api/pessoa_juridica";
      $.ajax({
        type: method,
        url: urlP,
        data: JSONRequest,
        dataType: "json",
        encode: true,
      }).done(function (response) {
        if (response && response.data) {
          $("#modalEmpresa").modal("hide");
          $('#empresaTbl').DataTable().ajax.reload();
        }
      });
    });

    // Open Modal New
    $('body').on('click', '#novaEmpresa', function() {
      $("#modalEmpresa").modal("show");
      $('#tituloModal').text("Nova Empresa");
      $('#inputId').val("");
      $("#inputTipo").val(),
      $("#inputCnpj").val(),
      $("#inputNomeFantasia").val(),
      $("#inputRazaoSocial").val(),
      $("#inputEmail").val(),
      $("#inputContato1").val(),
      $("#inputCargoContato1").val(),
      $("#inputCargoContato2").val(),
      $("#inputCelularContato1").val(),
      $("#inputCelularContato2").val(),
      $("#inputFixo").val(),
      $("#inputWhatsapp").val(),
      $("#inputEndereco").val(),
      $("#inputNumero").val(),
      $("#inputComplemento").val(),
      $("#inputCep").val(),
      $("#inputBairro").val(),
      $("#inputCidade").val(),
      $("#inputEstado").val(),
      $("#inputLatitude").val(),
      $("#inputLongitude").val(),
      $("#inputContrato").val(),
      $("#inputIdentificadorCelular").val(),
      $("#inputSenhaAcesso").val(),
      $("#inputCapacidadeMediaCarga").val(),
      $("#inputUsuarioResponsable").val(),
      $("#checkAtivo").prop("checked", false)
    });

    // Editar
    $('body').on('click', '.editarEmpresa', function() {
      const empresa_id = $(this).attr('data-id');
      $.ajax({
        type: "GET",
        url: `/api/pessao_juridica/${empresa_id}`,
      }).done(function (response) {
        if (response && response.data) {
          $("#modalEmpresa").modal("show");
          $('#tituloModal').text("Editar Empresa")
          $('#inputId').val(response.data.id);
          $("#inputTipo").val(response.data.tipo),
          $("#inputCnpj").val(response.data.cnpj),
          $("#inputNomeFantasia").val(response.data.nome_fantasia),
          $("#inputRazaoSocial").val(response.data.razao_social),
          $("#inputEmail").val(response.data.email),
          $("#inputContato1").val(response.data.contato_1),
          $("#inputCargoContato1").val(response.data.cargo_contato_1),
          $("#inputContato2").val(response.data.contato_2),
          $("#inputCargoContato2").val(response.data.cargo_contato_2),
          $("#inputCelularContato1").val(response.data.celular_contato_1),
          $("#inputCelularContato2").val(response.data.celular_contato_2),
          $("#inputFixo").val(response.data.fixo),
          $("#inputWhatsapp").val(response.data.whatsapp),
          $("#inputEndereco").val(response.data.enderco),
          $("#inputNumero").val(response.data.numero),
          $("#inputComplemento").val(response.data.complemento),
          $("#inputCep").val(response.data.cep),
          $("#inputBairro").val(response.data.bairro),
          $("#inputCidade").val(response.data.cidade),
          $("#inputEstado").val(response.data.estado),
          $("#inputLatitude").val(response.data.latitude),
          $("#inputLongitude").val(response.data.longitude),
          $("#inputContrato").val(response.data.contrato),
          $("#inputIdentificadorCelular").val(response.data.identificador_celular),
          $("#inputSenhaAcesso").val(response.data.senha_acesso),
          $("#inputCapacidadeMediaCarga").val(response.data.capacidade_media_carga),
          $("#inputUsuarioResponsable").val(response.data.usuario_responsavel_cadastro_id),
          $("#checkAtivo").prop("checked", response.data.ativo)
        }
      });
    });

    // Excluir
    $('body').on('click', '.excluirEmpresa',  function() {
      const empresa_id = $(this).attr('data-id');
      if (confirm('Aviso! Deseja realmente excluir á Empresa?')) {
        $.ajax({
          type: "DELETE",
          url:  `/api/pessoa_juridica/${empresa_id}`,
        }).done(function (response) {
          $('#empresaTbl').DataTable().ajax.reload();
        });
      }
    });
  });

  </script>
@endpush