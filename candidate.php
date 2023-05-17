<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Kandidat - Quick Count</title>

  <?php include ("layouts/header.php"); ?>

  <?php 
    if (!isset($_SESSION['user_id'])){
      echo "<script> location.href='index.php'; </script>";
    }

    if($_SESSION['user_role'] != 1){
      echo "<script> alert('Anda login bukan sebagai admin'); </script>";
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

  
  <main id="main" class="main min-vh-100">

    <section class="section profile">
      <div class="row">

      <div class="col-12 mb-3">
        <button type="button" class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#addModal">
        <i class="bi bi-person-plus-fill"></i> Tambah
        </button>
      </div>

              <div class="modal fade" id="addModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Tambah Kandidat</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    <form method="POST" enctype="multipart/form-data">
                      <div class="row g-3">
                        <div class="col-12">
                          <label class="form-label">Nama Kandidat</label>
                          <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="col-12">
                          <label class="form-label">Foto</label>
                          <input type="file" name="img" class="form-control" accept="image/*">
                        </div>

                        <div class="col-12">
                          <label class="form-label">Warna</label>
                          <input type="color" name="color" class="form-control">
                        </div>
                      </div>


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary" name="btnAdd">Simpan</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>

      
        <?php 
          
        $conn = $GLOBALS['conn'];

        $sql = "SELECT * FROM candidates"; 
        $result = $conn->query($sql);
        
        if ($result) {
          while($row = $result->fetch_assoc()) {
            if($row['image'] == NULL){
              $row['image'] = "default.jpg";
            }
        ?>

        <div class="col-xl-4">

          <div class="card">
            <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">

              <img src="assets/img/candidate/<?php echo $row['image']; ?>" height="100px" width="100px" alt="Profile" class="rounded-circle" style="border: 5px solid <?php echo $row['color']; ?>;">
              <h2><?php echo $row['name']; ?></h2>
              <div class="social-links mt-2">
                <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>">
                  <i class="bi bi-pencil-square"></i>
                </button>

                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['id']; ?>">
                  <i class="bi bi-trash3-fill"></i>
                </button>
              </div>
            </div>
          </div>

        </div>

        <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Ubah Kandidat</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    <form method="POST" enctype="multipart/form-data">
                      <div class="row g-3">
                      <div class="col-12 text-center">
                      <img src="assets/img/candidate/<?php echo $row['image']; ?>"  height="150px" width="150px" alt="Profile" class="rounded-circle" style="border: 5px solid <?php echo $row['color']; ?>;">
                      </div>                   
                      <input type="hidden" name="id" class="form-control" value="<?php echo $row['id']; ?>" required>
                        <div class="col-12">
                          <label class="form-label">Nama Kandidat</label>
                          <input type="text" name="name" class="form-control" value="<?php echo $row['name']; ?>" required>
                        </div>

                        <div class="col-12">
                          <label class="form-label">Foto</label>
                          <input type="file" name="img" class="form-control" accept="image/*">
                        </div>

                        <div class="col-12">
                          <label class="form-label">Warna</label>
                          <input type="color" name="color" class="form-control" value="<?php echo $row['color']; ?>"> 
                        </div>
                      </div>


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary" name="btnEdit">Ubah</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Hapus Kandidat</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    <form method="POST" enctype="multipart/form-data">
                      <div class="row g-3">
                      <div class="col-12 text-center">
                      <img src="assets/img/candidate/<?php echo $row['image']; ?>"  height="150px" width="150px" alt="Profile" class="rounded-circle" style="border: 5px solid <?php echo $row['color']; ?>;">
                      </div>                   
                      <input type="hidden" name="id" class="form-control" value="<?php echo $row['id']; ?>" required>
                        <div class="col-12 text-center">
                          Yakin ingin menghapus <strong><?php echo $row['name']; ?></strong>?
                        </div>
                      </div>


                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary" name="btnDelete">Hapus</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>

        <?php               
            }
            
          }
          ?>
      </div>
    </section>
  </main>

    <!-- ======= Footer ======= -->
    <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
    </div>
  </footer><!-- End Footer -->

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

<?php 
  if(isset($_POST['btnAdd'])) {
    add_candidate($_POST['name'], $_POST['color']);
  }

  if(isset($_POST['btnEdit'])) {
    edit_candidate($_POST['id'],$_POST['name'], $_POST['color']);
  }

  if(isset($_POST['btnDelete'])) {
    delete_candidate($_POST['id']);
  }
?>