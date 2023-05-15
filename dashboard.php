<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Quick Count</title>

  <?php include ("layouts/header.php");?>

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Updated: Mar 09 2023 with Bootstrap v5.2.3
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

<?php include ("layouts/navbar.php");?>

<?php include ("layouts/sidebar.php");?>

  
  <main id="main" class="main">

    <section class="section profile">
      <div class="row">
        <?php 
          
        $conn = $GLOBALS['conn'];

        $user_id = $_SESSION['user_id'];

        $cek_suara = "SELECT * FROM votes WHERE voted_by = $user_id"; 
        $hasil_cek = $conn->query($cek_suara);

        if($hasil_cek->num_rows > 0){
            echo "<script> alert('Anda sudah melakukan pemilihan'); </script>";
            echo "<script> location.href='result.php'; </script>";
        }

        $sql = "SELECT * FROM candidates"; 
        $result = $conn->query($sql);
        
        if ($result) {
          while($row = $result->fetch_assoc()) {
        ?>

        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/profile-img.jpg" alt="Profile" class="rounded-circle">
              <h2><?php echo $row['name']; ?></h2>
              <div class="social-links mt-2">
                <form method="POST">
                    <button class="btn btn-primary" type="submit" name="btn<?php echo $row['id']; ?>">Pilih Kandidat</button>
                </form>
              </div>
            </div>
          </div>

          <?php 
            if(isset($_POST['btn'.$row['id']])) {
              votes($_SESSION["user_id"] ,$row['id']);
            }
          ?>

        </div>

        <?php               
            }
            
          }
          ?>
      </div>
    </section>
  </main>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.min.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>

  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>