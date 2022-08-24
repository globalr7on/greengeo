<div class="modal fade" id="modalNota" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left" id="tituloNota"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form id="formNota">
              <div class="row mx-0 mb-4">
                  <div class="col-md-12 align-self-center">
                    <div class="form-group">
                      <label for="file">XML File:</label>
                      <input type="file" class="form-control" required id="file" name="file">
                    </div>
                    <button type="submit" class="btn btn-primary" id="submit-post">Leia XML</button>
                  </div>
                <div class="col-md-5 text-center">
                  <div class="form-group m-0 p-0">
                    <input type="hidden" id="input_id">
                    <input type="hidden" id="input_usuario_responsavel_cadastro_id" value="{{ Auth::user()->id }}">
                    <label for="input_pessoa_juridica_id" class="display-inherit mb-0">Empresa</label>
                    <select id="input_pessoa_juridica_id" data-style="btn-warning text-white" name="input_pessoa_juridica_id">
                      <option value="" disabled selected>Seleccione</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-3 align-self-center">
                  <div class="form-group mb-0">
                    <label for="input_numero_total">Numero Total</label>
                    <input type="text" class="form-control" id="input_numero_total">
                  </div>
                </div>

                <div class="col-md-2 align-self-center">
                  <div class="form-group">
                    <label for="input_serie">Serie</label>
                    <input type="text" class="form-control" id="input_serie">
                  </div>
                </div>
  
                <div class="col-md-2 align-self-center">
                  <div class="form-group">
                    <label for="input_folha">Folha</label>
                    <input type="number" class="form-control" id="input_folha">
                  </div>
                </div>
              </div>
              
              <div class="row mx-0 mb-4">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="input_chave_de_acesso">Chave de Acesso</label>
                    <input type="text" class="form-control maskchave" id="input_chave_de_acesso">
                  </div>
                </div>
              </div>

              <div class="row mx-0">
                <button type="button" class="btn btn-default" id="addProdutoAcabado">Produto Acabado</button>
                <button type="button" class="btn btn-default" id="addProdutoSegregado">Produto Segregado</button>
                <button type="button" class="btn btn-primary" id="salvarNotafiscal">Salvar</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>


@push('js')
  <script>
    // $('#formNota').submit(function(event) {
    //   event.preventDefault()
    // })

    // $('.datepicker').datetimepicker({
    //   format: "YYYY-MM-DD",
    //   icons: {
    //     time: "fa fa-clock-o",
    //     date: "fa fa-calendar",
    //     up: "fa fa-chevron-up",
    //     down: "fa fa-chevron-down",
    //     previous: 'fa fa-chevron-left',
    //     next: 'fa fa-chevron-right',
    //     today: 'fa fa-screenshot',
    //     clear: 'fa fa-trash',
    //     close: 'fa fa-remove'
    //   }
    // })
  </script>
@endpush