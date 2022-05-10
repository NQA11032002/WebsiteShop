<?php
require('Widget/Menu.php');
require('Widget/HoTro.php');

$dbServer = "localhost";
$dbUsername = "root";
$dbPass = "";
$dbname = "quanlyshop";
$conn = mysqli_connect($dbServer, $dbUsername, $dbPass, $dbname);

//thông tin thay đổi
$SDT = isset($_POST["SDT"]) ? $_POST["SDT"] : null;
$username = isset($_POST["username"]) ? $_POST["username"] : null;
$address = isset($_POST["address"]) ? $_POST["address"] : null;
$email = isset($_POST["email"]) ? $_POST["email"] : null;
$IDKH = isset($_SESSION['IDKH']) ? $_SESSION['IDKH'] : null;
$tenDangNhap = isset($_SESSION['tenDangNhap']) ? $_SESSION['tenDangNhap'] : null;
$ngaySinh = isset($_POST['birthday']) ? $_POST['birthday'] : null;
$gioiTinh = isset($_POST['gender']) ? $_POST['gender'] : null;

$avatar = isset($_SESSION['image']) ? $_SESSION['image'] : null;
$path = "\QuanLyShop\Image\KhachHang";
$changedAvatar = isset($_POST['file']) ? $path . "\\" . $_POST['file'] : null;

//mật khẩu thay đổi
$newPass = isset($_POST['new_password']) ? $_POST['new_password'] : null;
$confirmPass = isset($_POST['new_password_cf']) ? $_POST['new_password_cf'] : null;

//nhấn lưu thông tin
if (isset($_POST["btn_edit"])) {
    $sql = "SELECT * FROM taikhoan where taikhoan.ID = '" . $IDKH . "'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_array($result)) {
        $nowPassword = $row["matKhau"];

        if ($_POST['cur_password'] == $nowPassword) {
            $updateKH = "UPDATE `khachhang` SET `hoTen` = '" . $username . "' , `email` = '" . $email . "' , `diaChi` = '" . $address . "' , `gioiTinh` = '".$gioiTinh."' , ngaySinh = '".$ngaySinh."' , SDT = '" . $SDT . "' WHERE `khachhang`.`tenDangNhap` = '" . $tenDangNhap . "'";
            mysqli_query($conn, $updateKH);

            //Cập nhật lại thông tin hiển thị
            $_SESSION['hoTen'] = $username;
            $_SESSION['email'] = $email;
            $_SESSION['diachi'] = $address;
            $_SESSION['SDT'] = $SDT;
            $_SESSION['image'] = $changedAvatar;
            $_SESSION['ngaySinh'] = $ngaySinh;
            $_SESSION['gioiTinh'] = $gioiTinh;

        } else {
            $error["cur_password"] = "Mật khẩu hiện tại không chính xác";
        }
    }
}


//nhấn lưu mật khẩu
if (isset($_POST["btn_editPassWord"])) {
    $sql = "SELECT * FROM taikhoan where taikhoan.ID = '" . $IDKH . "'";
    $result = mysqli_query($conn, $sql);

    if ($row = mysqli_fetch_array($result)) {
        $nowPassword = $row["matKhau"];

        if ($_POST['cur_ChangedPassword'] == $nowPassword) {
            //mật khẩu mới và mật khẩu nhập trùng thì thay đổi mật khẩu
            if ($newPass == $confirmPass) {
                $updateKH = "UPDATE `taikhoan` SET `matKhau` = '" . $newPass . "' WHERE `taikhoan`.`ID` = '" . $IDKH . "'";
                mysqli_query($conn, $updateKH);
            } else {
                $error["cf_password"] = "Mật khẩu nhập lại không khớp với mật khẩu mới";
            }
        } else {
            $error["cur_ChangedPassword"] = "Mật khẩu hiện tại không chính xác";
        }
    }
}

mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/taiKhoan.css">
</head>

<body>
    <?php 
        if(isset($_SESSION['Logined']))
        { ?>
    <section class="account-container">
        <div class="title">
            <h1>Tài khoản</h1>
        </div>

        <div class="edit-account">
            <form action="" method="POST" id="form-account">
                <div class="account__avatar">
                    <img src="Image/KhachHang/2.jpg" alt="">
                    <input id="Changed_avatar" name="file" type="file">
                    <label for="Changed_avatar">Chọn ảnh</label>
                </div>

                <div class="account-left">
                    <div>
                        <h3>Thay đổi thông tin</h3>
                        <div class="col">
                            <div class="col-2">
                                <div class="row pd-r">
                                    <label>Tên hiển thị<span class="required">*</span></label>
                                    <input type="text" class="input-text" name="username" value="<?php echo $_SESSION['hoTen']; ?>">
                                </div>
                                <div class="row pd-l">
                                    <label for="gender">Giới tính</label>
                                    <div class="gender-container">
                                        <label for="male">Nam</label>
                                        <input type="radio" name="gender" id="male" value="Nam" <?php if(isset($_SESSION['gioiTinh'])) echo ($_SESSION['gioiTinh'] == "Nam") ? "checked" : "";  ?>>
                                        <label for="female">Nữ</label>
                                        <input type="radio" name="gender" id="female" value="Nữ" <?php if(isset($_SESSION['gioiTinh'])) echo ($_SESSION['gioiTinh'] == "Nữ") ? "checked" : "";  ?>>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="col">
                            <div class="col-2">
                                <div class="row pd-r">
                                    <label>Địa chỉ Email</label>
                                    <input type="text" class="input-text" name="email" value="<?php echo $_SESSION['email']; ?>" id="email">
                                </div>
                                <div class="row pd-l">
                                    <label>Địa chỉ giao hàng<span class="required">*</span></label>
                                    <input type="text" class="input-text" name="address" value="<?php echo $_SESSION['diachi']; ?>" id="address">
                                </div>
                            </div>

                            <div class="col-2">
                                <div class="row pd-r">
                                    <label>Số điện thoại<span class="required">*</span></label>
                                    <input type="text" class="input-text" name="SDT" value="<?php echo $_SESSION['SDT']; ?>" id="SDT">
                                </div>
                                <div class="row pd-l">
                                    <label for="birthday">Ngày sinh</label>
                                    <input type="date" name="birthday" id="birthday" value="<?php echo $_SESSION['ngaySinh'] ?>"> 
                                </div>
                            </div>

                            <div class="row">
                                <label>Mật khẩu hiện tại</label>
                                <input type="password" class="input-text" name="cur_password" value="">
                                <div class="input-error"><?php echo showError('cur_password') ?></div>
                            </div>
                        </div>
                        <input type="submit" name="btn_edit" value="Lưu thay đổi">
                    </div>
                </div>
            </form>

            <form action="" method="POST" id="form-password">
                <div class="account-right">
                    <h3>Thay đổi mật khẩu</h3>

                    <div class="row">
                        <label>Mật khẩu hiện tại</label>
                        <input type="password" class="input-text" name="cur_ChangedPassword" value="">
                        <div class="input-error"><?php echo showError('cur_ChangedPassword') ?></div>
                    </div>

                    <div class="row">
                        <label>Mật khẩu mới</label>
                        <input type="password" class="input-text" name="new_password" value="">
                    </div>
                    <div class="row">
                        <label>Xác nhận mật khẩu mới</label>
                        <input type="password" class="input-text" name="new_password_cf" value="">
                        <div class="input-error"><?php echo showError('cf_password') ?></div>
                    </div>

                    <input type="submit" name="btn_editPassWord" value="Đổi mật khẩu">
                </div>
            </form>
        </div>
    </section>
    <?php    }
    else
        { ?>
            <h1 align="center" style=" margin: 200px auto; width:100%; font-size: 20px">Vui lòng đăng nhập để xem thông tin</h1>
        <?php }
     ?>
</body>

</html>
<?php
require('Widget/Footer.php');
?>