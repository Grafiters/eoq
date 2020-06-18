<?php
include('../../Connect.php');
session_start();
if($_SESSION['username']==""){
  header('Location: /eoq/pages/auth/login.php');
}else

$id = $_GET['id'];

$query = "
  SELECT
    pivot_pembelian.id AS id,
    barang.name AS nama,
    barang.harga AS harga,
    pivot_pembelian.total AS jumlah,
    pivot_pembelian.pembelian_id AS pembelian,
    pivot_pembelian.total * barang.harga AS total
  FROM pivot_pembelian
  INNER JOIN barang
  ON pivot_pembelian.barang_id=barang.id
  WHERE pivot_pembelian.pembelian_id = $id;
";
$pembelians = $conn->query($query);
// var_dump($pembelians);
$query = "
SELECT
  pembelian.id AS id,
  pembelian.code AS kode,
  pembelian.supplier AS supplier,
  pembelian.tanggal AS tanggal
FROM pembelian
WHERE pembelian.id=$id
";
$pembelian = $conn->query($query)->fetch_assoc();
$items = $conn->query("SELECT * FROM barang ORDER BY created_at")->fetch_all();

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
            <h1>Detail Pembelian</h1>
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
                <div class="row">
                  <div class="col">
                    <h3 class="card-title my-auto">Detail Pembelian</h3>
                  </div>
                  <div class="col text-right">
                  <a class="btn btn-sm btn-primary" href="<?= '/eoq/backend/pembelian/detailLaporan.php?id='.$_GET['id'] ?>">cetak</a>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row align-items-end">
                  <!-- kode-pesan & tgl bayar -->
                  <div class="col">
                    <div class="form-group row">
                      <label class="col-form-label col-sm-4" for="">Kode Pembelian</label>
                      <div class="col-sm-8">
                        <input class="form-control" type="text" value="<?= $pembelian['kode'] ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-form-label col-sm-4" for="">Tanggal Pembelian</label>
                      <div class="col-sm-8">
                        <input type="date" name="tanggal" class="form-control" value="<?= date_format(date_create($pembelian['tanggal']), 'Y-m-d') ?>" disabled>
                      </div>
                    </div>
                  </div>
                  <!-- END kode-pesan & tgl bayar -->
                  <!-- Nama Supplier -->
                  <div class="col">
                    <div class="form-group row">
                      <label class="col-form-label col-sm-4" for="">Nama Supplier</label>
                      <div class="col-sm-8">
                        <select id="supplier" class="form-control" name="supplier" disabled>
                          <option><?= $pembelian['supplier'] ?></option>
                        </select>
                      </div>
                    </div>
                  </div>
                  <!-- END nama supplier -->
                </div>
                <!-- tabel belanja -->
                <table class="table table-hover table-bordered text-center">
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
                    <?php
                    $i = 1;
                    while ($beli = $pembelians->fetch_array()) {
                      echo "<tr>";
                        echo "<td>$i</td>";
                        echo "<td>".$beli['nama']."</td>";
                        echo "<td>Rp ".number_format($beli['harga'],0)."</td>";
                        echo "<td>".$beli['jumlah']."</td>";
                        echo "<td>Rp ".number_format($beli['total'], 0)."</td>";
                      echo "</tr>";
                      $i++;
                    }
                    ?>
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
const payment = document.getElementById('payment')
payment.value = harga.selectedOptions[0].attributes['price']['value']

barang.addEventListener('change', function(e) {
  harga.value = e.target.value
  const price = harga.selectedOptions[0].attributes['price']['value']
  const temp = price * jumlah.value
  payment.value = price
  total.setAttribute('value', `Rp ${temp.toLocaleString('id')}`)
})

jumlah.addEventListener('change', function(e) {
  const price = harga.selectedOptions[0].attributes['price']['value']
  const temp = price * e.target.value
  total.setAttribute('value', `Rp ${temp.toLocaleString('id')}`)
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


