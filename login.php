<?php
include("koneksi.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NaBox - Login</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Tomorrow:wght@800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="css/login.css">

</head>

<body>

    <?php include("navbar.php") ?>
    <div class="">
        <center>
            <form class="form-container" method="post" style="margin-top : 15vh;">
                <div class="form-group">
                    <div id="form-title">
                        <h1 class="form-title">NA BOX <span id="form-capt">Inventory</span></h1>
                        <p>your inventory partner</p>
                    </div>
                    <div class="form-group">
                        <input type="email" class="form-control" placeholder="E-mail" name="email" required>
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Password" name="password" required>
                    </div>
                    <button type="submit" class="btn" name="login">Login</button>
                    <br>
                    <br>
                    <p class="info-belum">Belum mendaftar ? <a class="regist-direct" href="register.php"><u>Daftar disini</u></a></p>
            </form>
        </center>
    </div>





    <div style="width : 75vw;margin-top : 50px;margin-left : 12vw; text-align : center;">
        <?php
        if (isset($_POST['login'])) {
            $email = strtolower(stripslashes($_POST['email']));
            $password = $_POST['password'];
            $ambil = $koneksi->query("SELECT * FROM user WHERE email = '$email'");
            $fetch = $ambil->fetch_assoc();
            if (mysqli_num_rows($ambil) == 1) {
                if (password_verify($password, $fetch['password'])) {
                    if ($fetch['logged_in'] != 1) {
                        $_SESSION['user'] = $fetch;
                        $koneksi->query("UPDATE user SET logged_in = 1 where email = '$email'");
                        echo "<div class = 'alert alert-info'>Anda berhasil Login!</div>";
                        echo "<meta http-equiv='refresh' content='1;url=index.php'>";
                    } else {
                        echo "<div class = 'alert alert-danger'>Anda sedang login di device lain</div>";
                        echo "<meta http-equiv='refresh' content='1;url=login.php'>";
                    }
                } else {
                    echo "<div class = 'alert alert-warning'>Data tidak cocok,silahkan ulangi atau lakukan registrasi  <a href ='register.php' class = 'alert-link'>disini</a></div>";
                }
            } else {
                echo "<div class = 'alert alert-warning'>Data tidak cocok,silahkan ulangi atau lakukan registrasi  <a href ='register.php' class = 'alert-link'>disini</a></div>";
            }
        }


        ?>
    </div>
    <?php include("script.php") ?>
</body>

</html>