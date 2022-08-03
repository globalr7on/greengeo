@extends('layouts.app', ['activePage' => 'modelo', 'titlePage' => __('Modelo')])
@section('subheaderTitle')
  Administrativo
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoModelo">+ Novo Modelo</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Administrativo</h4>
              <p class="card-category">Modelo</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="modeloTbl">
                  <thead>
                    <th class="text-primary font-weight-bold" style="width:auto">Descrição</th>
                    <th class="text-primary font-weight-bold text-center" style="width:5%">Ativo</th>
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
  @include('administrativo.modelo.modal')
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      let app = new App({
        apiUrl: '/api/modelo',
        apiDataTableColumns: [
          { data: "descricao" },
          {
            data: "ativo",
            className: "text-center",
            orderable: false,
            render: function (data, type, row) {
              return `<i class="fas fa-${data ? 'check' : 'times'} cursor-pointer changeStatus" data-id="${row.id}" data-value-old="${data}" title="Deseja atualizar o status?"></i>`
            }
          }
        ],
        datatableSelector: '#modeloTbl'
      })

      // Open Modal New
      $('body').on('click', '#novoModelo', function() {
        delFormValidationErrors()
        $("#modalModelo").modal("show")
        $('#tituloModal').text("Novo Modelo")
        $('#inputId').val("")
        $('#formModelo')[0].reset()
      })

      // Salvar 
      $('body').on('click', '#salvarModelo', function() {
        const JSONRequest = {
          descricao: $("#input_descricao").val(),
        }
        const id = $('#inputId').val()
        if (id) {
          app.api.put(`/modelo/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalModelo").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Atualizado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar, tente novamente')
          })
        } else {
          app.api.post('/modelo', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalModelo").modal("hide")
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
        app.api.get(`/modelo/${id}`).then(response =>  {
          if (response && response.status) {
            delFormValidationErrors()
            $('#formModelo')[0].reset()
            $("#modalModelo").modal("show")
            $('#tituloModal').text("Editar Modelo")
            $('#inputId').val(response.data.id)
            $("#input_descricao").val(response.data.descricao)
          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes. Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction',  function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/modelo/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('Excluído com sucesso')
            })
            .catch(error => notifyDanger('Falha ao excluir. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      })

      // Change status
      $('body').on('click', '.changeStatus', function() {
        sweetConfirm('Deseja realmente atualizar?').then(confirmed => {
          if (confirmed) {
            const id = $(this).attr('data-id')
            const valueOld = $(this).attr('data-value-old')
            app.api.put(`/modelo/${id}/status`, { ativo: parseInt(valueOld) ? 0 : 1 }).then(response =>  {
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
      })
    })
  </script>
@endpush