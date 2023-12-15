<?php

if(isset($_POST['update-pelanggan'])){
    $idc   = $_POST['id-cust'];
    $nama = $_POST['nama-cust'];
    $alamat = $_POST['alamat-cust'];
    $jenkel = $_POST['jenkel-cust'];
    $tlp = $_POST['tlp-cust'];

    $update = mysqli_query($koneksi, "UPDATE tb_member SET nama='$nama', alamat='$alamat', jenis_kelamin='$jenkel', tlp='$tlp' where id=$idc");

    if($update){
        echo 'Berhasil';
        header("location:customers.php?update=berhasil");
    } else {
    // print_r($_POST);
        echo 'Gagal';
        header("location:customers.php?update=gagal");
    };
  

}

if(isset($_POST['add-pelanggan'])){

        $nama = $_POST['nama-cust'];
        $alamat = $_POST['alamat-cust'];
        $jenkel = $_POST['jenkel-cust'];
        $tlp = $_POST['tlp-cust'];
    
        $input = mysqli_query($koneksi,"insert into tb_member 
                                        values ('','$nama','$alamat','$jenkel','$tlp')");
    
        if($input){
            echo 'Berhasil';
            header("location:customers.php?add=berhasil");
        } else {
            echo 'Gagal';
            header("location:customers.php?add=gagal");
        };
      
   
}

if(isset($_POST['delete-pelanggan'])){
    $idc = $_POST['id-cust'];

    $hapus = mysqli_query($koneksi,"delete from tb_member where id='$idc'");

    if($hapus){
        echo 'Berhasil';
        header("location:customers.php?hapus=berhasil");
    } else {
        echo 'Gagal';
        header("location:customers.php?hapus=gagal");
    };
  

}