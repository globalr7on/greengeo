@extends('layouts.app', ['activePage' => 'sucata', 'titlePage' => __('Clase Sucata')])
@section('css')
@endsection
@section('subheaderTitle')
  Administrativo
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novaClasseSucata">+ Novo Clase</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Administrativo</h4>
              <p class="card-category">Clase de Sucata</p>
            </div>
            <div class="card-body">
              <!-- <div class="table-responsive"> -->
              <div>
                <table class="table" id="sucataTbl">
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
   @include('sucata.modal')
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
        $('#tituloModal').text("Novo clase")
        $('#inputId').val("")
        $('#formClaseSucata')[0].reset()
      });

      // Salvar 
      $('body').on('click', '#salvarclase', function() {
        const JSONRequest = {
          descricao: $("#inputDescricao").val(),
         
        }
        const id = $('#inputId').val()
        if (id) {
          app.api.put(`/classe_sucata/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalClasseSucata").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('clase Atualizado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar o clase, tente novamente')
          })
        } else {
          app.api.post('/classe_sucata', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalClasseSucata").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('clase Criado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao criar clase, tente novamente')
          })
        }
      });

      // Editar
      $('body').on('click', '.editAction', function() {
        const id = $(this).attr('data-id');
        app.api.get(`/classe_sucata/${id}`).then(response =>  {
          if (response && response.status) {
            delFormValidationErrors()
            $('#formClaseSucata')[0].reset()
            $("#modalClasseSucata").modal("show");
            $('#tituloModal').text("Editar clase")
            $('#inputId').val(response.data.id);
            $("#inputDescricao").val(response.data.descricao);
          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes do clase. Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction',  function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir a clase?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/classe_sucata/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('clase excluído com sucesso')
            })
            .catch(error => notifyDanger('Falha ao excluir clase. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      })
    })
  </script>
@endpush