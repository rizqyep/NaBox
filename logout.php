<?php
include("koneksi.php");
session_start();
$nama = $_SESSION['user']['nama'];
$koneksi->query("UPDATE user SET logged_in = 0 WHERE nama = '$nama'");
session_destroy();
echo "<meta http-equiv='refresh' content='1;url=login.php'>";
