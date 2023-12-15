<?php
include '../../koneksi.php';

if (@$_GET['id_service'] !== ""){
    @$service = mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_service where id_service='$_GET[id_service]'"));
    $data_service = array('nama_service'   =>  @$service['nama_service'],
                        'harga'             =>  @$service['harga'],
                        'keterangan'        =>  @$service['keterangan']);
     echo json_encode($data_service);
    }
    