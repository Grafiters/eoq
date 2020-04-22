<?php
  include('../../Connect.php');
  $id = $_GET['id'];

  // var_dump($id);

  $query = $conn->query("SELECT penjualan.id AS id, penjualan.pembeli AS name, penjualan.code AS code, penjualan.created_at AS tanggal FROM pivot INNER JOIN penjualan ON penjualan.id='$id'");
  while ($data = $query->fetch_assoc()) {
    $id = $data['id'];
    $code = $data['code'];
    $tanggal = $data['tanggal'];
    $pembeli = $data['name'];
  }
  $penjualan = $query->fetch_assoc();
  // var_dump($penjualan);
  //$query = "SELECT pivot.id AS id, barang.name AS barang, barang.code AS code, barang.harga AS harga, pivot.jumlah AS jumlah FROM pivot, barang, penjualan WHERE pivot.barang_id=barang.id";
  //$penjualans = $conn->query($query);

  $penjualans = $conn->query("SELECT pivot.id AS id, barang.name AS barang, barang.code AS code, barang.harga AS harga, pivot.total AS jumlah, pivot.penjualan_id AS penjualan, pivot.total*barang.harga AS bayar FROM pivot INNER JOIN barang ON pivot.barang_id=barang.id");
  $items = $conn->query("SELECT * FROM barang ORDER BY created_at")->fetch_all();
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
            <a href="/eoq/pages/penjualan/index.php" class="nav-link active">
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
            <a href="/eoq/pages/pembelian/index.php" class="nav-link">
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
            <h1>Edit Penjualan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/index.php">Dashboard</a></li>
              <li class="breadcrumb-item">
                <a href="/pages/penjualan/index.php">Daftar Penjualan</a>
              </li>
              <li class="breadcrumb-item active">Edit Penjualan</li>
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
                <h3 class="card-title">Edit Penjualan</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row align-items-end">
                  <!-- kode-pesan & tgl bayar -->
                  <div class="col">
                    <div class="form-group row">
                      <label class="form-label col-sm-4" for="">Kode Penjualan</label>
                      <div class="col-sm-8">
                        <input class="form-control" type="text" value="<?php echo $code ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="form-label col-sm-4" for="">Tanggal Penjualan</label>
                      <div class="col-sm-8">
                        <input type="date" name="tanggal" class="form-control" value=<?php echo $tanggal ?> disabled>
                      </div>
                    </div>
                  </div>
                  <!-- END kode-pesan & tgl bayar -->
                  <!-- Nama Supplier -->
                  <div class="col">
                    <div class="form-group row">
                      <label class="form-label col-sm-4" for="">Nama Pembeli</label>
                      <div class="col-sm-8">
                        <input type="text" name="supplier" class="form-control" value="<?php echo $pembeli ?>" disabled>
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
                      <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php
                  $i = 1;
                  while ($beli = $penjualans->fetch_array()) {
                    $btnDelete = "<form class='d-inline mx-1' action='/eoq/backend/penjualan/deleteitem.php?id=".$beli['penjualan']."&pivot=".$beli['id']."' method='post'>
                      <button type='submit' class='btn btn-danger btn-sm'>
                      delete
                      </button>
                    </form>";
                    echo "<tr>";
                      echo "<td>$i</td>";
                      echo "<td>".$beli['barang']."</td>";
                      echo "<td>Rp ".number_format($beli['harga'],0)."</td>";
                      echo "<td>".$beli['jumlah']."</td>";
                      echo "<td>Rp ".number_format($beli['bayar'], 0)."</td>";
                      echo "<td>".$btnDelete."</td>";
                    echo "</tr>";
                    $i++;
                  }
                  ?>
                    <form action="/eoq/backend/penjualan/updatePenjualan.php?id=<?= $id ?>" method="post">
                      <tr>
                        <td><?php echo $id ?></td>
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
                          <input type="text" name="price" id="payment" class="d-none">
                          <select id="price" class="form-control" disabled>
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
                          <input id="amount" name="amount" class="form-control" type="number">
                        </td>
                        <td colspan="1">
                          <input id="total" name="total" class="form-control" type="number" disabled>
                        </td>
                        <td>
                          <button class="btn btn-sm btn-success" type="submit" name="update">
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
const harga = document.getElementById('price')
const jumlah = document.getElementById('amount')
const total = document.getElementById('total')
harga.addEventListener('change', function(e) {
  const jumlahBeli = jumlah.value
  const temp = jumlahBeli * e.target.value
  total.setAttribute('value', temp)
})
jumlah.addEventListener('change', function(e) {
  const hargaBeli = harga.value
  const temp = hargaBeli * e.target.value
  total.setAttribute('value', temp)
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


