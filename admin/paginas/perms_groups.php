<?php
include "../inc/config.php";
$user = new User();
$user->CheckLogin();
$pdo = Database::DB();
if(!$user->CheckPermission($_SESSION['odsuser'], "perms_groups")){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'">');
}
?>
<div id="paginainhoud" style="display:none;">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Permissie Groepen</h1>
        </div>
        <div class="col-sm-6">
          <button class="btn btn-success float-right">Nieuwe Groep</button>
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

              <table id="groepen" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Groep</th>
                    <th>Bewerk</th>
                    <th>Verwijder</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $getgroups = $pdo->prepare("SELECT * FROM `groups`");
                  $getgroups->execute();
                  $groups = $getgroups->fetchAll();
                  foreach($groups as $group){
                    echo "<tr id='".$group['id']."'>";
                    echo "<td>".$group['naam']."</td>";
                    echo "<td><button onclick='bewerk(".$group['id'].")' class='btn btn-warning btn-sm'>Bewerk</button></td>";
                    echo "<td><button onclick='verwijder(".$group['id'].")' class='btn btn-danger btn-sm'>Verwijder</button></td>";
                    echo "</tr>";
                  }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
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
      $("#paginacontent").load("/admin/ajax/get/perm_group.php?g="+uid, function(responseText, textStatus, req) {});
    }
  });
}
$(function () {
  $("#groepen").DataTable({
    "responsive": true,
    "autoWidth": false,
  });
});
$(document).ready(function(){
  $("#paginainhoud").fadeIn();
});
</script>
