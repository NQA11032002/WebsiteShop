<?php
    session_start();
    $connect = mysqli_connect("localhost","root","","quanlyshop");

    $IDKH = isset($_SESSION['IDKH']) ? $_SESSION['IDKH'] : null;
    $IDSP = isset($_SESSION['IDSP']) ? $_SESSION['IDSP'] : null;
    $SIZE = isset($_POST["rdSize"]) ? $_POST["rdSize"] : null;
    $AMOUT = isset($_POST['amout_Product']) ? $_POST['amout_Product'] : null;

    if(isset($_SESSION['Logined']))
    {
        $querySP = "select * from sanpham where ID = '".$IDSP."'";

        $resultSP = mysqli_query($connect,$querySP);

        $row = mysqli_fetch_array($resultSP);

        $total = ($row['giaSP'] - $row['giaGiam']) * $AMOUT;

        $query = "INSERT INTO `giohang`(`ID`, `IDSP`, `IDKH`, `soLuongDat`, `size`, `tongTien`) VALUES ('[value-1]','".$IDSP."','".$IDKH."','".$AMOUT."','".$SIZE."' , '".$total."')";
    
        $result = mysqli_query($connect,$query);
        

        header("location: Refresh:0");
    }
    else
    {
        header("location: /QuanLyShop/DangNhap.php");
    }

    mysqli_close($connect);
?>
