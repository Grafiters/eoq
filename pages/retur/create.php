<?php
include('../../Connect.php');
session_start();
if($_SESSION['username']==""){
  header('Location: /eoq/pages/auth/login.php');
}else if($_SESSION['role']=="penjualan"){
  $messages = "Permission Denied";
  header("Location: /eoq/pages/admin/index.php?msg=$messages");
}

$res = $conn->query("SELECT MAX(id) as maxid FROM retur")->fetch_assoc();

  // Proses
$code = "RT".sprintf("%03d", $res['maxid']+1);

$result = $conn->query("SELECT * FROM barang ORDER BY created_at");
$res = $conn->query("SELECT * FROM supplier ORDER BY created_at");
$items = $result->fetch_all(MYSQLI_ASSOC);
$suppliers = $res->fetch_all(MYSQLI_ASSOC);

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
            <h1>Tambah Retur</h1>
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
          <div class="col-12 mx-auto">
            <!-- general form elements disabled -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Tambah Retur</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row align-items-end">
                  <!-- kode-pesan & tgl bayar -->
                  <div class="col">
                    <div class="form-group row">
                      <label class="form-label col-sm-4" for="">Kode Retur</label>
                      <div class="col-sm-8">
                        <input class="form-control" type="text" value="<?php echo $code ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="form-label col-sm-4" for="">Tanggal Retur</label>
                      <div class="col-sm-8">
                        <input type="date" id="tanggal" name="tanggal" class="form-control">
                      </div>
                    </div>
                  </div>
                  <!-- END kode-pesan & tgl bayar -->
                  <!-- Nama Supplier -->
                  <div class="col">
                    <div class="form-group row">
                      <label class="col-form-label col-sm-4" for="">Nama Supplier</label>
                      <div class="col-sm-8">
                        <select name="supplier" id="supplier" class="form-control">
                          <?php foreach ($suppliers as $suplier): ?>
                            <option value="<?= $suplier['id'] ?>">
                              <?= ucwords($suplier['name']) ?>
                            </option>
                          <?php endforeach; ?>
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
                      <th>No</th> <th>Nama Barang</th>
                      <th>Harga Satuan</th>
                      <th>Jumlah</th>
                      <th>Total Bayar</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- form tambah belanja -->
                    <form action="/eoq/backend/retur/add.php" method="POST">
                      <input type="text" name="supplier" id="real-supplier" class="d-none">
                      <input type="date" name="tanggal" id="real-tanggal" class="d-none">
                      <tr>
                        <td>1</td>
                        <td>
                          <select id="barang" class="form-control" name="barang">
                          <?php foreach ($items as $item) {
                            $id = $item['id'];
                            $name = $item['name'];
                            echo "<option value='$id'>$name</option>";
                          }?>
                          </select>
                        </td>
                        <td>
                          <select id="price" class="form-control" name="price" disabled>
                          <?php foreach ($items as $item) {
                            $id = $item['id'];
                            $price = $item['harga'];
                            $harga = "Rp ".number_format($price, 0);
                            echo "<option value='$id' price='$price'>$harga</option>";
                          } ?>
                          </select>
                        </td>
                        <td>
                          <input id="amount" name="amount" class="form-control" type="number" min="0">
                        </td>
                        <td>
                          <input id="total" name="total" class="form-control" type="text" disabled>
                        </td>
                        <td>
                          <select id="status" name="status" class="form-control">
                            <option value="dilakukan retur">Dilakukan Retur</option>
                            <option value="barang dikembalikan">Barang Dikembalikan</option>
                          </select>
                        </td>
                        <td>
                          <button class="btn btn-sm btn-success" type="submit">tambah</button>
                        </td>
                      </tr>
                      <tr>
                        <td colspan="6"></td>
                        <td>
                          <a class="btn btn-sm btn-warning" href="/eoq/pages/retur">batal</a>
                          <a class="btn btn-sm btn-primary" href="/eoq/pages/retur">simpan</a>
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
const tanggal = document.getElementById('tanggal')
const realTanggal = document.getElementById('real-tanggal')

real.value = supplier.value
supplier.addEventListener('change', function({target}) {
  real.value = target.value
})
tanggal.addEventListener('change', function({target}) {
  realTanggal.value = target.value
})
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

