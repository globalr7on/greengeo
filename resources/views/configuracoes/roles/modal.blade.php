<div class="modal fade" id="modalFormRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left" id="modalFormRoleTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body p-2">
        <form id="formRole">
          <div class="row mx-0 mb-4">
            <div class="col-md-6 align-self-center">
              <div class="form-group">
                <input type="hidden" class="form-control" id="inputId">
                <label for="input_name">Função</label>
                <input type="text" class="form-control" id="input_name" placeholder="admin">
              </div>
            </div>

            <div class="col-md-6 text-center">
              <div class="form-group">
                <label for="input_guard_name" class="display-inherit mb-0">Acesso</label>
                <select data-style="btn-warning text-white" title="Selecione" name="guard_name" id="input_guard_name"></select>
              </div>
            </div>
          </div>

          <h4 class="text-primary font-weight-bold mx-3 my-2">Permissões</h4>
          <div class="row mx-4">
            <div class="col-md-12 px-0">
              <table class="table" id="permissionsTbl">
                <thead>
                  <th class="text-primary font-weight-bold" style="width:5%">
                    <div class="form-check mb-0">
                      <label class="form-check-label">
                        <input class="form-check-input" type="checkbox" id="selectAll">
                        <span class="form-check-sign" style="left:12px">
                          <span class="check"></span>
                        </span>
                      </label>
                    </div>
                  </th>
                  <th class="text-primary font-weight-bold" style="width:auto">Permissão</th>
                  <th class="text-primary font-weight-bold" style="width:15%">Acesso</th>
                </thead>
              </table>
            </div>
          </div>

          <div class="row mx-4">
            <div class="form-group m-0 p-0">
              <input type="hidden" class="form-control" id="input_permissions" value="{}">
            </div>
          </div>

          <div class="row mx-4 mt-2">
            <button class="btn btn-primary" id="salvarRole">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('js')
  <script>
    $('#formRole').submit(function(event) {
      event.preventDefault()
    })
  </script>
@endpush