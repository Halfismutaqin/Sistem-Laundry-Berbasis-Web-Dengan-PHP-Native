<?php session_start();
if (!isset($_SESSION['loginkasir'])) {
    header("location: ../login.php");
    exit;
}

include "../koneksi.php";
$queryTrnasaksi = "SELECT * FROM tb_transaksi";
$execTransaksi = mysqli_query($koneksi, $queryTrnasaksi);
$dataTransaksi = mysqli_fetch_all($execTransaksi, MYSQLI_ASSOC);


$queryDetail = "SELECT * FROM tb_detail_transaksi";
$execDetail = mysqli_query($koneksi, $queryDetail);
$dataDetail = mysqli_fetch_all($execDetail, MYSQLI_ASSOC);

$querryPaket = "SELECT * FROM tb_paket";
$execPaket = mysqli_query($koneksi, $querryPaket);
$dataPaket = mysqli_fetch_all($execPaket, MYSQLI_ASSOC);

if (isset($_POST['hps'])) {
    $id = $_POST['idhapus'];
    $queryHapusData = "DELETE FROM tb_detail_transaksi WHERE id_transaksi = $id";
    $execHapusData = mysqli_query($koneksi, $queryHapusData);
    $queryHapusTransaksi = "DELETE FROM tb_transaksi WHERE id = $id";
    $execHapusTransaksi = mysqli_query($koneksi, $queryHapusTransaksi);
    if ($execHapusData && $execHapusTransaksi) {
        header("location: riwayat.php");
    }
}


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Transaksi</title>
    <link rel="stylesheet" href="../assets/css/main/app.css">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="../assets/css/main/app-dark.css">
    <link rel="stylesheet" href="../assets/css/shared/iconly.css">
</head>

<body>
    <div class="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading pb-3">
                <h4>Riwayat Transaksi</h4>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header pb-4">
                            <h4>Daftar Transaksi</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <tr>
                                        <th>No</th>
                                        <th>Waktu Transaksi</th>
                                        <th>No Invoice</th>
                                        <th>Pelanggan</th>
                                        <th>Total Biyaya</th>
                                        <th>Pembayaran</th>
                                        <th>Status</th>
                                        <th>Aksi</th>
                                    </tr>
                                    <?php $no = 1; ?>
                                    <?php foreach ($dataTransaksi as $transaksi) : ?>
                                        <?php if ($transaksi['dibayar'] == 'belum_dibayar') {
                                            $status = "Belum Dibayar";
                                        }
                                        if ($transaksi['dibayar'] == 'dibayar') {
                                            $status = "Dibayar";
                                        }
                                        if ($transaksi['status'] == 'baru') {
                                            $proses = 'Baru';
                                        }
                                        if ($transaksi['status'] == 'proses') {
                                            $proses = 'Dalam Proses';
                                        }
                                        if ($transaksi['status'] == 'selesai') {
                                            $proses = 'Selesai';
                                        }
                                        if ($transaksi['status'] == 'diambil') {
                                            $proses = 'Diambil';
                                        } ?>
                                        <?php //if ($transaksi['tgl'] == '0000-00-00 00:00:00') {
                                        //$error = "visually-hidden";
                                        //} 
                                        ?>
                                        <tr class="<?= @$error ?>">
                                            <td><?= $no ?></td>
                                            <td><?= $transaksi['tgl'] ?></td>
                                            <td><?= $transaksi['kode_invoice'] ?></td>
                                            <td>
                                                <?php $idPelanggan = $transaksi['id_pelanggan']; ?>
                                                <?php $queryNama = "SELECT * FROM tb_pelanggan WHERE id = $idPelanggan";
                                                $execPelanggan = mysqli_query($koneksi, $queryNama);
                                                $dataPelanggan = mysqli_fetch_assoc($execPelanggan);
                                                $nama = $dataPelanggan['nama'];
                                                ?>
                                                <?= $nama ?>
                                            </td>
                                            <td>
                                                <?php
                                                $idTransaksi = $transaksi['id'];
                                                $queryAmbil = "SELECT * FROM tb_detail_transaksi WHERE id_transaksi = $idTransaksi";
                                                $execAmbil = mysqli_query($koneksi, $queryAmbil);
                                                $dataAmbil = mysqli_fetch_all($execAmbil, MYSQLI_ASSOC);
                                                $total = [];
                                                foreach ($dataAmbil as $ambil) {
                                                    $qty = $ambil['qty'];
                                                    $idPaket = $ambil['id_paket'];
                                                    $queryHarga = "SELECT * FROM tb_paket WHERE id = $idPaket";
                                                    $execHarga = mysqli_query($koneksi, $queryHarga);
                                                    $dataHarga = mysqli_fetch_assoc($execHarga);
                                                    $total[] +=  $dataHarga['harga'] * $qty;
                                                }
                                                $jumlah = count($total);
                                                $hargaA = "0";
                                                $hargaA;
                                                for ($i = 0; $i < $jumlah; $i++) {
                                                    $hargaA += $total[$i];
                                                }
                                                ?>
                                                <?= $hargaA ?>
                                            </td>
                                            <td><?= $status ?></td>
                                            <td><?= $proses ?></td>
                                            <td>
                                                <a href="detail.php?idtransaksi=<?= $transaksi['id'] ?>&kode=<?= $transaksi['kode_invoice'] ?>" style="color: white;"><button class="btn btn-primary">Detail</button></a>
                                                <?php @include "modal_hapus_riwayat.php"; ?>
                                            </td>
                                        </tr>
                                        <?php $no++ ?>
                                    <?php endforeach ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/app.js"></script>
</body>

</html>