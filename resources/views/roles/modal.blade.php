<div class="modal fade" id="modalFormRole" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFormRoleTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body p-2">
        <form id="formRole">
          <div class="row m-0">
            <div class="form-group col-md-6">
              <input type="hidden" class="form-control" id="inputId">
              <label for="input_name" class="position-relative mb-0 font-weight-bold">Função</label>
              <input type="text" class="form-control" id="input_name" placeholder="admin">
            </div>

            <div class="form-group col-md-6">
              <label for="input_guard_name" class="display-inherit mb-0">Acesso</label>
              <select data-style="btn-warning text-white" title="Select" name="guard_name" id="input_guard_name"></select>
            </div>
          </div>

          <h4 class="text-primary font-weight-bold mx-3 my-2">Permissões</h4>
          <div class="row mx-3" id="permissions"></div>
          <div class="row mx-3">
            <div class="form-group m-0 p-0">
              <input type="hidden" class="form-control" id="input_permissions" value="{}">
            </div>
          </div>
          <div class="row m-0">
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