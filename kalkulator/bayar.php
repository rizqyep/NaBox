<?php
include("../koneksi.php");

session_start();

$i = 0;
$gagal = 0;
$owner = $_SESSION['user']['nama_toko'];
while ($i < count($_SESSION['cart'])) {
    $nama_barang = json_encode($_SESSION['cart'][$i]['nama_barang']);
    $nama_barang = ltrim($nama_barang, '"');
    $nama_barang = rtrim($nama_barang, '"');
    $jumlah = json_encode($_SESSION['cart'][$i]['jumlah']);
    $jumlah = ltrim($jumlah, '"');
    $jumlah = rtrim($jumlah, '"');
    $ambil = $koneksi->query("SELECT * FROM barang WHERE pemilik = '$owner' AND nama = '$nama_barang' ");
    $isi = $ambil->fetch_assoc();
    $stok = $isi['stok'];

    if ($stok - $jumlah < 0) {
        echo "Barang $nama_barang stoknya hanya tersisa $stok";
        $gagal = 1;
        break;
    } else {
        $stok -= $jumlah;
        $koneksi->query("UPDATE barang SET stok = '$stok' WHERE pemilik = '$owner' AND nama = '$nama_barang'");
        $i++;
    }
}

if ($gagal != 1) {
    echo "Success";
}
unset($_SESSION['cart']);
