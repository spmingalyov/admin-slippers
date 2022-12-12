$(document).ready(function(e){
  $("#max").change(function() {
    $("#maxRange").submit();
 });

  $('#maxRange').on('sumbit', function(e) {
    e.preventDefault();
    let formData = new FormData(this);

    $.ajax({
      type: 'POST',
      url: $(this).attt('action'),
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(data) {
        console.log('succecc');
        console.log(data);
      },
      error: function(data) {
        console.log('error');
        console.log(data);
      }
    })
  })

})

