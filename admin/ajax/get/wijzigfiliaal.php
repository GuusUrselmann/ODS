<?php
include "../../inc/config.php";
if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) OR strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) != 'xmlhttprequest') {
  header('HTTP/1.0 403 Forbidden');
  die();
}
$user = new User();
$user->CheckLogin();
$pdo = Database::DB();
if(!$user->CheckPermission($_SESSION['odsuser'], "filialen_wijzig")){
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
<div id="paginainhoud" style="display:none;">
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0 text-dark">Bewerk "<?php echo $f['naam']; ?>"</h1>
        </div>
      </div>
    </div>
  </div>
  <form method="post" id="wijzigfiliaal">
    <input type="hidden" name="fid" value="<?php echo $f['id']; ?>">
    <div class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Algemene Gegevens</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Naam</label>
                      <input class="form-control" type="text" name="naam" value="<?php echo $f['naam']; ?>">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Actief</label>
                      <select class="form-control" name="actief">
                        <option value="1" <?php if($f['actief']=="1") echo "selected"; ?>>Ja</option>
                        <option value="1" <?php if($f['actief']=="0") echo "selected"; ?>>Nee</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-12">
                    <div class="form-group">
                      <label>Adres</label>
                      <input class="form-control" type="text" name="adres" value="<?php echo $f['adres']; ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Postcode</label>
                      <input class="form-control" type="text" name="postcode" value="<?php echo $f['postcode']; ?>">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Plaats</label>
                      <input class="form-control" type="text" name="plaats" value="<?php echo $f['plaats']; ?>">
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Telefoonnummer</label>
                      <input class="form-control" type="text" name="tel" value="<?php echo $f['tel']; ?>">
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Email Adres</label>
                      <input class="form-control" type="text" name="email" value="<?php echo $f['email']; ?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.col-md-6 -->
          <div class="col-lg-6">
            <div class="card">
              <div class="card-header">
                <h5 class="m-0">Betalingen en bezorging</h5>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Contant</label>
                      <select class="form-control" name="contant">
                        <option value="1" <?php if($f['contant']=="1") echo "selected"; ?>>Ja</option>
                        <option value="1" <?php if($f['contant']=="0") echo "selected"; ?>>Nee</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Pinnen</label>
                      <select class="form-control" name="pin">
                        <option value="1" <?php if($f['pin']=="1") echo "selected"; ?>>Ja</option>
                        <option value="1" <?php if($f['pin']=="0") echo "selected"; ?>>Nee</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Ideal</label>
                      <select class="form-control" name="ideal">
                        <option value="1" <?php if($f['ideal']=="1") echo "selected"; ?>>Ja</option>
                        <option value="1" <?php if($f['ideal']=="0") echo "selected"; ?>>Nee</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-3">
                    <div class="form-group">
                      <label>Factuur</label>
                      <select class="form-control" name="factuur">
                        <option value="1" <?php if($f['factuur']=="1") echo "selected"; ?>>Ja</option>
                        <option value="1" <?php if($f['factuur']=="0") echo "selected"; ?>>Nee</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Bezorgen</label>
                      <select class="form-control" name="bezorgen">
                        <option value="1" <?php if($f['bezorgen']=="1") echo "selected"; ?>>Ja</option>
                        <option value="1" <?php if($f['bezorgen']=="0") echo "selected"; ?>>Nee</option>
                      </select>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Afhalen</label>
                      <select class="form-control" name="afhalen">
                        <option value="1" <?php if($f['afhalen']=="1") echo "selected"; ?>>Ja</option>
                        <option value="1" <?php if($f['afhalen']=="0") echo "selected"; ?>>Nee</option>
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Maximale Afstand (Bezorgen)</label>
                      <div class="input-group mb-3">
                        <input type="number" step='1.00' class="form-control" name="maxafstand" value="<?php echo $f['maxafstand']; ?>">
                        <div class="input-group-append">
                          <span class="input-group-text">KM</span>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Bezorgkosten</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">&euro;</span>
                        </div>
                        <input type="number" step='0.25' class="form-control" name="bezorgkosten" value="<?php echo $f['bezorgkosten']; ?>">
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Gratis Bezorgen vanaf</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">&euro;</span>
                        </div>
                        <input type="number" step='0.25' class="form-control" name="gratisbezorgen" value="<?php echo $f['gratisbezorgen']; ?>">
                      </div>
                    </div>
                  </div>
                  <div class="col-sm-6">
                    <div class="form-group">
                      <label>Minimum bestelbedrag (bezorgen)</label>
                      <div class="input-group mb-3">
                        <div class="input-group-prepend">
                          <span class="input-group-text">&euro;</span>
                        </div>
                        <input type="number" step='0.25' class="form-control" name="minimumbedrag" value="<?php echo $f['minimumbedrag']; ?>">
                      </div>
                    </div>
                  </div>
                </div>
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
$("#wijzigfiliaal").submit(function(event){
  event.preventDefault();
  if (request) {
    request.abort();
  }
  var $form = $(this);
  var $inputs = $form.find("input, select, button, textarea");
  var serializedData = $form.serialize();
  $inputs.prop("disabled", true);
  request = $.ajax({
    url: "/admin/ajax/post/wijzigfiliaal.php",
    type: "post",
    data: serializedData
  });
  request.done(function (response, textStatus, jqXHR){
    //console.log(response);
    Toast.fire({
      icon: 'success',
      title: '<?php echo $f['naam']; ?> is aangepast'
    })
    $('#filialenpagina').click();
  });
  request.fail(function (jqXHR, textStatus, errorThrown){
    Toast.fire({
      icon: 'error',
      title: 'Er is iets fout gegaan. Probeer het opnieuw.'
    })
    $('#filialenpagina').click();
  });
  request.always(function () {
    $inputs.prop("disabled", false);
  });
});
$(document).ready(function(){
  $("#paginainhoud").fadeIn();
});
</script>
