<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Anda Harus Login terlebih dahulu!');</script>";
    echo "<script>location='login.php';</script>";
}
include("koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Na-Box</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="css/main.css">

</head>

<body>
    <?php include("navbar.php") ?>


    <h1 class="welcome">Selamat datang saudara <?php echo $_SESSION['user']['nama']; ?></h1>

    <div class="container" style="margin-top : 10vh;">
        <div class="ui very relaxed stackable two column grid">
            <div class="ui column">
                <center>
                    <div class="category-box">
                        <center>
                            <a href="inventori">

                                <i class="massive box icon"></i>
                            </a>
                            <br>
                            <br>
                            <a href="inventori">
                                <h3>Inventori</h3>
                            </a>

                        </center>
                    </div>
                </center>
            </div>
            <hr class="ruler-sm d-lg-none">
            <div class="ui column">
                <center>
                    <div class="category-box">
                        <center>
                            <a href="kalkulator">
                                <i class="massive calculator icon"></i>
                            </a>
                            <br>
                            <br>
                            <a href="kalkulator">
                                <h3>Kalkulator Pintar</h3>
                            </a> <br>
                            <br>


                        </center>
                    </div>
                </center>
            </div>
            <hr class="ruler-sm d-lg-none">
        </div>
    </div>
    <hr class="ruler-lg d-none d-lg-block">
    <div class="container">
        <div class="ui very relaxed stackable two column grid">
            <div class="ui column">
                <center>
                    <div class="category-box">
                        <center>
                            <a href="pemasok">

                                <i class="massive user icon"></i>
                            </a>
                            <br>
                            <br>
                            <a href="pemasok">
                                <h3>Kontak Pemasok</h3>
                            </a>

                        </center>
                    </div>
                </center>
            </div>
            <hr class="ruler-sm d-lg-none">
            <div class="ui column">
                <center>
                    <div class="category-box">
                        <center>
                            <a href="statistik">
                                <i class="massive chart area icon"></i>
                            </a>
                            <br>
                            <br>
                            <a href="statistik">
                                <h3>Statistik Penjualan</h3>
                            </a> <br>
                            <br>


                        </center>
                    </div>
                </center>
            </div>
            <hr class="ruler-sm d-lg-none">
        </div>
    </div>


    <?php include("script.php") ?>
</body>

</html>