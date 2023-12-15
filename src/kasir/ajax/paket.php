<?php
include "../../koneksi.php";

if (@$_GET['id_service'] !== ""){
@$service = mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_service where id_service='$_GET[id_service]'"));
$data_service = array('nama_service'   =>  @$service['nama_service'],
                    'harga'             =>  @$service['harga'],
                    'keterangan'        =>  @$service['keterangan']);
 echo json_encode($data_service);
}


// $member = mysqli_fetch_array(mysqli_query($koneksi, "select * from tb_member where id='$_GET[id_member]'"));
// $data_member = array('nama'         =>  $member['nama'],
//                     'alamat'        =>  $member['alamat'],
//                     'jenis_kelamin' =>  $member['jenis_kelamin'],
//                     'tlp'           =>  $member['tlp']);
//  echo json_encode($data_member);