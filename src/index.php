<?php
session_start();
require 'koneksi.php';
$pesan='';


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Login</title>
<!-- Konfigurasi Pemanggilan Style  -->
<link rel="stylesheet" href="../assets/css/main/app.css">
<link rel="stylesheet" href="../assets/css/main/app-dark.css">
<link rel="shortcut icon" href="../assets/images/logo/favicon.svg" type="image/x-icon">
<link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/png">
<link rel="stylesheet" href="../assets/css/shared/iconly.css">

</head>

<body class="is-preload bg-gradient-primary">
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-6 d-none d-lg-block bg-login">
                            <center>
                            <img src="../pictures/logo3.png" width="90%"></div>
                            </center>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h2 text-gray-900 mb-4">Selamat Datang</h1>
                                    <hr>
                                    </div>
                                    <?php 
                                        if(isset($_GET['pesan'])){
                                            if($_GET['pesan'] == "gagal"){
                                                echo "<div class='alert alert-danger' role='alert'>Login gagal! username atau password tidak sesuai!</div>";
                                            }
                                            if($_GET['pesan'] == "belum_login"){
                                                echo "<div class='alert alert-danger' role='alert'>Maaf anda harus login dahulu!</div>";
                                            }
                                        }
                                    ?>
                                    <br>
                                    <form method="post" class="user" action="cek_session.php">
                                        <div class="form-group">
                                            <h4>Username :</h4>
                                            <input type="text" name="username" class="form-control form-control-user"
                                                id="exampleInputEmail" aria-describedby="emailHelp"
                                                placeholder="Enter Username or Email Address..." required>
                                        </div>
                                        <div class="form-group">
                                            <h4>Password :</h4>
                                            <input type="password" name="password"
                                                class="form-control form-control-user" id="exampleInputPassword"
                                                placeholder="Password" required>
                                        </div>
                                        <!-- <div class="form-group">
                                            <div class="custom-control custom-checkbox small">
                                                <input type="checkbox" class="custom-control-input" id="customCheck">
                                                <label class="custom-control-label" for="customCheck">Remember
                                                    Me</label>
                                            </div>
                                        </div> -->
                                        <br>
                                    <hr>
                                        <input type="submit" value="Login" class="btn btn-primary btn-user btn-block"
                                            name="login" />
                                    </form>
                                    <div class="text-center">
                                        <!-- <a class="small" href="forgot-password.html">Forgot Password?</a> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

        <!-- Footer -->
        <footer class="fixed-bottom">
            <center>
                <p class="copyright">&COPY; Beauty Fresh Laundry - <?php echo date("Y"); ?></p>
            </center>
        </footer>

    </div>

    <!-- Konfigurasi Pemanggilan Javascript  -->

<script src="../assets/js/bootstrap.js"></script>
<script src="../assets/js/app.js"></script>

<!-- Need: Apexcharts -->
<script src="../assets/extensions/apexcharts/apexcharts.min.js"></script>
<script src="../assets/js/pages/dashboard.js"></script>

</body>

</html>