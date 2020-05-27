<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Anda Harus Login terlebih dahulu!');</script>";
    echo "<script>location='login.php';</script>";
}
$_SESSION['cart'] = array();
include("../koneksi.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="css/main.css">

    <title>NaBox - Kalkulator Pintar</title>
    <script src="https://code.jquery.com/jquery-3.5.0.js" integrity="sha256-r/AaFHrszJtwpe+tHyNi/XCfMxYpbsRg2Uqn0x3s2zc=" crossorigin="anonymous"></script>

</head>

<body>
    <?php include("navbar.php"); ?>
    <div class="container">
        <center>
            <h1>Kalkulator Pintar</h1>
            <form action="post">
                <div class="form-group">
                    <select class="form-control" name="pilihan" id="pilihan">
                        <?php
                        $owner = $_SESSION['user']['nama_toko'];
                        $ambil = $koneksi->query("SELECT * FROM barang WHERE pemilik = '$owner'");
                        while ($isi = $ambil->fetch_assoc()) { ?>
                            <option value="<?php echo $isi['nama']; ?>"><?php echo $isi['nama']; ?> - Stok <?php echo $isi['stok']; ?> </option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <input class="form-control" type="text" name="jumlah" id="jumlah" placeholder="Jumlah">
                </div>
                <button class="ui button blue" type="submit" id="masuk" name="masuk">Tambahkan</button>
            </form>

            <h1>List Barang</h1>
            <table class="table bordered">
                <thead>
                    <th scope="col">Nama Barang</th>
                    <th scope="col">Harga Satuan</th>
                    <th scope="col">Jumlah</th>
                    <th scope="col">Harga</th>
                </thead>
                <tbody id="showbarang">

                </tbody>
            </table>

            <div class="totalbox">
                <button class="ui big left floated  green button" id="cektotal" type="submit">Cek Total</button>
                <div class="ui  right floated button">
                    <h2>Total : <span id="showtotal"></span></h2>
                </div>
            </div>
            <div class="bayar" style="margin-top : 15vh">
                <button class="ui big yellow button" id="bayar" type="submit">Bayar</button>
            </div>
        </center>
    </div>
    <script>
        $(document).ready(function() {
            $('#masuk').click(function(event) {
                event.preventDefault();
                var pilihan = $('#pilihan').children("option:selected").val();
                var jumlah = $('#jumlah').val();

                $.ajax({
                    url: './cekbarang.php',
                    method: 'GET',
                    data: {
                        pilihan: pilihan,
                        jumlah: jumlah,
                    },
                    success: function(response) {
                        getData(response);
                    }
                });
            });
        });

        function getData(r) {
            globalResponse = r;
            document.getElementById("showbarang").innerHTML += r;
        }

        $(document).ready(function() {
            $('#cektotal').click(function(event) {
                event.preventDefault();
                $.ajax({
                    url: './cektotal.php',
                    method: 'GET',
                    success: function(response) {
                        getTotal(response);
                    }
                });
            });
        });

        function getTotal(r) {
            globalResponse = r;
            document.getElementById("showtotal").innerHTML = r;
        }


        $(document).ready(function() {
            $('#bayar').click(function(event) {
                $.ajax({
                    url: './bayar.php',
                    method: 'GET',
                    success: function(response) {
                        if (response == "Success") {
                            alert("Semua item Berhasil Dibayar!");
                            location.reload();
                        } else {
                            alert(response);
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>

</body>

</html>