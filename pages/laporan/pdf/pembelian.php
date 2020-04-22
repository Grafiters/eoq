<?php
  include('../../../Connect.php');

  if ($conn) {
    $query = mysqli_query($conn, "SELECT pembelian.id AS id, pembelian.code AS kode, supplier.name AS supplier, pembelian.total AS total,pembelian.created_at AS tanggal FROM pembelian INNER JOIN supplier ON pembelian.supplier_id=supplier.id");
  //   var_dump($buys);
  }

  var_dump($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Pembelian</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Laporan Pembelian</h1>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Pembelian</th>
                    <th>Tanggal Pembelian</th>
                    <th>Total Bayar</th>
                </tr>
            </thead>
            <tbody>
              <?php
                  $i = 1;
                  while ($pembelian = $query->fetch_array()) {
                    $status = $i;
                    $kode = $pembelian['kode'];
                    $tanggal = date_format(date_create($pembelian['tanggal']), "D, d/m/Y");
                    $totalHarga = number_format($pembelian['total'], 0);
                    echo "<tr>";
                      echo "<td>$i</td>";
                      echo "<td>$kode</td>";
                      echo "<td>$tanggal</td>";
                      echo "<td>Rp $totalHarga</td>";
                    echo "</tr>";
                    $i++;
                  }
              ?>
            </tbody>
        </table>
    </div>
</body>
</html>
