var sitetitle = "ODS";
var actievemenu = document.getElementById("homepagina");
var pagepath;
function wait(ms){
  var start = new Date().getTime();
  var end = start;
  while(end < start + ms) {
    end = new Date().getTime();
  }
}


function laadpagina(pagepath, menuid) {
  $(".overlay-wrapper").fadeIn("fast");
  var timeStampInMs = window.performance && window.performance.now && window.performance.timing && window.performance.timing.navigationStart ? window.performance.now() + window.performance.timing.navigationStart : Date.now();
  $('#paginainhoud').fadeOut({
    complete: function () {
      $("#paginacontent").load(pagepath, function(responseText, textStatus, req) {
        $(".overlay-wrapper").fadeOut("fast");
        if (textStatus == "error") {
          $("#paginacontent").load("/paginas/home.php?404");
        }
      });
      actievemenu.classList.remove("active");
      actievemenu = document.getElementById(menuid);
      actievemenu.classList.add("active");
    }
  });
}

$("#homepagina").click(function(){
  laadpagina('/admin/paginas/home.php', 'homepagina');
  $(document).prop('title', sitetitle+' - Home');
  window.history.pushState('Homepagina', 'Homepagina', '/admin/Home');
});
$("#couponpagina").click(function(){
  laadpagina('/admin/paginas/couponcodes.php', 'couponpagina');
  $(document).prop('title', sitetitle+' - Couponcodes');
  window.history.pushState('couponpagina', 'couponpagina', '/admin/Couponcodes');
});
$("#groeppermissiespagina").click(function(){
  laadpagina('/admin/paginas/perms_groups.php', 'groeppermissiespagina');
  $(document).prop('title', sitetitle+' - Groepspermissies');
  window.history.pushState('groeppermissiespagina', 'groeppermissiespagina', '/admin/Groepspermissies');
});
$("#gebruikerpermissiespagina").click(function(){
  laadpagina('/admin/paginas/perms_users.php', 'gebruikerpermissiespagina');
  $(document).prop('title', sitetitle+' - Gebruikerspermissies');
  window.history.pushState('gebruikerpermissiespagina', 'gebruikerpermissiespagina', '/admin/Gebruikerpermissies');
});
$("#filialenpagina").click(function(){
  laadpagina('/admin/paginas/filialen.php', 'filialenpagina');
  $(document).prop('title', sitetitle+' - Filialen');
  window.history.pushState('filialenpagina', 'filialenpagina', '/admin/Filialen');
});

function error404(){
  laadpagina('/admin/paginas/home.php?404', 'homepagina');
  $(document).prop('title','Hoggle All Seeing Eye - 404');
  window.history.pushState('404', '404', '/admin/404');
}
