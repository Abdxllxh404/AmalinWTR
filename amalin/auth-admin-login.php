<?php
require_once('connect.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>เข้าสู่ระบบเจ้าหน้าที่ - น้ำดื่มอมาลิน</title>
    <?php
    include("head.php");
    ?>

    <style>
    .img-lg {
        position: fixed;
        bottom: 3%;
        right: 2%;
        margin-top: -50px;
        margin-left: -50px;
        height: 25%;
    }
    </style>
</head>



<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div class="d-flex justify-content-end mt-5 me-5 text-lg">
                <a class="btn-close" aria-label="Close" href="auth-login.php"></a>
                </div>
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="mng-page.php"><img src="assets/images/logo/logo.png" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">เข้าสู่ระบบ</h1>
                    <p class="auth-subtitle mb-5">*สำหรับเจ้าหน้าที่</p>

                    <form method="POST" name="login">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" placeholder="ชื่อผู้ใช้"
                                id="user_admin" name="user_admin" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="รหัสผ่าน"
                                id="pass_admin" name="pass_admin" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button class="btn btn-success btn-block btn-lg shadow-lg mt-5" type="submit"
                            name="submit">เข้าสู่ระบบ</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">
                    <img class="img-lg" src="assets/images/logo/LogoAmalin.png" alt="LogoAmalin">
                </div>
            </div>
        </div>
    </div>
    <?php
            include("script.php");
    ?>
</body>

</html>

<?php
        if(isset($_POST['user_admin'])&&!empty($_POST["user_admin"])) 
        {
            $user_admin = stripcslashes($_POST['user_admin']);
            $user_admin = mysqli_real_escape_string($conn, $user_admin);
            $pass_admin = stripcslashes($_POST['pass_admin']);
            $pass_admin = mysqli_real_escape_string($conn, $pass_admin);
            
            //เช็คหาบัญชีผู้ใช้งานใน ฐานข้อมูล
            $sql = "SELECT * FROM tbl_admin WHERE user_admin= '$user_admin' AND pass_admin='".md5($pass_admin)."'";

            $result = mysqli_query($conn, $sql) or die(mysql_error());
            $rows = mysqli_num_rows($result);

            if($rows == 1){
                while($rows = $result->fetch_assoc()){
                    $_SESSION['id_admin'] = $rows["id_admin"];
                    $_SESSION['fname_admin'] = $rows["fname_admin"];
                    $_SESSION['lname_admin'] = $rows["lname_admin"];
                    $_SESSION['user_admin'] = $user_admin;
                    $_SESSION['p_admin'] = $rows["pass_admin"];
                    $_SESSION['tel_admin'] = $rows["tel_admin"];
                }
                echo    "<script>";
                echo    "window.location.href = 'mng-page.php';";
                echo    "</script>";

            }else{
                echo    "<script>";
                echo    "Swal.fire({ 
                            position: 'center',
                            icon: 'error',
                            title: 'เข้าสู่ระบบ ไม่สำเร็จ',
                            confirmButtonText: 'เข้าสู่ระบบ อีกครั้ง',
                            timer: 2500,
                            timerProgressBar: true
                            }).then((result) => {
                                document.getElementById(
                                    'user_admin').value = '$user_admin';
                        })";
                echo    "</script>";
            }
        }
    ?>