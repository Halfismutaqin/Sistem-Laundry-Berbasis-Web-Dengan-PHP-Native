<?php
require '../koneksi.php';
require '../cek_session.php';

if (!isset($_SESSION["username"])) {
	header("location:../index.php?pesan=belum_login");
}

$role=$_SESSION["role"];

if ($role!='Admin') {
    echo "Anda tidak punya akses pada halaman ini";
    exit;
}
$s_id_user=$_SESSION["id_user"];
// $s_email=$_SESSION["email"];
$s_username=$_SESSION["username"];
$s_password=$_SESSION["password"];
$s_role=$_SESSION["role"];


date_default_timezone_set('Asia/Jakarta');
setlocale(LC_TIME, 'id_ID.utf8');
?>