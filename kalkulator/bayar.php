<?php
include("../koneksi.php");

session_start();

$i = 0;
$gagal = 0;
$grand = 0;
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
        echo "Barang $nama_barang stoknya hanya tersisa $stok . pembayaran dibatalkan";
        $gagal = 1;
        break;
    }
    $i++;
}
$i = 0;
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
    $grand += $isi['harga'] * $jumlah;
    $stok -= $jumlah;
    $koneksi->query("UPDATE barang SET stok = '$stok' WHERE pemilik = '$owner' AND nama = '$nama_barang'");
    $i++;
}

if ($gagal != 1) {
    $tanggal_sekarang = date("Y-m-d");
    $ambil = $koneksi->query("SELECT * FROM penjualan where pemilik = '$owner' and tanggal = '$tanggal_sekarang'");
    $ada = $ambil->num_rows;
    if ($ada == 1) {
        $isi = $ambil->fetch_assoc();
        $current_nominal = $isi['nominal'];
        $update = $current_nominal + $grand;
        $koneksi->query("UPDATE penjualan SET nominal = '$update' where pemilik = '$owner' and tanggal = '$tanggal_sekarang'");
    } else {
        $koneksi->query("INSERT INTO penjualan SET tanggal = '$tanggal_sekarang',nominal = '$grand' ,pemilik = '$owner'");
    }
    echo "Success";
}
unset($_SESSION['cart']);
