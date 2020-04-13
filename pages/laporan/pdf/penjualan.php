<?php
    include('../../../Connect.php');
    // $query = "SELECT * FROM user ORDER BY user_id DESC";

    if ($conn) {
      $buys = mysqli_query($conn, "SELECT pivot.id AS id, penjualan.code AS kode, penjualan.created_at AS tanggal, barang.price*pivot.jumlah AS bayar FROM barang, penjualan, pivot WHERE barang.id=penjualan.id=pivot.id ");
    //   var_dump($buys);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1 class="text-center">Laporan Penjualan</h1>
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Kode Penjualan</th>
                    <th>Tanggal Pembelian</th>
                    <th>Total Bayar</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $idx = 1;
                while ($buy = $buys->fetch_assoc()) {
                  echo "<tr>";
                    echo "<td>$idx</td>";
                    echo "<td>".ucwords($buy['kode'])."</td>";
                    echo "<td>".ucwords($buy['tanggal'])."</td>";
                    echo "<td>".ucwords($buy['bayar'])."</td>";
                  echo "</tr>";
                }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
