<div class="modal fade" id="modalFormPermission" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalFormPermissionTitle"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body p-2">
        <form id="formPermission">
          <div class="row m-0">
            <div class="form-group col-md-6">
              <input type="hidden" class="form-control" id="inputId">
              <label for="input_name" class="position-relative mb-0 font-weight-bold">Name</label>
              <input type="text" class="form-control" id="input_name" placeholder="admin">
            </div>

            <div class="form-group col-md-6">
              <label for="input_guard_name" class="position-relative mb-0 font-weight-bold">Guard</label>
              <input type="text" class="form-control" id="input_guard_name" placeholder="web" value="web">
            </div>
          </div>

          <div class="row m-0">
            <button class="btn btn-primary" id="salvarPermission">Enviar</button>
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