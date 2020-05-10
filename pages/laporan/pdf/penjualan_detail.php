<?php
$temp = $result->fetch_all(MYSQLI_BOTH);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
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
    <h5 class="text-center">Data Penjualan</h5>
    <br />
    <table class="table-borderless">
      <tr>
        <td>Tanggal Penjualan</td>
        <td>
          <?= ": ".date_format(date_create($temp['tanggal']), "d F Y") ?>
        </td>
      </tr>
      <tr>
        <td>Kode Penjualan</td>
        <td>
          <?= ": ".ucwords($temp['kode']) ?>
        </td>
      </tr>
      <tr>
        <td>Nama Pembeli</td>
        <td>
          <?= ": ".ucwords($temp['pembeli']) ?>
        </td>
      </tr>
    </table>
    <br />
    <table class="d-print table table-bordered text-center">
      <thead>
        <tr>
          <th>Nama Barang</th>
          <th>Harga Satuan</th>
          <th>Jumlah Beli</th>
          <th>Bayar</th>
        </tr>
      </thead>
      <tbody>
      <?php
          $idx = 1;
          while ($buy = $result->fetch_assoc()) {
            echo "<tr>";
              echo "<td>$idx</td>";
              echo "<td>".ucwords($buy['kode'])."</td>";
              echo "<td>".date_format(date_create($buy['tanggal']), "l, d-m-Y")."</td>";
              echo "<td>Rp ".number_format($buy['total'], 0)."</td>";
            echo "</tr>";
            $idx++;
          }
      ?>
      </tbody>
    </table>
    <p class="text-right">
      <b>Total Bayar: </b> <?= "Rp ".number_format(1000, 0) ?>
    </p>
    <br/>
    <p>Admin/Bagian Pengadaan</p>
    <br/>
    <br/>
    <p>TTD dan Nama Terang</p>
  </div>
</body>
</html>
