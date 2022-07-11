<div class="modal fade" id="modalIbama" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left" id="tituloModal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
      <div class="modal-body">
        <form id="formIbama">
          <div class="row mx-0 mb-4">
            <div class="col-md-12">
              <div class="form-group">
                <input type="hidden" class="form-control" id="input_id">
                <label for="input_codigo">Código</label>
                <input type="text" class="form-control" id="input_codigo">
              </div>
            </div>
          </div>

          <div class="row mx-0 mb-4">
            <div class="col-md-12">
              <div class="form-group">
                <label for="input_denominacao">Denominação</label>
                <textarea class="form-control" id="input_denominacao" rows="3"></textarea>
              </div>
            </div>
          </div>

          <div class="row mx-0">
            <button type="button" class="btn btn-primary" id="salvarIbama">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('js')
  <script>
    $('#formIbama').submit(function(event) {
      event.preventDefault()
    })
  </script>
@endpush