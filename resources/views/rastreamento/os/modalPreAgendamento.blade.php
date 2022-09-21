<div class="modal fade" id="modalPreOs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left" id="tituloPreModal">Pre Ordem de Serviço</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body p-2">
      <div class="row">
          <div class="col-md-12">
            <form id="formPreOs">
            <div class="row mx-0 mb-4">
                  <div class="col-md-4 text-center">
                    <div class="form-group m-0 p-0">
                      <input type="hidden" id="parent_usuario_responsavel_id" value="{{ Auth::user()->usuario_responsavel_cadastro_id }}">
                      <input type="hidden" id="parent_tipo_empresa_id" value="{{ Auth::user()->usuario_responsavel_cadastro && Auth::user()->usuario_responsavel_cadastro->pessoa_juridica ? Auth::user()->usuario_responsavel_cadastro->pessoa_juridica->tipo_empresa_id : null }}">
                      <input type="hidden" id="input_usuario_responsavel_cadastro_id" value="{{ Auth::user()->id }}">
                      <input type="hidden" id="input_id">
                      <!-- <label for="input_gerador_id" class="display-inherit mb-0">Gerador</label>
                      <select id="input_gerador_id" data-style="btn-warning text-white" name="input_gerador_id" title="Selecione"></select> -->
                      <label for="input_transportador_id" class="display-inherit mb-0">Transportador</label>
                      <select id="input_transportador_id" data-style="btn btn-warning text-white rounded" name="input_transportador_id" title="Selecione"></select>
                    </div>
                  </div>
                  <div class="col-md-4 text-center">
                    <div class="form-group m-0 p-0">
                      <label for="input_destinador_id" class="display-inherit mb-0">Destinador</label>
                      <select id="input_destinador_id" data-style="btn btn-warning text-white rounded" name="input_destinador_id" title="Selecione"></select>
                    </div>
                  </div>
                  <div class="col-md-4 align-self-center">
                    <div class="form-group mb-0">
                      <label for="input_data_coleta">Data Coleta</label>
                      <input type="text" class="form-control datetimepicker" id="input_data_coleta">
                    </div>
                  </div>
                </div>
               <div class="row mx-0">
                  <button class="btn btn-default" id="addPreProduto" >Produtos</button>
                  <button class="btn btn-primary ">Salvar</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Produtos -->
<div class="modal fade" id="modalPreProdutos" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-left">Produtos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body pb-4">
          <div class="row  mx-0 mb-4">
            <div class="col-md-2 text-center">
                <div class="form-group">
                  <label for="input_ncm" class="display-inherit mb-0 text-left">NCM</label>
                  <input type="text" class="form-control" id="input_ncm">
                </div>
            </div>
            <div class="col-md-6 align-self-center">
              <div class="form-group">
                <input type="hidden" id="input_id">
                <label for="input_nome_produto">Nome do Produto</label>
                <input type="text" class="form-control" id="input_nome_produto">
              </div>
            </div>
            <div class="col-md-2 text-center">
              <div class="form-group">
                <label for="input_unidade" class="display-inherit mb-0 text-left">Unidade</label>
                <input type="text" class="form-control" id="input_unidade">
              </div>
            </div>
            <div class="col-md-2 text-center">
              <div class="form-group">
                <label for="input_quantidade" class="display-inherit mb-0 text-left">Quantidade</label>
                <input type="text" class="form-control" id="input_quantidade">
              </div>
            </div>
          </div>
        
          <div class="row mx-0 mb-4">
              <div class="col-md-12 text-center align-self-center">
                <div class="form-group">
                  <button class="btn btn-primary addPreProduto">Adicionar produto</button>
                </div>
              </div>
           </div>
            <table class="table" id="produtosPreTbl">
              <thead>
                <th class="text-primary font-weight-bold text-center" style="width:5%">NCM</th>
                <th class="text-primary font-weight-bold" style="width:auto">Descrição Produto</th>
                <th class="text-primary font-weight-bold text-center" style="width:6%">Unidade</th>
                <th class="text-primary font-weight-bold text-center" style="width:6%">Quantidade</th>
                <th class="text-primary font-weight-bold text-center" style="width:6%">Ações</th>
              </thead>
              <tfoot>
                <tr>
                  <th>Total:</th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                </tr>
              </tfoot>
            </table>
          </div>
        </div>
    </div>
  </div>
  <!-- <script type="javascript/json" id="produtosPreData"></script>
  <script type="javascript/json" id="tratamentoData"></script> -->
</div>


@push('js')
<script>
    $('.datetimepicker').datetimepicker({
      format: 'YYYY-MM-DD hh:mm:ss',
      // dateFormat: 'dd/mm/yyyy'
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
     
    })
  </script>
  <script>
    $('#formPreOs').submit(function(event) {
      event.preventDefault()
    })
  
    $('body').on('click', '#addPreProduto', function() {

      $("#modalPreProdutos").modal("show")
      $('#produtosPreTbl').DataTable().clear().draw()
    })


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