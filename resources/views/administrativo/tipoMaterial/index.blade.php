@extends('layouts.app', ['activePage' => 'tipo_material', 'titlePage' => __('Tipo Material')])
@section('subheaderTitle')
  Administrativo
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoTipoMaterial">+ Novo Tipo Material</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Administrativo</h4>
              <p class="card-category">Tipo Material</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="tipoMaterialTbl">
                  <thead>
                    <th class="text-primary font-weight-bold" style="width:auto">Descrição</th>
                    <th class="text-primary font-weight-bold text-center" style="width:5%">Ação</th>
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
        $('#tituloModal').text("Novo Tipo Material")
        $('#inputId').val("")
        $('#formTipoMaterial')[0].reset()
      })

      // Salvar 
      $('body').on('click', '#salvarTipoMaterial', function() {
        const JSONRequest = {
          descricao: $("#input_descricao").val()
        }
        const id = $('#inputId').val()
        if (id) {
          app.api.put(`/tipo_materiais/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalTipoMaterial").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess(' Atualizado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar, tente novamente')
          })
        } else {
          app.api.post('/tipo_materiais', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalTipoMaterial").modal("hide")
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
        const id = $(this).attr('data-id');
        app.api.get(`/tipo_materiais/${id}`).then(response =>  {
          if (response && response.status) {
            delFormValidationErrors()
            $('#formTipoMaterial')[0].reset()
            $("#modalTipoMaterial").modal("show")
            $('#tituloModal').text("Editar tipo material")
            $('#inputId').val(response.data.id)
            $("#input_descricao").val(response.data.descricao)
          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes . Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction', function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/tipo_materiais/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('Excluído com sucesso')
            })
            .catch(error => notifyDanger('Falha ao excluir. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      })
    })
  </script>
@endpush