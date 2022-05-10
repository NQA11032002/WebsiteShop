<?php
require_once('Widget/Menu.php');
require('Widget/scroll.php');

$connect = mysqli_connect("localhost", "root", "", "quanlyshop");

$queryProductHot = "SELECT sp.IDLoai,sp.ID,ls.IDSP,ls.soLuongDat,ls.size,sp.ImageSP,sp.tenSP,sp.giaSP,sum(ls.soLuongDat) 
                    FROM sanpham as sp 
                    join lichsumuahang as ls 
                    on sp.ID = ls.IDSP 
                    GROUP BY ls.IDSP,ls.soLuongDat,ls.size,sp.ImageSP,sp.tenSP,sp.giaSP
                    HAVING sum(ls.soLuongDat) >= 10
                    ORDER BY sum(ls.soLuongDat)
                    LIMIT 12";

$result = mysqli_query($connect, $queryProductHot);

mysqli_close($connect);
?>

<html>

<head>
    <meta charset="utf8">
    <title> Trang Chủ</title>
    <link rel="stylesheet" href="css/TrangChu.css">
    <link rel="stylesheet" href="css/Footer.css">
    <link rel="stylesheet" href="css/SanPham.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css" />
</head>
<style>
    .SubProduct p {
        text-align: center;
        letter-spacing: 5px;
        font-size: 20px;
        height: 10px;
        position: relative;
        padding: 20px 0;
    }

    .custom-bottom h2, .custom-bottom .h2{
        font-size: 50px;
    }
</style>

<body>
    <div class="formMain" align="center">
        <div class="formMain-Image-container">

            <i class="fa-solid fa-angle-left left"></i>

            <div class="formMain-Image">
                <div class="image-item">
                    <img class="formMain Image-Introduce" src="/QuanLyShop/Image/Nen/2.jpg" alt="">
                </div>
                <div class="image-item">
                    <img class="formMain Image-Introduce" src="/QuanLyShop/Image/TrangChu/4.jpg" alt="">
                </div>
                <div class="image-item">
                    <img class="formMain Image-Introduce" src="/QuanLyShop/Image/TrangChu/5.jpg" alt="">
                </div>
                <div class="image-item">
                    <img class="formMain Image-Introduce" src="/QuanLyShop/Image/TrangChu/6.jpg" alt="">
                </div>
            </div>

            <i class="fa-solid fa-angle-right right"></i>

        </div>

        <div class="formMain-Introduce">
            <div class="Introduce">
                <img class="formMain-icon" src="/QuanLyShop/Image/Icon/1.png" alt="">
                <h1>FREESHIP</h1>
                <p >Miễn phí vận chuyển giao hàng siêu nhanh.
            </div>

            <div class="Introduce">
                <img class="formMain-icon" src="/QuanLyShop/Image/Icon/3.png" alt="">
                <h1>HOÀN TIỀN 100%</h1>
                <p>Sản phẩm lỗi khi giao hàng được hoàn tiền 100%. Có thể trả sản phẩm trong khoảng thời gian 1-2H sau khi nhận hàng</p>
            </div>

            <div class="Introduce">
                <img class="formMain-icon" src="/QuanLyShop/Image/Icon/2.png" alt="">
                <h1>HỖ TRỢ 24/7</h1>
                <p>Hỗ trợ khách hàng về mặt hàng hoặc mọi thắc mắc xuyên suốt 24 giờ</p>
            </div>
        </div>
    </div>

    <div id="TitleMid">
        <h3>Thời Trang - Phong Cách - Hiện Đại</h3>
    </div>

    <div class="Clothes">
        <img class="" src="https://img3.thuthuatphanmem.vn/uploads/2019/10/14/banner-thoi-trang-nam-nu_113857303.jpg" alt="">
        <img class="" src="https://img6.thuthuatphanmem.vn/uploads/2022/03/04/background-quang-cao-thoi-trang-quan-ao_025656570.jpg" alt="">
        <img class="" src="https://vzone.vn/wp-content/uploads/2022/03/background-thoi-trang-hien-dai-dep_025701441.jpg" alt="">
    </div>

    <div id="Top_Product">
        <h3>Top Sản Phẩm Được Quan Tâm</h3>
        <form action="" method="GET">
            <div class="Main-Product">
                <?php
                while($row = mysqli_fetch_array($result))
                {?>
                    <div align="center" class="SubProduct">
                                <a href="PHP/Xulychitietsanpham.php?page=danhsach&id=<?php echo $row['ID']; ?>&IDLoai=<?php echo $row['IDLoai']; ?>" id="buyProduct">
                                <img type="image" id="ImgShirt" src="<?php echo $row['ImageSP']?>"></a>
                                
                                <p><?php echo $row['tenSP']?>
                                <p><?php echo $row['giaSP']?><u>đ</u>
                        </div>
                <?php }?>
            </div>
        </form>
    </div>

    <div class="Contain_ReviewUser">
        <h3>Nhận xét của khách hàng</h3>

        <div class="Nav_Review">
            <div class="Nav_ReviewUser">
                <div style="width: 200px; height: 100%;">
                    <img src="/QuanLyShop/Image/KhachHang/hovanlam.png" alt="">
                </div>

                <div class="ReviewUser">
                    <h4>Hồ Văn Lâm</h4>
                    <h5>11-03-1993</h5>
                    <p>
                        Welcome to KOODING.com, the leading online global marketplace.<br>
                        Our goal is to not only connect people around the globe through their love of Korean style, <br>
                        but also to provide instant access to the newest Korean women’s fashion, Korean men’s <br>
                        fashion, and Korean beauty products and brands across the world at the lowest cost and with zero hassle worldwide shipping. <br>
                        Above all, we strive to provide the KOODING community with high-end products found at Korean stores at the most affordable prices.<br>
                    </p>
                </div>
            </div>

            <div class="Nav_ReviewUser">
                <div style="width: 200px; height: 100%;">
                    <img src="/QuanLyShop/Image/KhachHang/meo1.jpg" alt="">
                </div>

                <div class="ReviewUser">
                    <h4>Oggy</h4>
                    <h5>11-03-2002</h5>
                    <p>
                        Welcome to KOODING.com, the leading online global marketplace.<br>
                        Our goal is to not only connect people around the globe through their love of Korean style, <br>
                        but also to provide instant access to the newest Korean women’s fashion, Korean men’s <br>
                        fashion, and Korean beauty products and brands across the world at the lowest cost and with zero hassle worldwide shipping. <br>
                        Above all, we strive to provide the KOODING community with high-end products found at Korean stores at the most affordable prices.<br>
                    </p>
                </div>
            </div>

            <div class="Nav_ReviewUser">
                <div style="width: 200px; height: 100%;">
                    <img src="/QuanLyShop/Image/KhachHang/meo2.jpg" alt="">
                </div>

                <div class="ReviewUser">
                    <h4>Tom</h4>
                    <h5>11-03-2002</h5>
                    <p>
                        Welcome to KOODING.com, the leading online global marketplace.<br>
                        Our goal is to not only connect people around the globe through their love of Korean style, <br>
                        but also to provide instant access to the newest Korean women’s fashion, Korean men’s <br>
                        fashion, and Korean beauty products and brands across the world at the lowest cost and with zero hassle worldwide shipping. <br>
                        Above all, we strive to provide the KOODING community with high-end products found at Korean stores at the most affordable prices.<br>
                    </p>
                </div>
            </div>

            <div class="Nav_ReviewUser">
                <div style="width: 200px; height: 100%;">
                    <img src="/QuanLyShop/Image/KhachHang/meo3.jpg" alt="">
                </div>

                <div class="ReviewUser">
                    <h4>Jack</h4>
                    <h5>11-03-2002</h5>
                    <p>
                        Welcome to KOODING.com, the leading online global marketplace.<br>
                        Our goal is to not only connect people around the globe through their love of Korean style, <br>
                        but also to provide instant access to the newest Korean women’s fashion, Korean men’s <br>
                        fashion, and Korean beauty products and brands across the world at the lowest cost and with zero hassle worldwide shipping. <br>
                        Above all, we strive to provide the KOODING community with high-end products found at Korean stores at the most affordable prices.<br>
                    </p>
                </div>
            </div>
        </div>

        <script>
                const sliderReview = document.querySelector(".Nav_Review");
                const sliderItemsReview = document.querySelectorAll(".Nav_ReviewUser");
                const prevSlideReview = document.querySelector(".left");
                const nextSlideReview = document.querySelector(".right");

                let currentIndexReview = 0;

                nextSlideReview.addEventListener("click", () => handleChangeSliderReview("next"));
                prevSlideReview.addEventListener("click", () => handleChangeSliderReview("prev"));

                function handleChangeSliderReview(direction) {
                    if (direction == "next") {
                        currentIndexReview++;
                        console.log(currentIndexReview)
                        if (currentIndexReview >= sliderItemsReview.length) {
                            currentIndexReview = 0;
                        }
                        updateSliderReview();
                    } else if (direction == "prev") {
                        currentIndexReview--;
                        if (currentIndexReview < 0) {
                            currentIndexReview = sliderItemsReview.length - 1;
                        }
                        updateSliderReview();
                    }

                    function updateSliderReview() {
                        sliderReview.style.transform = `translateX(-${currentIndexReview * 100}%)`;
                    }
                }
                setIntervalReview(() => {
                    nextSlide.click();
                }, 3000);
            </script> 
    </div>

    <div class="parallax" style="background-image: url(https://bizweb.dktcdn.net/100/113/556/themes/161811/assets/cb-bg-img.jpg?1638784216916);">
        <div class="custom-bottom">
            <h3>BỘ SƯU TẬP 2022</h3>
            <h2>MIỄN PHÍ VẬN CHUYỂN</h2>
            <div class="des-1">CHO ĐƠN HÀNG TRÊN 500K</div>
            <div class="des-2">CHƯƠNG TRÌNH NÀY ĐƯỢC ÁP DỤNG TRÊN MỌI MẶT HÀNG CỦA CHÚNG TÔI</div>
        </div>
    </div>
</body>

<script>
    const sliderMain = document.querySelector(".formMain-Image");
    const sliderItems = document.querySelectorAll(".image-item");
    const prevSlide = document.querySelector(".left");
    const nextSlide = document.querySelector(".right");
    let currentIndex = 0;
    nextSlide.addEventListener("click", () => handleChangeSlider("next"));
    prevSlide.addEventListener("click", () => handleChangeSlider("prev"));

    function handleChangeSlider(direction) {
        if (direction == "next") {
            currentIndex++;
            console.log(currentIndex)
            if (currentIndex >= sliderItems.length) {
                currentIndex = 0;
            }
            updateSlider();
        } else if (direction == "prev") {
            currentIndex--;
            if (currentIndex < 0) {
                currentIndex = sliderItems.length - 1;
            }
            updateSlider();
        }

        function updateSlider() {
            sliderMain.style.transform = `translateX(-${currentIndex * 100}%)`;
        }
    }
    setInterval(() => {
        nextSlide.click();
    }, 3000);
</script>

</html>

<?php
require('Widget/Footer.php');
?>