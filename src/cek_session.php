<?php 
// mengaktifkan session pada php
session_start();
 
// menghubungkan php dengan koneksi database
include 'koneksi.php';
if (isset($_POST['login'])) {
// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = ($_POST['password']);
print_r($_POST);
 
 
// menyeleksi data user dengan email dan password yang sesuai
$login = mysqli_query($koneksi,"SELECT * from tb_user where username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);
 
// cek apakah email dan password di temukan pada database
if($cek > 0){
 
	$data = mysqli_fetch_assoc($login);
 
	// cek jika user login sebagai kasir
	if($data['role']=="Kasir"){
 
		// buat session login dan email
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama'] = $data['nama'];
		$_SESSION['status'] = "login";
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$_SESSION['role'] = $data['role'];
		// alihkan ke halaman dashboard kasir
		header("location:kasir/index.php");
 
	// cek jika user login sebagai admin
	}else if($data['role']=="Admin"){
		// buat session login dan email
        $_SESSION['id_user'] = $data['id_user'];
        $_SESSION['nama'] = $data['nama'];
		$_SESSION['status'] = "login";
		$_SESSION['username'] = $username;
		$_SESSION['password'] = $password;
		$_SESSION['role'] = $data['role'];
		// alihkan ke halaman dashboard admin
		header("location:admin/index.php");
 
	}else{
		// alihkan ke halaman login kembali
		header("location:index.php?pesan=gagal");
        // $pesan = mysqli_errno($koneksi)."User Tidak Ditemukan";
		// echo $pesan;
	}	
}else{
	header("location:index.php?pesan=gagal");
    // $pesan = mysqli_errno($koneksi)."Username atau Password tidak sesuai";
	// echo $pesan;
}
}

date_default_timezone_set("Asia/Bangkok");
$date_now = date("Y-m-d");
?>