<div class="modal fade" id="modalNota" tabindex="-1" role="dialog" aria-labelledby="modalAddNew" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
      <div class="modal-content">
        <div class="card card-nav-tabs card-plain">
          <div class="card-header card-header-primary">
              <!-- colors: "header-primary", "header-info", "header-success", "header-warning", "header-danger" -->
            <div class="nav-tabs-navigation">
              <div class="nav-tabs-wrapper">
                <ul class="nav nav-tabs" data-tabs="tabs">
                  <li class="nav-item">
                    <a class="nav-link active" href="#nota" data-toggle="tab">Nota Fiscal</a>
                  </li>
                  {{-- <li class="nav-item">
                    <a class="nav-link" href="#items" data-toggle="tab">Items</a>
                  </li> --}}
                </ul>
              </div>
            </div>
          </div>
          <div class="card-body m-4">
            <div class="tab-content text-center">
              <div class="tab-pane active" id="nota">
                <form id="formNota"> 
                  <div class="form-row">
                    <div class="form-group col-md-6">
                       <input type="hidden" id="input_id">
                      <label for="input_pessoa_juridica_id" class="display-inherit mb-0">Empresa</label>
                      <select id="input_pessoa_juridica_id" data-style="btn-warning text-white" title="Single Select" name="input_pessoa_juridica_id" >
                        <option value="" disabled selected>Seleccione</option>
                      </select>
                    </div>
                    <div class="form-group col-md-6">
                       <label for="input_numero_total" class="display-inherit mb-4 text-left">Numero Total</label>
                      <input type="text" class="form-control" id="input_numero_total">
                    </div>
                  </div>
                  <div class="form-row">
                    <div class="form-group col-md-6">
                      <label for="input_serie" class="display-inherit mb-4 text-left">Serie</label>
                      <input type="text" class="form-control" id="input_serie">
                    </div>
                    <div class="form-group col-md-6">
                       <label for="input_folha" class="display-inherit mb-4 text-left">Folha</label>
                      <input type="text" class="form-control" id="input_folha">
                    </div>
                  </div>
                  <br>
                  <div class="form-row">
                    <div class="form-group col-md-12">
                      <label for="input_chave_de_acesso" class="display-inherit mb-4">Chave de Acesso</label>
                      <input type="text" class="form-control" id="input_chave_de_acesso">
                    </div>
                  </div>
                </form>
              </div>
              <div>
                <div class="col-12 text-right">
                  <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddItem">
                    Adicionar Item
                  </button>
                  <!-- <button type="button" class="btn btn-primary"  id="addItems">Adicionar Item</button> -->
                </div>
                <table id="itemTbl" class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th> EAN </th>
                          <th> Descrição </th>
                          <th> Peso </th>
                          <th> Largura </th>
                          <th> Codigo Fabricante </th>
                          <th> Serie </th>
                          <th> Data Fabricação </th>
                      </tr>
                  </thead>
                            {{-- <tbody>
                            <tr>
                                <td> {{$nota}} </td>
                                <td> {{$serie}} </td>
                                <td> {{$emicao}} </td>
                                <td> {{$saida}} </td>
                            </tr>
                            <tr>
                                <td> {{$nota}} </td>
                                <td> {{$serie}} </td>
                                <td> {{$emicao}} </td>
                                <td> {{$saida}} </td>
                            </tr>
                            </tbody> --}}

                    </table>
             
              </div>
            </div>
          </div>
          <div class="form-group col-md-6 px-4">
              <button type="button" class="btn btn-primary" id="salvarNfiscal">Salvar</button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Item modal -->
  <div class="modal fade" id="modalAddItem" tabindex="-1" role="dialog" aria-labelledby="modalAddItem" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="card-body ">
          <!-- <h5 class="modal-title" id="exampleModalLabel">Adicionar Items </h5> -->
          <form id="formAddItem">
            <div class="form-row">
              <div class="form-group col-md-6">
                <div class="col-lg-5 col-md-4 col-sm-3">
                    <input type="hidden" id="input_usuario_responsavel_cadastro_id" value="{{ Auth::user()->id }}">
                  <select  id="input_unidade_id" data-style="btn btn-primary btn-round" title="Single Select" name="unidad">
                    <option value="" disabled selected>Unidad</option>
                  </select>
                </div>
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="inputEan" name="ean" placeholder="EAN">
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="inputDescicao" name="descricao" placeholder="Descrição">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="inputPeso" name="peso" placeholder="Peso">
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="inputLargura" name="largura" placeholder="Largura">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="inputProfundidade" name="profundidade" placeholder="Profundidade">
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="inputComprimento" name="comprimento" placeholder="Comprimento">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="inputQuantidade" name="quantidade" placeholder="Quantidade">
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="inputEspecie" name="especie" placeholder="Especie">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="inputMarca" name="marca" placeholder="Marca">
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="inputCodigoFabricante" name="codigoFabricante" placeholder="Codigo de Fabricante">
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <input type="text" class="form-control" id="inputNumeroSeria" name="numeroSeria" placeholder="Numero de Serie">
              </div>
              <div class="form-group col-md-6">
                <input type="text" class="form-control datetimepicker" name="dataFabricacao" placeholder="Data de Fabricação" />
              </div>
            </div>
            <div class="form-row">
              <div class="form-group col-md-6">
                <button type="button" class="btn btn-primary" id="submitAddItem">Salvar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
