<?php


session_start();
if (!isset($_SESSION['loginkasir'])) {
    header("location: ../login.php");
    exit;
}

include "../db.php";


$querySemuaPelanggan = "SELECT * FROM tb_pelanggan";
$execSemuaPelanggan = mysqli_query($conn, $querySemuaPelanggan);
$dataSemuaPelanggan = mysqli_fetch_all($execSemuaPelanggan, MYSQLI_ASSOC);
// var_dump($dataSemuaPelanggan);


$kode = $_GET['kode'];
$idTransaksi = $_GET['idtransaksi'];
$queryTransaksi = "SELECT * FROM tb_transaksi WHERE id = $idTransaksi";
$execTransaksi = mysqli_query($conn, $queryTransaksi);
$dataTransaksi = mysqli_fetch_assoc($execTransaksi);
// var_dump($dataTransaksi);

$idPelanggan = $dataTransaksi['id_pelanggan'];
$queryPelanggan = "SELECT * FROM tb_pelanggan WHERE id = $idPelanggan";
$execPelanggan = mysqli_query($conn, $queryPelanggan);
$dataPelanggan = mysqli_fetch_assoc($execPelanggan);



$queryDetail = "SELECT * FROM tb_detail_transaksi WHERE id_transaksi = $idTransaksi";
$execDetail = mysqli_query($conn, $queryDetail);
$dataDetail = mysqli_fetch_all($execDetail, MYSQLI_ASSOC);
// var_dump($dataDetail);


$querryPaket = "SELECT * FROM tb_paket";
$execPaket = mysqli_query($conn, $querryPaket);
$dataPaket = mysqli_fetch_all($execPaket, MYSQLI_ASSOC);




if ((!isset($_GET['idtransaksi']) || !isset($_GET['kode'])) || ($kode !== $dataTransaksi['kode_invoice'] || $idTransaksi !== $dataTransaksi['id'])) {
    header("location: riwayat.php");
    exit;
}

// Warna badge
if ($dataTransaksi['dibayar'] == 'dibayar') {
    $bayarWarna = "badge bg-success";
}
if ($dataTransaksi['dibayar'] == 'belum_dibayar') {
    $bayarWarna = "badge bg-warning";
}
if ($dataTransaksi['status'] == 'baru') {
    $statusWarna = "badge bg-secondary";
}
if ($dataTransaksi['status'] == 'proses') {
    $statusWarna = "badge bg-info";
}
if ($dataTransaksi['status'] == 'selesai') {
    $statusWarna = "badge bg-primary";
}
if ($dataTransaksi['status'] == 'diambil') {
    $statusWarna = "badge bg-success";
}
// Akhir warna badge


// Inner html badge
if ($dataTransaksi['dibayar'] == 'belum_dibayar') {
    $status = "Belum Dibayar";
}
if ($dataTransaksi['dibayar'] == 'dibayar') {
    $status = "Dibayar";
}
if ($dataTransaksi['status'] == 'baru') {
    $proses = 'Baru';
}
if ($dataTransaksi['status'] == 'proses') {
    $proses = 'Dalam Proses';
}
if ($dataTransaksi['status'] == 'selesai') {
    $proses = 'Selesai';
}
if ($dataTransaksi['status'] == 'diambil') {
    $proses = 'Diambil';
}
// Akhir inner html badge



// Edit detail transaksi
if (isset($_POST['simpan'])) {
    // Ubah data tb transaksi
    $pelanggan = $_POST['pelanggan'];
    $tgl = $_POST['tgl'];
    $batastgl = $_POST['batastgl'];
    $tglbayar = $_POST['tglbayar'];
    $status = $_POST['status'];
    $status_bayar = $_POST['status_bayar'];
    if ($tgl == '0000-00-00 00:00:00') {
        exit;
    }
    $queryEditData = "UPDATE `tb_transaksi` SET `id_pelanggan` = '$pelanggan', `tgl` = '$tgl', `batas_waktu` = '$batastgl', `tgl_bayar` = '$tglbayar', `status` = '$status', `dibayar` = '$status_bayar' WHERE `tb_transaksi`.`id` = $idTransaksi;";
    $execEditData = mysqli_query($conn, $queryEditData);
    // Ubah data tb detail transaksi
    // Query Edit data
    // Cek sudah ada isinya tau belum,
    $jumlahRow = mysqli_num_rows($execDetail);
    $jumlahPaket = mysqli_num_rows($execPaket);
    foreach ($dataDetail as $detail) {
        // Jika sudah, ganti isinya dengan yang baru
        foreach ($dataPaket as $paket) {
            if ($paket['id'] == $detail['id_paket']) {
                $idPaket = $paket['id'];
                $qty = $_POST['qty' . "$idPaket"];
                $keterangan = $_POST['ket' . "$idPaket"];
                if ($detail['qty'] !== $qty) {
                    $queryUpdate = "UPDATE `tb_detail_transaksi` SET `qty` = '$qty', `keterangan` = '$keterangan' WHERE id_paket = $idPaket AND id_transaksi = $idTransaksi";
                    $execUpdate = mysqli_query($conn, $queryUpdate);
                }
            } else {
                continue;
            }
        }

        // Jika belum ada, masukan data tersebut dgn insert
        foreach ($dataPaket as $paket) {
            // global $idTransaksi;
            $idPaket = $paket['id'];
            $queryPilih = "SELECT * FROM tb_detail_transaksi WHERE id_paket = $idPaket AND id_transaksi = $idTransaksi";
            $execPilih = mysqli_query($conn, $queryPilih);
            $jumlahPilih = mysqli_num_rows($execPilih);
            if ($paket['id'] !== $detail['id_paket']) {
                $idPaket = $paket['id'];
                $qty = $_POST['qty' . "$idPaket"];
                $keterangan = $_POST['ket' . "$idPaket"];
                if (mysqli_num_rows($execDetail) == 0 && $qty !== 0) {
                    $queryTambahPesanan = "INSERT INTO `tb_detail_transaksi` (`id`, `id_transaksi`, `id_paket`, `qty`, `keterangan`) VALUES (NULL, '$idTransaksi', '$idPaket', '$qty', '$keterangan')";
                    $execTambahPesanan = mysqli_query($conn, $queryTambahPesanan);
                }
                if ($qty !== 0 && $jumlahPilih == 0) {
                    $queryTambahPesanan = "INSERT INTO `tb_detail_transaksi` (`id`, `id_transaksi`, `id_paket`, `qty`, `keterangan`) VALUES (NULL, '$idTransaksi', '$idPaket', '$qty', '$keterangan')";
                    $execTambahPesanan = mysqli_query($conn, $queryTambahPesanan);
                }
            }
        }
    }
    foreach ($dataPaket as $paket) {
        $idPaket = $paket['id'];
        $queryDeleteBug = "DELETE FROM tb_detail_transaksi WHERE id_transaksi = $idTransaksi AND qty = 0";
        $execDeleteBug = mysqli_query($conn, $queryDeleteBug);
    }
    if (@$queryUpdate || @$queryTambahPesanan) {
        header("location: detail.php?idtransaksi=$idTransaksi&kode=$kode");
    }
}





?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Transaksi</title>
    <link rel="stylesheet" href="../assets/css/main/app.css">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="../assets/css/main/app-dark.css">
    <link rel="stylesheet" href="../assets/css/shared/iconly.css">
    <style>
    </style>
</head>

<body>
    <div id="app">
        <?php include "sidebar.php" ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <h3>Detail Transaksi Laundry</h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header m-0 p-0 pt-3 mt-3 ms-5">
                            <div class="row col-12">
                                <div class="col-9">
                                    <h4>Detail Transaksi</h4>
                                </div>
                                <div class="float-end col-auto mb-0 pb-0 ">
                                    <span class="<?= $bayarWarna ?>"><?= $status ?></span>
                                    <span class="<?= $statusWarna ?>"><?= $proses ?></span>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class=" card-body">
                            <div class="table-responsive col-9">
                                <table class="table mb-5 table-lg">
                                    <tbody>
                                        <?php  ?>
                                        <tr>
                                            <td class="col-3">No Invoice</td>
                                            <td class="">: <?= $kode ?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">Waktu Transaksi</td>
                                            <td class="text-bold-500">: <?= $dataTransaksi['tgl'] ?></td>

                                        </tr>
                                        <tr>
                                            <td class="col-3">Nama</td>
                                            <td>: <?= $dataPelanggan['nama'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="col-3">No Telp</td>
                                            <td>: <?= $dataPelanggan['tlp'] ?></td>
                                        </tr>
                                        <tr>
                                            <td class="text-bold-500">Alamat</td>
                                            <td>: <?= $dataPelanggan['alamat'] ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered mb-0">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Paket</th>
                                            <th>Jenis Paket</th>
                                            <th>Tarif</th>
                                            <th>Berat</th>
                                            <th>Total Biaya</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1; ?>
                                        <?php foreach ($dataDetail as $detail) : ?>
                                            <?php
                                            $idPaket = $detail['id_paket'];
                                            $queryAmbilPaket = "SELECT * FROM tb_paket WHERE id = $idPaket";
                                            $execAmbilPaket = mysqli_query($conn, $queryAmbilPaket);
                                            $dataAmbilPaket = mysqli_fetch_assoc($execAmbilPaket);
                                            $namaPaket = $dataAmbilPaket['nama_paket'];
                                            $jenisPaket = $dataAmbilPaket['jenis'];
                                            $hargaPaket = $dataAmbilPaket['harga'];
                                            $totalHarga = $detail['qty'] * $hargaPaket;
                                            ?>
                                            <tr>
                                                <td><?= $no ?></td>
                                                <td><?= $namaPaket ?></td>
                                                <td><?= $jenisPaket ?></td>
                                                <td><?= $hargaPaket ?></td>
                                                <td><?= $detail['qty'] ?></td>
                                                <td><?= $totalHarga ?></td>
                                            </tr>
                                            <?php $no++ ?>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-5">
                                <?php include "modal_edit_detail.php"; ?>
                                <a href="cetak.php?idtransaksi=<?= $idTransaksi ?>&kode=<?= $kode ?>" target="_blank"><button class="btn btn-primary">Cetak Invoice</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>


<script src="../assets/js/bootstrap.js"></script>
<script src="../assets/js/app.js"></script>

</html>