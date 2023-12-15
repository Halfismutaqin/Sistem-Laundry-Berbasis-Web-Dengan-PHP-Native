<?php
$page = "transaksi";
require 'session.php';
require '../koneksi.php';
include 'transaksi_proses.php';
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
                <h3>Transaksi Laundry</h3>
            </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header py-3">
                        <h4 class="m-0 font-weight-bold text-primary">Buat Transaksi Baru</h4>
                    </div>
                    <form method="POST">
                        <div class="form-group">
                            <div class="card-body">

                                <?php
                                    $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
                                    // Output: 54esmdr0qf
                                    $invoice = "INV-".substr(str_shuffle($permitted_chars), 0, 5);

                                    //Validasi untuk menampilkan pesan pemberitahuan
                                    if (isset($_GET['add'])) {
                                
                                        if ($_GET['add']=='berhasil'){
                                            echo"<div class='alert alert-success'><strong>Berhasil!</strong> Berhasil Menambah Data transaksi!</div>";
                                        }else if ($_GET['add']=='gagal'){
                                            echo"<div class='alert alert-danger'><strong>Gagal!</strong> Gagal Menambah transaksi!</div>";
                                        }    
                                    }  
                                    //$idu=$_GET['id'];
                                    $query=mysqli_query($koneksi, "select * from tb_transaksi");

                                        $jml_data=mysqli_num_rows($query);
                                        $tgl_ini=date('ymd');
                                        $tgl=date('Y/m/d');
                                        $generate_id= $tgl_ini.$jml_data+1;
                                    
                                    ?>

                                <div class="card">
                                    <div class="col">
                                        <button type="button" class="btn btn-outline-primary block"
                                            data-bs-toggle="modal" data-bs-target="#tambah_trx<?= $generate_id ?>">(+)
                                            Tambah Item
                                            Transaksi </button>
                                        <!-- <a class="btn btn-warning"
                                                href="transaksi_detail.php?id-trx=<?= $generate_id ?>">(+) Tambah
                                                Item</a> -->
                                    </div>
                                    <table class="table table-table-responsive table-striped" border="2px">
                                        <thead class="bg-light-primary">
                                            <th colspan="7" style="text-align: center;">
                                                <h6>Detail Item Transaksi </h6>
                                            </th>
                                            <tr class="bg-white">
                                                <th scope="col">No</th>
                                                <!-- <th scope="col">ID Transaksi</th> -->
                                                <th scope="col">Paket Laundry</th>
                                                <th scope="col">Qty</th>
                                                <th scope="col">Jumlah</th>
                                                <th scope="col">Ket. Tambahan</th>
                                                <th scope="col">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $query = mysqli_query($koneksi,"SELECT * FROM `tb_detail_transaksi` a LEFT JOIN `tb_service` b
                                                ON a.id_service = b.id_service where kategori='paket' AND  id_transaksi='$generate_id'");
                                                $no = 1;
                                                $total = 0;
                                                $diskon = 0;
                                                $hitung_diskon = 0;
                                                $pajak = 0;
                                                $hitung_pajak = 0;
                                                $grand_total = 0;
                                                $count = mysqli_num_rows($query);
                                                $jml_item = $count;
                                                while ($data = mysqli_fetch_assoc($query)) 
                                                {
                                                    $id_detail = $data['id'];
                                                    $id_transaksi = $data['id_transaksi'];
                                                    $id_paket = $data['id_service'];
                                                    $nama_paket = $data['nama_service'];
                                                    $qty = $data['qty'];
                                                    $keterangan = $data['ket_pesan'];
                                                    $harga = $data['harga'];
                                                    $jumlah = $qty * $harga;
                                                    
                                                ?>
                                            <tr>
                                                <td><?= $no++?></td>
                                                <!-- <td><?= $id_transaksi ?></td> -->
                                                <td><?= $id_paket ?> [<?= $nama_paket ?>]</td>
                                                <td><?= $qty ?></td>
                                                <td><?= $jumlah ?></td>
                                                <td><?= $keterangan ?></td>
                                                <td>
                                                    <form method="POST">
                                                        <input type="hidden" name="id-detail"
                                                            value="<?= $id_detail; ?>">
                                                        <button class="btn btn-danger" type="submit"
                                                            name="hapus-item">Hapus</button>
                                                    </form>
                                                </td>
                                            </tr>
                                            <?php
                                                }
                                                ?>
                                        </tbody>
                                    </table>
                                    Jumlah item : <?= $count ?>
                                </div>
                                <hr>

                                <!-- kode php untuk menampilkan data layanan tambahan -->

                                <?php
                                            $query2 = mysqli_query($koneksi,"SELECT * FROM `tb_detail_transaksi` a LEFT JOIN `tb_service` b
                                            ON a.id_service = b.id_service where kategori='layanan' AND  id_transaksi='$generate_id'");
                                            $jml_layanan_tambahan = mysqli_num_rows($query2);
                                            while ($data = mysqli_fetch_assoc($query2)) 
                                            {
                                                $id_detail = $data['id'];
                                                $id_transaksi = $data['id_transaksi'];
                                                $id_paket = $data['id_service'];
                                                $nama_paket = $data['nama_service'];
                                                $qty = $data['qty'];
                                                $keterangan = $data['keterangan'];
                                                $ket_pesan = $data['ket_pesan'];
                                                $harga = $data['harga'];
                                                @$biaya_tambahan = ($jml_item*$harga);
                                                $total += ($jumlah);
                                                    if ($total>=100000 and $total <200000){
                                                        $diskon = 5;
                                                    }elseif ($total>=200000 and $total <300000){
                                                        $diskon = 7.5;
                                                    }elseif ($total>=300000){
                                                        $diskon = 10;
                                                    }else {$diskon = 0;}
                                                $hitung_diskon= $diskon/100*$total;

                                                @$grand_total= ($total+$biaya_tambahan)-$hitung_diskon;
                                            }
                                        ?>

                                <div class="col">
                                    <?php
                                if ($jml_layanan_tambahan == 0)
                                { 
                                    $cek_tombol = 'enabled';
                                    $visibility = 'hidden';
                                }
                                else
                                { 
                                    $cek_tombol = 'disabled';
                                    $visibility = '';}
                                ?>
                                    <button type="button" <?=$cek_tombol?> class="btn btn-outline-primary block"
                                        data-bs-toggle="modal" data-bs-target="#layanan_tambahan<?= $generate_id ?>">(+)
                                        Layanan Tambahan </button>
                                </div>
                                <table <?= $visibility ?> class="table table-responsive" border="2px">
                                    <thead class="bg-light-primary">
                                        <th>Nama Layanan</th>
                                        <th>Harga</th>
                                        <th>Keterangan</th>
                                        <th>Aksi</th>
                                    </thead>
                                    <tbody>
                                        <td><?= @$id_paket ?> [<?= @$nama_paket ?>]</td>
                                        <td><?= @$harga ?></td>
                                        <td style="width: 30%;"><?= @$keterangan ?></td>
                                        <td>
                                            <form method="POST">
                                                <input type="hidden" name="id-detail" value="<?= $id_detail; ?>">
                                                <button class="btn btn-danger" type="submit"
                                                    name="hapus-layanan">Hapus</button>
                                            </form>
                                        </td>
                                    </tbody>
                                </table>

                                <hr>

                                <div class="row justify-content-around">
                                    <div class="col-6 text-center">
                                        <h6>Kode Invoice :</h6>
                                        <input class="form-control alert alert-primary" name="kode-invoice"
                                            value="<?= $invoice ?>" style="text-align: center;">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 text-start">
                                        <?php
                                        $th_ini=date('Y');
                                        $bln_ini=date('m');
                                        $cek=mysqli_query($koneksi, "SELECT * FROM tb_transaksi where Year(tgl)=$th_ini AND Month(tgl)=$bln_ini");
                                        $jml_baris = mysqli_num_rows($cek);
                                        // echo $jml_baris;
                                        $kode = $jml_baris+1;
                                        ?>

                                        <!-- <Strong>< ?=date('ym').'-0000'.$kode ?></Strong> -->
                                        <h6>ID Transaksi :</h6>
                                        <input class="form-control bg-light-primary" name="id-transaksi"
                                            value="<?= $generate_id ?>" readonly>
                                        <br>
                                        <h6>Tanggal : </h6>
                                        <input type="text" class="form-control bg-light-primary" name="tanggal"
                                            value="<?= $tgl ?>" readonly>
                                        <br>

                                        <h6>Pilih Pelanggan :</h6>
                                        <!-- <input class="form-control" name="id-member"> -->
                                        <select class="choices form-select" id="select_member" name="id_member">
                                            <!-- Query ambil data member dari database-->
                                            <?php 
                                                $sql=mysqli_query($koneksi, "SELECT * FROM tb_member ORDER BY nama ASC");
                                                while ($data=mysqli_fetch_array($sql)) {
                                            ?>
                                            <option value="<?=$data['id']?>">
                                                <?=$data['nama'] ?>
                                            </option>
                                            <!-- Akhir Perulangan pengambilan data -->
                                            <?php
                                                 }
                                            ?>
                                        </select>
                                    </div>



                                    <!--  Modal layanan Tambahan-->
                                    <div class="modal fade text-left" id="layanan_tambahan<?= $generate_id ?>"
                                        tabindex="-1" aria-labelledby="myModalLabel1" style="display: none;"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel1">Layanan Tambahan Laundry
                                                    </h5>
                                                    <button type="clear" class="close rounded-pill"
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
                                                <div class="form-group">
                                                    <div class="card-body">
                                                        <h6>ID Transaksi :</h6>
                                                        <input class="form-control" name="id-transaksi"
                                                            value="<?= $generate_id; ?>" disabled readonly>
                                                        <br>
                                                        <h6>Jenis Layanan : </h6>
                                                        <select class="form-control" onchange="cek_database()"
                                                            id="id_service" type="text" name="id-service" required>
                                                            <option disabled selected> Pilih Paket </option>
                                                            <?php 
                                                            $sql=mysqli_query($koneksi, "SELECT * FROM tb_service where kategori='layanan'");
                                                            while ($data=mysqli_fetch_array($sql)) {
                                                            ?>
                                                            <option value="<?=$data['id_service']?>">
                                                                <?=$data['id_service']. " - " .$data['nama_service']?>
                                                            </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select><br>

                                                        <h6>Biaya Layanan :</h6>
                                                        <input type="number" id="harga" class="form-control" required
                                                            readonly disabled>

                                                        <input type="number" hidden class="form-control" name="qty"
                                                            value="1" required>
                                                        <br>
                                                        <h6>Keterangan Layanan : </h6>
                                                        <textarea id="keterangan" readonly disabled name="keterangan"
                                                            class="form-control" rows="2"></textarea>
                                                    </div>
                                                </div>
                                                <div class="card-footer text-center">
                                                    <button class="btn btn-primary" type="submit"
                                                        name="tambah-detail">Tambah</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Penutup Modal -->

                                    <!--  Modal Tambah Item Laundry-->
                                    <div class="modal fade text-left" id="tambah_trx<?= $generate_id ?>" tabindex="-1"
                                        aria-labelledby="myModalLabel1" style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-scrollable" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="myModalLabel1">Tambah Paket</h5>
                                                    <button type="clear" class="close rounded-pill"
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
                                                <div class="form-group">
                                                    <div class="card-body">
                                                        <h6>ID Transaksi :</h6>
                                                        <input class="form-control" name="id-transaksi"
                                                            value="<?= $generate_id; ?>" disabled readonly>
                                                        <br>
                                                        <h6>Kode Paket : </h6>
                                                        <select class="form-control" onchange="cek_paket()"
                                                            id="id-paket" type="text" name="id-service" required>
                                                            <option disabled selected> Pilih Paket </option>
                                                            <?php 
                                                            $sql=mysqli_query($koneksi, "SELECT * FROM tb_service where kategori='paket'");
                                                            while ($data=mysqli_fetch_array($sql)) {
                                                            ?>
                                                            <option value="<?=$data['id_service']?>">
                                                                <?=$data['id_service']. " - " .$data['nama_service']?>
                                                            </option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select><br>

                                                        <h6>Harga :</h6>
                                                        <input type="number" id="harga-paket" class="form-control"
                                                            required readonly disabled>
                                                        <br>

                                                        <h6>Qty :</h6>
                                                        <input type="number" class="form-control" name="qty" value="1"
                                                            required>
                                                        <br>
                                                        <h6>Keterangan tambahan : </h6>
                                                        <textarea id="ket_paket" name="keterangan" class="form-control"
                                                            rows="2"></textarea>

                                                    </div>
                                                </div>
                                                <div class="card-footer text-center">
                                                    <button class="btn btn-primary" type="submit"
                                                        name="tambah-detail">Tambah</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <!-- Penutup Modal -->

                                    <div class="col-6 text-start">
                                        <br>
                                        <table class="table table-responsive" border="1px" style="width: 100%;">
                                            <tr>
                                                <th>Jumlah
                                                    <input type="hidden" name="jumlah">
                                                </th>
                                                <th><?php echo " : Rp.".$total.",-" ?></th>
                                            </tr>
                                            <tr>
                                                <th>Diskon
                                                    <input type="hidden" name="diskon" value="<?=$hitung_diskon ?>">
                                                </th>
                                                <th><?php echo " : (-) ".$diskon."%  (Rp.".$hitung_diskon.",-)" ?>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Layanan Tambahan

                                                </th>
                                                <th> <input type="hidden" id="harga" class="form-control-sm"
                                                        name="biaya-tambahan" value="<?= @$biaya_tambahan ?>" readonly>
                                                    <?php echo " : (+) Rp.".@$biaya_tambahan.",-" ?>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th>Total
                                                    <input type="hidden" name="total-bayar">
                                                </th>
                                                <th><?php echo " : Rp.".$grand_total.",-" ?></th>
                                            </tr>
                                        </table>
                                        <input type="hidden" name="id-user" value="<?= $s_id_user ?>">

                                        <hr>
                                        <div class="row">
                                            <div class="col-3 mt-2">
                                                <h6>Dibayar : </h6>
                                            </div>
                                            <div class="col-9 mt-0">
                                                <select class="form-select" name="pembayaran">
                                                    <option value="lunas">Lunas</option>
                                                    <option value="belum dibayar">Belum Dibayar</option>
                                                </select>
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <div class="col-3 mt-2">
                                                <h6>Kasir : </h6>
                                            </div>
                                            <div class="col-9 mt-0">
                                                <input class="form-control bg-light-primary" type="text" value="<?= $s_username. " [" .$s_id_user. "] " ?>" readonly disabled>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                            <div class="card-footer text-center">
                                <button class="btn btn-primary" type="submit" name="add-transaksi">Simpan</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Pemanggilan javascript -->


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script type="text/javascript">
        function cek_database() {
            var id_service = $("#id_service").val();
            $.ajax({
                url: 'ajax/layanan.php',
                data: "id_service=" + id_service,
            }).success(function (data) {
                var json = data,
                    obj = JSON.parse(json);
                $('#nama_service').val(obj.nama_service);
                $('#harga').val(obj.harga);
                $('#keterangan').val(obj.keterangan);

            });
        }

        function cek_paket() {
            var id_service = $("#id-paket").val();
            $.ajax({
                url: 'ajax/paket.php',
                data: "id_service=" + id_service,
            }).success(function (data) {
                var json = data,
                    obj = JSON.parse(json);
                $('#nama_service').val(obj.nama_service);
                $('#harga-paket').val(obj.harga);
                $('#keterangan').val(obj.keterangan);

            });
        }
    </script>
    <?php
    include '../config_js.php';
    ?>

    <script src="../../assets/extensions/simple-datatables/umd/simple-datatables.js"></script>
    <script src="../../assets/js/pages/simple-datatables.js"></script>

    <script src="../../assets/extensions/sweetalert2/sweetalert2.min.js"></script>>
    <script src="../../assets/js/pages/sweetalert2.js"></script>>
</body>

</html>