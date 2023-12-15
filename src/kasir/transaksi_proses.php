<?php
if(isset($_POST['tambah-detail'])){
    $id_transaksi = $_POST['id-transaksi'];
    $id_paket = $_POST['id-service'];
    $qty = $_POST['qty'];
    $keterangan = $_POST['keterangan'];

    // print_r($_POST);
    $input = mysqli_query($koneksi,"insert into tb_detail_transaksi 
                                    values ('','$id_transaksi','$id_paket','$qty','$keterangan')");

    if($input){
        echo 'Berhasil';
        header("location:transaksi.php?add-item=berhasil");
    } else {
        echo 'Gagal';
        header("location:transaksi.php?add-item=gagal");
    };
  
}

if(isset($_POST['hapus-layanan'])){
    $id_dtl_trx = $_POST['id-detail'];

    $hapus = mysqli_query($koneksi,"delete from tb_detail_transaksi where id=$id_dtl_trx");

    if($hapus){
        echo 'Berhasil';
        header("location:transaksi.php?hapus-layanan=berhasil");
    } else {
        echo 'Gagal';
        header("location:transaksi.php?hapus-layanan=gagal");
    };
}

if(isset($_POST['hapus-item'])){
    $id_dtl_trx = $_POST['id-detail'];

    $hapus = mysqli_query($koneksi,"delete from tb_detail_transaksi where id=$id_dtl_trx");

    if($hapus){
        echo 'Berhasil';
        header("location:transaksi.php?hapus-item=berhasil");
    } else {
        echo 'Gagal';
        header("location:transaksi.php?hapus-item=gagal");
    };
}

if(isset($_POST['add-transaksi'])){

    $id_trx = $_POST['id-transaksi'];
    $kd_invoice = $_POST['kode-invoice'];
    $id_member = $_POST['id_member'];
    $tanggal = date('Y-m-d H:i:s');
    
    //$jumlah = $_POST['jumlah'];
    $biaya_tambahan = $_POST['biaya-tambahan'];
    $diskon = $_POST['diskon'];
    // $pajak = $_POST['pajak'];
    $total = $_POST['total-bayar'];
    $status = "baru";
    $pembayaran = $_POST['pembayaran'];
    if ($pembayaran == "lunas"){
        $tgl_bayar = date("Ymd");
    }else{
        $tgl_bayar = "";
    }
    $id_user = $s_id_user;

    
    $input = mysqli_query($koneksi,"INSERT INTO tb_transaksi VALUES ($id_trx,'$kd_invoice',$id_member,'$tanggal','$tgl_bayar',$biaya_tambahan,$diskon,'$status','$pembayaran',$id_user)");
    
    if($input){
        echo 'Berhasil';
        header("location:report/nota.php?id_trx=$id_trx");
    } else {
        // print_r($_POST);
        echo 'Gagal';
        header("location:transaksi.php?add=gagal");
    };
}
?>