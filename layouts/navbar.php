 <!-- ======= Header ======= -->
 <header id="header" class="header fixed-top d-flex align-items-center">

<div class="d-flex align-items-center justify-content-between">
  <?php 
  if($_SESSION['user_role'] == 1) {
    ?>
  <a href="admin-dashboard.php" class="logo d-flex align-items-center">
    <img src="assets/img/logo.png" alt="">
    <span class="d-none d-lg-block">Voting</span>
  </a>
  <?php
  } else{
    ?>

  <a href="dashboard.php" class="logo d-flex align-items-center">
    <img src="assets/img/logo.png" alt="">
    <span class="d-none d-lg-block">Voting</span>
  </a>

  <?php } ?>
  <i class="bi bi-list toggle-sidebar-btn"></i>
</div><!-- End Logo -->

<nav class="header-nav ms-auto">
  <ul class="d-flex align-items-center">

    <li class="nav-item dropdown pe-3">

      <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
        <img src="assets/img/user/default.jpg" alt="Profile" class="rounded-circle">
        <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION["user_name"]; ?></span>
      </a><!-- End Profile Iamge Icon -->

      <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
        <li class="dropdown-header">
          <h6><?php echo $_SESSION["user_name"]; ?></h6>
        </li>
        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <hr class="dropdown-divider">
        </li>

        <li>
          <form method="POST">
            <button class="dropdown-item d-flex align-items-center" name="btnLogout"><i class="bi bi-box-arrow-right"></i><span>Sign Out</span></button>
          </form>
        </li>

      </ul>
    </li>

  </ul>
</nav>

</header>

<?php 
  if(isset($_POST['btnLogout'])) {
    logout();
  }
?>