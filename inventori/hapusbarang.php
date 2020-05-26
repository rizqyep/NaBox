<?php
include("../koneksi.php");
$ambil = $koneksi->query("SELECT * FROM barang WHERE id = '$_GET[id]'");
$isi = $ambil->fetch_assoc();
$koneksi->query("DELETE FROM barang WHERE id= '$_GET[id]'");

echo "<script>alert('Barang Berhasil Dihapus!');</script>";
echo "<meta http-equiv='refresh' content='1;url=barang.php?kategori=$kategori'>";
