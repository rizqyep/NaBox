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
    <title>Na Box -Tambah Kontak</title>
</head>

<body>
    <?php
    include("navbar.php");
    ?>
    <center>
        <form class="form-container" method="post" style="margin-top : 15vh;">
            <div class="form-group">
                <div id="form-title">
                    <i class="massive user icon" style="color :#263238"></i>
                    <h1 class="form-title" style="color :#263238">Tambahkan Kontak</h1>
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Nama Pemasok" name="nama" required>
                </div>
                <div class="ui labeled input" style="width : 300px;height : 50px;border : solid 1px #263238">
                    <div class="ui label" style="padding:15px;">
                        +62
                    </div>
                    <input id="number" style="background : transparent;color : #263238" type="text" placeholder="Nomor Pemasok" name="nomor">
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
        $nama_pemasok = $_POST['nama'];
        $nomor = "+62" . $_POST['nomor'];
        $kategori = $_POST['kategori'];
        $kontak = $_SESSION['user']['nama_toko'];
        $koneksi->query("INSERT INTO pemasok SET nama = '$nama_pemasok',kontak = '$kontak',kategori ='$kategori',nomor='$nomor'");
        echo "<script>alert('Kontak berhasil ditambahkan');</script>";
        echo "<meta http-equiv='refresh' content='1;url=index.php'>";
    }
    ?>
</body>

</html>