<?php
include "inc/config.php";
$user = new User();
$user->CheckLogin();
$pdo = Database::DB();
?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">
  <title>ODS - Starter</title>
  <link rel="stylesheet" href="<?php echo adminurl; ?>/plugins/fontawesome-free/css/all.min.css">
  <link rel="stylesheet" href="<?php echo adminurl; ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo adminurl; ?>/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo adminurl; ?>/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <link rel="stylesheet" href="<?php echo adminurl; ?>/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="<?php echo adminurl; ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo adminurl; ?>/dist/css/adminlte.min.css">
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <?php include "inc/navbar_boven.php"; ?>
    <?php include "inc/navbar_links.php"; ?>

    <div class="overlay-wrapper" id="laden" style="display:none;"><div class="overlay"><i class="fas fa-2x fa-sync fa-spin"></i></div></div>
    <div class="content-wrapper" id="paginacontent"><div id="paginainhoud"></div></div>

    <?php include "inc/navbar_rechts.php"; ?>
    <?php include "inc/footer.php"; ?>
  </div>
  <script src="<?php echo adminurl; ?>/plugins/jquery/jquery.min.js"></script>
  <script src="<?php echo adminurl; ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="<?php echo adminurl; ?>/plugins/sweetalert2/sweetalert2.min.js"></script>
  <script src="<?php echo adminurl; ?>/plugins/toastr/toastr.min.js"></script>
  <script src="<?php echo adminurl; ?>/plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="<?php echo adminurl; ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="<?php echo adminurl; ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="<?php echo adminurl; ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="<?php echo adminurl; ?>/plugins/moment/moment.min.js"></script>
  <script src="<?php echo adminurl; ?>/plugins/inputmask/min/jquery.inputmask.bundle.min.js"></script>
  <script src="<?php echo adminurl; ?>/plugins/select2/js/select2.full.min.js"></script>
  <script src="<?php echo adminurl; ?>/dist/js/adminlte.min.js"></script>
  <script src="<?php echo adminurl; ?>/dist/js/navigatie.js"></script>
  <script>
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
  });
  $(document).ready( function() {
    <?php
    if(isset($_GET['p'])){
      ?>
      $('#<?php echo $_GET['p']; ?>').click();
      <?php
    } else {
      ?>
      $('#homepagina').click();
      <?php
    } ?>
  });
  </script>
</body>
</html>
