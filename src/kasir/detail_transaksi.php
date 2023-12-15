<?php session_start();
if (!isset($_SESSION['loginkasir'])) {
    header("location: ../login.php");
    exit;
}
include "../filelog.php";
include "../db.php";

$queryTransaksi = "SELECT * FROM tb_transaksi";
$execTransaksi = mysqli_query($conn, $queryTransaksi);
$dataTransaksi = mysqli_fetch_all($execTransaksi, MYSQLI_ASSOC);

// var_dump($_SESSION['id']);

// Ambil data pelanggan dari tb pelanggan
$queryPelanggan = "SELECT * FROM tb_pelanggan";
$execPelanggan = mysqli_query($conn, $queryPelanggan);
$dataPelanggan = mysqli_fetch_all($execPelanggan, MYSQLI_ASSOC);

$queryPaket = "SELECT * FROM tb_paket";
$execPaket = mysqli_query($conn, $queryPaket);
$dataPaket = mysqli_fetch_all($execPaket, MYSQLI_ASSOC);

$semuaHarga = [];
foreach ($dataPaket as $paket) {
    $semuaHarga[] += $paket['harga'];
}

$semuaId = [];
foreach ($dataPaket as $paket) {
    $semuaId[] += $paket['id'];
}
// var_dump($semuaId);



// Generate kode invoice random
$hmm = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$random = "INV-" . substr(str_shuffle($hmm), 0, 7);
// var_dump($random);

if (isset($_POST['kirim'])) {
    $invoice = $_POST['random'];
    $id_pelanggan = $_POST['pelanggan'];
    $tanggal = $_POST['tgl'];
    $batasTanggal = $_POST['batastgl'];
    $tanggalBayar = $_POST['tglbayar'];
    $status = $_POST['status'];
    $statusBayar = $_POST['status_bayar'];
    $id_kasir = $_SESSION['id'];
    $queryTambah = "INSERT INTO `tb_transaksi` (`id`, `kode_invoice`, `id_pelanggan`, `tgl`, `batas_waktu`, `tgl_bayar`, `diskon`, `status`, `dibayar`, `id_user`) VALUES (NULL, '$invoice', '$id_pelanggan', '$tanggal', '$batasTanggal', '$tanggalBayar', '', '$status', '$statusBayar', '$id_kasir');";
    $execTambah = mysqli_query($conn, $queryTambah);
    // Paket
    // Cek kode
    $kode = $_POST['random'];
    $queryCek = "SELECT * FROM tb_transaksi WHERE kode_invoice = '$kode'";
    $execCek = mysqli_query($conn, $queryCek);
    if (mysqli_num_rows($execCek) == 1) {
        $dataTransaksi = mysqli_fetch_assoc($execCek);
        $idTransaksi = $dataTransaksi['id'];
        foreach ($dataPaket as $pkt) {
            $namaPaket = $pkt['nama_paket'];
            $idPaket = $pkt['id'];
            $qty = $_POST["qty" . "$idPaket"];
            $keterangan = $_POST["ket" . "$idPaket"];
            if ($qty > 0 && $qty !== "") {
                $queryTambahTransaksi = "INSERT INTO `tb_detail_transaksi` (`id`, `id_transaksi`, `id_paket`, `qty`, `keterangan`) VALUES (NULL, '$idTransaksi', '$idPaket', '$qty', '$keterangan');";
                $execTambah = mysqli_query($conn, $queryTambahTransaksi);
            }
            if ($execTambah) {
                header("location: detail_transaksi.php");
            }
        }
    }

    $error = true;
    // if ($queryTambahTransaksi) {
    //     header("location: transaksi.php?kode=$invoice");
    // }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
    <link rel="stylesheet" href="../assets/css/main/app.css">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="../assets/css/main/app-dark.css">
    <link rel="stylesheet" href="../assets/css/shared/iconly.css">
</head>

<body>
    <div class="app">
        <?php include "sidebar.php"; ?>
    </div>

    <div id="main">
        <header class="mb-3">
            <a href="#" class="burger-btn d-block d-xl-none">
                <i class="bi bi-justify fs-3"></i>
            </a>
        </header>
        <div class="col-12">
            <div class=""></div>
        </div>
        <div class="page-heading pb-3">
            <h4>Detail Transaksi Pemesanan Laundry</h4>
        </div>
        <section id="multiple-column-form">
            <div class="row match-height">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header mb-0 pb-0">
                            <h4 class="card-title">Detail Transaksi</h4>
                        </div>
                        <div class="card-content">
                            <div class="card-body">
                                <form class="form" method="post">
                                    <div class="row">
                                        <div class="container mb-3">
                                            <div class="row">
                                                <div class="col mb-3">
                                                    <h4 class="text-center">Kode Invoice</h4>
                                                </div>
                                            </div>
                                            <div class="row justify-content-center fs-5 text-center">
                                                <div class="col-6">
                                                    <input type="text" name="" id="" disabled value="<?= $random; ?>" class="text-center form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="">
                                                    <h6>Nama Pelanggan</h6>
                                                </label>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="basicSelect" name="pelanggan">
                                                        <?php foreach ($dataPelanggan as $pelanggan) : ?>
                                                            <option value="<?= $pelanggan['id']; ?>"><?= $pelanggan['nama']; ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="">
                                                    <h6>Masukkan Tanggal</h6>
                                                </label>
                                                <div>
                                                    <input type="datetime-local" class="form-control" name="tgl">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="">
                                                    <h6>Batas Waktu Pembayaran</h6>
                                                </label>
                                                <div>
                                                    <input type="datetime-local" class="form-control" name="batastgl">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="">
                                                    <h6>Tanggal Pembayaran</h6>
                                                </label>
                                                <div>
                                                    <input type="datetime-local" class="form-control" name="tglbayar">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="">
                                                    <h6>Status</h6>
                                                </label>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="basicSelect" name="status">
                                                        <option value="baru">Baru</option>
                                                        <option value="proses">Proses</option>
                                                        <option value="selesai">Selesai</option>
                                                        <option value="diambil">Diambil</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-12">
                                            <div class="form-group">
                                                <label for="">
                                                    <h6>Status Bayar</h6>
                                                </label>
                                                <fieldset class="form-group">
                                                    <select class="form-select" id="basicSelect" name="status_bayar">
                                                        <option value="dibayar">Dibayar</option>
                                                        <option value="belum_dibayar">Belum Dibayar</option>
                                                    </select>
                                                </fieldset>
                                            </div>
                                        </div>
                                        <div class="mt-lg-2">
                                            <label for="">
                                                <h6>Daftar Paket</h6>
                                            </label>
                                        </div>
                                        <div class="table-responsive">
                                            <table class="table table-bordered mb-0">
                                                <thead>
                                                    <tr>
                                                        <th>No</th>
                                                        <th>Nama Paket</th>
                                                        <th>Jenis</th>
                                                        <th>Harga</th>
                                                        <th>Berat(Kg)</th>
                                                        <th>Keterangan</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $i = 0; ?>
                                                    <?php foreach ($dataPaket as $paket) : ?>
                                                        <?php $i++; ?>
                                                        <tr>
                                                            <td><?= $i; ?></td>
                                                            <td><?= $paket['nama_paket']; ?></td>
                                                            <td><?= $paket['jenis']; ?></td>
                                                            <td><?= $paket['harga']; ?></td>
                                                            <td>
                                                                <input type="number" name="qty<?= $paket['id'] ?>" class="form-control" value="0" id="qty<?= $paket['id']; ?>" onkeyup="cek()">
                                                            </td>
                                                            <td><input type="text" name="ket<?= $paket['id'] ?>" id="" value=" " class="form-control"></td>
                                                        </tr>
                                                    <?php endforeach ?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="row mt-lg-3 col-12">
                                            <div class="form-group col-5">
                                                <label for="">
                                                    <h6>Nama Kasir</h6>
                                                </label>
                                                <div>
                                                    <label for="" class="form-control" disabled><?= $_SESSION['nama'] ?></label>
                                                </div>
                                            </div>
                                            <div class="form-group col">
                                                <div class="float-end">
                                                    <h6>Total Harga :</h6>
                                                    <div class="mt-3">
                                                        <label class="form-control">Rp. <label id="tampil">0</label> </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-12 d-flex justify-content-end mt-3">
                                            <button type="submit" name="kirim" class="btn btn-primary mt-lg-3">Kirim</button>
                                            <input type="text" name="random" id="" class="visually-hidden" value="<?= $random; ?>">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/app.js"></script>
    <script>
        function cek() {
            var tampil = document.getElementById('tampil');
            <?php $b = 0 ?>
            var harga = [];
            <?php foreach ($semuaHarga as $harga) { ?>
                harga[<?= $b ?>] = <?= $harga ?>;
                <?php $b++ ?>
            <?php } ?>
            var idPaket = [];
            <?php $v = 0 ?>
            <?php foreach ($semuaId as $paketId) { ?>
                idPaket[<?= $v ?>] = <?= $paketId ?>;
                <?php $v++ ?>
            <?php } ?>
            <?php $s = 0 ?>
            var totalHarga = 0;
            <?php foreach ($dataPaket as $paket) : ?>
                <?php $idKetPa = $paket['id'] ?>
                var inputan = document.getElementById('qty' + '<?= $idKetPa ?>').value
                if (inputan > 0) {
                    totalHarga += (parseInt(inputan) * parseInt(harga[<?= $s ?>]));
                }
                <?php $s++ ?>
            <?php endforeach ?>
            tampil.innerHTML = totalHarga
        }
    </script>
</body>

</html>