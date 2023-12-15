<?php session_start();
if (!isset($_SESSION['loginkasir'])) {
    header("location: ../login.php");
    exit;
}



?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>kasir</title>
    <link rel="stylesheet" href="../assets/css/main/app.css">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="../assets/css/main/app-dark.css">
    <link rel="stylesheet" href="../assets/css/shared/iconly.css">
    <style>
        .card-body {
            height: 360px;
        }
    </style>

</head>

<body>

    <div id="app">
        <?php include "sidebar.php"; ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <h3>Sistem Informasi Manajemen Laundry</h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Halaman Hak Akses kasir</h4>
                            <hr>
                            <h4 class="fs-5">Sistem Informasi Manajemen Laundry</h4>
                        </div>
                        <div class="card-body">
                            <div class="col-md-6">
                                <p class="fs-4">Merupakan sebuah sistem yang digunakan untuk mengelola data kebutuhan Laundry mulai dari pemesanan, riwayat transaksi, proses transaksi, data pelanggan dan data paket Laundry.</p>
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