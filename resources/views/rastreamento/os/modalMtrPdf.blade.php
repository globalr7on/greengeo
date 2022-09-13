<div class="modal fade" id="modalMtrPdf" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left">Addicionar MTR</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <form id="formMtrPdf">
          <div class="row">
            <div class="col-md-3 align-self-center">
              <div class="form-group">
                <label for="input_orden_servicio_id">Ordem de Servico</label>
                <input type="text" class="form-control" name="orden_servicio_id" id="input_orden_servicio_id" disabled readonly>
              </div>
            </div>

            <div class="col-md-7 align-self-center">
              <input type="file" name="pdfs" id="pdfs" accept="pdf/*">
            </div>

            <div class="col-md-2 align-self-center">
              <button type="button" class="btn btn-primary" id="salvarPdfs">Enviar</button>
            </div>
          </div>
            
          <div class="row">
            <div class="col-md-12" id="pdfMtrPreview"></div>
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

    // function UpdatePreview() {
    //   let images = event.target.files || []
    //   for (let i = 0; i < images.length; i++) {
    //     $('#imagensPreview').append(`<img src="${URL.createObjectURL(images[i])}" title="${images[i].name}" width="128" height="128" class="mx-2" />`)
    //   }
    // }
  </script>
@endpush