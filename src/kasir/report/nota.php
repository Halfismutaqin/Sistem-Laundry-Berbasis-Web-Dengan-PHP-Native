<?php
    require '../../koneksi.php';

    if (!isset($_GET['kd_inv']) || ($_GET['kd_inv'])=="") {
        header("location: ../transaksi_history.php");
        exit;
    }
    
$querySemuaPelanggan = "SELECT * FROM tb_member";
$execSemuaPelanggan = mysqli_query($koneksi, $querySemuaPelanggan);
$dataSemuaPelanggan = mysqli_fetch_all($execSemuaPelanggan, MYSQLI_ASSOC);
// var_dump($dataSemuaPelanggan);


// $kode = $_GET['kode'];
$kd_inv = @$_GET['kd_inv'];
$queryTransaksi = "SELECT * FROM tb_transaksi WHERE kode_invoice = '$kd_inv' ";
$execTransaksi = mysqli_query($koneksi, $queryTransaksi);
$dataTransaksi = mysqli_fetch_assoc($execTransaksi);



$tgl = $dataTransaksi['tgl'];
$idPelanggan = $dataTransaksi['id_member'];
$idTransaksi = $dataTransaksi['id'];
$kode_inv = $dataTransaksi['kode_invoice'];
$pembayaran = $dataTransaksi['pembayaran'];
$queryPelanggan = "SELECT * FROM tb_member WHERE id = $idPelanggan";
$execPelanggan = mysqli_query($koneksi, $queryPelanggan);
$dataPelanggan = mysqli_fetch_assoc($execPelanggan);


$namaPelanggan = $dataPelanggan['nama'];
$noHp = $dataPelanggan['tlp'];
$alamat = $dataPelanggan['alamat'];

$queryDetail = "SELECT * FROM tb_detail_transaksi WHERE id_transaksi = $idTransaksi";
$execDetail = mysqli_query($koneksi, $queryDetail);
$dataDetail = mysqli_fetch_all($execDetail, MYSQLI_ASSOC);
// var_dump($dataDetail);


$querryPaket = "SELECT * FROM tb_service";
$execPaket = mysqli_query($koneksi, $querryPaket);
$dataPaket = mysqli_fetch_all($execPaket, MYSQLI_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../../../assets/css/main/app.css">
    <link rel="stylesheet" href="../../../assets/css/shared/iconly.css">
    <style>
		*{margin: 0; padding: 0}
		body{font-family: arial}
		.container_print{margin: auto; width:500px; text-align: center;}
		a{font-weight: bold}
	</style>
</head>

<body> 
    <!-- onload="window.print();"> -->
    <div class="container_print">
        <div class="card">
            <div class="card-header bg-light-secondary">
                <div class="row">
                    <div class="col-sm-1 text-center">
                        <img src="../../../pictures/logo2.PNG" width="100px" alt="brand">
                    </div>
                    <div class="col-sm-11 text-left">
                        <h4>Beauty Fresh LAUNDRY</h4>
                        <h6>Solo</h6>
                        <h6>@beautyfreshlaundry</h6>
                    </div>
                </div>
            </div>
            <hr class="mt-0">
            <div class="card-body">
                <!--baris/ row -->
                <div class="row">
                    <div class="text-end">
                        <?= date("d M Y"); ?>
                    </div>
                    <div class="col-sm-8">
                        <div class="form-group text-start">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>No Invoice</td>
                                        <td>: <?= $kode_inv ?></td>
                                        <input type="hidden" name="no_invoice" id="no_invoice" value="<?= $kode_inv ?>">
                                    </tr>
                                    <tr>
                                        <td>Waktu Transaksi</td>
                                        <td>: <?= $tgl ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pelanggan</td>
                                        <td>: <?= $namaPelanggan ?></td>
                                    </tr>
                                    <tr>
                                        <td>Alamat</td>
                                        <td>: <?= $alamat ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-6">

                    </div>
                </div>
                <!-- table table-bordered -->
                <!--rows -->
                <div>
                    <div class="table-responsive">
                        <table class="table table-bordered mb-0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Paket</th>
                                    <th>Jenis Paket</th>
                                    <th>Tarif</th>
                                    <th>Qty</th>
                                    <th>Jumlah</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; ?>
                                <?php $totalBayar = 0 ?>
                                <?php 
                                    $query = mysqli_query($koneksi,"SELECT * FROM `tb_detail_transaksi` a LEFT JOIN `tb_service` b
                                    ON a.id_service = b.id_service where kategori='paket' AND  id_transaksi='$idTransaksi'");
                                    $query2 = mysqli_query($koneksi,"SELECT * FROM `tb_detail_transaksi` a LEFT JOIN `tb_service` b
                                    ON a.id_service = b.id_service where kategori='layanan' AND  id_transaksi='$idTransaksi'");
                                    
                                    $no = 1;
                                    $total = 0;
                                    $diskon = 0;
                                    $hitung_diskon = 0;
                                    $pajak = 0;
                                    $hitung_pajak = 0;
                                    $grand_total = 0;
                                    $count = mysqli_num_rows($query);
                                    $jml_item = $count;
                                    while ($tambahan = mysqli_fetch_assoc($query2)) 
                                    {
                                        $nama_layanan = $tambahan['nama_service'];
                                        $harga_layanan = $tambahan['harga'];
                                        $biaya_tambahan = ($jml_item*$harga_layanan);
                                    }
                                    while ($data = mysqli_fetch_assoc($query)) 
                                    {
                                        $id_detail = $data['id'];
                                        $id_transaksi = $data['id_transaksi'];
                                        $id_paket = $data['id_service'];
                                        $nama_paket = $data['nama_service'];
                                        $jenis = $data['jenis'];
                                        $qty = $data['qty'];
                                        $keterangan = $data['ket_pesan'];
                                        $harga = $data['harga'];
                                        $jumlah = $qty * $harga;

                                        $total += ($jumlah);
                                            if ($total>=100000 and $total <200000){
                                                $diskon = 5;
                                            }elseif ($total>=200000 and $total <300000){
                                                $diskon = 7.5;
                                            }elseif ($total>=300000){
                                                $diskon = 10;
                                            }else {$diskon = 0;}
                                        $hitung_diskon= $diskon/100*$total;

                                        @$grand_total= ($total+$biaya_tambahan)-$hitung_diskon;
                                        
                                    ?>
                                <tr>
                                    <td><?= $no++?></td>
                                    <!-- <td><?= $id_transaksi ?></td> -->
                                    <td><?= $id_paket ?> - [<?= $nama_paket ?>]</td>
                                    <td><?= $jenis ?></td>
                                    <td><?= $harga ?></td>
                                    <td><?= $qty ?></td>
                                    <td><?= $jumlah ?></td>
                                </tr>
                                <?php
                                                }
                                            ?>
                            </tbody>
                        </table>
                        <br>
                        <div class="text-start">
                            Jenis Layanan : <strong> <?= $nama_layanan; ?> </strong> <br>
                            <span>(+) Biaya Layanan : <strong> Rp. <?= $biaya_tambahan ?>,- </strong></span> <br>
                            <span>(-) Diskon Belanja &nbsp; : <strong> - Rp.<?= $hitung_diskon ?>,- </strong></span> <br>
                            (*) Keterangan :<strong>  <?= $pembayaran; ?> </strong>
                        </div>
                        <hr>
                        <span class="float-end">
                            <h4 id="hasil" style="color: black;">Total Bayar : Rp. <?= $grand_total ?></h4>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="../../../assets/js/bootstrap.js"></script>
    <script src="../../../assets/js/app.js"></script>

</body>

</html>