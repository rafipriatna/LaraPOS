"use strict";

const flashMessageSuccess = $('.flash-message-success').data('flashmessage');
const flashMessageFail = $('.flash-message-fail').data('flashmessage');
const transactionCode = $('.flash-message-success').data('transactioncode');

if (flashMessageSuccess){
    iziToast.success({
        title: 'Success',
        message: flashMessageSuccess,
        position: 'topRight'
    });

    if (flashMessageSuccess == "Transaksi berhasil disimpan!") {
      window.open('/struk/' + transactionCode, 'mywindow', 'toolbar=0,scrollbars=1,statusbar=0,menubar=0,resizable=0,height=500,width=420')
    }
}

if (flashMessageFail){
  iziToast.error({
    title: 'Error',
    message: flashMessageFail,
    position: 'topRight'
  });
}

$("#toast-info").click(function() {
  iziToast.info({
    title: 'Hello, world!',
    message: 'This awesome plugin is made iziToast toastr',
    position: 'topRight'
  });
});

$("#toast-warning").click(function() {
  iziToast.warning({
    title: 'Hello, world!',
    message: 'This awesome plugin is made by iziToast',
    position: 'topRight'
  });
});

$("#toast-error").click(function() {
  iziToast.error({
    title: 'Hello, world!',
    message: 'This awesome plugin is made by iziToast',
    position: 'topRight'
  });
});