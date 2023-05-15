<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Hasil Pemungutan Suara - Quick Count</title>

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

    <section class="section">
      <div class="row">
        <?php 
          
            $conn = $GLOBALS['conn'];

            $sql = "SELECT candidates.name, candidates.color, COUNT(votes.candidate_id) AS total_suara 
            FROM `votes` INNER JOIN candidates ON candidates.id = votes.candidate_id
            GROUP BY candidate_id;"; 
            $result = $conn->query($sql);

            $candidates = "";
            $suara = "";
            $color = "";
        
            if ($result->num_rows > 0){
                while($row = $result->fetch_assoc()) {
                    $suara .= $row['total_suara'].",";
                    $candidates .= "'".$row['name']."',";
                    $color .= "'".$row['color']."',";
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
              <!-- End Pie Chart -->

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