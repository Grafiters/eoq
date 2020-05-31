<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Retur</title>
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
    <h5 class="text-center">Data Retur</h5>
    <br />
    <?php if ($awal!=""): ?>
    <p>Data Dari Tanggal <?= $awal ?> Sampai Tanggal <?= $akhir ?></p>
    <?php endif; ?>
    <table class="d-print table table-bordered text-center">
      <thead>
        <tr>
          <th>No</th>
          <th>Kode</th>
          <th>Tanggal Retur</th>
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
              echo "<td>".$buy['tanggal']."</td>";
              echo "<td>Rp ".number_format($buy['total'], 0)."</td>";
            echo "</tr>";
            $idx++;
          }
      ?>
      </tbody>
    </table>
    <br/>
    <p class="p-5">
			<?= ucwords($_SESSION['username']) ?>
		</p>
    <br/>
    <br/>
    <br/>
    <p>TTD dan Nama Terang</p>
  </div>
</body>
</html>
