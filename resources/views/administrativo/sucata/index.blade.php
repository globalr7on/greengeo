@extends('layouts.app', ['activePage' => 'sucata', 'titlePage' => __('Clase Sucata')])
@section('subheaderTitle')
  Administrativo
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novaClasseSucata">+ Nova Classe</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Administrativo</h4>
              <p class="card-category">Classe de Sucata</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="sucataTbl">
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
  @include('administrativo.sucata.modal')
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      let app = new App({
        apiUrl: '/api/classe_sucata',
        apiDataTableColumns: [
          { data: "descricao" },
        ],
        datatableSelector: '#sucataTbl'
      })

      // Open Modal New
      $('body').on('click', '#novaClasseSucata', function() {
        delFormValidationErrors()
        $("#modalClasseSucata").modal("show")
        $('#tituloModal').text("Nova classe")
        $('#inputId').val("")
        $('#formClaseSucata')[0].reset()
      })

      // Salvar 
      $('body').on('click', '#salvarclase', function() {
        const JSONRequest = {
          descricao: $("#input_descricao").val(),
        }
        const id = $('#inputId').val()
        if (id) {
          app.api.put(`/classe_sucata/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalClasseSucata").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Atualizado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar, tente novamente')
          })
        } else {
          app.api.post('/classe_sucata', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalClasseSucata").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Criado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao criar, tente novamente')
          })
        }
      })

      // Editar
      $('body').on('click', '.editAction', function() {
        const id = $(this).attr('data-id');
        app.api.get(`/classe_sucata/${id}`).then(response =>  {
          if (response && response.status) {
            delFormValidationErrors()
            $('#formClaseSucata')[0].reset()
            $("#modalClasseSucata").modal("show")
            $('#tituloModal').text("Editar classe")
            $('#inputId').val(response.data.id)
            $("#input_descricao").val(response.data.descricao)
          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes. Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction', function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/classe_sucata/${id}`).then(response =>  {
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