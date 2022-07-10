@extends('layouts.app', ['activePage' => 'acondicionamento', 'titlePage' => __('Acondicionamento')])
@section('subheaderTitle')
  Administrativo
@endsection
@section('content')
  <div class="content">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoAcondicionamento">+ Novo Acondicionamento</button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Administrativo</h4>
              <p class="card-category">Acondicionamentos</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="acondTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Descrição</th>
                    <th class="text-primary font-weight-bold text-center">Ativo</th>
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
  @include('administrativo.acondicionamento.modal')
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      let app = new App({
        apiUrl: '/api/acondicionamento',
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
        datatableSelector: '#acondTbl'
      })

      // Open Modal New
      $('body').on('click', '#novoAcondicionamento', function() {
        delFormValidationErrors()
        $("#modalAcondicionamento").modal("show")
        $('#tituloModal').text("Novo Acondicionamento")
        $('#inputId').val("")
        $('#formAcondicionamento')[0].reset()
      })

      // Salvar 
      $('body').on('click', '#salvarAcond', function() {
        const JSONRequest = {
          descricao: $("#input_descricao").val()
        }
        const id = $('#inputId').val()
        if (id) {
          app.api.put(`/acondicionamento/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalAcondicionamento").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Atualizado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar, tente novamente')
          })
        } else {
          app.api.post('/acondicionamento', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalAcondicionamento").modal("hide")
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
        app.api.get(`/acondicionamento/${id}`).then(response =>  {
          if (response && response.status) {
            delFormValidationErrors()
            $('#formAcondicionamento')[0].reset()
            $("#modalAcondicionamento").modal("show");
            $('#tituloModal').text("Editar Acondicionamento")
            $('#inputId').val(response.data.id)
            $("#input_descricao").val(response.data.descricao)
          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes do acondicionamento. Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction', function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/acondicionamento/${id}`).then(response =>  {
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
            app.api.put(`/acondicionamento/${id}/status`, { ativo: parseInt(valueOld) ? 0 : 1 }).then(response =>  {
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