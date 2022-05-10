<?php
    session_start();
    
    $IDKH = isset($_SESSION['IDKH']) ? $_SESSION['IDKH'] : null;

    $connect = mysqli_connect("localhost","root","","quanlyshop");

    $gioHang = "delete from giohang where IDKH = '".$IDKH."'";

    mysqli_query($connect,$gioHang);

    header("location: /QuanLyShop/GioHang.php");
    mysqli_close($connect);
?>
