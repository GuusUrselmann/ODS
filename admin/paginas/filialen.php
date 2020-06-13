<?php
include "../inc/config.php";
$user = new User();
$user->CheckLogin();
$pdo = Database::DB();
if(!$user->CheckPermission($_SESSION['odsuser'], "filialen")){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'">');
}
?>
<div id="paginainhoud" style="display:none;">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Filialen</h1>
        </div>
        <div class="col-sm-6">
          <?php if($user->CheckPermission($_SESSION['odsuser'], "filialen_nieuw")){ ?>
            <button class="btn btn-success float-right" data-toggle="modal" data-target="#nieuwefiliaalmodal">Nieuw Filiaal</button>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>

  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="card">
            <div class="card-body table-responsive">

              <table id="filialen" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Filiaal</th>
                    <th>Postcode</th>
                    <th>Actief</th>
                    <?php if($user->CheckPermission($_SESSION['odsuser'], "filialen_wijzig")){ ?>
                      <th>Bewerk</th>
                    <?php } ?>
                    <?php if($user->CheckPermission($_SESSION['odsuser'], "filialen_openingstijden")){ ?>
                      <th>Openingstijden</th>
                    <?php } ?>
                    <?php if($user->CheckPermission($_SESSION['odsuser'], "filialen_verwijder")){ ?>
                      <th>Verwijder</td>
                      <?php } ?>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    $getfilialen = $pdo->prepare("SELECT * FROM `filialen`");
                    $getfilialen->execute();
                    $filialen = $getfilialen->fetchAll();
                    foreach($filialen as $filiaal){
                      if($user->FiliaalToegang($_SESSION['odsuser'], $filiaal['id']) OR $user->CheckPermission($_SESSION['odsuser'], "filialen_all")){
                        echo "<tr id='".$filiaal['id']."'>";
                        echo "<td>".$filiaal['naam']."</td>";
                        echo "<td>".$filiaal['postcode']."</td>";
                        if($filiaal['actief'] == "1"){
                          echo '<td>Ja</td>';
                        } else {
                          echo '<td>Nee</td>';
                        }
                        if($user->CheckPermission($_SESSION['odsuser'], "filialen_wijzig")){
                          echo "<td><button onclick='bewerk(".$filiaal['id'].")' class='btn btn-warning btn-sm'>Bewerk</button></td>";
                        }
                        if($user->CheckPermission($_SESSION['odsuser'], "filialen_openingstijden")){
                          echo "<td><button onclick='openingstijden(".$filiaal['id'].")' class='btn btn-info btn-sm'>Openingstijden</button></td>";
                        }
                        if($user->CheckPermission($_SESSION['odsuser'], "filialen_verwijder")){
                          echo "<td><button onclick='delfiliaal(".$filiaal['id'].")' class='btn btn-danger btn-sm'>Verwijder</button></td>";
                        }
                        echo "</tr>";
                      }
                    }
                    ?>
                  </tbody>
                  <tfoot>
                    <tr>
                      <th>Filiaal</th>
                      <th>Postcode</th>
                      <th>Actief</th>
                      <?php if($user->CheckPermission($_SESSION['odsuser'], "filialen_wijzig")){ ?>
                        <th>Bewerk</th>
                      <?php } ?>
                      <?php if($user->CheckPermission($_SESSION['odsuser'], "filialen_openingstijden")){ ?>
                        <th>Openingstijden</th>
                      <?php } ?>
                      <?php if($user->CheckPermission($_SESSION['odsuser'], "filialen_verwijder")){ ?>
                        <th>Verwijder</td>
                        <?php } ?>
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
    <?php if($user->CheckPermission($_SESSION['odsuser'], "filialen_nieuw")){ ?>
      <div class="modal fade" id="nieuwefiliaalmodal">
        <form id="newfiliaal" method="post">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h4 class="modal-title">Nieuw Filiaal</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Filiaal Naam</label>
                  <div class="input-group">
                    <input type="text" id="naam" name="naam" class="form-control" required>
                  </div>
                </div>
              </div>
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Sluiten</button>
                <input type="submit" class="btn btn-primary" value="opslaan"/>
              </div>
            </div>
          </div>
        </form>
      </div>
    <?php } ?>
    <script>
    <?php if($user->CheckPermission($_SESSION['odsuser'], "filialen_wijzig")){ ?>
      function bewerk(id){
        laadpagina('/admin/ajax/get/wijzigfiliaal.php?id='+id, 'filialenpagina');
      }
      <?php } ?>
    <?php if($user->CheckPermission($_SESSION['odsuser'], "filialen_openingstijden")){ ?>
      function openingstijden(id){
        laadpagina('/admin/ajax/get/filiaalopeningstijden.php?id='+id, 'filialenpagina');
      }
      <?php } ?>
      <?php if($user->CheckPermission($_SESSION['odsuser'], "filialen_nieuw")){ ?>
        var request;
        $("#newfiliaal").submit(function(event){
          event.preventDefault();
          if (request) {
            request.abort();
          }
          var $form = $(this);
          var $inputs = $form.find("input, select, button, textarea");
          var serializedData = $form.serialize();
          $inputs.prop("disabled", true);
          request = $.ajax({
            url: "/admin/ajax/post/createfiliaal.php",
            type: "post",
            data: serializedData
          });
          request.done(function (response, textStatus, jqXHR){
            $('#nieuwefiliaalmodal').modal('hide');
            Toast.fire({
              icon: 'success',
              title: 'Filiaal Aangemaakt'
            })
            $('#filialenpagina').click();

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
        <?php } ?>
        <?php
        if($user->CheckPermission($_SESSION['odsuser'], "filialen_verwijder")){
          ?>
          function delfiliaal(id){
            if(confirm("Weet je zeker dat dit filiaal verwijderd moet worden?"))
            {
              $.ajax({
                url: "/admin/ajax/post/deletefiliaal.php",
                method:"POST",
                data:{id:id},
                success:function(data){
                  console.log(data);
                  Toast.fire({
                    icon: 'success',
                    title: 'Filiaal is verwijderd'
                  })
                  $('#'+id).fadeOut();
                }
              });
            }
          }
          <?php
        }
        ?>
        $(function () {
          $("#filialen").DataTable({
            "responsive": true,
            "autoWidth": false,
          });
        });
        $(document).ready(function(){
          $("#paginainhoud").fadeIn();
        });
        </script>
