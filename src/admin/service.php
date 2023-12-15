<?php
$page = "service";
require 'session.php';
require '../koneksi.php';
include 'service_proses.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Laundry</title>
    <?php
    include '../config_css.php';
    ?>
    <link rel="icon" href="../../pictures/icon_tab.png">
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
                <h3>Paket/ Layanan Laundry</h3>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- Tambah Pelanggan -->
                        <div class="card-header py-3">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#tambah_service">
                                Tambah Paket
                            </button>
                            <hr>

                        </div>
                        <!-- Akhir Tambah Pelanggan -->
                        <!-- Daftar Pelanggan -->
                        <div class="card-body">
                            <h5>Data Paket/ Layanan Laundry</h5>
                            <div class="table-responsive">
                                <table class="table table-hover" id="table1">
                                    <thead class="table-primary">
                                        <tr>
                                            <th>No</th>
                                            <th>KD Paket</th>
                                            <th>Kategori</th>
                                            <th>Jenis Paket</th>
                                            <th>Nama</th>
                                            <th>Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 0; ?>
                                        <?php foreach ($dataPaket as $paket) : ?>
                                        <?php $i++; ?>
                                        <tr>
                                            <td><?= $i; ?></td>
                                            <td><?= $paket['id_service']; ?></td>
                                            <td><?= $paket['kategori']; ?></td>
                                            <td><?= $paket['jenis']; ?></td>
                                            <td><?= $paket['nama_service']; ?></td>
                                            <td><?= $paket['harga']; ?></td>
                                            <td style="text-align: center;">
                                                <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                    data-bs-target="#edit_service<?= $paket['id_service']; ?>">
                                                    Edit
                                                </button>

                                                <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                                    data-bs-target="#Delete<?= $paket['id_service']; ?>">
                                                    Delete
                                                </button>
                                            </td>
                                        </tr>
                                        <!-- Modal Edit Service/ Layanan-->
                                        <div class="modal fade text-left" id="edit_service<?= $paket['id_service']; ?>"
                                            tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header bg-primary">
                                                        <h5 class="modal-title white" id="myModalLabel1">Edit Paket</h5>
                                                        <button type="button" class="close rounded-pill"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-x">
                                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="post">
                                                            <div class="col-sm">
                                                                <h6>Ketegori</h6>
                                                                <fieldset class="form-group">
                                                                    <select class="form-select" id="basicSelect" name="kategori">
                                                                        <option value="<?=$paket['kategori'];?>" selected>
                                                                            <?=$paket['kategori'];?> </option>
                                                                        <!-- Query ambil data untuk diedit -->
                                                                        <?php 
                                                                            $sql=mysqli_query($koneksi, "SELECT * FROM tb_service GROUP BY kategori");
                                                                            while ($data=mysqli_fetch_array($sql)) {
                                                                        ?>
                                                                        <option value="<?=$data['kategori']?>">
                                                                            <?=$data['kategori'] ?>
                                                                        </option>
                                                                        <!-- Akhir Perulangan pengambilan data -->
                                                                        <?php
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </fieldset>
                                                            </div>
                                                            <div class="col-sm">
                                                                <h6>Masukkan Jenis Paket</h6>
                                                                <fieldset class="form-group">
                                                                    <select class="form-select" id="basicSelect" name="jenis_paket">
                                                                        <option class="bg-light-primary" value="<?=$paket['jenis'];?>"  selected>
                                                                            <?=$paket['jenis'];?> </option>
                                                                        <option class="bg-light-secondary" value="" disabled>&nbsp;   === Pilihan Paket: ===</option>
                                                                        <option value="kiloan">Kiloan</option>
                                                                        <option value="selimut">Selimut</option>
                                                                        <option value="bed cover">Bed Cover</option>
                                                                        <option value="satuan">Satuan</option>
                                                                        <option value="karpet">Karpet</option>
                                                                        <option value="gorden">Gorden</option>
                                                                        <option value="spring bed">Spring Bed</option>
                                                                        <option value="boneka">Boneka</option>
                                                                        <option value="tas">Tas</option>
                                                                        <option value="sepatu">Sepatu</option>
                                                                        <option value="lainnya">Lainnya</option>
                                                                        <option class="bg-light-secondary" value="" disabled>&nbsp;   === Pilihan Layanan: ===</option>
                                                                        <option value="kilat">Kilat</option>
                                                                        <option value="reguler">Reguler</option>
                                                                        <option value="express">Express</option>
                                                                    </select>
                                                                </fieldset>
                                                            </div>


                                                            <h6>Nama Service : </h6>
                                                            <input class="form-control" type="text" name="nama_service"
                                                                required value="<?= $paket['nama_service'] ?>"><br>

                                                            <h6>Harga : </h6>
                                                            <input class="form-control" type="text" name="harga"
                                                                required value="<?= $paket['harga'] ?>"><br>

                                                            <h6>Keterangan (Opsional) : </h6>
                                                            <textarea class="form-control" type="text" name="keterangan" rows="3"><?= $paket['keterangan'] ?></textarea>

                                                            <div class="modal-footer">
                                                                <input type="text" name="id_service" id=""
                                                                    class="visually-hidden"
                                                                    value="<?= $paket['id_service']; ?>">
                                                                <button type="button" class="btn"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Close</span>
                                                                </button>
                                                                <button type="submit" class="btn btn-primary ml-1"
                                                                    data-bs-dismiss="modal" name="edit">
                                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Simpan</span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Penutup Modal Edit -->
                                        <!--  Modal Delete -->
                                        <div class="modal fade text-left" id="Delete<?= $paket['id_service']; ?>"
                                            tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-scrollable" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="myModalLabel1">Hapus Paket</h5>
                                                        <button type="button" class="close rounded-pill"
                                                            data-bs-dismiss="modal" aria-label="Close">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-x">
                                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="" method="post">
                                                            <h6>Apakah anda yakin ingin menghapus paket <strong>
                                                                    <?=$paket['nama_service']; ?> </strong>?</h6>
                                                            <div class="modal-footer">
                                                                <input type="text" name="id_service" id=""
                                                                    class="visually-hidden"
                                                                    value="<?= $paket['id_service']; ?>">
                                                                <button type="button" class="btn"
                                                                    data-bs-dismiss="modal">
                                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Tidak</span>
                                                                </button>
                                                                <button type="submit" class="btn btn-primary ml-1"
                                                                    data-bs-dismiss="modal" name="delete">
                                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                                    <span class="d-none d-sm-block">Ya</span>
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- Penutup Modal Delete -->
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- Akhir Daftar Service/ Layanan -->
                    </div>
                </div>
            </div>

            <!--  Modal Tambah service/ layanan-->
            <div class="modal fade text-left" id="tambah_service" tabindex="-1" aria-labelledby="myModalLabel1"
                style="display: none;" aria-hidden="true">
                <div class="modal-dialog modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header bg-primary">
                            <h5 class="modal-title white" id="myModalLabel1">Tambah Paket</h5>
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
                            <form action="" method="post">
                                <div class="col-sm">
                                    <h6>Kategori Paket/ Layanan</h6>
                                    <fieldset class="form-group">
                                        <select class="form-select" id="basicSelect" name="ketegori">
                                            <option value="paket">Paket</option>
                                            <option value="layanan">Layanan</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="col-sm">
                                    <h6>Jenis/ Bahan Paket</h6>
                                    <fieldset class="form-group">
                                        <select class="form-select" id="basicSelect" name="jenis">
                                            <option class="bg-light-secondary" value="" disabled>&nbsp;   === Pilihan Paket: ===</option>
                                            <option value="kiloan">Kiloan</option>
                                            <option value="selimut">Selimut</option>
                                            <option value="bed cover">Bed Cover</option>
                                            <option value="satuan">Satuan</option>
                                            <option value="karpet">Karpet</option>
                                            <option value="gorden">Gorden</option>
                                            <option value="spring bed">Spring Bed</option>
                                            <option value="boneka">Boneka</option>
                                            <option value="tas">Tas</option>
                                            <option value="sepatu">Sepatu</option>
                                            <option value="lainnya">Lainnya</option>
                                            <option class="bg-light-secondary" value="" disabled>&nbsp;   === Pilihan Layanan: ===</option>
                                            <option value="kilat">Kilat</option>
                                            <option value="reguler">Reguler</option>
                                            <option value="express">Express</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <h6>Nama Paket/ Layanan : </h6>
                                <input class="form-control" type="text" name="nama_service" required><br>

                                <h6>Harga : </h6>
                                <input class="form-control" type="number" name="harga" required><br>

                                <h6>Keterangan (Opsional) : </h6>
                                <textarea class="form-control" type="text" name="keterangan" rows="3"></textarea>

                                <div class="modal-footer">
                                    <button type="button" class="btn" data-bs-dismiss="modal">
                                        <i class="bx bx-x d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Close</span>
                                    </button>
                                    <button type="submit" class="btn btn-primary ml-1"
                                        name="tambah">
                                        <i class="bx bx-check d-block d-sm-none"></i>
                                        <span class="d-none d-sm-block">Tambah</span>
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