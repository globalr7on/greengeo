// Main js for all views

// $(document).ready(function () {

//     // Stepper
//     var stepperElement = $('.bs-stepper')[0]
//     if (stepperElement) {
//         var stepper = new Stepper(stepperElement)
//         $('.stepper-next').on('click', function (e) {
//           stepper.next()
//         })
//         $('.stepper-prev').on('click', function (e) {
//           stepper.previous()
//         })
//     }
//     // Stepper
// })

class App {
  constructor({...params}) {
    this.api = new Api(params?.baseUrl)
    this.config = {
      apiUrl: params?.apiUrl || null,
      apiDataSrc: params?.apiDataSrc || 'data',
      apiDataTableColumns: params?.apiDataTableColumns || [],
      apiDataTableColumnDefs: params?.apiDataTableColumnDefs || [],
      useDefaultDataTableColumnDefs: params?.useDefaultDataTableColumnDefs || true,
      datatableSelector: params?.datatableSelector || null,
      scrollX: params?.scrollX || false,
    }
    this.default = {
      apiDataTableColumnDefs: [
        {
          targets: this.config.apiDataTableColumns.length,
          render: function (data, type, row) {
            return `<i class="fa fa-trash cursor-pointer deleteAction" data-id="${row.id}" title="Excluir"></i>&nbsp;<i class="fa fa-pen cursor-pointer editAction" data-id="${row.id}" title="Editar"></i>`
          }
        }
      ]
    }
    this.dataTableConfig = {
      language: {
        "url": "//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Portuguese-Brasil.json"
      },
      scrollX: this.config.scrollX,
      dom: 'Bfrtip',
      buttons: [
        {
          extend: 'copyHtml5',
          text: 'Copiar',
          titleAttr: 'Copiar para Área de Transferência',
          className: 'btn-default-light rounded-0 mr-1 py-2 font-weight-bold',
          charset: 'UTF-8',
        },
        {
          extend: 'csv',
          text: 'CSV',
          titleAttr: 'Exportar a CSV',
          className: 'btn-default-light rounded-0 mr-1 py-2 font-weight-bold',
          charset: 'UTF-8',
        },
        {
          extend: 'excel',
          text: 'Excel',
          titleAttr: 'Exportar a Excel',
          className: 'btn-default-light rounded-0 mr-1 py-2 font-weight-bold',
          charset: 'UTF-8',
        },
        {
          extend: 'pdf',
          text: 'PDF',
          titleAttr: 'Exportar a PDF',
          className: 'btn-default-light rounded-0 mr-1 py-2 font-weight-bold',
          charset: 'UTF-8',
        },
        {
          extend: 'print',
          text: 'Imprimir',
          titleAttr: 'Imprimir Documento',
          className: 'btn-default-light rounded-0 mr-1 py-2 font-weight-bold',
          charset: 'UTF-8',
          color: 'black'
        },
      ],
      ajax: {
        url: this.config.apiUrl,
        dataSrc: this.config.apiDataSrc
      },
      columns: this.config.apiDataTableColumns,
      columnDefs : [
        ...this.config.apiDataTableColumnDefs,
        ...this.config.useDefaultDataTableColumnDefs ? this.default.apiDataTableColumnDefs : {},
      ]
    }
    this.datatable = $(this.config.datatableSelector).DataTable(this.dataTableConfig)
  }

  stepper(selector = '.bs-stepper') {
		var stepperElement = $(selector)[0]
    var stepper = null
    if (stepperElement) {
      stepper = new Stepper(stepperElement)
      $('.stepper-next').on('click', function (e) {
        stepper.next()
      })
      $('.stepper-prev').on('click', function (e) {
        stepper.previous()
      })
    }
    return stepper
	}
}

