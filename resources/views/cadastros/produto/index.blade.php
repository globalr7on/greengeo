@extends('layouts.app', ['activePage' => 'produto', 'titlePage' => __('Produto Acabado')])
@section('css')
@endsection
@section('subheaderTitle')
  Cadastros
@endsection
@section('content')
   <div class="content mt-0">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoProduto">
         + Novo Produto
        </button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Cadastros</h4>
              <p class="card-category">Produto</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="produtoTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Fabricante</th>
                    <th class="text-primary font-weight-bold">Peso bruto</th>
                    <th class="text-primary font-weight-bold">Peso liquido</th>
                    <th class="text-primary font-weight-bold">Dimensões</th>
                    <th class="text-primary font-weight-bold">Altura</th>
                    <th class="text-primary font-weight-bold">Largura</th>
                    <th class="text-primary font-weight-bold">Profundidade</th>
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
   @include('cadastros.produto.modal')
  
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      
      let app = new App({
        apiUrl: '/api/produto',
        apiDataTableColumns: [
          { data: "nome_fabricante" },
          { data: "peso_bruto" },
          { data: "peso_liquido" },
          { data: "dimensoes" },
          { data: "altura" },
          { data: "largura" },
          { data: "profundidade" },
          { 
            data: "ativo", className: "text-center", render: function (data, type) {
              return data ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'
            }
          }
        ],
        apiDataTableColumnsDefs : [
          { targets: 1, orderable: false },
        
          { 
            targets : 8,
            className: "text-center",
            render : function (data, type, row) {
              return `
                <i class="fa fa-trash cursor-pointer excluirEmpresa" data-id="${row.id}" title="Excluir" ></i>
                &nbsp;
                <i class="fa fa-pen cursor-pointer editarEmpresa" data-id="${row.id}"  title="Editar"></i>
              `
            }
          }
        ],
        datatableSelector: '#produtoTbl'
      })
     
      // Open Modal New
      $('body').on('click', '#novaEmpresa', function() {
       
        app.stepper()
        delFormValidationErrors()
        $("#modalEmpresa").modal("show")
        $('#tituloModal').text("Novo Empresa")
        $('#input_id').val("")
        $('#formEmpresa')[0].reset()
        getTipoEmpresa()
        getAtividade()
      });

      // Salvar ''
      $('body').on('click', '#salvarEmpresa', function() {
        const JSONRequest = {
          cnpj: $("#input_cnpj").val(),
          nome_fantasia: $("#input_nome_fantasia").val(),
          razao_social: $("#input_razao_social").val(),
          email: $("#input_email").val(),
          contato_1: $("#input_contato_1").val(),
          cargo_contato_1: $("#input_cargo_contato_1").val(),
          contato_2: $("#input_cargo_contato_2").val(),
          cargo_contato_2: $("#input_cargo_contato_2").val(),
          celular_contato_1: $("#input_celular_contato_1").val(),
          celular_contato_2: $("#input_celular_contato_2").val(),
          fixo: $("#input_fixo").val(),
          whatsapp: $("#input_whatsapp").val(),
          endereco: $("#input_endereco").val(),
          numero: $("#input_numero").val(),
          complemento: $("#input_complemento").val(),
          cep: $("#input_cep").val(),
          bairro: $("#input_bairro").val(),
          cidade: $("#input_cidade").val(),
          estado: $("#input_estado").val(),
          latitude: $("#input_latitude").val(),
          longitude: $("#input_longitude").val(),
          contrato: $("#input_contrato").val(),
          identificador_celular: $("#input_identificador_celular").val(),
          senha_acesso: $("#input_senha_acesso").val(),
          capacidade_media_carga: $("#input_capacidade_media_carga").val(),
          usuario_responsavel_cadastro_id: $("#input_usuario_responsavel_cadastro_id").val(),
          atividade_id: $("#input_atividade_id").val(),
          tipo_empresa_id: $("#input_tipo_empresa_id").val(),
          ativo: $("#checkAtivo").prop("checked") ? 1 : 0
        }
        const id = $('#input_id').val()
        if (id) {
          app.api.put(`/pessoa_juridica/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalEmpresa").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Empresa Atualizada com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar o empresa, tente novamente')
          })
        } else {
          app.api.post('/pessoa_juridica', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalEmpresa").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Empresa Criado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao criar empresa, tente novamente')
          })
        }
      });

      // Editar
      $('body').on('click', '.editAction', function() {
        app.stepper()
        const id = $(this).attr('data-id');
        app.api.get(`/pessoa_juridica/${id}`).then(response =>  {
          if (response && response.status) {
            getTipoEmpresa(response.data.tipo_empresa_id)
            getAtividade(response.data.atividade_id)
            delFormValidationErrors()
            $('#formEmpresa')[0].reset()
            $("#modalEmpresa").modal("show");
            $('#tituloModal').text("Editar Empresa")
            $('#input_id').val(response.data.id);
            $("#input_cnpj").val(response.data.cnpj),
            $("#input_nome_fantasia").val(response.data.nome_fantasia),
            $("#input_razao_social").val(response.data.razao_social),
            $("#input_email").val(response.data.email),
            $("#input_contato_1").val(response.data.contato_1),
            $("#input_cargo_contato_1").val(response.data.cargo_contato_1),
            $("#input_contato_2").val(response.data.contato_2),
            $("#input_cargo_contato_2").val(response.data.cargo_contato_2),
            $("#input_celular_contato_1").val(response.data.celular_contato_1),
            $("#input_celular_contato_2").val(response.data.celular_contato_2),
            $("#input_fixo").val(response.data.fixo),
            $("#input_whatsapp").val(response.data.whatsapp),
            $("#input_endereco").val(response.data.endereco),
            $("#input_numero").val(response.data.numero),
            $("#input_complemento").val(response.data.complemento),
            $("#input_cep").val(response.data.cep),
            $("#input_bairro").val(response.data.bairro),
            $("#input_cidade").val(response.data.cidade),
            $("#input_estado").val(response.data.estado),
            $("#input_latitude").val(response.data.latitude),
            $("#input_longitude").val(response.data.longitude),
            $("#input_contrato").val(response.data.contrato),
            $("#input_identificador_celular").val(response.data.identificador_celular),
            $("#input_senha_acesso").val(response.data.senha_acesso),
            $("#input_capacidade_media_carga").val(response.data.capacidade_media_carga),
            $("#input_usuario_responsavel_cadastro_id").val(response.data.usuario_responsavel_cadastro_id),
            $("#checkAtivo").prop("checked", response.data.ativo)
          }
        })
        .catch(error => console.log(error) && notifyDanger('Falha ao obter detalhes do empresa. Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction',  function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir a clase?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/pessoa_juridica/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('empresa excluída com sucesso')
            })
            .catch(error => notifyDanger('Falha ao excluir empresa. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      });

      function getTipoEmpresa(value) {
        app.api.get('/tipo_empresa').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_tipo_empresa_id', response.data, ['id', 'descricao'], value)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter funções, tente novamente')
        })
      }

      function getAtividade(value) {
        app.api.get('/atividade').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_atividade_id', response.data, ['id', 'descricao'], value)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter funções, tente novamente')
        })
      }
   
     });
  </script>
@endpush