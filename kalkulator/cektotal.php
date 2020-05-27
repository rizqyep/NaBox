<?php
session_start();


$i = 0;
$grand = 0;
$count = count($_SESSION['cart']);
while ($i < $count) {
    $total = json_encode($_SESSION['cart'][$i]['total']);
    $grand += $total;
    $i++;
}
echo $grand;
