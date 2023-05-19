<aside id="sidebar" class="sidebar">

<ul class="sidebar-nav" id="sidebar-nav">

  <?php 
  if($_SESSION['user_role'] == 0) {
  ?>
    <li class="nav-item">
      <a class="nav-link collapsed" href="dashboard.php">
        <i class="bi bi-people"></i>
        <span>Pemilihan Kandidat</span>
      </a>
    </li>
  <?php
  }
?>

  <?php 
  if($_SESSION['user_role'] == 1) {
  ?>
    <li class="nav-item">
      <a class="nav-link collapsed" href="admin-dashboard.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="candidate.php">
        <i class="bi bi-person"></i>
        <span>Kandidat</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link collapsed" href="user.php">
        <i class="bi bi-people"></i>
        <span>Pemilih</span>
      </a>
    </li>
  <?php
  }
  ?>

  <li class="nav-item">
    <a class="nav-link collapsed" href="result.php">
      <i class="bi bi-pie-chart"></i>
      <span>Hasil</span>
    </a>
  </li>

</ul>

</aside>
