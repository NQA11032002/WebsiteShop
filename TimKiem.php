<?php
    require('Widget/Menu.php');
    require('Widget/scroll.php');

    $tenTimkiem = $_POST["tenSPTK"];
                    
    $conn = mysqli_connect("localhost","root","","quanlyshop");

    $query = "select * from sanpham as sp where sp.tenSP like '".'%'.$tenTimkiem.'%'."'";
            
    $result = mysqli_query($conn,$query);
    $countCheck = mysqli_num_rows($result);

    mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/SanPham.css">
    <title>Document</title>
</head>
<body>
<div style="margin-top: 100px;" class="Main-Product" >
            <?php
                 $connect = mysqli_connect("localhost", "root", "", "quanlyshop");

                 while($row = mysqli_fetch_array($result))
                 { ?>
                     <div align="center" class="SubProduct">
 
                     <?php
                         $querySK = "SELECT * FROM sukien";
                         $resultSK = mysqli_query($connect,$querySK);
 
                     while($rowSK = mysqli_fetch_array($resultSK))
                     {
                         if($row['IDLoai'] == $rowSK['IDTL'])
                         { ?>
                             <span class="Discount">-<?php if(isset($rowSK['tienGiam']))  echo $rowSK['tienGiam']?>%</span>
 
                     <?php }
                     } ?>
                         
                         <a href="PHP/Xulychitietsanpham.php?page=danhsach&brand=<?php echo $row['brand']; ?>&id=<?php echo $row['ID']; ?>&IDLoai=<?php echo $row['IDLoai']; ?>" id="buyProduct">
                             <img type="image" id="ImgShirt" src="<?php echo $row['imageSP']?>"></a>
                                 
                         <p><?php echo $row['tenSP']?></p>
                         <div style="display:flex; width:100%; justify-content:center">
                                <?php
                                    if($row['giaGiam'] > 0)
                                    {?>
                                        <p style="text-decoration:line-through; color:gray; font-weight:500; font-size: 15px; margin: auto 10px"><?php echo format_money($row['giaSP'],0,'','.')?></p>
                                <?php }?>

                                <p><?php echo format_money($row['giaSP'] - $row['giaGiam'],0,'','.')?>
                        </div>       
                     </div>
                 <?php }?>
                 <?php
                 if($countCheck == 0)
                 {  ?>
                    <h2 style="text-align: center; margin: 180px 0;" id="Result">Không tìm thấy kết quả nào</h2>                 
                <?php } ?>
            </div>
    </body>
</html>

<?php
    require('Widget/Footer.php');
?>