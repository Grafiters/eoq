<?php
include('../../Connect.php');
session_start();
if($_SESSION['username']==""){
  header('Location: /eoq/pages/auth/login.php');
}else if($_SESSION['role']=="penjualan"){
  $messages = "Permission Denied";
  header("Location: /eoq/pages/admin/index.php?msg=$messages");
}

$result = $conn->query("SELECT * FROM barang ORDER BY created_at");
$res = $conn->query("SELECT * FROM supplier ORDER BY created_at");
if ($result->num_rows > 0) {
  $items = $result->fetch_all();
  $suppliers = $res->fetch_all();
}

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
            <h1>Tambah Pembelian</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/index.php">Dashboard</a></li>
              <li class="breadcrumb-item">
                <a href="/eoq/pages/pembelian/index.php">Daftar Pembelian</a>
              </li>
              <li class="breadcrumb-item active">Tambah Pembelian</li>
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
          <div class="col-md-8 mx-auto">
            <!-- general form elements disabled -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tambah Pembelian</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row align-items-end">
                  <!-- kode-pesan & tgl bayar -->
                  <div class="col">
                    <div class="form-group row">
                      <label class="form-label col-sm-4" for="">Kode Pembelian</label>
                      <div class="col-sm-8">
                        <input class="form-control" type="text" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="form-label col-sm-4" for="">Tanggal Pembelian</label>
                      <div class="col-sm-8">
                        <input type="date" name="tanggal" class="form-control" disabled>
                      </div>
                    </div>
                  </div>
                  <!-- END kode-pesan & tgl bayar -->
                  <!-- Nama Supplier -->
                  <div class="col">
                    <div class="form-group row">
                      <label class="col-form-label col-sm-4" for="">Nama Pembeli</label>
                      <div class="col-sm-8">
                        <select id="supplier" class="form-control">
                          <?php
                            foreach ($suppliers as $supplier) {
                              $id = $supplier[0];
                              $name = ucwords($supplier[2]);
                              echo "<option value='$id'>$name</option>";
                            }
                          ?>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- END nama supplier -->
                </div>

                <!-- tabel belanja -->
                <table class="table table-hover table-borderless text-center">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Barang</th>
                      <th>Harga Satuan</th>
                      <th>Jumlah Beli</th>
                      <th>Total Bayar</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- form tambah belanja -->
                    <form action="/eoq/backend/pembelian/add.php" method="POST">
                      <input type="text" name="supplier" id="real-supplier" class="d-none">
                      <tr>
                        <td>1</td>
                        <td>
                          <select id="barang" class="form-control" name="barang">
                          <?php
                          foreach ($items as $item) {
                            $id = $item[0];
                            $name = $item[2];
                            echo "<option value='$id'>$name</option>";
                          }
                          ?>
                          </select>
                        </td>
                        <td>
                          <select id="price" class="form-control" name="price" disabled>
                          <?php
                          foreach ($items as $item) {
                            $id = $item[0];
                            $price = $item[3];
                            $harga = "Rp ".number_format($item[3], 0);
                            echo "<option value='$id' price='$price'>$harga</option>";
                          }
                          ?>
                          </select>
                        </td>
                        <td>
                          <input id="amount" name="amount" class="form-control" type="number" min="0">
                        </td>
                        <td>
                          <input id="total" name="total" class="form-control" type="text" disabled>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="5" class="text-right">
                          <button class="btn btn-sm btn-warning" type="reset">
                            reset
                          </button>
                          <button class="btn btn-sm btn-success" type="submit">
                            submit
                          </button>
                        </td>
                      </tr>
                    </form>
                    <!-- END form tambah belanja -->
                  </tbody>
                </table>
                <!-- END tabel belanja -->

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

<script>
const barang = document.getElementById('barang')
const harga = document.getElementById('price')
const jumlah = document.getElementById('amount')
const total = document.getElementById('total')
const supplier = document.getElementById('supplier')
const real = document.getElementById('real-supplier')
real.value = supplier.value
barang.addEventListener('change', function(e) {
  harga.value = e.target.value
  const price = harga.selectedOptions[0].attributes['price']['value']
  const temp = price * jumlah.value
  total.setAttribute('value', `Rp ${temp.toLocaleString('id')}`)
})
jumlah.addEventListener('change', function(e) {
  const price = harga.selectedOptions[0].attributes['price']['value']
  const temp = price * e.target.value
  total.setAttribute('value', `Rp ${temp.toLocaleString('id')}`)
})
supplier.addEventListener('change', function(e) {
  real.value = e.target.value
})
</script>

<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>

