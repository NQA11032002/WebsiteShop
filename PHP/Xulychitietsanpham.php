<?php
    session_start();

    $connect = mysqli_connect("localhost","root","","quanlyshop");
 
    /* lấy id từ địa chỉ web */
    $ID = $_GET['id'];

    $query = "SELECT * FROM `sanpham` WHERE ID = '".$ID."'";

    $result = mysqli_query($connect,$query);

    if($row = mysqli_fetch_array($result))
    {
        $_SESSION['IDSP'] = $row['ID'];
        $_SESSION['IDLoai'] = $row['IDLoai'];
        $_SESSION['imgSPBuy'] = $row['imageSP'];
        $_SESSION['tenSPBuy'] = $row['tenSP'];
        $_SESSION['giaSPBuy'] = $row['giaSP'];
        $_SESSION['giaSPGiam'] = $row['giaSP'] - $row['giaGiam'];
        $_SESSION['mieuTaSPBuy'] = $row['mieuTaSP'];
        
        //Lấy giá giảm của sự kiện
        $querySuKien = "SELECT * FROM sukien WHERE IDTL = '".$row['IDLoai']."'";

        $resultSuKien = mysqli_query($connect,$querySuKien);

        $rowSK = mysqli_fetch_array($resultSuKien);

        $_SESSION['tienGiamSK'] = $rowSK['tienGiam'];

        header("location: /QuanLyShop/ChiTietSP.php");
    }

    mysqli_close($connect);
?>