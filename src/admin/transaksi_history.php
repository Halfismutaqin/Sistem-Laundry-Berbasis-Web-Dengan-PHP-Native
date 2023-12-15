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
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary">Data transaksi Belum Selesai</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive table-hover" id="table">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Invoice</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Dibayar</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                        $query = mysqli_query($koneksi,"SELECT * FROM tb_transaksi where status NOT IN ('diambil') AND pembayaran NOT IN ('lunas') ");
                        $no = 1;
                        $count = mysqli_num_rows($query);
                        while ($data = mysqli_fetch_assoc($query)) 
                        {
                            $id_transaksi = $data['id'];
                            $kd_invoice = $data['kode_invoice'];
                            $tgl = $data['tgl'];
                            $status = $data['status'];
                            $pembayaran = $data['pembayaran'];
                            
                            if ($status == "baru") {
                                $progres = "
                                <div class='badge bg-light-secondary'>BARU</div>
                                ";
                            }else if ($status == "proses") {
                                $progres = "
                                <div class='badge bg-light-warning'>PROSES</div>
                                ";
                            }else if ($status == "selesai") {
                                $progres = "
                                <div class='badge bg-light-primary'>SELESAI</div>
                                ";
                            }else{
                                $progres = "
                                <div class='badge bg-light-success'>DIAMBIL</div>
                                ";
                            }

                            if ($pembayaran == "lunas") {
                                $status_pembayaran = "
                                <div class='badge bg-light-success'>LUNAS</div>
                                ";
                            }else{
                                $status_pembayaran = "
                                <div class='badge bg-light-danger'>BELUM LUNAS</div>
                                ";
                            }
                        ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $kd_invoice ?></td>
                                        <td><?= $tgl ?></td>
                                        <td><?= $progres ?></td>
                                        <td><?= $status_pembayaran ?></td>
                                        <td>
                                            <form method="Post">
                                                <input type="hidden" name="id-transaksi" value="<?= $id_transaksi; ?>">
                                                <a class="btn btn-primary"
                                                    href="transaksi_update.php?id=<?= $id_transaksi ?>">Laundry
                                                    Selesai</a>
                                            </form>
                                        </td>

                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <h6>Jumlah transaksi belum selesai: <?php echo $count; ?></h6>
                        </div>
                    <!-- </div> -->
                    <hr>

                    <!-- Semua Data Transaksi -->
                    <!-- <div class="card"> -->
                        <div class="card-header py-3">
                            <h4 class="m-0 font-weight-bold text-primary">Data Semua Transaksi</h4>
                        </div>
                        <div class="card-body">
                            <table class="table table-responsive table-hover" id="table1">
                                <thead class="table-primary">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Kode Invoice</th>
                                        <th scope="col">Tanggal</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Dibayar</th>
                                        <th scope="col">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                        $query = mysqli_query($koneksi,"SELECT * FROM tb_transaksi ");
                        $no = 1;
                        $count = mysqli_num_rows($query);
                        while ($data = mysqli_fetch_assoc($query)) 
                        {
                            $id_transaksi = $data['id'];
                            $kd_invoice = $data['kode_invoice'];
                            $tgl = $data['tgl'];
                            $status = $data['status'];
                            $pembayaran = $data['pembayaran'];
                            
                            if ($status == "baru") {
                                $progres = "
                                <div class='badge bg-light-secondary'>BARU</div>
                                ";
                            }else if ($status == "proses") {
                                $progres = "
                                <div class='badge bg-light-warning'>PROSES</div>
                                ";
                            }else if ($status == "selesai") {
                                $progres = "
                                <div class='badge bg-light-primary'>SELESAI</div>
                                ";
                            }else{
                                $progres = "
                                <div class='badge bg-light-success'>DIAMBIL</div>
                                ";
                            }

                            if ($pembayaran == "lunas") {
                                $status_pembayaran = "
                                <div class='badge bg-light-success'>LUNAS</div>
                                ";
                            }else{
                                $status_pembayaran = "
                                <div class='badge bg-light-danger'>BELUM LUNAS</div>
                                ";
                            }
                        ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $kd_invoice ?></td>
                                        <td><?= $tgl ?></td>
                                        <td><?= $progres ?></td>
                                        <td><?= $status_pembayaran ?></td>
                                        <td>
                                            <form method="Post">
                                                <input type="hidden" name="id-transaksi" value="<?= $id_transaksi; ?>">
                                                <a class="btn btn-primary"
                                                    href="transaksi_update.php?id=<?= $id_transaksi ?>">Laundry
                                                    Selesai</a>
                                            </form>
                                        </td>

                                    </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>

                            <h6>Jumlah seluruh transaksi : <?php echo $count; ?></h6>
                        </div>
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
                                            <option class="bg-light-secondary" value="" disabled>&nbsp; === Pilihan
                                                Paket: ===</option>
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
                                            <option class="bg-light-secondary" value="" disabled>&nbsp; === Pilihan
                                                Layanan: ===</option>
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
                                    <button type="submit" class="btn btn-primary ml-1" name="tambah">
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