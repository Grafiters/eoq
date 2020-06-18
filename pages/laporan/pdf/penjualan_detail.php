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
          <?= ": ".date_format(date_create($temp[0]['tanggal']), "d F Y") ?>
        </td>
      </tr>
      <tr>
        <td>Kode Penjualan</td>
        <td>
          <?= ": ".ucwords($temp[0]['kode']) ?>
        </td>
      </tr>
      <tr>
        <td>Nama Pembeli</td>
        <td>
          <?= ": ".ucwords($temp[0]['pembeli']) ?>
        </td>
      </tr>
    </table>
    <br />
    <table class="d-print table table-bordered text-center">
      <thead>
        <tr>
          <th>No.</th>
          <th>Nama Barang</th>
          <th>Harga Satuan</th>
          <th>Jumlah Beli</th>
          <th>Bayar</th>
        </tr>
      </thead>
      <tbody>
      <?php
          $subTotal = 0;
          $total = 0;
          foreach ($temp as $id => $buy) {
            $idx = $id + 1;
            $subTotal = $buy['harga'] * $buy['total'];
            $total += $subTotal;
            echo "<tr>";
              echo "<td>".$idx."</td>";
              echo "<td>".ucwords($buy['barang'])."</td>";
              echo "<td>Rp ".number_format($buy['harga'], 0)."</td>";
              echo "<td>".$buy['total']."</td>";
              echo "<td>Rp ".number_format($subTotal, 0)."</td>";
            echo "</tr>";
          }
      ?>
      </tbody>
    </table>
    <p class="text-right">
      <b>Total Bayar: </b> <?= "Rp ".number_format($total, 0) ?>
    </p>
    <br/>
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
