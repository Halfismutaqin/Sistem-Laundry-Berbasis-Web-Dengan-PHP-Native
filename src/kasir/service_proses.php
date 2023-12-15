<?php
$querryPaket = "SELECT * FROM tb_service";
$execPaket = mysqli_query($koneksi, $querryPaket);
$dataPaket = mysqli_fetch_all($execPaket, MYSQLI_ASSOC);
$jumlah = mysqli_num_rows($execPaket);

if (isset($_POST['tambah'])) {

    $kategori = htmlspecialchars($_POST['ketegori']);
    $jenis = htmlspecialchars($_POST['jenis']);
    $nama = htmlspecialchars($_POST['nama_service']);
    $harga = htmlspecialchars($_POST['harga']);
    $keterangan = htmlspecialchars($_POST['keterangan']);
    // Generate Kode Paket/ Layanan
    $kode = strtoupper(substr($kategori,0,1));
    $mt_rand = mt_rand(100, 999);
    $id_service = $kode.$mt_rand.($jumlah+1);

    $querryTambah = "INSERT INTO `tb_service` VALUES ('$id_service', '$kategori', '$jenis', '$nama', $harga, '$keterangan');";
    $execTambah = mysqli_query($koneksi, $querryTambah);
    if ($execTambah) {
        // $log = $_SESSION['nama'] . " (" . $_SESSION['role'] . ") " . "Telah menambah paket dengan nama paket $nama dan dengan jenis $jenis pada daftar paket";
        // logger($log, "../../../");
        header("location: service.php?add=berhasil");
    }
}

if (isset($_POST['edit'])) {
    
    $id = htmlspecialchars($_POST['id_service']);
    $kategori = htmlspecialchars($_POST['kategori']);
    $jenis = htmlspecialchars($_POST['jenis_paket']);
    $nama = htmlspecialchars($_POST['nama_service']);
    $harga = htmlspecialchars($_POST['harga']);
    $keterangan = htmlspecialchars($_POST['keterangan']);
    $querryEdit = "UPDATE `tb_service` SET `kategori` = '$kategori', `jenis` = '$jenis', `nama_service` = '$nama', `harga` = '$harga', `keterangan` = '$keterangan' WHERE `tb_service`.`id_service` = $id";
    $execEdit = mysqli_query($koneksi, $querryEdit);
    if ($execEdit) {
        // $log = $_SESSION['nama'] . " (" . $_SESSION['role'] . ") " . "Telah mengubah paket dengan id paket ($id) pada daftar paket";
        // logger($log, "../../../");
        header("location: service.php?update=berhasil");
    }
}

if (isset($_POST['delete'])) {
    $id = $_POST['id_service'];
    $querryDelete = "DELETE FROM tb_service WHERE id_service = '$id'";
    $execDelete = mysqli_query($koneksi, $querryDelete);
    if ($execDelete) {
        // $log = $_SESSION['nama'] . " (" . $_SESSION['role'] . ") " . "Telah menghapus paket dengan id paket ($id) pada daftar paket";
        // logger($log, "../../../");
        header("location: service.php?hapus=berhasil");
    }
}
?>