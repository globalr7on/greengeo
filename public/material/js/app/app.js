// Main js for all views

class App {
  constructor({...params}) {
    this.token = localStorage.getItem('token')
    this.api = new Api({baseUrl: params?.baseUrl, token: this.token})
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
        dataSrc: this.config.apiDataSrc,
        headers: {
          'Content-Type': 'application/json',
          'Authorization': `Bearer ${this.token}`,
        }
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

function addInputError(inputId, error) {
  (Array.isArray(error) ? error : [error]).map(currError => {
    $(`#${inputId}`).addClass("error").parent().append(`<label id="${inputId}-error" class="error mb-0" for="${inputId}">${currError}</label>`)
    $(`#${inputId}`).parent().find('label').addClass("error")
  })
}

function delFormValidationErrors() {
  $('.error').removeClass('error')
  $('label[id$="-error"]').remove()
}

function addFormValidationErrors(data) {
  if (!Object.keys(data).length) {
    return
  }
  delFormValidationErrors()
  Object.keys(data).map(field => addInputError(`input_${field}`, data[field]))
}

// NOTIFICATIONS
function _showNotification(from, align, type = "success", icon = "add_alert", message = "Successfully") {
  $.notify({
    icon: icon,
    message: message
  },{
    type: type,
    delay: 2000,
    timer: 1000,
    placement: {
      from: from,
      align: align
    }
  })
}

function notifySuccess(message) {
  _showNotification('top', 'right', type = "success", icon = "add_alert", message = message)
}

function notifyWarning(message) {
  _showNotification('top', 'right', type = "warning", icon = "add_alert", message = message)
}

function notifyInfo(message) {
  _showNotification('top', 'right', type = "info", icon = "add_alert", message = message)
}

function notifyDanger(message) {
  _showNotification('top', 'right', type = "danger", icon = "add_alert", message = message)
}

function sweetConfirm(message, title = "Aviso!") {
  return new Promise((resolve, reject) => {
    swal({
      title: title,
      text: message,
      type: "question",
      buttonsStyling: false,
      showConfirmButton: true,
      confirmButtonClass: "btn btn-success",
      showCancelButton: true,
      cancelButtonClass: "btn btn-danger",
    })
    .then(result => resolve(result?.dismiss ? false : true))
    .catch(error => reject(error))
  })
}

function loadSelect(selector, data, fields = ['id', 'name'], selected = null) {
  $(selector).empty().append('<option disabled selected>Seleccione</option>')
  $.each(data, function(index, value) {
    $(selector).append(`<option value="${value[fields[0]]}">${value[fields[1]]}</option>`)
  })
  $(selector).selectpicker('refresh')
  if (selected) {
    $(selector).selectpicker('val', selected)
  }
}

// Maskcpf
const maskcpf = "999.999.999-99";
$(".maskcpf").each(function () {
  $(this).inputmask({
    mask: maskcpf,
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    autoUnmask: true,
  });
});
setTimeout(() => {
  $(".maskcpf").focus(function () {
    $(this).inputmask("remove");
    return false;
  }).blur(function () {
    $(this).inputmask("remove");
    $(this).inputmask({
      mask: maskcpf,
      clearIncomplete: true,
      removeMaskOnSubmit: true,
      autoUnmask: true,
    });
  });
}, 500);

// Maskcnpj
const maskcnpj = "99.999.999/9999-99";
$(".maskCnpj").each(function () {
  $(this).inputmask({
    mask: maskcnpj,
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    autoUnmask: true,
  });
});
setTimeout(() => {
  $(".maskCnpj").focus(function () {
    $(this).inputmask("remove");
    return false;
  }).blur(function () {
    $(this).inputmask("remove");
    $(this).inputmask({
      mask: maskcnpj,
      clearIncomplete: true,
      removeMaskOnSubmit: true,
      autoUnmask: true,
    });
  });
}, 500);

// Maskrg
$(".maskrg").each(function () {
  $(this).inputmask({
    mask: getMaskRg($(this).val()),
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    autoUnmask: true,
  });
});
setTimeout(() => {
  $(".maskrg").focus(function () {
    $(this).inputmask("remove");
    return false;
  }).blur(function () {
    $(this).inputmask("remove");
    $(this).inputmask({
      mask: getMaskRg($(this).val()),
      clearIncomplete: true,
      removeMaskOnSubmit: true,
      autoUnmask: true,
    });
  });
}, 500);

function getMaskRg(val) {
  let mask = "";
  switch (val.length) {
    case 10:
      mask = "aa-99.999.999";
      break;

    case 11:
      mask = "aa-99.999.999";
      break;

    default:
      mask = "aa-99.999.999";
  }
  return mask;
}
// MaskPeso 
const maskpeso = "99.99 KG";
$(".maskpeso").each(function () {
  $(this).inputmask({
    mask: maskpeso,
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    autoUnmask: true,
  });
});
setTimeout(() => {
  $(".maskpeso").focus(function () {
    $(this).inputmask("remove");
    return false;
  }).blur(function () {
    $(this).inputmask("remove");
    $(this).inputmask({
      mask: maskpeso,
      clearIncomplete: true,
      removeMaskOnSubmit: true,
      autoUnmask: true,
    });
  });
}, 500);
     
// MaskCep 
// $("#input_cep").each(function () {
//   $(this).inputmask({
//     mask: getMaskCep($(this).val()),
//     clearIncomplete: true,
//     removeMaskOnSubmit: true,
//     autoUnmask: true,
//   });
// });
// setTimeout(() => {
//   $("#input_cep").focus(function () {
//     $(this).inputmask("remove");
//     return false;
//   }).blur(function () {
//     $(this).inputmask("remove");
//     $(this).inputmask({
//       mask: getMaskCep($(this).val()),
//       clearIncomplete: true,
//       removeMaskOnSubmit: true,
//       autoUnmask: true,
//     });
//   });
// }, 500);

// function getMaskCep(val) {
//   let mask = "";          
//   switch (val.length) {
//     default:
//       mask = "999999-999";
//   }
//   return mask;
// }