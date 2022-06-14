@extends('layouts.app', ['activePage' => 'acondicionamento', 'titlePage' => __('Acondicionamento')])
@section('css')
@endsection
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
              <!-- <div class="table-responsive"> -->
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

  <div class="modal fade" id="modalAcondicionamento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModal">Criar Novo Acondicionamento</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <form>
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <div class="togglebutton">
                      <label>Ativo?
                        <input type="checkbox" checked="" id="checkAtivo">
                          <span class="toggle"></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group col-md-12">
                    <input type="hidden" class="form-control" id="inputId">
                    <label for="inputDescricao">Descrição</label>
                    <input type="text" class="form-control" id="inputDescricao">
                  </div>
                </div>
                <button type="button" class="btn btn-primary" id="salvarAcond">Salvar</button>
              </form>
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
    let app = new App({
      apiUrl: '/api/acondicionamento',
      apiDataTableColumns: [
        { data: "descricao" },
        { data: "ativo", className: "text-center", render: function (data, type) {
          return data ? '<i class="fas fa-check"></i>' : '<i class="fas fa-times"></i>'
        } }
      ],
      apiDataTableColumnDefs: [
        { targets: 1, orderable: false }
      ],
      datatableSelector: '#acondTbl'
    })

    // Salvar 
    $('body').on('click', '#salvarAcond', function() {
      const JSONRequest = {
        descricao: $("#inputDescricao").val(),
        ativo: $("#checkAtivo").prop("checked") ? 1 : 0
      }
      const id = $('#inputId').val();
      if (id) {
        app.api.put(`/acondicionamento/${id}`, JSONRequest).then(response =>  {
          if (response && response.data) {
            $("#modalAcondicionamento").modal("hide");
            $('#acondTbl').DataTable().ajax.reload();
          }
        })
        .catch(error => {
          console.log('app.api.put error', error)
        })
      } else {
        app.api.post('/acondicionamento', JSONRequest).then(response =>  {
          if (response && response.data) {
            $("#modalAcondicionamento").modal("hide");
            $('#acondTbl').DataTable().ajax.reload();
          }
        })
        .catch(error => {
          console.log('app.api.post error', error)
        })
      }
    });

    // Open Modal New
    $('body').on('click', '#novoAcondicionamento', function() {
      $("#modalAcondicionamento").modal("show");
      $('#tituloModal').text("Nova Acondicionamento");
      $('#inputId').val("");
      $("#inputDescricao").val("");
      $("#checkAtivo").prop("checked", false)
    });

    // Editar
    $('body').on('click', '.editAction', function() {
      const acond_id = $(this).attr('data-id');
      app.api.get(`/acondicionamento/${acond_id}`).then(response =>  {
        if (response && response.data) {
          $("#modalAcondicionamento").modal("show");
          $('#tituloModal').text("Editar Acondicionamento")
          $('#inputId').val(response.data.id);
          $("#inputDescricao").val(response.data.descricao);
          $("#checkAtivo").prop("checked", response.data.ativo)
        }
      })
      .catch(error => {
        console.log('app.api.get error', error)
      })
    });

    // Excluir
    $('body').on('click', '.deleteAction',  function() {
      const acond_id = $(this).attr('data-id');
      if (confirm('Aviso! Deseja realmente excluir o acondicionamento?')) {
        app.api.delete(`/acondicionamento/${acond_id}`).then(response =>  {
          $('#acondTbl').DataTable().ajax.reload();
        })
        .catch(error => {
          console.log('app.api.delete error', error)
        })
      }
    });
  });
</script>
@endpush