<?php
    require('Widget/Menu.php');
    require('Widget/Sub_Menu.php');
    require('Widget/scroll.php');
?>

<?php
	$connect = mysqli_connect("localhost","root","","quanlyshop");
	
	$command = "SELECT * FROM `sanpham` as sp  WHERE sp.IDLoai = 2";

    $_SESSION['IDLoai'] = 2;
    
	$result = mysqli_query($connect,$command);
?>
<html>
    <head>
        <meta charset="utf8"></meta>
        <title>Shop Áo</title>
        <link rel="stylesheet" href="css/SanPham.css">
    </head>

    <body>
        <div class="Main-Product" >
        <?php
            while($row = mysqli_fetch_array($result))
            {?>
                <div align="center" class="SubProduct">
                                <a href="PHP/Xulychitietsanpham.php?page=danhsach&id=<?php echo $row['ID']; ?>&IDLoai=<?php echo $row['IDLoai']; ?>" id="buyProduct">
                                <img type="image" id="ImgShirt" src="<?php echo $row['imageSP']?>"></a>
                                
                                <p><?php echo $row['tenSP']?>
                                <p><?php echo $row['giaSP']?><u>đ</u>
                        </div>
            <?php }?>
        </div>
</body>
</html>

<?php
    require('Widget/Footer.php');
?>