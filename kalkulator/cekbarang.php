<?php
session_start();
include("../koneksi.php");
$barang = $_GET['pilihan'];
$jumlah = $_GET['jumlah'];
$user = $_SESSION['user']['nama_toko'];
$ambil = $koneksi->query("SELECT * FROM barang WHERE pemilik = '$user' AND nama = '$barang'");

$isi = $ambil->fetch_assoc();

$harga = $isi['harga'];
$total = (int) $jumlah * $harga;





array_push($_SESSION['cart'], array('nama_barang' => $barang, 'jumlah' => $jumlah, 'total' => $total));



echo "
<tr>
    <td id = 'barang'>$barang</td>
    <td id = 'jumlah'>$harga</td>
    <td id = 'jumlah'>$jumlah</td>
    <td id = 'total'>$total</td>
</tr>
";
