<?php
include "../inc/config.php";
$user = new User();
$system = new System();
$user->CheckLogin();
$pdo = Database::DB();
if(!$user->CheckPermission($_SESSION['odsuser'], "perms_users")){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'">');
}
?>
<div id="paginainhoud" style="display:none;">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Gebruikers</h1>
        </div>
        <div class="col-sm-6">
          <button class="btn btn-success float-right">Nieuwe Gebruiker</button>
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

              <table id="gebruikers" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Gebruiker</th>
                    <th>Groep</th>
                    <th>Bewerk</th>
                    <th>Verwijder</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $getusers = $pdo->prepare("SELECT * FROM `users`");
                  $getusers->execute();
                  $users = $getusers->fetchAll();
                  foreach($users as $user){
                    echo "<tr id='".$user['id']."'>";
                    echo "<td>".$user['fullname']."</td>";
                    echo "<td>".$system->GetGroupName($user['groep'])."</td>";
                    echo "<td><button onclick='bewerk(".$user['id'].")' class='btn btn-warning btn-sm'>Bewerk</button></td>";
                    echo "<td><button onclick='verwijder(".$user['id'].")' class='btn btn-danger btn-sm'>Verwijder</button></td>";
                    echo "</tr>";
                  }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Gebruiker</th>
                    <th>Groep</th>
                    <th>Bewerk</th>
                    <th>Verwijder</th>
                  </tr>
                </tfoot>
              </table>

            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<script>
function bewerk(uid){
  $('#paginainhoud').fadeOut({
    complete: function () {
      $("#paginacontent").load("/admin/ajax/get/perm_user.php?u="+uid, function(responseText, textStatus, req) {});
    }
  });
}
$(function () {
  $("#gebruikers").DataTable({
    "responsive": true,
    "autoWidth": false,
  });
});
$(document).ready(function(){
  $("#paginainhoud").fadeIn();
});
</script>
