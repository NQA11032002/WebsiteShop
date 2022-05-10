<?php
    session_start();
    $connect = mysqli_connect("localhost","root","","quanlyshop");

    $IDKH = isset($_SESSION['IDKH']) ? $_SESSION['IDKH'] : null;
    $IDSP = isset($_SESSION['IDSP']) ? $_SESSION['IDSP'] : null;
    $SIZE = isset($_POST["rdSize"]) ? $_POST["rdSize"] : null;
    $AMOUT = isset($_POST['amout_Product']) ? $_POST['amout_Product'] : null;
    $now = new DateTime();

    if(isset($_SESSION['Logined']))
    {        
        $querySP = "select * from sanpham where ID = '".$IDSP."'";

        $resultSP = mysqli_query($connect,$querySP);

        $row = mysqli_fetch_array($resultSP);

        $total = ( $row['giaSP'] - $row['giaGiam']) * $AMOUT;

        $query = "INSERT INTO `donhang`(`IDSanPham`, `IDKhachHang`, `soLuongDat`, `size`,`ThoiGianDH`,`trangThai`,`nhanHang`,`tongTien`) 
                  VALUES ('".$IDSP."','".$IDKH."','".$AMOUT."','".$SIZE."','".$now->format('Y-m-d H:i:s')."' , 'Đang Duyệt','Chưa Nhận' , '".$total."')";
    
        mysqli_query($connect,$query);
    
        header("location: /QuanLyShop/DonMua.php");
    }
    else
    {
        header("location: /QuanLyShop/DangNhap.php");
    }

    mysqli_close($connect);
?>
