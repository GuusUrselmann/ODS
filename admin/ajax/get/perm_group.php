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
if(!isset($_GET['g'])){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'/Groepspermissies">');
}
$getgroup = $pdo->prepare("SELECT * FROM `groups` WHERE `id` = :gid");
$getgroup->execute(["gid"=>$_GET['g']]);
if($getgroup->rowCount() == NULL){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'/Groepspermissies">');
}
$group = $getgroup->fetch();
?>
<div id="paginainhoud" style="display:none;">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark"><?php echo $group['naam']; ?>'s permissies</h1>
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

                <input type="hidden" name="gid" value="<?php echo $group['id']; ?>">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label>Groep naam</label>
                      <input type="text" name="groupnaam" class="form-control" value="<?php echo $group['naam']; ?>">
                    </div>
                  </div>
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
                            if($user->CheckGroupPermission($group['id'], $p['slug'])){
                              echo '<option value="'.$p['slug'].'" selected>'.$p['naam'].'</option>';
                            } else {
                              echo '<option value="'.$p['slug'].'">'.$p['naam'].'</option>';
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
    url: "/admin/ajax/post/groupperms.php",
    type: "post",
    data: serializedData
  });
  request.done(function (response, textStatus, jqXHR){
    console.log(response);
    Toast.fire({
      icon: 'success',
      title: '<?php echo $group['naam']; ?>\'s permissies aangepast'
    })
    $('#groeppermissiespagina').click();
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
