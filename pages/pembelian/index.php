<?php
include('../../Connect.php');
session_start();
if($_SESSION['username']==""){
  header('Location: /eoq/pages/auth/login.php');
}else if(!$_SESSION['role']=="pengadaan" || !$_SESSION['role']=="admin"){
  $messages = "Permission Denied";
  header("Location: /eoq/pages/admin/index.php?msg=$messages");
}

$query = "
  SELECT
    pembelian.id AS id,
    pembelian.code AS kode,
    pembelian.supplier AS supplier,
    pembelian.total AS total,
    pembelian.tanggal AS tanggal
  FROM pembelian
";

$pembelians = $conn->query($query);

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | General Form Elements</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../plugins/datatables-bs4/css/dataTables.bootstrap4.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?= include('../sidebar/index.php') ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Daftar Pembelian</h1>
          </div>
          <div class="col-sm-6">
            <?php include('../breadcrumbs/index.php') ?>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- right column -->
          <div class="col-12">
            <!-- START Message -->
            <?php
              if (isset($_GET['status'])) {
                if ($_GET['status']) {
                  $alert = "alert alert-primary alert-dismissible fade show";
                } else {
                  $alert = "alert alert-danger alert-dismissible fade show";
                }
                $message = $_GET['msg'];
                echo " <div class='$alert' role='alert'>
                  $message
                  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                  </button>
                </div>";
              }
            ?>
            <!-- END Message -->
            <!-- general form elements disabled -->
            <div class="card">
              <div class="card-header text-right border-bottom-0">
                <h3 class="card-title">Daftar Pembelian</h3>
                <a class="btn btn-success btn-sm" href="/eoq/pages/pembelian/create.php">
                  Tambah Pembelian
                </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover text-center">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Pembelian</th>
                    <th>Tanggal Pembelian</th>
                    <th>Total Bayar</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      $i = 1;
                      while ($pembelian = $pembelians->fetch_array()) {
                        $status = $i;
                        $kode = $pembelian['kode'];
                        $tanggal = date_format(date_create($pembelian['tanggal']), "D, d/m/Y");
                        $totalHarga = number_format($pembelian['total'], 0);
                        $btnPrint = "<a href='/eoq/pages/pembelian/detail.php?id=".$pembelian['id']."' class='btn btn-success btn-sm mx-1 text-white'>detail</a>";
                        $btnEdit = "<a href='/eoq/pages/pembelian/edit.php?id=".$pembelian['id']."' class='btn btn-sm btn-primary mx-1'>edit</a>";
                        $btnDelete = "<form class='d-inline mx-1' action='/eoq/backend/pembelian/delete.php?id=".$pembelian['id']."' method='post'><input type='submit' name='delete' class='btn btn-sm btn-danger' value='hapus'/></form>";
                        $action = $btnPrint.$btnEdit.$btnDelete;
                        echo "<tr>";
                          echo "<td>$i</td>";
                          echo "<td>$kode</td>";
                          echo "<td>$tanggal</td>";
                          echo "<td>Rp $totalHarga</td>";
                          echo "<td>$action</td>";
                        echo "</tr>";
                        $i++;
                      }
                    ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!--/.col (right) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.0.2
    </div>
    <strong>Copyright &copy; 2014-2019 <a href="http://adminlte.io">AdminLTE.io</a>.</strong> All rights
    reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables -->
<script src="../../plugins/datatables/jquery.dataTables.js"></script>
<script src="../../plugins/datatables-bs4/js/dataTables.bootstrap4.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="../../dist/js/demo.js"></script>
<!-- page script -->
<script>
  $(function () {
    $("#example1").DataTable();
  });
</script>
</body>
</html>
