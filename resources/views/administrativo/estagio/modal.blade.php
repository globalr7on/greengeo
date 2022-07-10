<div class="modal fade" id="modalEstagio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left" id="tituloModal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
        
      <div class="modal-body">
        <form id="formEstagio">
          <div class="row mx-0 mb-4">
            <div class="col-md-12">
              <div class="form-group">
                <input type="hidden" id="inputId">
                <label for="input_descricao">Descrição</label>
                <input type="text" class="form-control" id="input_descricao">
              </div>
            </div>
          </div>

          <div class="row mx-0 mb-4">
            <button type="button" class="btn btn-primary" id="salvarEstagio">Salvar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('js')
  <script>
    $('#formEstagio').submit(function(event) {
      event.preventDefault()
    })
  </script>
@endpush