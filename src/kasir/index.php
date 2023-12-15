<?php
$page   = 'dashboard';
require '../koneksi.php';
require 'session.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Sistem Laundry</title>
    <?php
        include '../config_css.php';
    ?>
</head>

<body>
    <div id="app">
        <!-- Template Sidebar -->
        <?php
            include 'template_sidebar.php';
        ?>
        <!-- end Sidebar -->
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            
            <div class="page-heading">
                <div class="row">
                    <div class="col-6">
                        <div class="text-start">
                            <h3>Dashboard</h3>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="text-end">
                                <div class="avatar bg-warning me-3">
                            <div class="btn btn-primary rounded-pill">Hi.. (<?= @$s_username ."-". $s_id_user ?>)
                                    <img src="../../assets/images/faces/2.jpg" alt="" srcset="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-content">
                <section class="row">
                    <!-- <div class="col-12 col-lg-9">
                        <div class="row"> -->
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon purple mb-2">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Data Customers</h6>
                                                <h6 class="font-extrabold mb-0">...</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon blue mb-2">
                                                    <i class="iconly-boldProfile"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Data Layanan</h6>
                                                <h6 class="font-extrabold mb-0">...</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-6 col-lg-4 col-md-6">
                                <div class="card">
                                    <div class="card-body px-4 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4 col-lg-12 col-xl-12 col-xxl-5 d-flex justify-content-start ">
                                                <div class="stats-icon green mb-2">
                                                    <i class="iconly-boldAdd-User"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8 col-lg-12 col-xl-12 col-xxl-7">
                                                <h6 class="text-muted font-semibold">Laporan</h6>
                                                <h6 class="font-extrabold mb-0">...</h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <!-- </div> -->
                    <!-- </div> -->
                        <!-- <div class="row"> -->
                            <div class="card">
                                <div class="card-body">
                            <center>
                                <h1>Isi Konten</h1>
                            </center>
                                </div>
                            </div>
                        <!-- </div> -->
                </section>
            </div>

            <br><br><br><br><br><br><br><br><br><br><br><br>
            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <center>
                        <div class="footer">
                            <p>2022 &copy; Laundry</p>
                        </div>
                    </center>
                </div>
            </footer>
        </div>
    </div>

    <!-- Pemanggilan javascript -->
    <?php
    include '../config_js.php';
    ?>
</body>

</html>