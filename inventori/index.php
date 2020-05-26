<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>
    alert('Anda Harus Login terlebih dahulu!');
</script>";
    echo "<script>
    location = 'login.php';
</script>";
}
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Na Box - Inventori</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="css/main.css">
</head>

<body>
    <?php include("navbar.php"); ?>
    <div class="container">
        <br>
        <center>
            <h1>Kategori Barang Anda</h1>
        </center>
        <br>
        <br>
        <a style='border-radius: 0px' href="tambahkategori.php" class="ui right floated blue button">
            <i class="plus icon"></i>
            Tambah Kategori
        </a>


        <div class="ui very relaxed stackable two column grid" style="margin-top : 10%;">
            <?php
            $nama = $_SESSION['user']['nama_toko'];
            $ambil = $koneksi->query("SELECT * FROM kategori WHERE pemilik = '$nama'");
            while ($isi = $ambil->fetch_assoc()) {
            ?>
                <div class="ui column">
                    <center>
                        <div class="category-box">
                            <div class="foto-holder">
                                <img class="foto-barang" src="../fotobarang/<?php echo $isi['foto_kategori']; ?>" alt="">
                            </div>
                            <br>
                            <a href="barang.php?kategori=<?php echo $isi['nama_kategori']; ?>">
                                <h3><?php echo $isi['nama_kategori']; ?></h3>
                            </a>

                        </div>
                    </center>
                </div>
                <hr class="ruler-sm d-lg-none">
            <?php } ?>

        </div>
    </div>

    <?php include("../script.php"); ?>
</body>

</html>