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

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Data Pemilih</h5>

                <button type="button" class="btn btn-primary w-25" data-bs-toggle="modal" data-bs-target="#addModal">
                    <i class="bi bi-person-plus-fill"></i> Tambah
                </button>

            <div class="modal fade" id="addModal" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Tambah Pemilih</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    <form method="POST" enctype="multipart/form-data">
                      <div class="row g-3">

                        <div class="col-12">
                          <label class="form-label">Username</label>
                          <input type="text" name="username" class="form-control" required>
                        </div>

                        
                        <div class="col-12">
                          <label class="form-label">Password</label>
                          <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="col-12">
                          <label class="form-label">Nama</label>
                          <input type="text" name="name" class="form-control" required>
                        </div>

                        <div class="col-12">
                          <label class="form-label">Role</label>
                          <select type="text" name="role" class="form-control" required>
                            <option value="0">User</option>
                            <option value="1">Admin</option>
                          </select>
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

            </div>

            <div class="p-3">
              <table class="table datatable border">
                <thead>
                  <tr>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Role</th>
                    <th>Created By</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                <?php 
          
                    $conn = $GLOBALS['conn'];
                
                    $sql = "SELECT * FROM data_user ORDER BY username"; 
                    $result = $conn->query($sql);
                        
                    if ($result) {
                        while($row = $result->fetch_assoc()) {
                            if($row['username'] != 'admin'){
                    ?>
                  <tr>
                    <td><?php echo $row['username'];?></td>
                    <td><?php echo $row['name'];?></td>
                    <td><?php echo $row['role'];?></td>
                    <td><?php echo $row['created_by'];?></td>
                    <td>
                        <button type="button" class="btn btn-warning text-white" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>">
                        <i class="bi bi-pencil-square"></i>
                        </button>

                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal<?php echo $row['id']; ?>">
                        <i class="bi bi-trash3-fill"></i>
                        </button>
                    </td>
                  </tr>

              <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Ubah Pemilih</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" class="form-control" required value="<?php echo $row['id']; ?>">
                      <div class="row g-3">

                        <div class="col-12">
                          <label class="form-label">Nama</label>
                          <input type="text" name="name" class="form-control" required value="<?php echo $row['name']; ?>">
                        </div>

                      </div>

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                      <button type="submit" class="btn btn-primary" name="btnEdit">Simpan</button>
                    </div>
                    </form>
                  </div>
                </div>
              </div>

              
              <div class="modal fade" id="deleteModal<?php echo $row['id']; ?>" tabindex="-1">
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title">Hapus Pemilih</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                    <form method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" class="form-control" required value="<?php echo $row['id']; ?>">
                      <div class="col-12 text-center">
                          Yakin ingin menghapus <strong><?php echo $row['username']; ?></strong> ?
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
                    }
                    ?>
                </tbody>
              </table>
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

<?php 
  if(isset($_POST['btnAdd'])) {
    add_user($_POST['username'], $_POST['password'], $_POST['name'], (int)$_POST['role'], (int)$_SESSION['user_id']);
  }

  if(isset($_POST['btnEdit'])) {
    edit_user($_POST['id'], $_POST['name']);
  }

  if(isset($_POST['btnDelete'])) {
    delete_user($_POST['id']);
  }
?>