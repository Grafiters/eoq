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
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="../../index3.html" class="brand-link">
      <img src="../../dist/img/AdminLTELogo.png"
           alt="AdminLTE Logo"
           class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
            <a href="/index.php" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Data Master
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a class="nav-link" href="/eoq/pages/admin">
                  <i class="far fa-user nav-icon"></i>
                  <p>Data User</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/eoq/pages/item">
                  <i class="fas fa-box nav-icon"></i>
                  <p>Data Barang</p>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/eoq/pages/reseller/index.php">
                  <i class="fas fa-user-tie nav-icon"></i>
                  <p>Data Reseller</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="/eoq/pages/penjualan/index.php" class="nav-link">
              <i class="nav-icon fas fa-warehouse"></i>
              <p>Stok</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/eoq/pages/penjualan/index.php" class="nav-link">
              <i class="nav-icon fas fa-cart-plus"></i>
              <p>Penjualan</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/eoq/pages/pembelian/index.php" class="nav-link">
              <i class="nav-icon fas fa-box"></i>
              <p>Pembelian</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/eoq/pages/pembelian/index.php" class="nav-link active">
              <i class="nav-icon fas fa-calculator"></i>
              <p>Perhitungan EOQ</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="/eoq/pages/pembelian/index.php" class="nav-link">
              <i class="nav-icon fas fa-scroll"></i>
              <p>Laporan</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

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
                <form action="" class="w-50">
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
                      <select class="form-control" name="data">
                      <?php
                        $barang = ['bio7', 'bio activa', 'bio moringa', 'm-king'];
                        foreach ($barang as $n) {
                          echo "<option value='$n'>$n</option>";
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
                      <input class="form-control" type="number" name="toatl_kerja">
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
                      <button class="btn btn-success" type="submit">
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
                    <th>Tanggal Perhitungan</th>
                    <th>Nama Barang</th>
                    <th>Kebutuhan Tahunan</th>
                    <th>Biaya Sekali Pesan</th>
                    <th>Biaya Simpan Barang</th>
                    <th>Hasil EOQ</th>
                    <th>Hasil Biasa Pesan</th>
                    <th>Hasil Biaya Simpan</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php
                      for ($i = 1; $i < 8; $i++) {
                        $status = $i%2 ? 'hello' : 'bark';
                        $btnEdit = "<a href='/pages/penjualan/edit.php?id=".$i."' class='btn btn-sm btn-primary mx-1'>edit</a>";
                        $btnDelete = "<form class='d-inline mx-1' action='/admin/deleteAdmin.php?id=".$user['user_id']."' method='post'><input type='submit' name='delete' class='btn btn-sm btn-danger' value='hapus'/></form>";
                        $action = $btnEdit.$btnDelete;
                        echo "<tr>";
                          echo "<td>Apr 06, 2020</td>";
                          echo "<td>Bio7</td>";
                          echo "<td>27.500</td>";
                          echo "<td>Rp 130.000</td>";
                          echo "<td>Rp 150</td>";
                          echo "<td>6.909</td>";
                          echo "<td>Rp 518.193</td>";
                          echo "<td>Rp 518.175</td>";
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

