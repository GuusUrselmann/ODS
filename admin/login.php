<?php
include "inc/config.php";
$user = new User();
if(isset($_SESSION['odsuser'])){
  header( "refresh:0;url=".adminurl."" );
  die();
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo sitename; ?> - Log In</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="<?php echo adminurl; ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <link rel="stylesheet" href="<?php echo adminurl; ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="<?php echo adminurl; ?>/dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="<?php echo adminurl; ?>"><b>Online Delivery</b> System</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg"></p>
      <form id="loginform" method="post">
        <div class="input-group mb-3">
          <input type="text" id="username" name="username" class="form-control" placeholder="Gebruikersnaam">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" id="password" name="password" class="form-control" placeholder="Wachtwoord">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block">Log in</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>
<script src="<?php echo adminurl; ?>/plugins/jquery/jquery.min.js"></script>
<script src="<?php echo adminurl; ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo adminurl; ?>/dist/js/adminlte.min.js"></script>
<script src="<?php echo adminurl; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="<?php echo adminurl; ?>/plugins/toastr/toastr.min.js"></script>

<script src="<?php echo adminurl; ?>/dist/js/login.js"></script>
</body>
</html>
