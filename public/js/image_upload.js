var originalFileSrc = "";

$('#img-file').change(function() {
    var input = this;
    var url = $(this).val();
    originalFileSrc = $('#img-preview').attr('src');
    var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
    if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) 
     {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img-name').html(input.files[0].name);
            $('#img-preview').attr('src', e.target.result);
            $('#img-reset').css("display", "block");
        }
       reader.readAsDataURL(input.files[0]);
    }
    else
    {
      $('#img-name').html("Pilih foto");
      $('#img-preview').attr('src', originalFileSrc);
      $('#img-reset').css("display", "none");
    }
})

$('#img-reset').click(function() {
  $('#img-file').val('');
  $('#img-name').html("Pilih foto");
  $('#img-preview').attr('src', originalFileSrc);
  $('#img-reset').css("display", "none");
})