<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Dashboard - Quick Count</title>

  <?php include ("layouts/header.php");?>

  <?php 
    if (!isset($_SESSION['user_id'])){
      echo "<script> location.href='index.php'; </script>";
    }

    if($_SESSION['user_role'] != 1){
      echo "<script> alert('Anda login bukan sebagai user'); </script>";
      echo "<script> location.href='index.php'; </script>";
    }
  ?>

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

        <?php 
          
        $conn = $GLOBALS['conn'];

        $total_kandidat = 0;


        $sql = "SELECT count(id) as total_kandidat FROM candidates"; 
        $result = $conn->query($sql);
        
        if ($result) {
          while($row = $result->fetch_assoc()) {    
                $total_kandidat = $row['total_kandidat'];
            }
        }

        $sql = "SELECT count(id) as total_pemilih FROM users WHERE admin = 0"; 
        $result = $conn->query($sql);
        
        if ($result) {
          while($row = $result->fetch_assoc()) {    
                $total_pemilih = $row['total_pemilih'];
            }
        }

        $sql = "SELECT count(id) as total_suara FROM votes"; 
        $result = $conn->query($sql);
        
        if ($result) {
          while($row = $result->fetch_assoc()) {    
                $total_suara = $row['total_suara'];
            }
        }
        ?>


<section class="section dashboard">
      <div class="row">

        <!-- Left side columns -->
        <div class="col-lg-12">
          <div class="row">

            <div class="col-xxl-4 col-md-6">
              <div class="card info-card">

                <div class="card-body">
                  <h5 class="card-title">Kandidat</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-primary text-white">
                      <i class="bi bi-person"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $total_kandidat; ?> Kandidat</h6>
                      <span class="text-muted small pt-2 ps-1">Mengikuti pemilihan</span>

                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-md-6">
              <div class="card info-card">

                <div class="card-body">
                  <h5 class="card-title">Pemilih</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-success text-white">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $total_pemilih; ?> Pemilih</h6>
                      <span class="text-muted small pt-2 ps-1">Memiliki Hak Suara</span>

                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-xxl-4 col-md-6">
              <div class="card info-card">

                <div class="card-body">
                  <h5 class="card-title">Suara</h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center bg-danger text-white">
                        <i class="bi bi-check-circle"></i>
                    </div>
                    <div class="ps-3">
                      <h6><?php echo $total_suara; ?> Suara</h6>
                      <span class="text-muted small pt-2 ps-1"> <?php echo $total_suara/$total_pemilih; ?> % Telah tercatat</span>

                    </div>
                  </div>
                </div>

              </div>
            </div>

          </div>
        </div>


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