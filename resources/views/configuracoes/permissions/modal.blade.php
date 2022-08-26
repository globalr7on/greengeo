<div class="modal fade" id="modalFormPermission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left" id="modalFormPermissionTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body p-2">
        <form id="formPermission">
          <div class="row mx-0">
            <div class="col-md-6 align-self-center">
              <div class="form-group">
                <input type="hidden" class="form-control" id="inputId">
                <label for="input_name">Permissão</label>
                <input type="text" class="form-control" id="input_name" placeholder="Permissão">
              </div>
            </div>

            <div class="col-md-6">
              <div class="form-group">
                <label for="input_guard_name" class="display-inherit mb-0">Acesso</label>
                <select data-style="btn-warning text-white" title="Selecione" name="guard_name" id="input_guard_name"></select>
              </div>
            </div>
          </div>

          <div class="row mx-2">
            <button class="btn btn-primary" id="salvarPermission">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('js')
  <script>
    $('#formPermission').submit(function(event) {
      event.preventDefault()
    })
  </script>
@endpush