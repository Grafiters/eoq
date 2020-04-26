<?php
  include ("../../Connect.php");
  session_start();

  // membuat code penjualan dari tabel penjualan
  $query = $conn->query('SELECT MAX(id) as maxId FROM penjualan');
  $hasil = $query->fetch_assoc();
  $idCode = $hasil['maxId'];
  
  $char = "PJL";
  $noUrut = (int)substr($idCode, 0, 2);
  $noUrut++;
  if ($noUrut<10) {
      $code = $char."00".$noUrut;
  }else if($noUrut<100){
      $code = $char."0".$noUrut;
  }else{
      $code = $char.$noUrut;
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
            <h1>Tambah Penjualan</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="/index.php">Dashboard</a></li>
              <li class="breadcrumb-item">
                <a href="/pages/penjualan/index.php">Daftar Penjualan</a>
              </li>
              <li class="breadcrumb-item active">Tambah Penjualan</li>
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
                <h3 class="card-title">Tambah Penjualan</h3>
              </div>
              <!-- /.card-header -->
              <form action="/eoq/backend/penjualan/addPenjualan.php" method="post">
              <div class="card-body">
                <div class="row align-items-end">
                  <!-- kode-pesan & tgl bayar -->
                  <div class="col">
                    <div class="form-group row">
                      <label class="form-label col-sm-4" for="">Kode Penjualan</label>
                      <div class="col-sm-8">
                        <input  name="code" class="form-control" type="text" value="<?php echo $code ?>" disabled>
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="form-label col-sm-4" for="">Tanggal Penjualan</label>
                      <div class="col-sm-8">
                        <input type="date" name="tanggal" class="form-control">
                      </div>
                    </div>
                  </div>
                  <!-- END kode-pesan & tgl bayar -->
                  <!-- Nama Supplier -->
                  <div class="col">
                    <div class="form-group row">
                    <!-- menampilkan nama supplier dalam bentuk option-->
                      <label class="form-label col-sm-4" for="">Nama Pembeli</label>
                      <div class="col-sm-8">
                        <input type="text" name="namepemb" class="form-control">
                      </div>
                    <!-- akhir menapilkan nama supplier -->
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
                      <tr>
                        <td>1</td>
                        <!-- AWAL menampilkan nama barang dari tabel barang dengan menggunakan option -->
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
                          <input id="amount" name="amount" class="form-control" type="number">
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
                          <button class="btn btn-sm btn-success" type="submit" name="submit">
                            submit
                          </button>
                        </td>
                      </tr>
                    <!-- END form tambah belanja -->
                  </tbody>
                </table>
                <!-- END tabel belanja -->
              </div>
              </form>
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

barang.addEventListener('change', function(e) {
  harga.value = e.target.value
  const price = harga.selectedOptions[0].attributes['price']['value']
  const temp = price * jumlah.value
  total.setAttribute('value', `Rp ${temp.toLocaleString('id')}`)
})

jumlah.addEventListener('change', function(e) {
  const hargaBeli = harga.selectedOptions[0].attributes['price']['value']
  const temp = hargaBeli * e.target.value
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

