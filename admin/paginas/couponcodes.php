<?php
include "../inc/config.php";
$user = new User();
$systen = new System();
$user->CheckLogin();
$pdo = Database::DB();
if(!$user->CheckPermission($_SESSION['odsuser'], "coupon")){
  die('<meta http-equiv="refresh" content="0; url='.adminurl.'">');
}
?>
<div id="paginainhoud" style="display:none!important;">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Couponcodes</h1>
        </div>
        <div class="col-sm-6">
          <?php if($user->CheckPermission($_SESSION['odsuser'], "coupon_maken")){ ?>
            <button class="btn btn-success float-right" data-toggle="modal" data-target="#nieuwecouponmodal">Nieuwe Couponcode</button>
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
            <div class="card-body">

              <table id="couponcodes" class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>Couponcode</th>
                    <th>Korting</th>
                    <th>Min. Bedrag</th>
                    <th>Eenmalig</th>
                    <th>Actief</th>
                    <th>Geldig tot</th>
                    <?php if($user->CheckPermission($_SESSION['odsuser'], "coupon_wijzig")){ ?>
                      <th>Bewerk</th>
                    <?php } ?>
                    <?php if($user->CheckPermission($_SESSION['odsuser'], "coupon_verwijderen")){ ?>
                      <th>Verwijder</th>
                    <?php } ?>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $getcoupons = $pdo->prepare("SELECT * FROM `couponcodes` ORDER BY `code`");
                  $getcoupons->execute();
                  $coupons = $getcoupons->fetchAll();
                  foreach($coupons as $coupon){
                    if($user->FiliaalToegang($_SESSION['odsuser'], $coupon['filiaal']) OR $coupon['filiaal'] == "0"){
                      echo "<tr id='".$coupon['id']."'>";
                      echo "<td>".$coupon['code']."</td>";
                      if($coupon['soort'] == "bedrag"){
                        echo "<td>&euro; ".$coupon['waarde']."</td>";
                      } else {
                        echo "<td>".$coupon['waarde']."%</td>";
                      }
                      echo "<td>&euro; ".$coupon['min']."</td>";
                      echo "<td>".$coupon['eenmalig']."</td>";
                      echo "<td>".$coupon['actief']."</td>";
                      echo "<td>".date("d-m-Y H:i", $coupon['einddatum'])."</td>";
                      if($user->CheckPermission($_SESSION['odsuser'], "coupon_wijzig")){
                        echo "<td><button onclick='editcoupon(".$coupon['id'].")' class='btn btn-warning btn-sm'>Bewerk</button></td>";
                      }
                      if($user->CheckPermission($_SESSION['odsuser'], "coupon_verwijderen")){
                        echo "<td><button onclick='delcoupon(".$coupon['id'].")' class='btn btn-danger btn-sm'>Verwijder</button></td>";
                      }
                      echo "</tr>";
                    }
                  }
                  ?>
                </tbody>
                <tfoot>
                  <tr>
                    <th>Couponcode</th>
                    <th>Korting</th>
                    <th>Min. Bedrag</th>
                    <th>Eenmalig</th>
                    <th>Actief</th>
                    <th>Geldig tot</th>
                    <?php if($user->CheckPermission($_SESSION['odsuser'], "coupon_wijzig")){ ?>
                      <th>Bewerk</th>
                    <?php } ?>
                    <?php if($user->CheckPermission($_SESSION['odsuser'], "coupon_verwijderen")){ ?>
                      <th>Verwijder</th>
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
<?php if($user->CheckPermission($_SESSION['odsuser'], "coupon_maken")){ ?>
  <div class="modal fade" id="nieuwecouponmodal">
    <form id="newcouponform" method="post">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Nieuwe Couponcode</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label>Couponcode</label>
              <div class="input-group">
                <input type="text" id="couponcode" name="couponcode" class="form-control" required>
                <span class="input-group-append">
                  <button type="button" onclick="random();" class="btn btn-info">Willekeurig</button>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label>Geldig tot</label>
              <input id="datemask" name="einddatum" value="<?php echo date("d-m-Y 23:59", strtotime("+5 days")); ?>" type="text" class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="dd-mm-yyyy HH:MM" data-mask="" im-insert="false" required>
            </div>
            <div class="form-group">
              <label>Filiaal</label>
              <select name="filiaal" class="form-control">
                <?php if($user->CheckPermission($_SESSION['odsuser'], "coupon_allefilialen")){ ?>
                  <option value="0">Alle Filialen</option>
                <?php } ?>
                <?php
                $getfilialen = $pdo->prepare("SELECT * FROM `filialen` ORDER BY `naam`");
                $getfilialen->execute();
                $filialen = $getfilialen->fetchAll();
                foreach($filialen as $filiaal){
                  if($user->FiliaalToegang($_SESSION['odsuser'], $filiaal['id'])){
                    echo '<option value="'.$filiaal['id'].'">'.$filiaal['naam'].'</option>';
                  }
                }
                ?>
              </select>
            </div>
            <div class="form-group">
              <label>Soort korting</label>
              <select name="soort" class="form-control">
                <option value="bedrag">Vast Bedrag</option>
                <option value="procent">Percentage op totaalbedrag</option>
              </select>
            </div>
            <div class="form-group">
              <label>Bedrag / Percentage</label>
              <input name="waarde" type="text" class="form-control" placeholder="5.50 / 20" required>
            </div>
            <div class="form-group">
              <label>Afhalen of Bezorgen</label>
              <select name="type" class="form-control">
                <option value="afhalen">Afhalen</option>
                <option value="bezorgen">Bezorgen</option>
                <option value="beide">Afhalen en Bezorgen</option>
              </select>
            </div>
            <div class="form-group">
              <label>Minimaal Bestelbedrag</label>
              <input name="min" type="text" class="form-control" placeholder="5.50" required>
            </div>
            <div class="form-group">
              <label>Eenmalig geldig</label>
              <select name="eenmalig" class="form-control">
                <option value="nee">Nee</option>
                <option value="ja">Ja</option>
              </select>
            </div>
            <div class="form-group">
              <label>Is actief</label>
              <select name="actief" class="form-control">
                <option value="ja">Ja</option>
                <option value="nee">Nee</option>
              </select>
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
<?php if($user->CheckPermission($_SESSION['odsuser'], "coupon_wijzig")){ ?>
  <div class="modal fade" id="wijzigcouponmodal">
    <form id="wijzigcouponform" method="post">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Wijzig Couponcode</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div id="wijzigcoupondiv">
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
<?php
if($user->CheckPermission($_SESSION['odsuser'], "coupon_wijzig")){
?>
function editcoupon(cid){
  $('#wijzigcoupondiv').load('/admin/ajax/get/wijzigcoupon.php?cid='+cid);
  $('#wijzigcouponmodal').modal('show');
}
var request;
$("#wijzigcouponform").submit(function(event){
  event.preventDefault();
  if (request) {
    request.abort();
  }
  var $form = $(this);
  var $inputs = $form.find("input, select, button, textarea");
  var serializedData = $form.serialize();
  $inputs.prop("disabled", true);
  request = $.ajax({
    url: "/admin/ajax/post/editcoupon.php",
    type: "post",
    data: serializedData
  });
  request.done(function (response, textStatus, jqXHR){
    console.log(response);
    if(response === "double"){
      Toast.fire({
        icon: 'error',
        title: 'Deze couponcode is al in gebruik.'
      })
    } else {
      $('#wijzigcouponmodal').modal('hide');
      Toast.fire({
        icon: 'success',
        title: 'Coupon Aangepast'
      })
      $('#couponpagina').click();
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
<?php
}
if($user->CheckPermission($_SESSION['odsuser'], "coupon_verwijderen")){
  ?>
  function delcoupon(id){
    if(confirm("Weet je zeker dat deze Coupon code verwijderd moet worden?"))
    {
      $.ajax({
        url: "/admin/ajax/post/coupondelete.php",
        method:"POST",
        data:{id:id},
        success:function(data){
          console.log(data);
          Toast.fire({
            icon: 'success',
            title: 'Coupon is verwijderd'
          })
          $('#'+id).fadeOut();
        }
      });
    }
  }
  <?php
}
?>
<?php if($user->CheckPermission($_SESSION['odsuser'], "coupon_maken")){ ?>
  var request;
  $("#newcouponform").submit(function(event){
    event.preventDefault();
    if (request) {
      request.abort();
    }
    var $form = $(this);
    var $inputs = $form.find("input, select, button, textarea");
    var serializedData = $form.serialize();
    $inputs.prop("disabled", true);
    request = $.ajax({
      url: "/admin/ajax/post/createcoupon.php",
      type: "post",
      data: serializedData
    });
    request.done(function (response, textStatus, jqXHR){
      if(response === "double"){
        Toast.fire({
          icon: 'error',
          title: 'Deze couponcode is al in gebruik.'
        })
      } else {
        $('#nieuwecouponmodal').modal('hide');
        Toast.fire({
          icon: 'success',
          title: 'Coupon Aangemaakt'
        })
        $('#couponpagina').click();
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
  <?php } ?>
  $(function () {
    $('#datemask').inputmask('dd-mm-yyyy HH:MM', { 'placeholder': 'dd-mm-yyyy HH:MM' })
    $("#couponcodes").DataTable({
      "responsive": true,
      "autoWidth": false,
    });
  });
  $(document).ready(function(){
    $("#paginainhoud").fadeIn();
  });
  function random(){
    xmlhttp=new XMLHttpRequest();
    xmlhttp.open("GET", "<?php echo adminurl; ?>/ajax/get/random.php?aantal=10", false);
    xmlhttp.send();
    var data = xmlhttp.responseText;
    $("#couponcode").val(data);
  }
  </script>
