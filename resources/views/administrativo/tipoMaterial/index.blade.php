@extends('layouts.app', ['activePage' => 'tipo_material', 'titlePage' => __('Tipo Material')])
@section('css')
@endsection
@section('subheaderTitle')
  Administrativo
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoTipoMaterial">+ Novo Tipo Material </button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Administrativo</h4>
              <p class="card-category">Tipo Material</p>
            </div>
            <div class="card-body">
              <!-- <div class="table-responsive"> -->
              <div>
                <table class="table" id="tipoMaterialTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Descrição</th>
                    <th class="text-primary font-weight-bold text-center">Ação</th>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
   @include('administrativo.tipoMaterial.modal')
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      let app = new App({
        apiUrl: '/api/tipo_materiais',
        apiDataTableColumns: [
           { data: "descricao" },
          
        ],
        datatableSelector: '#tipoMaterialTbl'
      })

      // Open Modal New
      $('body').on('click', '#novoTipoMaterial', function() {
        delFormValidationErrors()
        $("#modalTipoMaterial").modal("show")
        $('#tituloModal').text("Novo Permission")
        $('#inputId').val("")
        $('#formTipoMaterial')[0].reset()
      });

      // Salvar 
      $('body').on('click', '#salvarTipoMaterial', function() {
        const JSONRequest = {
          descricao: $("#inputDescricao").val()
        }
        const id = $('#inputId').val()
        if (id) {
          app.api.put(`/tipo_materiais/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalTipoMaterial").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Tipo Material Atualizado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar a tipo material, tente novamente')
          })
        } else {
          app.api.post('/tipo_materiais', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalTipoMaterial").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Tipo Material Criado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao criar tipo Material, tente novamente')
          })
        }
      });

      // Editar
      $('body').on('click', '.editAction', function() {
        const id = $(this).attr('data-id');
        app.api.get(`/tipo_materiais/${id}`).then(response =>  {
          if (response && response.status) {
            delFormValidationErrors()
            $('#formTipoMaterial')[0].reset()
            $("#modalTipoMaterial").modal("show");
            $('#tituloModal').text("Editar tipo matrial")
            $('#inputId').val(response.data.id);
            $("#inputDescricao").val(response.data.descricao);
            $("#checkAtivo").prop("checked", response.data.ativo)


          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes do tipo material . Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction',  function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir a tipo material?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/tipo_materiais/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('Tipo material excluído com sucesso')
            })
            .catch(error => notifyDanger('Falha ao excluir tipo material. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      })
    })
  </script>
@endpush