$('#myTable').on('click', '.btn-delete', function(e){
    e.preventDefault();
    let form = $(this).parents('form');
    swal({
        title: 'Apakah kamu yakin?',
        text: 'Data yang sudah dihapus tidak bisa dikembalikan lagi!',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        buttons: ['Batal', 'Ok']
      })
      .then((willDelete) => {
        if (willDelete) {
            swal({
                title: 'Data dihapus!',
                text: 'Redirecting...',
                icon: 'success',
                timer: 2000,
                buttons: false,
            }).then(() => {
                form.submit();
            })
        }
      });
});

$('.btn-delete').click(function(e){
    e.preventDefault();
    let form = $(this).parents('form');
    swal({
        title: 'Konfirmasi',
        text: 'Hapus produk?',
        icon: 'warning',
        buttons: true,
        dangerMode: true,
        buttons: ['Batal', 'Ok']
      })
      .then((willDelete) => {
        if (willDelete) {
            form.submit();
        }
      });
});
