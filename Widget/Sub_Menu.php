
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/QuanLyShop/css/SubMenu.css">
    <title>Document</title>
</head>

<body>  
    <div id="wrapper_SubMenu">
        <ul id="main_menu_SubMenu">
            <div id="Title_Submenu">
                <li><h4 id="AffterName"><?php if(isset($_GET['page'])) echo $_GET['page']; ?> <span style="Color:Gray; padding-right: 3px;">/</span></h4></li>
                <li><h4><?php if(isset( $_GET['TheLoai'])) echo $_GET['TheLoai']; ?></h4></li>
            </div>

            <div>
                <li><a href="">Lọc Giá</a>
                    <ul id="Classify" class="sub_menu">
                        <li><a href="LocGia.php?fromPrice=0&toPrice=150000&page=Sản Phẩm&TheLoai=Dưới 150,000đ">Dưới 150.000VNĐ</a></li>
                        <li><a href="LocGia.php?fromPrice=150000&toPrice=250000&page=Sản Phẩm&TheLoai=Từ 150,000đ - 250,000đ">150.000đ - 250.000đ</a></li>
                        <li><a href="LocGia.php?fromPrice=250000&toPrice=350000&page=Sản Phẩm&TheLoai=Từ 250,000đ - 350,000đ">250.000đ - 350.000đ</a></li>
                        <li><a href="LocGia.php?fromPrice=350000&toPrice=500000&page=Sản Phẩm&TheLoai=Từ 350,000đ - 500,000đ">350.000đ - 500.000đ</a></li>
                        <li><a href="LocGia.php?fromPrice=500000&toPrice=999999999&page=Sản Phẩm&TheLoai=Trên 500,000đ">Trên 500.000đ</a></li>
                    </ul>
                </li>

                <li><a href="MacDinh.php?page=Sản phẩm&TheLoai=Mặc Định">Xắp xếp</a>
                    <ul class="sub_menu" style="right: 0;">
                        <li><a href="MacDinh.php?page=Sản phẩm&TheLoai=Mặc Định">Mặc định</a></li>
                        <li><a href="TangDan.php?page=Sản phẩm&TheLoai=Tăng Dần">Giá thấp đến cao</a></li>
                        <li><a href="GiamDan.php?page=Sản phẩm&TheLoai=Giảm Dần">Giá cao đến thấp</a></li>
                    </ul>
                </li>   
            </div>   
            

        </ul>                    
    </div>
</body>
</html>


