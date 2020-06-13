<?php
include "../../inc/config.php";
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
  header('HTTP/1.0 403 Forbidden');
  die();
}
$user = new User();
$user->CheckLogin();
$pdo = Database::DB();
if(!$user->CheckPermission($_SESSION['odsuser'], "perms_groups")){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'">');
}
if(!isset($_GET['u'])){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'/Gebruikerpermissies">');
}
$getuser = $pdo->prepare("SELECT * FROM `users` WHERE `id` = :uid");
$getuser->execute(["uid"=>$_GET['u']]);
if($getuser->rowCount() == NULL){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'/Gebruikerpermissies">');
}
$userinfo = $getuser->fetch();
?>
<div id="paginainhoud" style="display:;">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php echo $userinfo['fullname']; ?>'s permissies</h1>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <form id="grouppermsform">

                <input type="hidden" name="uid" value="<?php echo $userinfo['id']; ?>">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Gebruikersnaam</label>
                      <input type="text" disabled class="form-control" value="<?php echo $userinfo['username']; ?>">
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Volledige naam</label>
                      <input type="text" name="fullname" class="form-control" value="<?php echo $userinfo['fullname']; ?>" required>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Filialen</label>
                      <select class="form-control select2bs4" name="filialenbeheer[]" multiple data-placeholder="Selecteer Filialen" placeholder="Selecteer Filialen" style="width: 100%;">
                        <?php
                        $getfilialen = $pdo->prepare("SELECT * FROM `filialen` ORDER BY `naam`");
                        $getfilialen->execute();
                        $filialen = $getfilialen->fetchAll();
                        foreach($filialen as $filiaal){
                          if($user->FiliaalToegang($userinfo['id'], $filiaal['id'])){
                            echo '<option selected value="'.$filiaal['id'].'">'.$filiaal['naam'].'</option>';
                          } else {
                            echo '<option value="'.$filiaal['id'].'">'.$filiaal['naam'].'</option>';
                          }
                        }
                        ?>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-12"><hr></div>
                  <?php
                  $getpermgroup = $pdo->prepare("SELECT * FROM `perms` GROUP BY `cat`");
                  $getpermgroup->execute();
                  $permgroups = $getpermgroup->fetchAll();
                  foreach($permgroups as $pg){
                    ?>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label><?php echo $pg['cat'];?></label>
                        <select class="form-control select2bs4" name="<?php echo $pg['cat']; ?>[]" multiple data-placeholder="Selecteer Permissies" placeholder="Selecteer Permissies" style="width: 100%;">
                          <?php
                          $getpermissions = $pdo->prepare("SELECT * FROM `perms` WHERE `cat` = :cat ORDER BY `naam`");
                          $getpermissions->execute(["cat"=>$pg['cat']]);
                          $permissions = $getpermissions->fetchAll();
                          foreach($permissions as $p){
                            if($user->CheckGroupPermission($userinfo['groep'], $p['slug'])){
                              echo '<option disabled>'.$p['naam'].' (Via groep)</option>';
                            } else {
                              if($user->CheckUserPermission($userinfo['id'], $p['slug'])){
                                echo '<option selected value="'.$p['slug'].'">'.$p['naam'].'</option>';
                              } else {
                                echo '<option value="'.$p['slug'].'">'.$p['naam'].'</option>';
                              }
                            }
                          }
                          ?>
                        </select>
                      </div>
                    </div>
                    <?php
                  }
                  ?>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="submit" class="btn btn-success btn-block" value="Opslaan">
                    </div>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
var request;
$("#grouppermsform").submit(function(event){
  event.preventDefault();
  if (request) {
    request.abort();
  }
  var $form = $(this);
  var $inputs = $form.find("input, select, button, textarea");
  var serializedData = $form.serialize();
  $inputs.prop("disabled", true);
  request = $.ajax({
    url: "/admin/ajax/post/userperms.php",
    type: "post",
    data: serializedData
  });
  request.done(function (response, textStatus, jqXHR){
    Toast.fire({
      icon: 'success',
      title: '<?php echo $group['naam']; ?>\'s permissies aangepast'
    })
    $('#gebruikerpermissiespagina').click();
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

$(function () {
  $('.select2bs4').select2({
    theme: 'bootstrap4'
  });
});
$(document).ready(function(){
  $("#paginainhoud").fadeIn();
});
</script>
