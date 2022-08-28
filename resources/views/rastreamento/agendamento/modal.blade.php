<div class="modal fade" id="modalAgenda" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left" id="tituloAgenda"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form id="formAgenda">
              <div class="row mx-0 mb-4">
                <div class="col-md-4 text-center">
                  <div class="form-group m-0 p-0">
                    <input type="hidden" id="input_id">
                    <input type="hidden" id="input_usuario_responsavel_cadastro_id" value="{{ Auth::user()->id }}">
                    <label for="input_pessoa_juridica_id" class="display-inherit mb-0">Transportadora</label>
                    <select id="input_pessoa_juridica_id" data-style="btn-warning text-white" name="input_pessoa_juridica_id">
                      <option value="" disabled selected>Seleccione</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4 text-center">
                  <div class="form-group m-0 p-0">
                  <label for="input_ordem_servico_id" class="display-inherit mb-0">Ordem de serviço</label>
                    <select id="input_ordem_servico_id" data-style="btn-warning text-white" name="input_ordem_servico_id">
                      <option value="" disabled selected>Seleccione</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4 text-center">
                  <div class="form-group m-0 p-0">
                  <label for="input_acondicionamento_id" class="display-inherit mb-0">Acondicionamento</label>
                    <select id="input_acondicionamento_id" data-style="btn-warning text-white" name="input_acondicionamento_id">
                      <option value="" disabled selected>Seleccione</option>
                    </select>
                  </div>
                </div>
              </div>
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="input_data_coleta">Data Coleta</label>
                      <input type="text" class="form-control datetimepicker" id="input_data_coleta">
                    </div>
                  </div>
                </div>
              </div>
              </div>
              <div class="row mx-0">
                <button type="button" class="btn btn-default" id="enviarAgendamento">Enviar agendamento</button>
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

    $('.datetimepicker').datetimepicker({
        // format: "YYYY-MM-DD hh:ii:s",
        format: 'YYYY-MM-DD hh:mm:ss',
        icons: {
            time: "fa fa-clock-o",
            date: "fa fa-calendar",
            up: "fa fa-chevron-up",
            down: "fa fa-chevron-down",
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-screenshot',
            clear: 'fa fa-trash',
            close: 'fa fa-remove'
        }
    });
    // $('.datepicker').datetimepicker({
    //   // format: "YYYY-MM-DD hh:ii:s",
    //   lang: 'pt-BR',
    //   timepicker: true,
    //   format: 'd/m/Y h:i'
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