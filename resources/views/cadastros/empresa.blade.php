@extends('layouts.app', ['activePage' => 'empresa', 'titlePage' => __('Empresa')])
@section('css')
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
              <div>
                <table class="table" id="empresaTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Tipo</th>
                    <th class="text-primary font-weight-bold">CNPJ</th>
                    <th class="text-primary font-weight-bold">Fantasia</th>
                    <th class="text-primary font-weight-bold">Razao Social</th>
                    <th class="text-primary font-weight-bold">Email</th>
                    <th class="text-primary font-weight-bold">Contato1</th>
                    <th class="text-primary font-weight-bold">Cargo Contato1</th>
                    <th class="text-primary font-weight-bold">Celular Contato1</th>
                    <th class="text-primary font-weight-bold">Contato2</th>
                    <th class="text-primary font-weight-bold">Cargo Contato2</th>
                    <th class="text-primary font-weight-bold">Celular Contato2</th>
                    <th class="text-primary font-weight-bold">Fixo</th>
                    <th class="text-primary font-weight-bold">Whatsapp</th>
                    <th class="text-primary font-weight-bold">Endereço</th>
                    <th class="text-primary font-weight-bold">Número</th>
                    <th class="text-primary font-weight-bold">Complemento</th>
                    <th class="text-primary font-weight-bold">Cep</th>
                    <th class="text-primary font-weight-bold">Bairro</th>
                    <th class="text-primary font-weight-bold">Cidade</th>
                    <th class="text-primary font-weight-bold">Estado</th>
                    <th class="text-primary font-weight-bold">Latitude</th>
                    <th class="text-primary font-weight-bold">Longitude</th>
                    <th class="text-primary font-weight-bold">Contrato</th>
                    <th class="text-primary font-weight-bold">Identificador</th>
                    <th class="text-primary font-weight-bold">Senha Acesso</th>
                    <th class="text-primary font-weight-bold">Capacidade Media Carga</th>
                    <th class="text-primary font-weight-bold">Ativo</th>
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
                    <label for="inputContrato" class="position-relative mb-0 font-weight-bold">Contrato Nro.</label>
                    <input type="text" class="form-control" id="inputContrato">
                  </div>
                </div>

                <div class="row m-0">
                  <div class="form-group col-md-6 text-center">
                    <label for="inputTipo" class="display-inherit mb-0">Tipo de Empresa</label>
                    <select class="selectpicker" data-style="btn-warning text-white" title="Single Select" name="tipo" id="inputTipo">
                      <option value="" disabled selected>Seleccione</option>
                      <option value="gerador">Gerador</option>
                      <option value="transportador">Transportador</option>
                      <option value="destinador">Destinador</option>
                    </select>
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputId" class="position-relative mb-0 font-weight-bold">ID Pessoa Juridica</label>
                    <input type="text" class="form-control" id="inputId">
                  </div>
                </div>

                <div class="row m-0">
                  <div class="form-group col-md-6">
                    <label for="inputRazaoSocial" class="position-relative mb-0 font-weight-bold">Razão Social</label>
                    <input type="text" class="form-control" id="inputRazaoSocial">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputNomeFantasia" class="position-relative mb-0 font-weight-bold">CNPJ</label>
                    <input type="text" class="form-control" id="inputNomeFantasia">
                  </div>   
                </div>

                <button class="btn btn-primary stepper-next">Next</button>
              </div>

              <div id="step2" class="content" role="tabpanel" aria-labelledby="step2-trigger">
                <h4 class="text-primary font-weight-bold text-uppercase">Endereço</h4>

                <div class="row m-0">
                  <div class="form-group col-md-6">
                    <label for="inputEndereco" class="position-relative mb-0 font-weight-bold">Lougradouro</label>
                    <input type="text" class="form-control" id="inputEndereco">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputNumero" class="position-relative mb-0 font-weight-bold">Número</label>
                    <input type="text" class="form-control" id="inputNumero">
                  </div>
                </div>

                <div class="row m-0">
                  <div class="form-group col-md-6">
                    <label for="inputComplemento" class="position-relative mb-0 font-weight-bold">Complemento</label>
                    <input type="text" class="form-control" id="inputComplemento">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputCep" class="position-relative mb-0 font-weight-bold">CEP</label>
                    <input type="text" class="form-control" id="inputCep">
                  </div>
                </div>

                <div class="row m-0">
                  <div class="form-group col-md-6">
                    <label for="inputCidade" class="position-relative mb-0 font-weight-bold">Cidade</label>
                    <input type="text" class="form-control" id="inputCidade">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputEstado" class="position-relative mb-0 font-weight-bold">Estado</label>
                    <input type="text" class="form-control" id="inputEstado">
                  </div>
                </div>

                <div class="row m-0">
                  <div class="form-group col-md-6">
                    <label for="inputLatitude" class="position-relative mb-0 font-weight-bold">Latitude</label>
                    <input type="text" class="form-control" id="inputLatitude">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputLogitude" class="position-relative mb-0 font-weight-bold">Logintude</label>
                    <input type="text" class="form-control" id="inputLogitude">
                  </div>   
                </div>

                <button class="btn btn-primary stepper-prev">Previous</button>
                <button class="btn btn-primary stepper-next">Next</button>
              </div>

              <div id="step3" class="content" role="tabpanel" aria-labelledby="step3-trigger">
                <h4 class="text-primary font-weight-bold text-uppercase">Contato</h4>

                <div class="row m-0">
                  <div class="form-group col-md-6">
                    <label for="inputContato1" class="position-relative mb-0 font-weight-bold">Contato 1</label>
                    <input type="text" class="form-control" id="inputContato1">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputCargoContato1" class="position-relative mb-0 font-weight-bold">Cargo</label>
                    <input type="text" class="form-control" id="inputCargoContato1">
                  </div>
                </div>

                <div class="row m-0">
                  <div class="form-group col-md-6">
                    <label for="inputCelularContato1" class="position-relative mb-0 font-weight-bold">Celular</label>
                    <input type="text" class="form-control" id="inputCelularContato1">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputWhats1" class="position-relative mb-0 font-weight-bold">Whatsapp</label>
                    <input type="text" class="form-control" id="inputWhats1">
                  </div>
                </div>

                <div class="row m-0">
                  <div class="form-group col-md-6">
                    <label for="inputContato2" class="position-relative mb-0 font-weight-bold">Contato 2</label>
                    <input type="text" class="form-control" id="inputContato2">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputCargoContato2" class="position-relative mb-0 font-weight-bold">Cargo</label>
                    <input type="text" class="form-control" id="inputCargoContato2">
                  </div>
                </div>

                <div class="row m-0">
                  <div class="form-group col-md-6">
                    <label for="inputCelularContato2" class="position-relative mb-0 font-weight-bold">Celular</label>
                    <input type="text" class="form-control" id="inputCelularContato2">
                  </div>
                  <div class="form-group col-md-6">
                    <label for="inputWhats2" class="position-relative mb-0 font-weight-bold">Whatsapp</label>
                    <input type="text" class="form-control" id="inputWhats2">
                  </div>
                </div>

                <button class="btn btn-primary stepper-prev">Previous</button>
                <button class="btn btn-primary">Enviar</button>
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
      $('#empresaTbl').DataTable({
        scrollX: '500px',
        // dom: 'Bfrtip',
        dom: 'Bfrtip',
        buttons: [
          {
            extend: 'copy',
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
            render : function (data, type, row) {
              return `
                <i class="fa fa-trash cursor-pointer excluirEmpresa" data-id="${row.id}" title="Excluir" ></i>
                &nbsp;
                <i class="fa fa-pen cursor-pointer editarEmpresa" data-id="${row.id}"  title="Editar"></i>
              `
            }
          }
        ]
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