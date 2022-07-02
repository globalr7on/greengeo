<div class="modal fade" id="modalVeiculo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="tituloModal"></h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="col-md-12">
            <form id="formVeiculo">
              <div class="form-row">
                <div class="form-group col-md-4 align-self-center text-center">
                  <div class="togglebutton">
                    <label>
                      Ativo?
                      <input type="checkbox" id="checkAtivo">
                      <span class="toggle"></span>
                    </label>
                  </div>
                </div>
                <div class="form-group col-md-4 text-center">
                  <label for="input_pessoa_juridica_id" class="display-inherit mb-0">Empresa</label>
                  <select id="input_pessoa_juridica_id" data-style="btn-warning text-white" title="Single Select" name="empresa" >
                    <option value="" disabled selected>Seleccione</option>
                  </select>
                </div>
                <div class="form-group col-md-4">
                  <label for="input_placa" class="display-inherit mb-0">Placa</label>
                  <input type="text" class="form-control" id="input_placa" >
                </div>
              </div>
                
              <div class="form-row ">
                <input type="hidden" class="form-control" id="inputId">
                <div class="form-group col-md-4 text-center">
                   <label for="input_modelo_id" class="display-inherit mb-0">Modelo</label>
                  <select id="input_modelo_id" data-style="btn-warning text-white" title="Single Select" name="modelo" >
                    <option value="" disabled selected>Seleccione</option>
                  </select>
                </div>
                <div class="form-group col-md-4 text-center">
                  <label for="input_marca_id" class="display-inherit mb-0">Marca</label>
                  <select id="input_marca_id" data-style="btn-warning text-white" title="Single Select" name="marca" >
                    <option value="" disabled selected>Seleccione</option>
                  </select>
                </div>
                <div class="form-group col-md-4 text-center">
                  <label for="input_acondicionamento_id" class="display-inherit mb-0">Acondicionamento</label>
                  <select id="input_acondicionamento_id" data-style="btn-warning text-white" title="Single Select" name="acondicionamento" >
                    <option value="" disabled selected>Seleccione</option>
                  </select>
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                   <label for="input_chassis" class="display-inherit mb-0">Chassis</label>
                  <input type="text" class="form-control" id="input_chassis" >
                </div>
                <div class="form-group col-md-6">
                  <label for="input_capacidade_media_carga" class="display-inherit mb-0">Capacidade</label>
                  <input type="text" class="form-control maskpeso" id="input_capacidade_media_carga">KG
                </div>
              </div>

              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="input_renavam" class="display-inherit mb-0">Renavam</label>
                  <input type="text" class="form-control" id="input_renavam">
                </div>
                <div class="form-group col-md-6">
                  <label for="input_combustivel" class="display-inherit mb-0">Combustivel</label>
                  <select id="input_combustivel" data-style="btn-warning text-white" class="form-select" aria-label="Default select example" title="Single Select" name="input_combustivel" >
                    <option selected>Open this select menu</option>
                    <option value="1">Diesel</option>
                    <option value="2">Diesel S10</option>
                    <option value="3">Gasolina</option>
                    <option value="3">Bio-Diesel</option>
                    <option value="3">Alcool</option>
                  </select>
                  {{-- <select  id="input_combustivel" class="form-select" data-style="btn-warning text-white" title="Single Select" name="input_combustivel" >
                    <option value="" disabled selected>Seleccione</option>
                    <option value="">Diesel</option>
                    <option value="1">Diesel S10</option>
                    <option value="2">Gasolina</option>
                    <option value="3">Bio-Diesel</option>
                    <option value="4">Alcool</option>
                  </select> --}}
                </div>
              </div>
              <button type="button" class="btn btn-primary" id="salvarVeiculo">Salvar</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

@push('js')
  <script>
    $('#formVeiculo').submit(function(event) {
      event.preventDefault()
    })

  </script>
@endpush