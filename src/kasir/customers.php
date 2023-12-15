<?php
$page   = 'customers';
require '../koneksi.php';
require 'session.php';
include 'customers_proses.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pelanggan</title>
    <?php
    include '../config_css.php';
    ?>
    <link rel="stylesheet" href="../../assets/extensions/simple-datatables/style.css">
    <link rel="stylesheet" href="../../assets/css/pages/simple-datatables.css">
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
                <h3>Kelola Pelanggan</h3>
              </div>

            <div class="page-content">
                <?php
                //Validasi untuk menampilkan pesan pemberitahuan
                if (isset($_GET['add'])) {

                    if ($_GET['add'] == 'berhasil') {
                        echo "<div  class='alert alert-success alert-dismissible show fade'><strong>Berhasil!</strong> Berhasil Menambah Data Pelanggan!
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    } else if ($_GET['add'] == 'gagal') {
                        echo "<div class='alert alert-warning alert-dismissible show fade'><strong>Gagal!</strong> Gagal Menambah Pelanggan!
                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                        </div>";
                    }
                }
                ?>

                <div class="card">
                    <div class="card-header py-3">
                        <a class="btn btn-primary" href="pelanggan_tambah.php" data-bs-toggle="modal"
                            data-bs-target="#TambahPelanggan">Tambah Pelanggan</a>
                        <hr>
                    </div>
                    <div class="card-body">
                            <h5>Data Pelanggan</h5>
                        <table class="table table-responsive table-hover" id="table1">
                            <thead class="table-primary">
                                <tr class="text-center">
                                    <th scope="col">No</th>
                                    <th scope="col">Nama Pelanggan</th>
                                    <th scope="col">Alamat</th>
                                    <th scope="col">Jenis Kelamin</th>
                                    <th scope="col">No Telepon</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $query = mysqli_query($koneksi, "SELECT * FROM tb_member");
                                $no = 1;
                                $count = mysqli_num_rows($query);
                                while ($data = mysqli_fetch_assoc($query)) {
                                    $id_cust = $data['id'];
                                    $nama_cust = $data['nama'];
                                    $alamat_cust = $data['alamat'];
                                    $jenkel_cust = $data['jenis_kelamin'];
                                    $no_tlp_cust = $data['tlp'];
                                ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $nama_cust; ?></td>
                                    <td><?= $alamat_cust; ?></td>
                                    <td><?= $jenkel_cust; ?></td>
                                    <td><?= $no_tlp_cust; ?></td>
                                    <td class="text-center">
                                        <form method="Post">
                                            <input type="hidden" name="id-cust" value="<?= $id_cust; ?>">
                                            <a type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#EditPelanggan<?= $id_cust; ?>"> Edit</a>
                                            <button name="delete-pelanggan" class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>

                                </tr>
                                <!-- Modal Edit Data Pelanggan -->
                                <div class="modal fade" id="EditPelanggan<?= $id_cust; ?>" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header bg-primary">
                                                <h5 class="modal-title white" id="myModalLabel160">Edit Data Pelanggan
                                                </h5>
                                                <button type="button" class="close" data-bs-dismiss="modal"
                                                    aria-label="Close">
                                                    <i data-feather="x"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form method="POST">
                                                    <div class="form-group">
                                                        <div class="card-body">
                                                            <input type="hidden" name="id-cust"
                                                                value="<?= $id_cust; ?>">
                                                            <h6>Nama Pelanggan : </h6>
                                                            <input class="form-control" type="text" name="nama-cust"
                                                                required value="<?= $nama_cust ?>"><br>
                                                            <h6>Alamat : </h6>
                                                            <textarea name="alamat-cust" class="form-control"
                                                                rows="4"><?= $alamat_cust ?></textarea><br>
                                                            <h6>Jenis Kelamin : </h6>
                                                            <select class="form-select" name="jenkel-cust">
                                                                <option value="L"
                                                                    <?= (@$data['jenis_kelamin'] == 'L') ? 'selected' : '' ?>>
                                                                    Laki-Laki</option>
                                                                <option value="P"
                                                                    <?= (@$data['jenis_kelamin'] == 'P') ? 'selected' : '' ?>>
                                                                    Perempuan</option>
                                                            </select><br>
                                                            <h6>No Telepon : </h6>
                                                            <input class="form-control" type="tel" name="tlp-cust"
                                                                required value="<?= $no_tlp_cust ?>"><br>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light-danger"
                                                    data-bs-dismiss="modal">
                                                    <i class="bx bx-x d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Batal</span>
                                                </button>

                                                <button name="update-pelanggan" type="submit"
                                                    class="btn btn-primary ml-1">
                                                    <i class="bx bx-check d-block d-sm-none"></i>
                                                    <span class="d-none d-sm-block">Simpan</span>
                                                </button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                }
                                ?>
                            </tbody>
                        </table>

                        <hr width="100%">
                        <h6>Jumlah data pelanggan : <?php echo $count; ?></h6>
                    </div>
                </div>


                <!-- Mentrigger Modal: -->
                <div class="modal fade" id="TambahPelanggan" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header bg-primary">
                                <h5 class="modal-title white" id="myModalLabel160">Tambah Data Pelanggan
                                </h5>
                                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                    <i data-feather="x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form method="POST">
                                    <div class="form-group">
                                        <div class="card-body">
                                            <h6>Nama Pelanggan : </h6>
                                            <input class="form-control" type="text" name="nama-cust" required
                                                placeholder="Masukkan Nama Lengkap Pelanggan"><br>
                                            <h6>Alamat : </h6>
                                            <textarea name="alamat-cust" class="form-control" rows="4"
                                                placeholder="Masukkan Alamat Pelanggan"></textarea><br>
                                            <h6>Jenis Kelamin : </h6>
                                            <select class="form-select" name="jenkel-cust">
                                                <option value="L">Laki-Laki</option>
                                                <option value="P">Perempuan</option>
                                            </select><br>
                                            <h6>No Telepon : </h6>
                                            <input class="form-control" type="tel" name="tlp-cust" required
                                                placeholder="Masukkan Nomor Telepon/ Whatsapp"><br>
                                        </div>
                                    </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-danger" data-bs-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Batal</span>
                                </button>

                                <button name="add-pelanggan" id="top-center" type="submit" class="btn btn-primary ml-1">
                                    <i class="bx bx-check d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block">Simpan</span>
                                </button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!-- End of Page Content -->
            </div>

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