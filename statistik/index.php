<?php
session_start();
if (!isset($_SESSION['user'])) {
    echo "<script>alert('Anda harus login dahulu!');</script>";
    echo "<script>location='login.php';</script>";
}
include("../koneksi.php");
$dataPoints = array();
$owner = $_SESSION['user']['nama_toko'];
$ambil = $koneksi->query("SELECT * FROM penjualan WHERE pemilik = '$owner' ORDER BY tanggal");
while ($isi = $ambil->fetch_assoc()) {
    $tanggal = $isi['tanggal'];
    $nominal = $isi['nominal'];
    array_push($dataPoints, array('label' => $tanggal, 'y' => $nominal));
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Na Box - Statistik</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.4.1/semantic.min.css">
    <link rel="stylesheet" href="css/main.css">



    <script>
        window.onload = function() {

            var chart = new CanvasJS.Chart("chartContainer", {
                animationEnabled: true,
                //theme: "light2",
                title: {
                    text: "Statistik Penjualan Bulan Mei"
                },
                axisX: {
                    crosshair: {
                        enabled: true,
                        snapToDataPoint: true
                    }
                },
                axisY: {
                    title: "Nominal",
                    crosshair: {
                        enabled: true,
                        snapToDataPoint: true
                    }
                },
                toolTip: {
                    enabled: false
                },
                data: [{
                    type: "area",
                    dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
                }]
            });
            chart.render();

        }
    </script>
</head>


<body>


    <?php include("navbar.php"); ?>
    <div class="container">
        <h1 id="judul">Menu Statistik Penjualan</h1>
        <div id="chartContainer" style="height: 50vh; width: 100%;"></div>
    </div>
    <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>

    <?php include("../script.php") ?>
</body>

</html>