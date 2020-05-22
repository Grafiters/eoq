<?php
session_start();
include('../../backend/penjualan/showPenjualan.php');

if($_SESSION['username']==""){
  header('Location: /eoq/pages/auth/login.php');
}
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
            <h1>Daftar Penjualan</h1>
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
            <!-- general form elements disabled -->
            <div class="card">
                <div class="card-header text-left border-bottom-0">
                <a class="btn btn-success btn-sm" href="/eoq/backend/penjualan/download.php">
                  Cetak Seluruh Laporan
                </a>
                <button class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
                  Cetak Laporan By Tanggal
                </button>
              </div>
              <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <form action="/eoq/backend/penjualan/downloadtgl.php" method="post">
                        <table>
                          <tr>
                            <td><div class="form-groub">Dari Tanggal</div></td>
                            <td><div class="form-groub">:</div></td>
                            <td>
                              <div class="form-groub">
                                <input type="date" class="form-control" name="tgl_awal" required>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td><div class="form-groub">Sampai</div></td>
                            <td><div class="form-groub">:</div></td>
                            <td>
                              <div class="form-groub">
                                <input type="date" class="form-control" name="tgl_akhir" required>
                              </div>
                            </td>
                          </tr>
                          <tr>
                            <td></td>
                            <td></td>
                          </tr>
                        </table>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="submit" class="btn btn-primary" name="cetak">Save changes</button>
                        </div>
                      </form>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-hover text-center">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Kode Penjualan</th>
                    <th>Tanggal Penjualan</th>
                    <th>Total Bayar</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      foreach ($buys->fetch_all(MYSQLI_BOTH) as $key => $buy) {
                        $btnEdit = "<a href='/eoq/pages/penjualan/edit.php?id=".$buy[0]."' class='btn btn-sm btn-primary mx-1'>edit</a>";
                        $btnDelete = "<form class='d-inline mx-1' action='/eoq/backend/penjualan/deletePenjualan.php?id=".$buy[0]."' method='post'><input type='submit' name='delete' class='btn btn-sm btn-danger' value='hapus'/></form>";
                        $action = $btnEdit.$btnDelete;
                        $bayar = "Rp ".number_format($buy['bayar'], 0);
                        $tanggal = date_format(date_create($buy['tanggal']), 'l, d F Y');
                        $idx = $key + 1;
                        echo "<tr>";
                          echo "<td>$idx</td>";
                          echo "<td>".ucwords($buy['kode'])."</td>";
                          echo "<td>$tanggal</td>";
                          echo "<td>$bayar</td>";
                        echo "</tr>";
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

