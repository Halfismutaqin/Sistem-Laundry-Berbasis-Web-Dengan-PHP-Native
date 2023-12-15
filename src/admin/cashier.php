<?php

$page = "datakasir";
require '../koneksi.php';
require 'session.php';
include 'cashier_proses.php';

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Kasir</title>
    <?php
    include '../config_css.php';
    ?>
    <link rel="stylesheet" href="../../assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="../../assets/css/pages/simple-datatables.css">
</head>

<body>
    <div class="app">
        <?php include "template_sidebar.php"; ?>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>
            <div class="page-heading">
                <h3>Kelola Kasir/ Pegawai</h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- Tambah Kasir -->
                        <div class="card-header py-3">
                            <a class="btn btn-primary" href="#.php" data-bs-toggle="modal"
                                data-bs-target="#modal_tambah">Tambah Kasir</a>
                            <hr>
                        </div>

                        <!-- Daftar Kasir/pegawai -->
                        <div class="card-body">
                            <h5>Data Kasir/pegawai</h5>
                            <div class="table-responsive">
                                <table class="table table-hover" id="table1">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>No</th>
                                            <th>Outlet</th>
                                            <th>Nama</th>
                                            <th>Username </th>
                                            <th>Password</th>
                                            <th>Role</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <?php $i = 0; ?>
                                    <?php foreach ($dataUser as $user) : ?>
                                    <?php $i++; ?>
                                    <tr>
                                        <td><?= $i; ?></td>
                                        <td><?= "[".$user['id_outlet']."] ".$user['nama_outlet']; ?></td>
                                        <td><?= $user['nama']; ?></td>
                                        <td><?= $user['username']; ?></td>
                                        <td><?= $user['password']; ?></td>
                                        <td><?= $user['role']; ?></td>
                                        <td>
                                            <a href="" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#modal_edit<?= $user['id_user']; ?>">
                                                <i></i>
                                                <span>Edit</span>
                                            </a>
                                            <a href="" class="btn btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#hapus<?= $user['id_user']; ?>">
                                                <i></i>
                                                <span>Delete</span>
                                            </a>
                                        </td>
                                    </tr>
                                    <!-- Modal Edit -->
                                    <div class="modal fade text-left" id="modal_edit<?= $user['id_user']; ?>" tabindex="-1"
                                        aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                    <h5 class="modal-title white" id="myModalLabel1">Edit Anggota</h5>
                                                    <button type="button" class="close rounded-pill"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-x">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post">
                                                        <div class="form-group position-relative has-icon-left">
                                                            <input type="text" class="form-control"
                                                                placeholder="Masukkan Nama User" name="editnama"
                                                                value="<?= $user['nama']; ?>">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-person"></i>
                                                            </div>
                                                        </div>
                                                        <div class="form-group position-relative has-icon-left">
                                                            <input type="email" class="form-control"
                                                                placeholder="Masukkan Email" name="editemail"
                                                                value="<?= $user['email']; ?>">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-bookmark"></i>
                                                            </div>
                                                        </div>
                                                        <div class="form-group position-relative has-icon-left">
                                                            <input type="text" class="form-control"
                                                                placeholder="Masukkan Username" name="editusername"
                                                                value="<?= $user['username']; ?>">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-bookmark"></i>
                                                            </div>
                                                        </div>
                                                        <div class="form-group position-relative has-icon-left">
                                                            <input type="password" class="form-control"
                                                                placeholder="Masukkan Password" name="editpassword"
                                                                value="<?= $user['password']; ?>">
                                                            <div class="form-control-icon">
                                                                <i class="bi bi-key"></i>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm">
                                                            <h6>Masukkan Role</h6>
                                                            <fieldset class="form-group">
                                                                <select class="form-select" id="basicSelect"
                                                                    name="editrole">
                                                                    <option value="<?=$user['role']?>" selected>
                                                                        <?=$user['role']?> </option>
                                                                    <option value="Kasir">Kasir</option>
                                                                    <option value="Admin">Admin</option>
                                                                </select>
                                                            </fieldset>
                                                        </div>
                                                        <div class="col-sm">
                                                            <h6>Outlet</h6>
                                                            <fieldset class="form-group">
                                                                <select class="form-control" id="basicSelect"
                                                                    type="text" name="editoutlet" required>
                                                                    <option value="<?=$user['id_outlet']?>" selected>
                                                                        <?=$user['id_outlet']?> - <?=$user['nama_outlet']?> </option>
                                                                    <?php 
                                                                    $sql=mysqli_query($koneksi, "SELECT * FROM tb_outlet");
                                                                    while ($data=mysqli_fetch_array($sql)) {
                                                                    ?>
                                                                    <option value="<?=$data['id_outlet']?>">
                                                                        <?=$data['id_outlet']. " - " .$data['nama_outlet']?>
                                                                    </option>
                                                                    <?php
                                                                    }
                                                                    ?>
                                                                </select><br>
                                                            </fieldset>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn" data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Close</span>
                                                            </button>
                                                            <button type="submit" class="btn btn-primary ml-1"
                                                                data-bs-dismiss="modal" name="edit">
                                                                <input type="text" class="visually-hidden"
                                                                    value="<?= $user['id_user']; ?>" name="id">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Simpan</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Modal Hapus -->
                                    <div class="modal fade text-left" id="hapus<?= $user['id_user']; ?>" tabindex="-1"
                                        aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel1">Hapus Data Kasir/ Pegawai
                                                    </h5>
                                                    <button type="button" class="close rounded-pill"
                                                        data-bs-dismiss="modal" aria-label="Close">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                            viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                                            stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-x">
                                                            <line x1="18" y1="6" x2="6" y2="18"></line>
                                                            <line x1="6" y1="6" x2="18" y2="18"></line>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="" method="post">
                                                        <h5 class="text-center">Apakah anda yakin ingin menghapus
                                                            data pegawai <strong><?= $user['nama'] ?></strong></h5>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn" data-bs-dismiss="modal">
                                                                <i class="bx bx-x d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Tidak</span>
                                                            </button>
                                                            <button type="submit" class="btn btn-primary ml-1"
                                                                data-bs-dismiss="modal" name="delete">
                                                                <input type="text" class="visually-hidden"
                                                                    value="<?= $user['id_user']; ?>" name="idhapus">
                                                                <i class="bx bx-check d-block d-sm-none"></i>
                                                                <span class="d-none d-sm-block">Ya</span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach ?>
                                </table>

                            </div>
                        </div>
                        <!-- Akhir Daftar cashier -->
                    </div>
                </div>
            </div>


            <!-- Modal Tambah -->
            <div class="modal fade text-left" id="modal_tambah" tabindex="-1" aria-labelledby="myModalLabel1"
                style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="myModalLabel1">Tambah Data Kasir/ Pegawai</h5>
                            <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-x">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                                </svg>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST">
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" class="form-control" placeholder="Masukkan Nama User" name="nama"
                                        required>
                                    <div class="form-control-icon">
                                        <i class="bi bi-person"></i>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="email" class="form-control" placeholder="Masukkan Email" name="email"
                                        required>
                                    <div class="form-control-icon">
                                        <i class="bi bi-bookmark"></i>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="text" class="form-control" placeholder="Masukkan Username"
                                        name="username" required>
                                    <div class="form-control-icon">
                                        <i class="bi bi-bookmark"></i>
                                    </div>
                                </div>
                                <div class="form-group position-relative has-icon-left">
                                    <input type="password" class="form-control" placeholder="Masukkan Password"
                                        name="password" required>
                                    <div class="form-control-icon">
                                        <i class="bi bi-key"></i>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <h6>Masukkan Role</h6>
                                    <fieldset class="form-group">
                                        <select class="form-select" id="basicSelect" name="role" required>
                                            <option value="Kasir">Kasir</option>
                                            <option value="Admin">Admin</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-sm">
                                    <h6>Outlet</h6>
                                    <fieldset class="form-group">
                                        <select class="form-control" id="basicSelect" type="text" name="id_outlet"
                                            required>
                                            <option disabled selected> Pilih Otlet </option>
                                            <?php 
                                            $sql=mysqli_query($koneksi, "SELECT * FROM tb_outlet");
                                            while ($data=mysqli_fetch_array($sql)) {
                                            ?>
                                            <option value="<?=$data['id_outlet']?>">
                                                <?=$data['id_outlet']. " - " .$data['nama_outlet']?></option>
                                            <?php
                                            }
                                            ?>
                                        </select><br>
                                    </fieldset>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Batal</span>
                                    </button>

                                    <button name="add-user" id="top-center" type="submit"
                                        class="btn btn-primary ml-1">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Simpan</span>
                                    </button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <!-- Penutup Modal -->

        </div>
    </div>



    <!-- Pemanggilan javascript -->
    <?php
    include '../config_js.php';
    ?>

    <script src="../../assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="../../assets/js/pages/simple-datatables.js"></script>
</body>

</html>