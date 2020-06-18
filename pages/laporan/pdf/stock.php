<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pembelian</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
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
    <h5 class="text-center">Laporan Data Stok</h5>
    <br />
    <p>Tanggal Cetak : <?= date("d-m-Y") ?></p>
    <table class="table table-bordered w-100 text-center">
      <thead>
        <tr>
          <td>No</td>
          <td>Kode Barang</td>
          <td>Nama Barang</td>
          <td>Satuan</td>
          <td>Stok</td>
          <td>Total Bayar</td>
        </tr>
      </thead>
      <tbody>
        <?php foreach($stocks as $id => $stock): ?>
        <tr>
          <td>
            <?= $id+1 ?>
          </td>
          <td>
            <?= ucwords($stock['code']) ?>
          </td>
          <td>
            <?= ucwords($stock['name']) ?>
          </td>
          <td>
            <?= "Rp ".number_format($stock['harga'], 0) ?>
          </td>
          <td>
            <?= ucwords($stock['total']) ?>
          </td>
          <td>
            <?= "Rp ".number_format($stock['harga']*$stock['total']) ?>
          </td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <br />
    <p class="mx-5">
      <?= ucwords($_SESSION['username']) ?>
    </p>
    <br/>
    <br/>
    <br/>
    <p>TTD dan Nama Terang</p>
  </div>
</body>
</html>

