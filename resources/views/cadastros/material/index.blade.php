@extends('layouts.app', ['activePage' => 'material', 'titlePage' => __('Materiais')])
@section('css')
@endsection
@section('subheaderTitle')
  Cadastros
@endsection
@section('content')
   <div class="content mt-0">
    <div class="container-fluid">
      <div class="col-12 text-right">
        <button type="button" class="btn btn-primary" id="novoMaterial">
         + Novo Material
        </button>
      </div>
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header card-header-primary">
              <h4 class="card-title">Cadastros</h4>
              <p class="card-category">Material</p>
            </div>
            <div class="card-body">
              <div>
                <table class="table" id="materialTbl">
                  <thead>
                    <th class="text-primary font-weight-bold">Ibama</th>
                    <th class="text-primary font-weight-bold">Material</th>
                    <th class="text-primary font-weight-bold">Estado Físico</th>
                    <th class="text-primary font-weight-bold">Unidade</th>
                    <th class="text-primary font-weight-bold">Ativo</th>
                    <th class="text-primary font-weight-bold">Ação</th>
                  </thead>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
   @include('cadastros.material.modal')
  
@endsection

@push('js')
  <script>
    $(document).ready(function () {
      const empresaId = "{{ Auth::user()->pessoa_juridica_id }}" || null
      let app = new App({
        apiUrl: '/api/material',
        apiDataTableColumns: [
          { data: "ibama" },
          { data: "tipo_material" },
          { data: "estado_fisico" },
          { data: "unidade" },
          {
            data: "ativo",
            className: "text-center",
            orderable: false,
            render: function (data, type, row) {
              return `<i class="fas fa-${data ? 'check' : 'times'} cursor-pointer changeStatus" data-id="${row.id}" data-value-old="${data}" title="Deseja atualizar o status?"></i>`
            }
          }
        ],
        apiDataTableColumnsDefs : [
          { targets: 1, orderable: false },
        ],
        datatableSelector: '#materialTbl'
      })
     
      // Open Modal New
      $('body').on('click', '#novoMaterial', function() {
        app.stepper()
        delFormValidationErrors()
        $("#modalMaterial").modal("show")
        $('#tituloModal').text("Novo Material")
        $('#input_id').val("")
        $('#formMaterial')[0].reset()
        getIbama()
        getTipoMaterial()
        getUnidade()
        getEstado()
        getEmpresa(empresaId, empresaId ?  true : false)
      })

      // Salvar
      $('body').on('click', '#salvarMaterial', function() {
        const JSONRequest = {
          ibama_id: $("#input_ibama_id").val(),
          estado_fisico: $("#input_estado_fisico").val(),
          gerador_id: $("#input_gerador_id").val(),
          tipo_material_id: $("#input_tipo_material_id").val(),
          unidade_id: $("#input_unidade_id").val(),
        }
        const id = $('#input_id').val()
        if (id) {
          app.api.put(`/material/${id}`, JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalMaterial").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Atualizado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao atualizar, tente novamente')
          })
        } else {
          app.api.post('/material', JSONRequest).then(response => {
            if (response && response.status) {
              $("#modalMaterial").modal("hide")
              app.datatable.ajax.reload()
              notifySuccess('Criado com sucesso')
            }
          })
          .catch(error => {
            addFormValidationErrors(error?.data)
            notifyDanger('Falha ao criar, tente novamente')
          })
        }
      })

      // Editar
      $('body').on('click', '.editAction', function() {
        app.stepper()
        const id = $(this).attr('data-id');
        app.api.get(`/material/${id}`).then(response =>  {
          if (response && response.status) {
            delFormValidationErrors()
            $('#formProduto')[0].reset()
            $("#modalProduto").modal("show");
            $('#tituloModal').text("Editar Produto")
            getIbama(response.data.ibama_id)
            getTipoMaterial(response.data.tipo_material_id)
            getUnidade(response.data.unidade_id)
            getEstado(response.data.estado_fisico)
            getEmpresa(response.data.gerador_id)
          }
        })
        .catch(error => notifyDanger('Falha ao obter detalhes. Tente novamente'))
      })

      // Excluir
      $('body').on('click', '.deleteAction', function() {
        const id = $(this).attr('data-id')
        sweetConfirm('Deseja realmente excluir a clase?').then(confirmed => {
          if (confirmed) {
            app.api.delete(`/material/${id}`).then(response =>  {
              app.datatable.ajax.reload()
              notifySuccess('Excluída com sucesso')
            })
            .catch(error => notifyDanger('Falha ao excluir. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      })

      // Change status
      $('body').on('click', '.changeStatus', function() {
        sweetConfirm('Deseja realmente atualizar?').then(confirmed => {
          if (confirmed) {
            const id = $(this).attr('data-id')
            const valueOld = $(this).attr('data-value-old')
            app.api.put(`/material/${id}/status`, { ativo: parseInt(valueOld) ? 0 : 1 }).then(response =>  {
              if (response && response.status) {
                app.datatable.ajax.reload()
                notifySuccess('Atualizada com sucesso')
              } else {
                notifySuccess('Não foi possível atualizar, tente novamente')
              }
            })
            .catch(error => notifyDanger('Falha ao atualizar. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      })

      function addIbamaDenominacao(data, id) {
        const denominacao = data.find(curr => curr.id == id)?.denominacao || null
        $('#denominacao').val(denominacao)
        console.log('addIbamaDenominacao', denominacao)
      }

      function getIbama(value) {
        app.api.get('/ibama').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_ibama_id', response.data, ['id', 'codigo'], value)
            $('body').on('change', '#input_ibama_id', function(event) {
              addIbamaDenominacao(response.data, event.target.value);
            })
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter dados, tente novamente')
        })
      }

      function getTipoMaterial(value) {
        app.api.get('/tipo_materiais').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_tipo_material_id', response.data, ['id', 'descricao'], value)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter dados, tente novamente')
        })
      }

      function getUnidade(value) {
        app.api.get('/unidad').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_unidade_id', response.data, ['id', 'simbolo'], value)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter dados, tente novamente')
        })
      }

      function getEstado(value) {
        const data = [
          { id: 'solido', descricao: 'Solido' },
          { id: 'liquido', descricao: 'Liquido' },
          { id: 'gasoso', descricao: 'Gasoso' }
        ]
        loadSelect('#input_estado_fisico', data, ['id', 'descricao'], value)
      }

      function getEmpresa(value, disabled) {
        app.api.get('/pessoa_juridica').then(response =>  {
          if (response && response.status) {
            loadSelect('#input_gerador_id', response.data, ['id', 'razao_social'], value, disabled)
          }
        })
        .catch(error => {
          console.log('app.api.get error', error)
          notifyDanger('Falha ao obter empresa, tente novamente')
        })
      }

      // Changes Status 
       $('body').on('click', '.changeStatus', function() {
        sweetConfirm('Deseja realmente atualizar?').then(confirmed => {
          if (confirmed) {
            const id = $(this).attr('data-id')
            const valueOld = $(this).attr('data-value-old')
            app.api.put(`/material/${id}/status`, { ativo: parseInt(valueOld) ? 0 : 1 }).then(response =>  {
              if (response && response.status) {
                app.datatable.ajax.reload()
                notifySuccess('Atualizada com sucesso')
              } else {
                notifySuccess('Não foi possível atualizar, tente novamente')
              }
            })
            .catch(error => notifyDanger('Falha ao atualizar. Tente novamente'))
          }
        }).catch(error => notifyDanger('Ocorreu um erro, tente novamente'))
      })
    })
  </script>
@endpush