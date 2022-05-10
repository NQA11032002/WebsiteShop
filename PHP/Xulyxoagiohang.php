<?php
    $connect = mysqli_connect("localhost","root","","quanlyshop");

    $ID = $_GET['IDGH'];

    $delete = "delete FROM giohang where giohang.ID = '".$ID."'";

    $result = mysqli_query($connect,$delete);

    header("location: /QuanLyShop/GioHang.php");

    mysqli_close($connect);
?>