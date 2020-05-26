<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Anda Harus Login terlebih dahulu!');</script>";
    echo "<script>location='login.php';</script>";
}
include("../koneksi.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Na Box - List Kontak</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="css/main.css">

</head>

<body>
    <?php
    include("navbar.php");

    ?>


    <div class="container">
        <br>
        <center>
            <h1>List Kontak Pemasok Anda</h1>
        </center>
        <br>
        <br>
        <a style='border-radius: 0px' href="tambahpemasok.php" class="ui right floated blue button">

            <i class="icon user"></i>
            Tambah Pemasok
        </a>
        <div style="height : 80px"></div>
        <?php
        $nama = $_SESSION['user']['nama_toko'];
        $ambil = $koneksi->query("SELECT * FROM pemasok WHERE kontak = '$nama' ");
        $cek = $ambil->num_rows;


        if ($cek == 0) {
            echo "<center>
            <h1 style ='margin-top:30vh'>Anda Belum Memiliki Kontak Pemasok</h1>
            </center>";
        } else {
        ?>
            <table class="table bordered text-center">
                <thead>
                    <th scope="col">Info Kontak</th>
                    <th scoe="col">Aksi</th>
                </thead>
                <tbody>
                    <?php while ($isi = $ambil->fetch_assoc()) {
                    ?>

                        <tr>
                            <td>
                                <h2><b><?php echo $isi['nama'];
                                        echo "<br>"; ?></b></h2>
                                <?php
                                echo "Pemasok " . $isi['kategori']; ?>
                            </td>
                            <td>

                                <a href="tel:<?php echo $isi['nomor']; ?>"> <i class="big phone icon"></i></a>
                                <a href="sms:<?php echo $isi['nomor']; ?>"> <i class="big comment alternate outline icon"></i></a>
                                <a href="https://wa.me/<?php echo $isi['nomor']; ?>" target="blank"><i class="whatsapp big icon"></i></a>
                            </td>
                        </tr>
                <?php

                    }
                } ?>
                </tbody>
            </table>


    </div>


    <?php
    include("../script.php");
    ?>
</body>

</html>