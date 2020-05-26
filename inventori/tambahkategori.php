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
    <title>Na Box - Inventori</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="css/form.css">
</head>

<body>
    <?php include("navbar.php"); ?>

    <center>
        <form class="form-container" method="post" style="margin-top : 15vh;" enctype="multipart/form-data">
            <div class="form-group">
                <div id="form-title">
                    <h1 class="form-title" style="color :#263238">Tambah Kategori Barang</h1>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nama Kategori" name="nama" required>
                </div>
                <div class="form-group">
                    <label>Upload Foto</label>
                    <input type="file" class="form-control" name="foto"></input>
                </div>

                <button type="submit" class="btn" name="tambah">Tambahkan</button>
                <br>
                <br>
        </form>
    </center>
    <?php include("../script.php");
    if (isset($_POST['tambah'])) {
        $nama_kategori = $_POST['nama'];
        $namafoto = $_FILES['foto']['name'];
        $lokasifoto = $_FILES['foto']['tmp_name'];
        move_uploaded_file($lokasifoto, "../fotobarang/" . $namafoto);
        $nama = $_SESSION['user']['nama_toko'];
        $koneksi->query("INSERT INTO kategori SET nama_kategori = '$nama_kategori',foto_kategori ='$namafoto',pemilik='$nama'");
        echo "<meta http-equiv='refresh' content='1;url=index.php'>";
    }

    ?>
</body>

</html>