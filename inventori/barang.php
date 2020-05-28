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
    <title>Na Box - List Barang</title>
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
            <h1>List Barang Dengan Kategori <?php echo $_GET['kategori']; ?></h1>
        </center>
        <br>
        <br>
        <a style='border-radius: 0px' href="tambahbarang.php" class="ui right floated green button">

            <i class="plus icon"></i>
            Tambah Barang
        </a>
        <div style="height : 80px"></div>
        <?php
        $nama = $_SESSION['user']['nama_toko'];
        $ambil = $koneksi->query("SELECT * FROM barang WHERE pemilik = '$nama' AND kategori = '$_GET[kategori]' ");
        $cek = $ambil->num_rows;


        if ($cek == 0) {
            echo "<center>
            <h1 style ='margin-top:15vh'>Anda Belum Memiliki Barang di Kategori ini!</h1>
            <a style='border-radius: 0px'class ='ui green button' href ='tambahbarang.php'>Tambah Barang</a>
            </center>";
        } else { ?>


            <table class="table bordered text-center">
                <thead>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Stok</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Aksi</th>
                </thead>
                <tbody>
                    <?php while ($isi = $ambil->fetch_assoc()) {
                    ?>
                        <tr>
                            <td>
                                <div style="height : 30px" class="d-lg-none"></div>
                                <?php echo $isi['nama']; ?>
                            </td>
                            <td>
                                <div style="height : 30px" class="d-lg-none"></div>
                                <?php echo $isi['stok']; ?>
                            </td>
                            <td>
                                <div style="height : 30px" class="d-lg-none"></div>
                                <?php echo $isi['harga']; ?>
                            </td>
                            <td>
                                <a style="border-radius: 0px;" class=" ui small yellow button" href="ubahbarang.php?id=<?php echo $isi['id']; ?>">Ubah</a>
                                <div style="height : 20px" class="d-lg-none"></div>
                                <a style="border-radius: 0px;" class="ui small red button" href="hapusbarang.php?id=<?php echo $isi['id']; ?>">Hapus</a>

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