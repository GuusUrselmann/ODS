const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
var request;
$("#loginform").submit(function(event){
  event.preventDefault();
  if (request) {
    request.abort();
  }
  var $form = $(this);
  var $inputs = $form.find("input, select, button, textarea");
  var serializedData = $form.serialize();
  $inputs.prop("disabled", true);
  request = $.ajax({
    url: "/admin/ajax/post/login.php",
    type: "post",
    data: serializedData
  });
  request.done(function (response, textStatus, jqXHR){
    console.log(response);
    if(response === "ok"){
      Toast.fire({
        icon: 'success',
        title: ' Login Goedgekeurd. Je word zo doorgestuurd'
      })
      setTimeout(function(){
        window.location.reload(1);
      }, 2000);
    } else {
      Toast.fire({
        icon: 'error',
        title: ' Er is iets fout gegaan. Probeer het opnieuw'
      })
      $('#username').val("");
      $('#password').val("");
    }

  });
  request.fail(function (jqXHR, textStatus, errorThrown){
    console.error(
      "Er is iets fouts gegaan: "+
      textStatus, errorThrown, jqXHR
    );
  });
  request.always(function () {
    $inputs.prop("disabled", false);
  });
});
