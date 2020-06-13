<?php
if(!isset($config)){
  header("HTTP/1.0 404 Not Found");
  die();
}
?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <a href="<?php echo adminurl; ?>" class="brand-link">
    <img src="dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
    style="opacity: .8">
    <span class="brand-text font-weight-light">ODS</span>
  </a>

  <div class="sidebar">
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="#" class="d-block"><?php echo $user->GetFullName($_SESSION['odsuser']); ?></a>
      </div>
    </div>

    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

        <li class="nav-item" >
          <a class="nav-link" id="homepagina">
            <i class="nav-icon fas fa-home"></i>
            <p>
              Home
            </p>
          </a>
        </li>
        <?php if($user->CheckPermission($_SESSION['odsuser'], "coupon")){ ?>
          <li class="nav-item" >
            <a class="nav-link" id="couponpagina">
              <i class="nav-icon fas fa-ticket-alt"></i>
              <p>
                Couponcodes
              </p>
            </a>
          </li>
        <?php } ?>
        <?php if($user->CheckPermission($_SESSION['odsuser'], "filialen")){ ?>
          <li class="nav-item" >
            <a class="nav-link" id="filialenpagina">
              <i class="nav-icon fas fa-hotel"></i>
              <p>
                Filialen
              </p>
            </a>
          </li>
        <?php } ?>

        <?php if($user->CheckPermission($_SESSION['odsuser'], "perms_groups") OR $user->CheckPermission($_SESSION['odsuser'], "perms_users")){ ?>
          <li class="nav-item has-treeview">
            <a class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Permissies
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if($user->CheckPermission($_SESSION['odsuser'], "perms_groups")){ ?>
                <li class="nav-item">
                  <a class="nav-link" id="groeppermissiespagina">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Groep Permissies</p>
                  </a>
                </li>
              <?php } ?>
              <?php if($user->CheckPermission($_SESSION['odsuser'], "perms_users")){ ?>
                <li class="nav-item">
                  <a class="nav-link" id="gebruikerpermissiespagina">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Gebruiker Permissies</p>
                  </a>
                </li>
              <?php } ?>
            </ul>
          </li>
        <?php } ?>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
