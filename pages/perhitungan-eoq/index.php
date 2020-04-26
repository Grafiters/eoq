<?php
  include ("../../Connect.php");
  include ("../../backend/hitung-eoq/showHitung.php");
  session_start();
  if($_SESSION['username']==""){
    header('Location: /eoq/pages/auth/login.php');
  }else if(!$_SESSION['role']=="pengadaan" || !$_SESSION['role']=="admin"){
    $messages = "Permission Denied";
    header("Location: /eoq/pages/admin/index.php?msg=$messages");
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
            <h1>Daftar Perhitungan EOQ</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/index.php">Dashboard</a></li>
              <li class="breadcrumb-item active">Daftar Perhitungan EOQ</li>
            </ol>
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
              <div class="card-body">

                <!-- START of FORM -->
                <form action="/eoq/backend/hitung-eoq/addHitung.php" method="post" class="w-50">
                  <div class="form-group row">
                    <label class="col-md-6 col-form-label" for="">Tanggal Perhitungan</label>
                    <div class="col-md-6">
                      <input class="form-control" type="date" name="tanggal">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-6 col-form-label" for="">Data</label>
                    <div class="col-md-6">
                      <select class="form-control" name="data">
                      <?php for ($i = 1; $i < 4; $i++) {
                          $temp = 2017 + $i;
                          echo "<option value='$temp'>Data $temp</option>";
                      } ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-6 col-form-label" for="">Barang</label>
                    <div class="col-md-6">
                      <select class="form-control" name="barang">
                      <?php
                        $barang = $conn->query('SELECT * FROM barang');
                        while ($brg = $barang->fetch_assoc() ) {
                          echo '<option value="'.$brg['id'].'">'.$brg['name'].'</option>';
                        }
                      ?>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-6 col-form-label" for="">Kebutuhan Barang Tahunan</label>
                    <div class="col-md-6">
                      <input class="form-control" type="number" name="kebutuhan_tahunan">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-6 col-form-label" for="">Biaya Dalam Sekali Pemesanan</label>
                    <div class="col-md-6">
                      <input class="form-control" type="number" name="biaya_sekali_pesan">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-6 col-form-label" for="">Biaya Penyimpanan Barang</label>
                    <div class="col-md-6">
                      <input class="form-control" type="number" name="biaya_simpan_barang">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-6 col-form-label" for="">Jumlah Hari Kerja Dalam Setahun</label>
                    <div class="col-md-6">
                      <input class="form-control" type="number" name="total_kerja">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="col-md-6 col-form-label" for="">Lead Time (Waktu Tunggu)</label>
                    <div class="col-md-6">
                      <input class="form-control" type="number" name="waktu_tunggu">
                    </div>
                  </div>
                  <div class="form-group text-center">
                    <div class="col-md-6 offset-md-6">
                      <button class="btn btn-success" type="submit" name="submit">
                        Hitung
                      </button>
                    </div>
                  </div>
                </form>
                <!-- END of FORM -->
                <!-- START TABLE -->
                <table id="example1" class="table table-bordered table-hover text-center">
                  <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal Perhitungan</th>
                    <th>Nama Barang</th>
                    <th>Kebutuhan Tahunan</th>
                    <th>Biaya Sekali Pesan</th>
                    <th>Biaya Simpan Barang</th>
                    <th>Hasil EOQ</th>
                    <th>Hasil Biasa Pesan</th>
                    <th>Hasil Biaya Simpan</th>
                    <th>Rop</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                  <?php
                      foreach ($result->fetch_all(MYSQLI_BOTH) as $key => $eoq) {
                        $btnEdit = "<a href='/eoq/backend/hitung-eoq/download.php?id=".$eoq[0]."' class='btn btn-sm btn-primary mx-1'>cetak</a>";
                        $btnDelete = "<form class='d-inline mx-1' action='/eoq/backend/hitung-eoq/deleteHitung.php?id=".$eoq[0]."' method='post'><input type='submit' name='delete' class='btn btn-sm btn-danger' value='hapus'/></form>";
                        $action = $btnEdit.$btnDelete;
                        $idx = $key + 1;
                        echo "<tr>";
                        echo "<td>$idx</td>";
                        echo "<td>".date_format(date_create($eoq['created_at']), "l, d-m-Y")."</td>";
                        echo "<td>".ucwords($eoq['name'])."</td>";
                        echo "<td>".ucwords($eoq['kebutuhan_tahunan'])."</td>";
                        echo "<td>".ucwords($eoq['biaya_sekali_pesan'])."</td>";
                        echo "<td>".ucwords($eoq['biaya_simpan_barang'])."</td>";
                        echo "<td>".ucwords($eoq['eoq'])."</td>";
                        echo "<td>".ucwords($eoq['hasil_biasa_pesan'])."</td>";
                        echo "<td>".ucwords($eoq['hasil_biaya_simpan'])."</td>";
                        echo "<td>".ucwords($eoq['rop'])."</td>";
                        echo "<td>$action</td>";
                        echo "</tr>";
                      }
                    ?>  
                  </tbody>
                </table>
                <!-- END TABLE -->
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

