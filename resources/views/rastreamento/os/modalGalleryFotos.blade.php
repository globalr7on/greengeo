@section('css')
<style>
  .carousel-control-next, .carousel-control-prev {
    opacity: .1;
  }
</style>
@endsection

<div class="modal fade" id="modalGalleryFotos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left">Galeria de fotos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div id="carouselIndicators" class="carousel slide" data-ride="carousel">
          <ol class="carousel-indicators"></ol>
          <div class="carousel-inner"></div>
          <button class="carousel-control-prev" type="button" data-target="#carouselIndicators" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </button>
          <button class="carousel-control-next" type="button" data-target="#carouselIndicators" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </button>
        </div>
      </div>
    </div>
  </div>
  <script type="application/json" id="imagensData"></script>
</div>

@push('js')
  <script>
    $(document).ready(function () {
      // Show imagens
      $('body').on('click', '.showFotos', function() {
        const imagensData = JSON.parse($("#imagensData").val() || '[]')
        $('.carousel-inner').empty()
        $('.carousel-indicators').empty()
        imagensData.map(curr => {
          const items = $('.carousel-inner').children().length
          $('.carousel-indicators').append(`<li data-target="#carouselIndicators" data-slide-to="${items}" class="${!items ? 'active' : ''}"></li>`)
          $('.carousel-inner').append(`
            <div class="carousel-item ${!items ? 'active' : ''}">
              <img src="${curr.url}" class="d-block w-100" alt="foto" data-id="${curr.id}" style="object-fit:contain;height:400px;background-color:#0000008f;">
            </div>
          `)
        })
        if (imagensData.length > 0) {
          $("#modalGalleryFotos").modal("show")
        } else {
          notifyWarning('Não há fotos para mostrar')
        }
      })
    })
  </script>
@endpush