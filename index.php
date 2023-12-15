<?php

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beauty Fresh Laundry</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <?php
    include 'nav.php';
    ?>

    <div class="container-sm">
        <h3 class="text-center">Home Page</h3>
        <hr>
        <h4 class="text-center">Berisi informasi jasa Laundry</h4>
        <hr>


        <div class="row">
            <?php
        include "src/koneksi.php";

              $query = mysqli_query($koneksi, "SELECT * FROM tb_service where kategori = 'paket' ");
              $no=1;
              foreach ($query as $key => $value) {
                  
        ?>
            <!-- # code...     -->
            <div class="col-sm-3">
                <div class="card card-column text-center">
                    <div class="card-header">
                    <h5 class="text-primary">Nama Paket : <?= $value['nama_service'];  ?></h5>
                    </div>

                    <div class="card-body">
                        <img src="pictures/logo2.png" alt="ini logo" width="80%">
                        <hr>                        
                        
                        <h5 class=" text-start">Harga : <?= $value['harga'];  ?></h5>
                        <p class="text-start">
                            <strong>Keterangan : </strong>
                            <br><?= $value['keterangan'];  ?>
                        </p>
                        <hr>
                        <a class="btn btn-primary" href="detail_paket.php?id=<?=$value['id_service'] ?>">Detail</a>
                    </div>



                </div>
                <br>
            </div>

            <?php
	}       
    // endforeach
    ?>
        </div>


    </div>
</body>

</html>