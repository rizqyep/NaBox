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
    ?>
    <center>
        <form class="form-container" method="post" style="margin-top : 15vh;">
            <div class="form-group">
                <div id="form-title">
                    <h1 class="form-title" style="color :#263238">Tambahkan Barang</h1>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nama Barang" name="nama" required>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Jumlah Barang" name="jumlah">
                </div>
                <div class="ui labeled input" style="width : 300px;height : 50px;border : solid 1px #263238">
                    <div class="ui label" style="padding:15px;">
                        Rp.
                    </div>
                    <input id="price" style="background : transparent;color : #263238" type="text" placeholder="Harga Barang" name="harga">
                </div>
                <div class="form-group">
                    <select name="kategori" class="form-control" placeholder="kategori">
                        <option>Piliih Kategori</option>
                        <?php
                        $nama = $_SESSION['user']['nama_toko'];
                        $ambil = $koneksi->query("SELECT * FROM kategori WHERE pemilik = '$nama'");
                        while ($isi = $ambil->fetch_assoc()) {
                        ?>
                            <option id="opt" value="<?php echo $isi['nama_kategori']; ?>"><?php echo $isi['nama_kategori']; ?></option>
                        <?php
                        }
                        ?>

                    </select>
                </div>
                <button type="submit" class="btn" name="tambah">Tambahkan</button>
                <br>
                <br>
        </form>
    </center>
    <?php
    include("../script.php");

    if (isset($_POST['tambah'])) {
        $nama_barang = $_POST['nama'];
        $jumlah = $_POST['jumlah'];
        $harga = $_POST['harga'];
        $kategori = $_POST['kategori'];
        $pemilik = $_SESSION['user']['nama_toko'];
        $koneksi->query("INSERT INTO barang SET nama = '$nama_barang',harga ='$harga',pemilik = '$pemilik',kategori ='$kategori',stok='$jumlah'");
        echo "<script>alert('Barang berhasil ditambahkan');</script>";
        echo "<meta http-equiv='refresh' content='1;url=barang.php?kategori=$kategori'>";
    }
    ?>
</body>

</html>