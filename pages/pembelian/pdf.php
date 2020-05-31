<?php include('../../backend/pembelian/detailLaporan.php') ?>
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
                <h3 class="card-title">Detail Pembelian</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="text-center">
                  <h5>GTT GROUP</h5>
                  <br />
                  <h5>
                    Jl Mugas Dalem No 7 Semarang 50249<br>
                    Phone +622440124545<br>
                    Email Address: bio_7jateng@yahoo.com
                  </h5>
                  <hr width="100%">
                </div>
                <div>
                  <br />
                  <h5 class="text-center">Data Pembelian</h5>
                  <br />
                  <table class="table-borderless">
                    <tr>
                      <td>Tanggal Pembelian</td>
                      <td>
                        <?= ": ".date_format(date_create($temp[0]['tanggal']), "d F Y") ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Kode Pembelian</td>
                      <td>
                        <?= ": ".ucwords($temp[0]['kode']) ?>
                      </td>
                    </tr>
                    <tr>
                      <td>Nama Supplier</td>
                      <td>
                        <?= ": ".ucwords($temp[0]['supplier']) ?>
                      </td>
                    </tr>
                  </table>
                  <br />
                  <table class="d-print table table-bordered text-center">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Barang</th>
                        <th>Harga Satuan</th>
                        <th>Jumlah Beli</th>
                        <th>Bayar</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                      $subtotal = 0;
                      $total = 0;
                      foreach ($temp as $idx => $buy) {
                        $foo = $idx+1;
                        $total += $buy['total'];
                        echo "<tr>";
                        echo "<td>$foo</td>";
                        echo "<td>".ucwords($buy['nama'])."</td>";
                        echo "<td>Rp ".number_format($buy['harga'], 0)."</td>";
                        echo "<td>".ucwords($buy['jumlah'])."</td>";
                        echo "<td>Rp ".number_format($buy['total'], 0)."</td>";
                        echo "</tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                  <p class="text-right">
                    <b>Total Bayar: </b> <?= "Rp ".number_format($total, 0) ?>
                  </p>
                  <br/>
                  <p class="mx-5"><?= ucwords($_SESSION['username']) ?></p>
                  <br/>
                  <br/>
                  <br/>
                  <p>TTD dan Nama Terang</p>
                </div>


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


