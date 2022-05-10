<?php
    session_start();

    $connect = mysqli_connect("localhost","root","","quanlyshop");

    $IDKH = isset($_SESSION['IDKH']) ? $_SESSION['IDKH'] : null;


        //giỏ hàng
        $query = "select sp.imageSP, sp.tenSP ,(gh.soLuongDat * sp.giaSP) as toTal from giohang as gh join sanpham as sp on gh.IDSP = sp.ID where IDKH = '".$IDKH."'";

        $result = mysqli_query($connect,$query);

        //số lượng giỏ hàng
        $querySumCart = "select count(gh.ID) as sumCart from giohang as gh where gh.IDKH = '".$IDKH."'";

        $resultSumCart = mysqli_query($connect,$querySumCart);

        $rowSumCart = mysqli_fetch_array($resultSumCart);
        global $sumCart;

        $sumCart = $rowSumCart['sumCart'];

        //sự kiện
        $querySK = "select * from sukien";

        $resultSK = mysqli_query($connect,$querySK);

        //số lượng sự kiện
        $querySumSK = "select count(sukien.ID) as sumSK from sukien";

        $resultSumSK = mysqli_query($connect,$querySumSK);

        $rowSumSK = mysqli_fetch_array($resultSumSK);

        global $sumSK;

        $sumSK = $rowSumSK['sumSK'];

    mysqli_close($connect);
?>
<?php 
require "PHP/function.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/QuanLyShop/css/Menu.css">
    <link rel="stylesheet" href="/QuanLyShop/css/SanPham.css">
    <link rel="stylesheet" href="/QuanLyShop/css/DangNhap.css">
    <title>Document</title>
</head>

<body>  
    <div  id="wrapper">
        <div id="header">
            <nav class="container">
                <ul id="main-menu">
                    <li><a href="TrangChu.php">Trang Chủ </a></li>
                    <li><a href="TatCaSanPham.php?page=Sản Phẩm&TheLoai=Tất Cả">Sản Phẩm</a>
                        <ul class="sub-menu">
                            <li><a href="DoNam.php?page=Quần Áo&TheLoai=Đồ Nam">Đồ Nam</a></li>
                            <li><a href="DoNu.php?page=Quần Áo&TheLoai=Đồ Nữ">Đồ Nữ</a></li>
                            <li><a href="LoadAo.php?page=Sản Phẩm&TheLoai=Áo">Áo</a></li>
                            <li><a href="LoadQuan.php?page=Sản Phẩm&TheLoai=Quần">Quần</a></li>
                            <li><a href="LoadBalo.php?page=Sản Phẩm&TheLoai=Ba Lô">Ba Lô</a></li>
                            <li><a href="LoadGiay.php?page=Sản Phẩm&TheLoai=Giày">Giày</a></li>
                            <li><a href="LoadMu.php?page=Sản Phẩm&TheLoai=Mũ">Mũ</a></li>
                        </ul>
                    </li>
                    <li><a href="GioiThieu.php">Giới Thiệu</a></li>
                    <li><a href="LienHe.php">Liên Hệ</a></li>
                </ul>   
                
            <ul id="main-menu">
                <li id="menu-search">
                    <form action="TimKiem.php?page=Sản Phẩm&TheLoai=Tìm Kiếm" method="POST">
                        <div id="Contain_SearchProc">
                            <input type="text" value="" name="tenSPTK" id="IDTimKiem" placeholder="Tìm Kiếm">
                            <input type="submit" class="btTimKiem" value="">
                        </div>
                    </form>
                </li>

                <!-- php -->
                <?php
                    if(isset($_SESSION['Logined']))
                    {?>
                        <div id="DivInfor">
                            <li id="menu-Infor">
                                <a>
                                    <img src="<?php if(isset($_SESSION['image'])) echo $_SESSION['image'] ?>" alt="">
                                    <?php if(isset($_SESSION['hoTen'])) echo $_SESSION['hoTen'] ?></a>    
                                <ul class="sub-menu">
                                        <li><a href="/QuanLyShop/taiKhoan.php">Tài Khoản</a></li>
                                        <li><a href="/QuanLyShop/DonMua.php">Đơn Mua</a></li>
                                        <li><a href="/QuanLyShop/PHP/Xulydangxuat.php">Đăng Xuất</a></li>                      
                                </ul>
                            </li>
                        </div> 
                        <?php                
                    }else
                    {?>
                        <div id="DivDangNhap">
                            <li class="menu-DangNhap"><a href="/QuanLyShop/DangNhap.php" name="btDangNhap">Đăng Nhập</a></li>
                        </div>

                        <div id="DivDangKy" >
                                <li class="menu-DangNhap">
                                <a href="dangky.php">Đăng Ký</a>
                                </li>
                        </div>  
                        <?php
                    }?>
            </ul>                      
            </nav>  
            
            <div class="Contain_Event Contain_HistoryCart">                  
                        <img  src="/QuanLyShop/Image/Menu/notify.png" alt=""><span id="sumCart"><?php echo $sumSK?></span></img>

                        <div class="History_Cart">
                            <h3 align="center">Sự kiện gần đây</h3>

                            <?php
                                while($rowSK = mysqli_fetch_array($resultSK))
                                {
                                ?>
                                    <div class="Container_History">                  
                                        <div style="margin-right: 20px;" class="Contain__Img">
                                            <img id="Container_History_Img" src="<?php echo $rowSK['image'];?>" alt="">
                                        </div>

                                        <div class="Contain__InforHistory">
                                            <h1 style="font-size: 20px;"><?php echo $rowSK['tenSK'] ?></h1>
                                            <h4 style="margin-top: -25px; color: gray; font-size: 12px"><?php echo $rowSK['ngayBatDau']?> - <span><?php echo $rowSK['ngayKetThuc']?></span></h4>
                                            <h5 ><?php echo $rowSK['noiDungSK'] ?></h5>
                                        </div>
                                    </div>     
                            <?php }?>                         
                        </div>
            </div>       

            <!-- Giỏ hàng-->
            <div class="Contain_HistoryCart">
                        <img onclick="Page_Cart();" src="/QuanLyShop/Image/Menu/Cart.png" alt=""><span id="sumCart"><?php echo $sumCart?></span></img>

                        <div class="History_Cart">
                            <h3 align="center">Lịch sử giỏ hàng</h3>

                            <?php
                                $total = 0;
                                while($row = mysqli_fetch_array($result))
                                { 
                                    $total = $total + $row['toTal']; 
                                    $GLOBALS = $total; 
                                ?>
                                    <div class="Container_History">                  
                                        <div class="Contain__Img">
                                            <img id="Container_History_Img" src="<?php echo $row['imageSP'];?>" alt="">
                                        </div>


                                        <div class="Contain__InforHistory">
                                            <p><?php echo $row['tenSP'];?></p>
                                            <p><?php echo format_money($row['toTal'],0,'','.');?></p>
                                        </div>
                                    </div>     
                            <?php }?>
                            
                            <div class="History_Bottom">
                                <h4 >Tổng: <?php if(!is_array($GLOBALS)) echo format_money($GLOBALS,0,'','.') ?></h4>
                                <a href="GioHang.php">Giỏ Hàng</a>
                            </div>

                        </div>
                       
                <script>
                    function Page_Cart()
                    {
                        window.location.href = "GioHang.php";
                    }
                </script>
            </div>       
        </div>             
    </div>
</body>
</html>


