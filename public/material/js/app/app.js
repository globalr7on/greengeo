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
      columnDefs: [
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
    z_index: 1900,
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

function sweetInput({...params}) {
  return swal(params).then(params.successCallback).catch(params.errorCallback)
}

function loadSelect(selector, data, fields = ['id', 'name'], selected = null, disabled = false, callback = undefined) {
  // $(selector).empty().append('<option disabled selected>Seleccione</option>')
  $(selector).empty()
  $.each(data, function(index, value) {
    if (callback) {
      const [optionValue, optionText] = callback(value)
      $(selector).append(`<option value="${optionValue}">${optionText}</option>`)
    } else {
      $(selector).append(`<option value="${value[fields[0]]}">${value[fields[1]]}</option>`)
    }
  })
  $(selector).prop('disabled', disabled)
  $(selector).selectpicker('refresh')
  if (selected) {
    $(selector).selectpicker('val', selected)
  }
}

// Init tooltips
$('[data-toggle="tooltip"]').tooltip()

// Init datapickers
$('.datepicker').datetimepicker({
  locale: "pt-br",
  format: 'DD-MM-YYYY',
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

// Maskcpf
const maskcpf = "999.999.999-99";
$(".maskcpf").each(function () {
  $(this).inputmask({
    mask: maskcpf,
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    autoUnmask: true,
  })
})

setTimeout(() => {
  $(".maskcpf").focus(function () {
    $(this).inputmask("remove")
    return false;
  }).blur(function () {
    $(this).inputmask("remove")
    $(this).inputmask({
      mask: maskcpf,
      clearIncomplete: true,
      removeMaskOnSubmit: true,
      autoUnmask: true,
    })
  })
}, 500)

// Maskcnpj
const maskcnpj = "99.999.999/9999-99"
$(".maskCnpj").each(function () {
  $(this).inputmask({
    mask: maskcnpj,
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    autoUnmask: true,
  })
})

setTimeout(() => {
  $(".maskCnpj").focus(function () {
    $(this).inputmask("remove")
    return false
  }).blur(function () {
    $(this).inputmask("remove")
    $(this).inputmask({
      mask: maskcnpj,
      clearIncomplete: true,
      removeMaskOnSubmit: true,
      autoUnmask: true,
    })
  })
}, 500)

// Maskrg
$(".maskrg").each(function () {
  $(this).inputmask({
    mask: getMaskRg($(this).val()),
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    autoUnmask: true,
  })
})

setTimeout(() => {
  $(".maskrg").focus(function () {
    $(this).inputmask("remove")
    return false
  }).blur(function () {
    $(this).inputmask("remove")
    $(this).inputmask({
      mask: getMaskRg($(this).val()),
      clearIncomplete: true,
      removeMaskOnSubmit: true,
      autoUnmask: true,
    })
  })
}, 500)

function getMaskRg(val) {
  let mask = ""
  switch (val.length) {
    case 10:
      mask = "a-99.999.999"
    break

    case 11:
      mask = "a-99.999.999"
    break

    default:
      mask = "a-99.999.999"
  }
  return mask
}

// const maskpeso = "99999999,99";
// $(".maskpeso").each(function () {
//   $(this).inputmask({
//     mask: maskpeso,
//     clearIncomplete: true,
//     removeMaskOnSubmit: true,
//     autoUnmask: true,
//   });
// });
// setTimeout(() => {
//   $(".maskpeso").focus(function () {
//     $(this).inputmask("remove");
//     return false;
//   }).blur(function () {
//     $(this).inputmask("remove");
//     $(this).inputmask({
//       mask: maskpeso,
//       clearIncomplete: true,
//       removeMaskOnSubmit: true,
//       autoUnmask: true,
//     });
//   });
// }, 500);
     
// MaskCep 
const maskcep = "99999-999"
$(".maskcep").each(function () {
  $(this).inputmask({
    mask: maskcep,
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    autoUnmask: true,
  })
})

setTimeout(() => {
  $(".maskcep").focus(function () {
    $(this).inputmask("remove")
    return false
  }).blur(function () {
    $(this).inputmask("remove")
    $(this).inputmask({
      mask: maskcep,
      clearIncomplete: true,
      removeMaskOnSubmit: true,
      autoUnmask: true,
    })
  })
}, 500)

// MaskCep 
const maskcarteira = "99999999999"
$(".maskcarteira").each(function () {
  $(this).inputmask({
    mask: maskcarteira,
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    autoUnmask: true,
  })
})

setTimeout(() => {
  $(".maskcarteira").focus(function () {
    $(this).inputmask("remove")
    return false
  }).blur(function () {
    $(this).inputmask("remove")
    $(this).inputmask({
      mask: maskcarteira,
      clearIncomplete: true,
      removeMaskOnSubmit: true,
      autoUnmask: true,
    })
  })
}, 500)

// Maskrenavam
const maskrenavam = "99999999999";
$(".maskrenavam").each(function () {
  $(this).inputmask({
    mask: maskrenavam,
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    autoUnmask: true,
  })
})

setTimeout(() => {
  $(".maskrenavam").focus(function () {
    $(this).inputmask("remove")
    return false
  }).blur(function () {
    $(this).inputmask("remove")
    $(this).inputmask({
      mask: maskrenavam,
      clearIncomplete: true,
      removeMaskOnSubmit: true,
      autoUnmask: true,
    })
  })
}, 500)

// MaskPlaca
const maskplaca = "aaa-9a99"
$(".maskplaca").each(function () {
  $(this).inputmask({
    mask: maskplaca,
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    autoUnmask: true,
  })
})

setTimeout(() => {
  $(".maskplaca").focus(function () {
    $(this).inputmask("remove")
    return false
  }).blur(function () {
    $(this).inputmask("remove")
    $(this).inputmask({
      mask: maskplaca,
      clearIncomplete: true,
      removeMaskOnSubmit: true,
      autoUnmask: true,
    })
  })
}, 500)

// MaskChaveAcesso
const maskchave = "9999-9999-9999-9999-9999-9999-9999-9999-9999-9999"
$(".maskchave").each(function () {
  $(this).inputmask({
    mask: maskchave,
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    autoUnmask: true,
  })
})

setTimeout(() => {
  $(".maskchave").focus(function () {
    $(this).inputmask("remove")
    return false
  }).blur(function () {
    $(this).inputmask("remove")
    $(this).inputmask({
      mask: maskchave,
      clearIncomplete: true,
      removeMaskOnSubmit: true,
      autoUnmask: true,
    })
  })
}, 500)

// MaskWhats
const maskwhats = "(99)99999-9999"
$(".maskwhats").each(function () {
  $(this).inputmask({
    mask: maskwhats,
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    autoUnmask: true,
  })
})

setTimeout(() => {
  $(".maskwhats").focus(function () {
    $(this).inputmask("remove")
    return false
  }).blur(function () {
    $(this).inputmask("remove")
    $(this).inputmask({
      mask: maskwhats,
      clearIncomplete: true,
      removeMaskOnSubmit: true,
      autoUnmask: true,
    })
  })
}, 500)

// MaskPhone
const maskphone1 = "(99)99999-9999"
$(".maskphone1").each(function () {
  $(this).inputmask({
    mask: maskphone1,
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    autoUnmask: true,
  })
})

setTimeout(() => {
  $(".maskphone1").focus(function () {
    $(this).inputmask("remove")
    return false
  }).blur(function () {
    $(this).inputmask("remove")
    $(this).inputmask({
      mask: maskphone1,
      clearIncomplete: true,
      removeMaskOnSubmit: true,
      autoUnmask: true,
    })
  })
}, 500)

const maskphone2 = "(99)99999-9999"
$(".maskphone2").each(function () {
  $(this).inputmask({
    mask: maskphone2,
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    autoUnmask: true,
  })
})

setTimeout(() => {
  $(".maskphone2").focus(function () {
    $(this).inputmask("remove")
    return false
  }).blur(function () {
    $(this).inputmask("remove")
    $(this).inputmask({
      mask: maskphone2,
      clearIncomplete: true,
      removeMaskOnSubmit: true,
      autoUnmask: true,
    })
  })
}, 500)

const maskfixo = "(99)9999-9999"
$(".maskfixo").each(function () {
  $(this).inputmask({
    mask: maskfixo,
    clearIncomplete: true,
    removeMaskOnSubmit: true,
    autoUnmask: true,
  })
})

setTimeout(() => {
  $(".maskfixo").focus(function () {
    $(this).inputmask("remove")
    return false
  }).blur(function () {
    $(this).inputmask("remove")
    $(this).inputmask({
      mask: maskfixo,
      clearIncomplete: true,
      removeMaskOnSubmit: true,
      autoUnmask: true,
    })
  })
}, 500)

function maskPeso(selector, initVal = '') {
  $(selector).maskWeight({
    integerDigits: 8,
    decimalDigits: 2,
    decimalMark: ',',
    initVal: initVal,
    roundingZeros: true,
    digitsCount: 8,
    callBack: null,
    doFocus: true
  })
}

// Formats
function formatStringToFloat(value) {
  return value ? parseFloat(value.replace(',', '.')) || null : null
}

function formatFloatToString(value) {
  return value ? String(value).replace('.', ',') : ''
}

function validarCNPJ(cnpj) {
  cnpj = cnpj.replace(/[^\d]+/g,'')
  if(cnpj == '' || cnpj.length != 14) {
    return false
  }
     
  // Valida DVs
  tamanho = cnpj.length - 2
  numeros = cnpj.substring(0, tamanho)
  digitos = cnpj.substring(tamanho)
  soma = 0;
  pos = tamanho - 7
  for (i = tamanho; i >= 1; i--) {
    soma += numeros.charAt(tamanho - i) * pos--
    if (pos < 2){
      pos = 9
    }
  }
  resultado = soma % 11 < 2 ? 0 : 11 - soma % 11
  if (resultado != digitos.charAt(0)) {
    return false
  }
  tamanho = tamanho + 1
  numeros = cnpj.substring(0, tamanho)
  soma = 0
  pos = tamanho - 7
  for (i = tamanho; i >= 1; i--) {
    soma += numeros.charAt(tamanho - i) * pos--
    if (pos < 2) {
      pos = 9
    }
  }
  resultado = soma % 11 < 2 ? 0 : 11 - soma % 11
  if (resultado != digitos.charAt(1)) {
    return false
  }
  return true
}

function getRandomColor() {
  return `#${Math.floor(Math.random()*16777215).toString(16)}`
}