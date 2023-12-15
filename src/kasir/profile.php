<?php session_start();
if (!isset($_SESSION['loginkasir'])) {
    header("location: ../login.php");
    exit;
}

include "../db.php";

$idKasir = $_SESSION['id'];
$queryAmbilData = "SELECT * FROM tb_user WHERE id = $idKasir";
$execAmbilData = mysqli_query($conn, $queryAmbilData);
$dataKasir = mysqli_fetch_assoc($execAmbilData);


if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $nama = $_POST['editnama'];
    $username = $_POST['editusername'];
    $password = $_POST['editpassword'];
    // $role = $_POST['editrole'];
    $queryEdit = "UPDATE tb_user SET nama = '$nama', username = '$username', password = '$password' WHERE id = $id";
    $execEdit = mysqli_query($conn, $queryEdit);
    if ($execEdit) {
        // $log = $_SESSION['nama'] . " (" . $_SESSION['role'] . ") " . "Telah mengubah user dengan id ($id) pada daftar anggota";
        // logger($log, "../../../");
        header("location: profile.php");
    }
}
// if($dataKasir['role'] == '')


?>








<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/main/app.css">
    <link rel="shortcut icon" href="../assets/images/logo/favicon.png" type="image/png">
    <link rel="stylesheet" href="../assets/css/main/app-dark.css">
    <link rel="stylesheet" href="../assets/css/shared/iconly.css">
</head>

<body>
    <div id="app">
        <?php include "sidebar.php" ?>
        <div id="main">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Profil Pengguna</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <!-- <img class="card-img-top" src="page/pengguna/foto/chadengle.jpg" alt="Card image"> -->
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>ID</td>
                                <td width="80%">: <?= $dataKasir['id'] ?></td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td width="80%">: <?= $dataKasir['nama'] ?></td>
                            </tr>
                            <tr>
                                <td>Username</td>
                                <td width="80%">: <?= $dataKasir['username'] ?></td>
                            </tr>
                            <tr>
                                <td>Password</td>
                                <td width="80%">: <?= $dataKasir['password'] ?></td>
                            </tr>
                            <tr>
                                <td>Sebagai</td>
                                <td width="80%">: <?= $dataKasir['role'] ?></td>
                            </tr>
                            <tr>
                                <td>Status</td>
                                <td width="80%">: Aktif</td>
                            </tr>
                        </tbody>
                    </table>
                    <?php include "modal_edit_profil.php" ?>
                </div>
            </div>
        </div>
    </div>


    <script src="../assets/js/bootstrap.js"></script>
    <script src="../assets/js/app.js"></script>
</body>

</html>