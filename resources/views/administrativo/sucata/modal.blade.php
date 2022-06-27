<div class="modal fade" id="modalClasseSucata" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="tituloModal">Criar Nova Classe</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
            <span aria-hidden="true">&times;</span> 
          </button>
        </div>
        <div class="modal-body">
          <div class="row">
            <div class="col-md-12">
              <form id="formClaseSucata">
                <div class="form-row">
                  <div class="form-group col-md-12">
                    <div class="togglebutton">
                      <label>Ativo?
                        <input type="checkbox" checked="" id="checkAtivo">
                          <span class="toggle"></span>
                      </label>
                    </div>
                  </div>
                  <div class="form-group col-md-12">
                    <input type="hidden" class="form-control" id="inputId">
                    <label for="inputDescricao">Descrição</label>
                    <input type="text" class="form-control" id="inputDescricao">
                  </div>
                </div>
                <button type="button" class="btn btn-primary" id="salvarclase">Salvar</button>
              </form>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>

  @push('js')
  <script>
    $('#formClaseSucata').submit(function(event) {
      event.preventDefault()
    })
  </script>
@endpush