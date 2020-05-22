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
    <h5 class="text-center">Data Pembelian</h5>
    <br />
    <table class="table-borderless">
      <tr>
        <td>Berdasarkan Data</td>
      </tr>
      <tr>
        <td>Tanggal Perhitungan</td>
        <td>
          <?= ": ".$temp['tanggal'] ?>
        </td>
      </tr>
      <tr>
        <td>Nama Barang</td>
        <td>
          <?= ": ".ucwords($temp['name']) ?>
        </td>
      </tr>
      <tr>
        <td>Kebutuhan Barang Tahunan</td>
        <td>
          <?= ": ".ucwords($temp['kebutuhan_tahunan']) ?>
        </td>
      </tr>
      <tr>
        <td>Biaya Sekali Pesan</td>
        <td>
          <?= ": ".ucwords($temp['biaya_sekali_pesan']) ?>
        </td>
      </tr>
      <tr>
        <td>Biaya Simpan</td>
        <td>
          <?= ": ".ucwords($temp['biaya_simpan_barang']) ?>
        </td>
      </tr>
      <tr>
        <td>Jumlah Hari Kerja</td>
        <td>: <?= $temp['kerja']." Hari" ?></td>
      </tr>
      <tr>
        <td>Lead Time (Waktu Tunggu)</td>
        <td>
          <?= ": ".ucwords($temp['tunggu']) ?>
        </td>
      </tr>
    </table>
    <br />
    <h5 class="text-center">Hasil</h5>
    <br />
    <table class="table-borderless">
      <tr>
        <td>Hasil EOQ</td>
        <td>
          <?= ": ".$temp['eoq'] ?>
        </td>
      </tr>
      <tr>
        <td>Hasil Biaya Pesan</td>
        <td>
          <?= ": Rp ".number_format($temp['hasil_biasa_pesan'], 0) ?>
        </td>
      </tr>
      <tr>
        <td>Hasil Biaya Simpan</td>
        <td>
          <?= ": Rp ".number_format($temp['hasil_biaya_simpan'], 0) ?>
        </td>
      </tr>
      <tr>
        <td>ROP</td>
        <td>
          <?= ": ".$temp['rop'] ?>
        </td>
      </tr>
      <tr class="text-white">
        <td>Kebutuhan Barang Tahunan</td>
        <td>
          <?= ": ".ucwords($temp['pembeli']) ?>
        </td>
      </tr>
    </table>
    <br/>
    <p class="mx-5"><?= ucwords($_SESSION['username']) ?></p>
    <br/>
    <br/>
    <br/>
    <p>TTD dan Nama Terang</p>
  </div>
</body>
</html>
