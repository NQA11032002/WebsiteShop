<?php
    require('Widget/Menu.php');
    require('Widget/scroll.php');

    //chi tiết sản phẩm
    $connect = mysqli_connect("localhost","root","","quanlyshop");

    $IDLoai = isset($_SESSION['IDLoai']) ? $_SESSION['IDLoai'] : null;

    $query = "select * from sanpham as sp where sp.IDLoai = '".$IDLoai."'";
    
    $result = mysqli_query($connect,$query);

    //phân trang đánh giá sản phẩm
    //số bài trên một trang
    $baiTrenMotTrang = 5;

    //nếu chưa chọn trang mặc định là trang 0
    if(!$_GET['page'])
    {
        $page = 0;
    }
    else
    {
        $page = $_GET['page'];
    }

    
    $IDSP = isset($_SESSION['IDSP']) ? $_SESSION['IDSP'] : null;

    //trang hiện tại
    $current_page = !empty($_GET['page']) ? $_GET['page'] : 0;

    //Tổng số dòng
    $querySoDong= "SELECT * from danhgiasanpham where IDSP = '".$IDSP."'";  
    $resultRow= mysqli_query($connect,$querySoDong);
    $soDong = mysqli_num_rows($resultRow);

     //số trang
    $soTrang = $soDong / $baiTrenMotTrang;

    $temp = $page * $baiTrenMotTrang;

    //Các đánh giá sản phẩm
    $queryReview = "SELECT kh.avatar,kh.hoTen, dg.ngayBinhLuan, dg.binhLuan from danhgiasanpham as dg join khachhang as kh on dg.IDKH = kh.ID where IDSP = '".$IDSP."' LIMIT $temp , $baiTrenMotTrang";

    $resultReview = mysqli_query($connect,$queryReview);
    $Sum = mysqli_num_rows($resultReview);

     //Giảm giá
    $querySuKien = "SELECT * FROM sukien WHERE IDTL = '".$IDLoai."'";

    $resultSuKien = mysqli_query($connect,$querySuKien);
 
    if($rowSK = mysqli_fetch_array($resultSuKien))
    {
        global $tienGiam;
        $tienGiam = $rowSK['tienGiam'];
    }
 

    mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="css/MuaHang.css">
    <link rel="stylesheet" href="css/SanPham.css">
    <link rel="stylesheet" href="css/ChiTietSP.css">
        <link rel="stylesheet" href="css/DonMua.css">
</head>

<body>
    <div id="MainBuy"> 
        <div id="imgSP">
            <img src="<?php if(isset($_SESSION['imgSPBuy'])) echo $_SESSION['imgSPBuy'] ?>" alt="">
        </div>
        
        <form id="form" action="" method="POST">
            <div id="inforSP">
                <h1><?php if(isset($_SESSION['tenSPBuy'])) echo $_SESSION['tenSPBuy']?></h1>

                <div id="total" style="display: flex; margin: 10px 0px" align="center">
                    <?php
                        if($_SESSION['giaSPGiam'] > 0)
                        {?>
                            <h4 style="margin: auto 0px; text-decoration: line-through; color: gray"><?php if(isset($_SESSION['giaSPBuy'])) echo format_money($_SESSION['giaSPBuy'],0,'','.')?></h4>
                    <?php }
                    ?>
                    <h2 style="margin: auto 10px; color: red; border-top:0;"><?php if(isset($_SESSION['giaSPGiam'])) echo format_money($_SESSION['giaSPGiam'],0,'','.')?></h2>

                    <?php
                    if($_SESSION['giaSPGiam'] > 0)
                    {?>
                        <h4 style="margin: auto 0px; color: white; background: red; width: 50px">-<?php if(isset($_SESSION['tienGiamSK'])) echo $_SESSION['tienGiamSK']?>%</h4>
                 <?php } ?>

                </div>


                <div id="Main_Size">
                    <h3>Size</h3>

                    <div>
                        <input type="radio" name="rdSize" checked="true" id="cbSizeS" value="S">S
                        <input type="radio" name="rdSize" id="cbSizeM" value="M">M
                        <input type="radio" name="rdSize" id="cbSizeL" value="L">L
                        <input type="radio" name="rdSize" id="cbSizeXL" value="XL">XL
                    </div>
                </div>

                <div class="Main_Amount">
                    <span>Số Lượng</span>

                    <div class="increase_reduction">
                        <input type="button" name="Reduction" onclick="btReduction();" value="-">
                        <input type="text" name="amout_Product" id="amount" value="1" placeholder="1">
                        <input type="button" name="Increase" onclick="btIncrease();" value="+">
                    </div>

                    <script>
                        function btIncrease()
                        {
                            $value = document.getElementById('amount').value;
                            $value++;
                            document.getElementById('amount').value = $value;
                        }

                        function btReduction()
                        {
                            $value = document.getElementById('amount').value;
                            $value--;
                            document.getElementById('amount').value = $value;
                        }
                    </script>
                </div>

            <div id="Container_Notifi">

            </div>

            <div class="incCrart_buyProduct">
                <input type="button" onclick="Notyfi();" id="btIncreaCart" value="Thêm Vào Giỏ Hàng"></input>
                <input type="button" onclick="BuyProduct();" id="btBuyProduct" value="Mua Hàng"></input>

                <script>
                    function BuyProduct()
                    {
                        this.form.action = 'PHP/XulyclickMuaHang.php';
                        this.form.submit();
                    }

                    function Notyfi()
                    {
                        const check = document.getElementById('Container_Notifi');
                        if(check)
                        {

                            const toast = document.createElement('div');

                            toast.classList.add('toast');
                            toast.innerHTML = `
                                                <div id="Notification">
                                                        <h4>Thêm giỏ hàng thành công</h4>
                                                </div>
                                                `;
                            check.appendChild(toast);

                            this.form.action = 'PHP/Xulygiohang.php';
                            this.form.submit();
                        }
                    }
                </script>
            </div>
        </div>
        </form>
        
        <div id="describeSP">
            <div>
                <h1>Mô Tả Sản Phẩm</h1>
                <h4><?php if(isset($_SESSION['mieuTaSPBuy'])) echo $_SESSION['mieuTaSPBuy'] ?></h4>
            </div>

            <div>
                <h1>Điều Khoản Dịch Vụ</h1>
                <h3>Lưu ý khi đặt hàng</h3>
                <ul>
                    <li>
                        <p>Các bạn check lại thông tin , kiểm tra lại thông tin đơn hàng trong Email
                    </li>
                    <li>
                        <p>Các đơn hàng sẽ được gọi xác nhận trong 48h kể từ lúc đặt
                    </li>
                    <li>
                        <p>Thời gian nhận hàng tầm 2-3 ngày (nội thành),3 - 4 ngày (ngoại thành)
                    </li>
                    <li>
                        <p>Khi các bạn nhận được hàng bạn nhớ lưu ý KIỂM TRA HÀNG VỚI SHIPPER
                    </li>
                </ul>             
            </div>  
        </div>
    </div>

    <div class="ImageSize">
        <h2>Thông Số Chọn Size</h2>
        <div style="margin: 0 50px">
            <img style="width:600px; height: 420px" src="/QuanLyShop/Image/Nen/SizeAo.png" alt="">
            <img style="width:600px; height: 420px" src="/QuanLyShop/Image/Nen/SizeQuan.png" alt="">
        </div>
            <img id="imgSizeShoes" style="margin: 10px auto;Width: 750px; Height: 450px;" src="/QuanLyShop/Image/Nen/SizeGiay.jpg" alt="">

    </div>
    
    <!-- những sản phẩm liên quan -->
    <div class="Main_ProductRelation">
        <h3>Sản Phẩm Liên Quan</h3>

        <div class="List_ProductRelation">
            <?php
                while($row = mysqli_fetch_array($result))
                {?>
                <div align="center" class="SubProduct">
                    <?php
                        //nếu IDLoai == -1 là trang tất cả sản phẩm
                        if($IDLoai == -1)
                        {
                            //truy vấn sự kiện
                            $querySuKien = "SELECT * FROM sukien";

                            $resultSuKien = mysqli_query($connect,$querySuKien);
                        
                            while($rowSK = mysqli_fetch_array($resultSuKien))
                            {
                                //nếu IDTL bên sự kiện == IDLoai của sản phẩm thì tạo thẻ giảm giá
                                if($rowSK['IDTL'] == $row['IDLoai'])
                                {?>
                                    <span class="Discount">-<?php if(isset($rowSK['tienGiam']))  echo $rowSK['tienGiam']?>%</span>
                            <?php  } }?> 
                          
                          
                            <a href="PHP/Xulychitietsanpham.php?page=danhsach&id=<?php echo $row['ID']; ?>&IDLoai=<?php echo $row['IDLoai']; ?>" id="buyProduct">
                                <img type="image" id="ImgShirt" src="<?php echo $row['imageSP']?>">
                            </a>

                            <p><?php echo $row['tenSP']?>
                            <div style="display:flex; width:100%; justify-content:center">
                                <?php
                                    if($row['giaGiam'] > 0)
                                    {?>
                                        <p style="text-decoration:line-through; color:gray; font-weight:500; font-size: 15px; margin: auto 10px"><?php echo format_money($row['giaSP'],0,'','.')?></p>
                                <?php }?>

                                <p><?php echo format_money($row['giaSP'] - $row['giaGiam'],0,'','.')?>
                            </div>                
                    <?php }
                    else
                    {
                        if(isset($tienGiam))
                        {?>
                            <span class="Discount"><?php  echo $tienGiam?>%</span>
                    <?php  } ?>

                        <a href="PHP/Xulychitietsanpham.php?page=danhsach&id=<?php echo $row['ID']; ?>&IDLoai=<?php echo $row['IDLoai']; ?>" id="buyProduct">
                            <img type="image" id="ImgShirt" src="<?php echo $row['imageSP']?>">
                        </a>
                                    
                        <p><?php echo $row['tenSP']?>
                        <div style="display:flex; width:100%; justify-content:center">
                                <?php
                                    if($row['giaGiam'] > 0)
                                    {?>
                                        <p style="text-decoration:line-through; color:gray; font-weight:500; font-size: 15px; margin: auto 10px"><?php echo format_money($row['giaSP'],0,'','.')?></p>
                                <?php }?>

                                <p><?php echo format_money($row['giaSP'] - $row['giaGiam'],0,'','.')?>
                        </div>       
                <?php  } ?>
                </div>
            <?php }?>
        </div>
    </div>

    <!-- đánh giá sản phẩm -->
    <div class="reviewProduct">
        <h3 align="center">Đánh Giá Sản Phẩm</h3>
        <h5 align="center"style="margin: 10px"><?php echo $Sum; ?> Bình luận</h5>

        <form id="formReview" action="" method="POST" onsubmit="return false;">
            <div class="comment">
                <div class="Nav_Comment">
                    <img src="<?php if(isset($_SESSION['image'])) echo $_SESSION['image']; ?>" alt="">
                    <div class="Content">
                        <input style="border: none; border-bottom: 1px solid gray; padding-left: 15px;" name="review" type="text" value="">
                        <input style="border: 1px solid gray; cursor: grab;" onclick="InsertReview();" id="submit_Content" type="button" value="Đăng">
                    </div>
                </div>         
            </div>

            <script>
                function InsertReview()
                {
                    this.formReview.action = 'PHP/Xulybinhluansanpham.php';
                    this.formReview.submit();
                }
            </script>
        </form>

        <div class="Contain_Comment">
            <?php
                while($row = mysqli_fetch_array($resultReview))
                {?>
                    <div style="border-top: 1px solid gray" class="comment">
                        <div class="Nav_Comment">
                            <img src="<?php echo $row['avatar']; ?>" alt="">
                            <div class="Content">
                                <p style="font-size: 13px; font-weight: bold"><?php echo $row['hoTen'] ?></p>
                                <p style="color: gray; font-size: 12px; font-weight: bold"><?php echo $row['ngayBinhLuan'] ?></p>
                                <p><?php echo $row['binhLuan']; ?></p>
                            </div>
                        </div>    
                    </div>
            <?php }?>
        </div>

        <div class="Pagination" style="margin: 20px 0">
                <?php
                        //về trang đầu
                        if($current_page > 0)
                        {
                            $StartPage = 0;
                            echo "<a id='numberPage' href='ChiTietSP.php?page={$StartPage}'>Đầu</a>";
                        }

                        //bắt đầu trang 1 hiện nút trước
                        if($current_page > 0)
                        {
                            $previous_page = $current_page - 1;
                                echo "<a id='previous_Number' href='ChiTietSP.php?page={$previous_page}'>Trước</a>";
                        }

                        for($page = 0; $page < $soTrang; $page++)
                        {   
                            if($current_page == $page)
                                echo "<strong id='current_Page' href='ChiTietSP.php?page={$page}'>{$page}</strong>";
                            else
                            {
                                //nằm từ khoản +-3
                                if($page > $current_page - 3 && $page < $current_page + 3)
                                    echo "<a id='numberPage' href='ChiTietSP.php?page={$page}'>{$page}</a>";
                            }
                        }
                        
                        //trang đầu tiên và trang cuối thì hiện nút sau
                        if($current_page >= 0 && $current_page < $page - 1)
                        {
                            $after_page = $current_page + 1;
                                echo "<a id='affter_Number' href='ChiTietSP.php?page={$after_page}'>Sau</a>";
                        }

                        //tới trang cuối
                        if($current_page >= 0 && $current_page < $page - 1)  
                        {
                            $EndPage = $page - 1;
                            echo "<a id='numberPage' href='ChiTietSP.php?page={$EndPage}'>Cuối</a>";
                        }
                    ?>
            </div>           
    </div>

</body>
</html>

<?php
    require('Widget/Footer.php');
?>