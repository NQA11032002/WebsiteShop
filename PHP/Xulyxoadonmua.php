<?php
    $connect = mysqli_connect("localhost","root","","quanlyshop");

    $ID = $_GET['IDDH'];

    $checkTrangThai = "select * from donhang where donhang.ID = '".$ID."' and trangThai = 'Đang Duyệt'";
    $resultQuery = mysqli_query($connect,$checkTrangThai);
    if(mysqli_fetch_array($resultQuery))
        $delete = "delete FROM donhang where donhang.ID = '".$ID."' and trangThai = 'Đang Duyệt'";
    else
    {
        $update = "update donhang set donhang.trangThai = 'Đã Hủy' where donhang.ID = '".$ID."'";
        $resultQuery = mysqli_query($connect,$update);
    }

    $result = mysqli_query($connect,$delete);
    
    header("location: /QuanLyShop/DonMua.php");   

    mysqli_close($connect);
?>