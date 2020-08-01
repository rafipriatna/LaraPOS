"use strict";

const flashMessageSuccess = $('.flash-message-success').data('flashmessage');

if (flashMessageSuccess){
    iziToast.success({
        title: 'Success',
        message: flashMessageSuccess,
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