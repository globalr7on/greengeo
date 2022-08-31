<div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left">Addicionar fotos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="formImagens">
          <div class="row">
            <div class="col-md-3 align-self-center">
              <div class="form-group">
                <label for="input_orden_servicio_id">Ordem de Servico</label>
                <input type="hidden" id="input_orden_servicio_id">
                <input type="text" class="form-control" id="input_orden_servicio" disabled readonly>
              </div>
            </div>

            <div class="col-md-7 align-self-center">
              <input type="file" name="imagens[]" id="input_imagens[]" multiple accept="image/*" oninput='UpdatePreview()'>
            </div>

            <div class="col-md-2 align-self-center">
              <button type="button" class="btn btn-primary" id="salvarImagens">Enviar</button>
            </div>
          </div>
            
          <div class="row">
            <div class="col-md-12" id="imagensPreview"></div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@push('js')
  <script>
    $('#formImagens').submit(function(event) {
      event.preventDefault()
    })

    function UpdatePreview() {
      let images = event.target.files || []
      for (let i = 0; i < images.length; i++) {
        $('#imagensPreview').append(`<img src="${URL.createObjectURL(images[i])}" title="${images[i].name}" width="128" height="128" class="mx-2" />`)
      }
    }
  </script>
@endpush