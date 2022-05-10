<?php
    session_start();

    //thêm bình luận
    $connect = mysqli_connect("localhost","root","","quanlyshop");

    if(isset($_SESSION['Logined']))
    {
        $IDSP = isset($_SESSION['IDSP']) ? $_SESSION['IDSP'] : null;
        $IDKH = isset($_SESSION['IDKH']) ? $_SESSION['IDKH'] : null;
        $date = new DateTime();
        $binhLuan = isset($_POST["review"]) ? $_POST["review"] : null;
    
        $insertReview = "INSERT INTO `danhgiasanpham`(`IDKH`, `IDSP`, `binhLuan`, `ngayBinhLuan`) VALUES ('".$IDKH."' , '".$IDSP."' , '".$binhLuan."' , '".$date->format('Y-m-d')."')";
        
        mysqli_query($connect,$insertReview);

        header("location: /QuanLyShop/ChiTietSP.php");
    }
    else
        header("location: /QuanLyShop/DangNhap.php");

    mysqli_close($connect);
?>