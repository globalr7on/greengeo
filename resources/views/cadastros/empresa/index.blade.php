@extends('layouts.app', ['activePage' => 'empresa', 'titlePage' => __('Empresas')])
@section('css')
@endsection
@section('subheaderTitle')
  Administrativo
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
              <h4 class="card-title">Cadastros</h4>
              <p class="card-category">Empresas</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="empresaTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">CNPJ</th>
                    <th class="text-primary font-weight-bold">Razao Social</th>
                    <th class="text-primary font-weight-bold">Email</th>
                    <th class="text-primary font-weight-bold">Contato1</th>
                    <th class="text-primary font-weight-bold">Celular Contato1</th>
                    <th class="text-primary font-weight-bold">Fixo</th>
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
   @include('cadastros.empresa.modal')
  
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      const id = {{ Auth::user()->id }}
      let app = new App({
        apiUrl: `/api/pessoa_juridica${id ? '?usuario_responsavel_cadastro_id='+id : ''}`,
        apiDataTableColumns: [
          { data: "cnpj" },
          { data: "razao_social" },
          { data: "email" },
          { data: "contato_1" },
          { data: "celular_contato_1" },
          { data: "fixo" },
          { data: "capacidade_media_carga" },
          { 
            data: "ativo",
            className: "text-center",
            orderable: false,
            render: function (data, type, row) {
              // return data ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'
              return `<i class="fas fa-${data ? 'check' : 'times'} cursor-pointer changeStatus" data-id="${row.id}" data-value-old="${data}" title="Deseja atualizar o status?"></i>`
            }
          }
        ],
        apiDataTableColumnsDefs : [
          { targets: 1, orderable: false },
          { targets: 0, width: "70px" },
        ],
        datatableSelector: '#empresaTbl'
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
        maskPeso("#input_capacidade_media_carga")
      });

      // Salvar
      $('body').on('click', '#salvarEmpresa', function() {
        const JSONRequest = {
          cnpj: $("#input_cnpj").val(),
          nome_fantasia: $("#input_nome_fantasia").val(),
          razao_social: $("#input_razao_social").val(),
          email: $("#input_email").val(),
          contato_1: $("#input_contato_1").val(),
          cargo_contato_1: $("#input_cargo_contato_1").val(),
          contato_2: $("#input_contato_2").val(),
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
          identificador_celular: '123456',
          senha_acesso: $("#input_senha_acesso").val(),
          capacidade_media_carga: formatStringToFloat($("#input_capacidade_media_carga").val()),
          usuario_responsavel_cadastro_id: $("#input_usuario_responsavel_cadastro_id").val(),
          atividade_id: $("#input_atividade_id").val(),
          tipo_empresa_id: $("#input_tipo_empresa_id").val(),
          // ativo: $("#checkAtivo").prop("checked") ? 1 : 0
        }
        const id = $('#input_id').val()
        if (id) {
          app.api.put(`/pessoa_juridica/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalEmpresa").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Atualizado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar, tente novamente')
          })
        } else {
          app.api.post('/pessoa_juridica', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalEmpresa").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Criado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao criar, tente novamente')
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
            $("#input_usuario_responsavel_cadastro_id").val(response.data.usuario_responsavel_cadastro_id),
            // $("#checkAtivo").prop("checked", response.data.ativo)
            maskPeso("#input_capacidade_media_carga", formatFloatToString(response.data.capacidade_media_carga))
          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes. Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction', function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/pessoa_juridica/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('Excluída com sucesso')
            })
            .catch(error => notifyDanger('Falha ao excluir. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      });
      
      // Change status
      $('body').on('click', '.changeStatus', function() {
        sweetConfirm('Deseja realmente atualizar?').then(confirmed => {
          if (confirmed) {
            const id = $(this).attr('data-id')
            const valueOld = $(this).attr('data-value-old')
            app.api.put(`/pessoa_juridica/${id}/status`, { ativo: parseInt(valueOld) ? 0 : 1 }).then(response =>  {
              if (response && response.status) {
                app.datatable.ajax.reload()
                notifySuccess('Atualizada com sucesso')
              } else {
                notifySuccess('Não foi possível atualizar, tente novamente')
              }
            })
            .catch(error => notifyDanger('Falha ao atualizar. Tente novamente'))
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
          notifyDanger('Falha ao obter dados de tipo empresa, tente novamente')
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
          notifyDanger('Falha ao obter dados de atividade, tente novamente')
        })
      }

      $('body').on('blur', '#input_cep , #input_numero', function() {
        var cep = $('#input_cep').val()
        var numero = $('#input_numero').val()
        if(cep && numero) {
          app.api.get(`/geo?cep=${cep}&numero=${numero}`).then(response =>  {
            if (response.status) {
              $('#input_endereco').val(response.data.endereco)
              $('#input_bairro').val(response.data.bairro)
              $('#input_cidade').val(response.data.cidade)
              $('#input_estado').val(response.data.estado)
              $('#input_latitude').val(response.data.coord.lat)
              $('#input_longitude').val(response.data.coord.lng)
            } else {
              notifyDanger(response.data)
            }
          }).catch(error => notifyDanger('Falha ao obter dados de endereço, tente novamente'))
        }
      })
    });
  </script>
@endpush