<div class="modal fade" id="modalFoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left" id="tituloModal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12 text-center">
            <form action="{{ route('imagens.criar') }}" method="post" enctype="multipart/form-data">
              {{ @csrf_field() }}
              <input type="hidden" name="orden_servicio_id" id="orden_servicio_id">
               <input type="file" name="uploaded_file[]" id="uploaded_file[]" multiple oninput='UpdatePreview()'> 
              <input type="submit" class="btn btn-primary">
            </form>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12" id="imagensPreview"></div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  function UpdatePreview() {
    let images = event.target.files || []
    for (let i = 0; i < images.length; i++) {
      $('#imagensPreview').append(`<img src="${URL.createObjectURL(images[i])}" title="${images[i].name}" width="128" height="128" class="mx-2" />`)
    }
  }
</script>