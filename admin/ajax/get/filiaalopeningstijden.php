<?php
include "../../inc/config.php";
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
  header('HTTP/1.0 403 Forbidden');
  die();
}
$user = new User();
$user->CheckLogin();
$pdo = Database::DB();
if(!$user->CheckPermission($_SESSION['odsuser'], "filialen_openingstijden")){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'/Filialen">');
}
if(!isset($_GET['id'])){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'/Filialen">');
}
$getfiliaal = $pdo->prepare("SELECT * FROM `filialen` WHERE `id` = :id");
$getfiliaal->execute(["id"=>$_GET['id']]);
if($getfiliaal->rowCount() == NULL){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'/Filialen">');
}
if(!$user->FiliaalToegang($_SESSION['odsuser'], $_GET['id']) AND !$user->CheckPermission($_SESSION['odsuser'], "filialen_all")){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'/Filialen">');
}
$f = $getfiliaal->fetch();
?>
<div id="paginainhoud" style="display:none!important">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Openingstijden van "<?php echo $f['naam']; ?>"</h1>
        </div>
      </div>
    </div>
  </div>
  <form method="post" id="openingstijdenform">
    <input type="hidden" name="fid" value="<?php echo $f['id']; ?>">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Afhaal Openingstijden</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3"><b>Dag</b></div>
                  <div class="col-sm-3"><b>Open/Gesloten</b></div>
                  <div class="col-sm-6"><b>Openingstijden</b></div>
                </div>
                <?php openingstijdenafhalen(1, $f['id']); ?>
                <?php openingstijdenafhalen(2, $f['id']); ?>
                <?php openingstijdenafhalen(3, $f['id']); ?>
                <?php openingstijdenafhalen(4, $f['id']); ?>
                <?php openingstijdenafhalen(5, $f['id']); ?>
                <?php openingstijdenafhalen(6, $f['id']); ?>
                <?php openingstijdenafhalen(0, $f['id']); ?>
              </div>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Bezorging Openingstijden</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3"><b>Dag</b></div>
                  <div class="col-sm-3"><b>Open/Gesloten</b></div>
                  <div class="col-sm-6"><b>Openingstijden</b></div>
                </div>
                <?php openingstijdenbezorgen(1, $f['id']); ?>
                <?php openingstijdenbezorgen(2, $f['id']); ?>
                <?php openingstijdenbezorgen(3, $f['id']); ?>
                <?php openingstijdenbezorgen(4, $f['id']); ?>
                <?php openingstijdenbezorgen(5, $f['id']); ?>
                <?php openingstijdenbezorgen(6, $f['id']); ?>
                <?php openingstijdenbezorgen(0, $f['id']); ?>
              </div>
            </div>
          </div>
          <div class="col-lg-12">
            <div class="row">
              <button type="submit" class="btn btn-lg btn-block btn-success">Opslaan</button>
            </div>
          </div>

        </div>
      </div>
    </div>
  </form>
</div>
<script>
var request;
$("#openingstijdenform").submit(function(event){
  event.preventDefault();
  if (request) {
    request.abort();
  }
  var $form = $(this);
  var $inputs = $form.find("input, select, button, textarea");
  var serializedData = $form.serialize();
  $inputs.prop("disabled", true);
  request = $.ajax({
    url: "/admin/ajax/post/openingstijden.php",
    type: "post",
    data: serializedData
  });
  request.done(function (response, textStatus, jqXHR){
    console.log(response);
    Toast.fire({
      icon: 'success',
      title: 'Openingstijden Aangepast'
    })
    laadpagina('/admin/ajax/get/filiaalopeningstijden.php?id=<?php echo $f['id']; ?>', 'filialenpagina');
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
$(document).ready(function(){
  $("#paginainhoud").fadeIn();
});
</script>
