<?php
include("koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NaBox - Registrasi</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="shortcut icon" type="image/x-icon" href="img/logo.png" />
    <link rel="stylesheet" href="css/registrasi.css">

</head>

<body>
    <?php include("navbar.php") ?>
    <div class="">
        <center>
            <form id="form-container" method="post" style="margin-top : 7vh; margin-bottom : 5%;">
                <div class="form-group">
                    <div id="form-title">
                        <h1 class="form-title">Registrasi</h1>
                        <p>Silahkan isi data anda!</p>
                        <p style="font-size : 12px;">*Username yang diisikan berupa huruf dan angka<br>(tidak memuat simbol)</p>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nama" name="nama" required>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Nama Toko" name="namatoko" required>

                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="E-mail" name="email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>

                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Konfirmasi Password" name="password2" required>
                    </div>
                    <button type="submit" class="btn" name="register">Registrasi</button>
                    <br><br>
                    <p class="info-sudah ">Sudah punya akun? <a href="login.php" class="login-direct"><u>Login disini</u></a></p>
            </form>
        </center>
    </div>

    <div style="margin-top : 10vh;width : 75vw;margin-left : 12vw; text-align : center;">
        <center>
            <?php
            if (isset($_POST['register'])) {
                $nama = $_POST['nama'];
                $namatoko = $_POST['namatoko'];
                $email = $_POST['email'];
                $password = mysqli_real_escape_string($koneksi, $_POST['password']);
                $conf_password = mysqli_real_escape_string($koneksi, $_POST['password2']);
                if ($password != $conf_password) {
                    echo "<script>alert('Password dan konfirmasi tidak sesuai');</script>";
                } else {
                    $password = password_hash($password, PASSWORD_DEFAULT);
                    $ambil = $koneksi->query("SELECT * FROM user where email = '$email'");
                    $cocok = $ambil->num_rows;
                    if ($cocok >= 1) {
                        echo "<script>alert('Email sudah digunakan');</script>";
                    } else {
                        $koneksi->query("INSERT INTO user SET nama_toko = '$namatoko',nama = '$nama',email = '$email',password = '$password'");
                        echo "<div class = 'alert alert-info'>Anda berhasil terdaftar!</div>";
                        echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                    }
                }
            }
            ?>

    </div>


    <?php include("script.php") ?>
</body>

</html>