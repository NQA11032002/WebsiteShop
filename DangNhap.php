<?php
require_once("PHP/function.php");

session_start();

$conn = mysqli_connect("localhost", "root", "", "quanlyshop");


if (isset($_POST['btTaiKhoan']) && isset($_POST['btMatKhau'])) {
    $taiKhoan = $_POST['btTaiKhoan'];
    $matKhau = $_POST['btMatKhau'];
    $query = "select * from taikhoan as tk where tk.tenDangNhap = '" . $taiKhoan . "' and tk.matKhau = '" . $matKhau . "'";

    $result = mysqli_query($conn, $query);


    if ($GLOBALS['name'] = mysqli_fetch_array($result)) {
        $queryInfor = "select * from khachhang as kh where kh.tenDangNhap = '" . $taiKhoan . "'";
        $resultInfor = mysqli_query($conn, $queryInfor);

        $_SESSION['Logined'] = $taiKhoan;

        if ($rowInfor = mysqli_fetch_array($resultInfor)) {
            $_SESSION['tenDangNhap'] = $rowInfor['tenDangNhap'];
            $_SESSION['IDKH'] = $rowInfor['ID'];
            $_SESSION['hoTen'] = $rowInfor['hoTen'];
            $_SESSION['image'] = $rowInfor['avatar'];
            $_SESSION['gioiTinh'] = $rowInfor['gioiTinh'];
            $_SESSION['ngaySinh'] = $rowInfor['ngaySinh'];
            $_SESSION['SDT'] = $rowInfor['SDT'];
            $_SESSION['email'] = $rowInfor['email'];
            $_SESSION['diachi'] = $rowInfor['diaChi'];
        }
        
        if(isset($_POST['remember_me'])) {
			setcookie("btTaiKhoan",  $taiKhoan, time() + 3600);
			setcookie("btMatKhau", $matKhau, time() + 3600);
			setcookie("user_login", $_POST['remember_me'], time() + 3600);
		} else {
			setcookie("btTaiKhoan", $taiKhoan, time() - 3600);
			setcookie("btMatKhau", $matKhau, time() - 3600);
			setcookie("user_login",$_POST['remember_me'], time() - 3600);
		}
        header("location: TrangChu.php");
    }else{
        $error["login"] = "Tên đăng nhập hoặc mật khẩu không đúng";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html id="backGround" lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/DangNhap.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
    </style>
</head>

<body style="background: linear-gradient(to right, #bdc3c7,#2c3e50);">
    <div class="Container_Login">
        <div>
            <h1>ĐĂNG NHẬP</h1>
        </div>

        <div class="Main-Login">
            <p id="ResultProcess"><?php if ($GLOBALS == false) echo "Tài khoản hoặc mật khẩu không đúng!"; ?></p>
            <form action="" method="POST">
                <div class="Main_Input">
                <i class="fa-solid fa-user"></i>
                    <input value="<?php echo get_data_cookie("btTaiKhoan") ;?>" class="account" type="text" name="btTaiKhoan" placeholder="Tài Khoản" value="">
                </div>
                <div class="Main_Input">
                <i class="fa-solid fa-lock"></i>
                    <input value="<?php echo get_data_cookie("btMatKhau"); ?>" class="account" type="password" name="btMatKhau" placeholder="Mật Khẩu" value="">
                    <div class="input-error"><?php echo  showError('login') ?></div>
                </div>
                <div class="Remember_Forgot_PassWord">
                    <label class="remember">
                        <input name="remember_me"type="checkbox" <?php if (!empty($_COOKIE['user_login'])) echo "checked";?> >
                        <p>Nhớ mật khẩu</p>
                    </label>

                    <div class="forgot">
                        <a href="QuenMatKhau.php">Quên mật khẩu</a>
                    </div>
                </div>

                <input class="btLogin" type="submit" value="Đăng Nhập">
            </form>
        </div>


        <div class="Loing_MXH">
            <div class="Loing_MXH Facebook">
                <img src="Image\DangNhap\fac.png" alt="">
                <a href="#">Facebook</a>
            </div>

            <div class="Loing_MXH Twitter">
                <img src="Image\DangNhap\twitter.png" alt="">
                <a href="#">Twitter</a>
            </div>
        </div>

        <div id="Register">
            <h4>Bạn mới biết đến Wibugangz?</h4>
            <a href="./dangky.php">Đăng Ký</a>
        </div>
    </div>
</body>

</html>