<?php
    include ('../../Connect.php');
    require_once ('../dompdf/autoload.inc.php');
    $id = $_GET['id'];
    $query = mysqli_query($conn, "SELECT barang.name AS name, hasil.* FROM barang, hasil WHERE hasil.id=$id");
    // var_dump($query);
    while($result = mysqli_fetch_array($query)){
        $barang = $result['name'];
        $kebutuhan = $result['kebutuhan_tahunan'];
        $sekalipesan = $result['biaya_sekali_pesan'];
        $biayasimpan = $result['biaya_simpan_barang'];
        $eoq = $result['eoq'];
        $hasilpesan = $result['hasil_biasa_pesan'];
        $hasilsimpan = $result['hasil_biaya_simpan'];
        $rop = $result['rop'];
        $tanggal = $result['created_at'];
    }

    use Dompdf\Dompdf;
    $document = new Dompdf();

    $html = '<html><body'.
            '<center></center><br>'.
            '<center>Hasil Perhitungan</center><br>'.
            '<center>Hasil dari perhitungan EOQ pada GTT Groub</center><br>'.
            '<table class="table table-bordered">'.
                '<thead>'.
                    '<tr>'.
                        '<th></th>'.
                        '<th></th>'.
                    '</tr>'.
                '</thead>'.
                '<tbody>'.
                    '<tr>'.
                        '<td>Tanggal Perhitugan EOQ</td>'.
                        '<td>'.$tanggal.'</td>'.
                    '</tr>'.
                    '<tr>'.
                        '<td>Nama Barang</td>'.
                        '<td>'.$barang.'</td>'.
                    '</tr>'.
                    '<tr>'.
                        '<td>Kebutuhan Tahunan</td>'.
                        '<td>'.$kebutuhan.'</td>'.
                    '</tr>'.
                    '<tr>'.
                        '<td>Biaya Sekali Pakai</td>'.
                        '<td> Rp '.$sekalipesan.'</td>'.
                    '</tr>'.
                    '<tr>'.
                        '<td>Biaya Simpan Barang</td>'.
                        '<td> Rp '.$biayasimpan.'</td>'.
                    '</tr>'.
                    '<tr>'.
                        '<td>Hasil EOQ</td>'.
                        '<td> Rp '.$eoq.'</td>'.
                    '</tr>'.
                    '<tr>'.
                        '<td>Hasil Biaya Pesan</td>'.
                        '<td> Rp '.$hasilpesan.'</td>'.
                    '</tr>'.
                    '<tr>'.
                        '<td>Hasil Biaya Simpan</td>'.
                        '<td> Rp '.$hasilsimpan.'</td>'.
                    '</tr>'.
                    '<tr>'.
                        '<td>ROP</td>'.
                        '<td> Rp'.$rop.'</td>'.
                    '</tr>'.
                '</tbody>'.
            '</table>'.
            '</body></html>';
    
    $document->load_html($html);
    $document->setPaper('A4', 'lanscape');
    $document->render();
    $document->stream('Eoq', array("Attachment"=>0));
?>