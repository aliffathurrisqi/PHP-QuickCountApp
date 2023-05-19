<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Hasil Pemungutan Suara - Quick Count</title>

  <?php include ("layouts/header.php");?>

  <?php 
    if (!isset($_SESSION['user_id'])){
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

    <section class="section">
      <div class="row">
        <?php 
          
            $conn = $GLOBALS['conn'];

            $sql = "SELECT * FROM hasil_voting"; 
            $result = $conn->query($sql);

            $candidates = "";
            $suara = "";
            $color = "";
        
            if ($result->num_rows > 0){
                if ($result->num_rows < 20){
                  
                  echo "<script> alert('Pemungutan suara kurang dari 20 orang, kembali beberapa saat lagi'); </script>";
                  
                  if($_SESSION['user_role'] == 0) {
                    logout();
                  } else{
                      echo "<script> location.href='admin-dashboard.php'; </script>";
                  }

                }

                while($row = $result->fetch_assoc()) {
                    $suara .= $row['total_suara'].",";
                    $candidates .= "'".$row['name']."',";
                    $color .= "'".$row['color']."',";
                }
            } else{
                echo "<script> alert('Pemungutan belum dimulai'); </script>";
                if($_SESSION['user_role'] == 0) {
                    echo "<script> location.href='dashboard.php'; </script>";
                } else{
                    echo "<script> location.href='admin-dashboard.php'; </script>";
                }
            }

        ?>

        <div class="col-lg-12">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Hasil Pemungutan Suara</h5>

              <!-- Pie Chart -->
              <div id="pieChart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  new ApexCharts(document.querySelector("#pieChart"), {
                    series: [<?php echo substr($suara, 0, -1);?>],
                    chart: {
                      height: 350,
                      type: 'pie',
                      toolbar: {
                        show: true
                      }
                    },
                    labels: [<?php echo substr($candidates, 0, -1);?>],
                    colors: [<?php echo substr($color, 0, -1);?>]
                  }).render();
                });
              </script>


        <?php 
          
            $conn = $GLOBALS['conn'];

            $sql = "SELECT COUNT(id) as total_suara FROM users WHERE admin = 0"; 
            $result = $conn->query($sql);

            if ($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    $total_suara = $row['total_suara'];
                }
            }
            
            $sql = "SELECT COUNT(id) as suara_masuk FROM votes"; 
            $result = $conn->query($sql);

            if ($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    $suara_masuk = $row['suara_masuk'];
                }
            }
            
            $percent = ($suara_masuk/$total_suara) * 100;

        ?>

            <h5 class="card-title">Total Suara Masuk</h5>
            <div class="progress w-50">
                <div class="progress-bar bg-secondary" role="progressbar" style="width: <?php echo $percent; ?>%" aria-valuenow="<?php echo $percent; ?>" aria-valuemin="0" aria-valuemax="<?php echo $percent; ?>"><?php echo $percent; ?>%</div>
            </div>
            <div class="w-50">
                <span class="float-end"><?php echo $suara_masuk; ?> / <?php echo $total_suara; ?> suara</span>
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