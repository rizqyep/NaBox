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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="css/form.css">
    <title>Na Box - Tambah Barang</title>
</head>

<body>
    <?php
    include("navbar.php");
    $ambil = $koneksi->query("SELECT * FROM barang where id = '$_GET[id]'");
    $isi = $ambil->fetch_assoc();
    ?>
    <center>
        <form class="form-container" method="post" style="margin-top : 15vh;">
            <div class="form-group">
                <div id="form-title">
                    <h1 class="form-title" style="color :#263238">Edit Barang (<?php echo $isi['nama']; ?>)</h1>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nama Barang" name="nama" value="<?php echo $isi['nama']; ?>">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Jumlah Barang" name="jumlah" value="<?php echo $isi['stok']; ?>">
                </div>
                <div class="ui labeled input">
                    <div class="ui label">
                        Rp.
                    </div>
                    <input type="text" placeholder="Harga Barang" name="harga" value="<?php echo $isi['harga'] ?>">
                </div>
                <br>

                <button type="submit" class="btn" name="ubah">Ubah</button>
                <br>
                <br>
        </form>
    </center>
    <?php
    include("../script.php");

    if (isset($_POST['ubah'])) {
        $nama_barang = $_POST['nama'];
        $jumlah = $_POST['jumlah'];
        $harga = $_POST['harga'];
        $kategori = $isi['kategori'];

        $koneksi->query("UPDATE barang SET 
        nama = '$nama_barang',
        harga ='$harga',
        stok='$jumlah' 
        WHERE id = '$_GET[id]'");
        echo "<script>alert('Data barang berhasil diubah');</script>";
        echo "<meta http-equiv='refresh' content='1;url=barang.php?kategori=$kategori'>";
    }
    ?>
</body>

</html>