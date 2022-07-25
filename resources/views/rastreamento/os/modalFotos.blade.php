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
          <div class="col-md-12">
             <form action="{{ route('imagens.criar') }}" method="post" enctype="multipart/form-data">
                {{ @csrf_field() }}
                <input type="file" name="uploaded_file[]" id="uploaded_file[]" multiple  oninput='UpdatePreview()'>
                <input type="submit">
            </form>
          </div>
          <div class="col-md-12">
               <img src="{{ asset('material') }}/img/new_logo.png" id ="frame" alt="test" width="128" height="128" />
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    function UpdatePreview(){
    $('#frame').attr('src', URL.createObjectURL(event.target.files[0]));
};
</script>