<?php
// var_dump($_POST);
include '../koneksi.php';

$queryUser = "SELECT * FROM tb_user NATURAL JOIN tb_outlet";
$execUser  = mysqli_query($koneksi, $queryUser);

$dataUser = mysqli_fetch_all($execUser, MYSQLI_ASSOC);

if(isset($_POST['add-user'])){
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role = $_POST['role'];
    $id_outlet = $_POST['id_outlet'];
    // print_r($_POST);
    $queryTambah = "INSERT INTO `tb_user` VALUES (NULL , '$nama', '$email', '$username', '$password', '$role', $id_outlet);";
    $execTambah = mysqli_query($koneksi, $queryTambah);
    if ($execTambah) {
        $log = $_SESSION['nama'] . " (" . $_SESSION['role'] . ") " . "Telah menambahkan user $nama pada daftar anggota";
        
        // logger($log, "../../../");
        header("location: cashier.php");
    }
}
// Besok lanjut fungsi log edit data kasir!!!!!!!!!!
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['editnama'];
    $email = $_POST['editemail'];
    $username = $_POST['editusername'];
    $password = $_POST['editpassword'];
    $role = $_POST['editrole'];
    $id_outlet = $_POST['editoutlet'];
    $queryEdit = "UPDATE tb_user SET nama = '$nama', email = '$email', username = '$username', password = '$password', role = '$role', id_outlet = $id_outlet WHERE id_user = $id";
    $execEdit = mysqli_query($koneksi, $queryEdit);
    if ($execEdit) {
        $log = $_SESSION['nama'] . " (" . $_SESSION['role'] . ") " . "Telah mengubah user dengan id ($id) pada daftar anggota";
        // logger($log, "../../../");
        header("location: cashier.php");
    }
}
if (isset($_POST['delete'])) {
    $id = $_POST['idhapus'];
    $querryDelete = "DELETE FROM tb_user WHERE id_user = $id";
    $execDelete = mysqli_query($koneksi, $querryDelete);
    if ($execDelete) {
        $log = $_SESSION['nama'] . " (" . $_SESSION['role'] . ") " . "Telah menghapus user dengan id ($id) pada daftar anggota";
        // logger($log, "../../../");
        header("location: cashier.php");
    }
}

?>