<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
</head>
<body>
    <div>
        <h1 class="text-center">Laporan Penjualan</h1>
        <table class="d-print table table-bordered text-center">
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
    </div>
</body>
</html>
