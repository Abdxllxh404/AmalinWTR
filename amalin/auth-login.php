<?php
require_once('connect.php');
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>เข้าสู่ระบบ - น้ำดื่มอมาลิน</title>
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
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.php"><img src="assets/images/logo/logo.png" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">เข้าสู่ระบบ</h1>
                    <p class="auth-subtitle mb-5">ลงชื่อเข้าใช้งานระบบ</p>

                    <form method="POST" name="login">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl" placeholder="อีเมล" id="email_acc"
                                name="email_acc" required>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" placeholder="รหัสผ่าน"
                                id="pass_acc" name="pass_acc" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block btn-lg shadow-lg mt-5" type="submit"
                            name="submit">เข้าสู่ระบบ</button>
                    </form>

                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">หากคุณยังไม่มีบัญชี?
                            <a href="auth-register.php" class="font-bold">ลงทะเบียน</a>
                        </p>
                        <p>
                            <a class="font-bold" href="auth-forgot-password.php">ลืมรหัสผ่าน?</a>
                        </p>
                    </div>
                    <hr>
                    <div class="text-center mt-5 text-lg">
                        <a class="font-bold" href="auth-admin-login.php">สำหรับเจ้าหน้าที่</a>
                    </div>
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
        if(isset($_POST['email_acc'])&&!empty($_POST["email_acc"])) 
        {
            $email_acc = stripcslashes($_POST['email_acc']);
            $email_acc = mysqli_real_escape_string($conn, $email_acc);
            $pass_acc = stripcslashes($_POST['pass_acc']);
            $pass_acc = mysqli_real_escape_string($conn, $pass_acc);
            
            //เช็คหาบัญชีผู้ใช้งานใน ฐานข้อมูล
            $sql = "SELECT * FROM tbl_acc WHERE email_acc= '$email_acc' AND pass_acc='".md5($pass_acc)."'";

            $result = mysqli_query($conn, $sql) or die(mysql_error());
            $rows = mysqli_num_rows($result);

            if($rows == 1){
                while($rows = $result->fetch_assoc()){
                    $_SESSION['id_acc'] = $rows["id_acc"];
                    $_SESSION['fname_acc'] = $rows["fname_acc"];
                    $_SESSION['lname_acc'] = $rows["lname_acc"];
                    $_SESSION['email_acc'] = $email_acc;
                    $_SESSION['p_acc'] = $rows["pass_acc"];
                    $_SESSION['tel_acc'] = $rows["tel_acc"];
                }
                echo    "<script>";
                echo    "window.location.href = 'index.php';";
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
                                    'email_acc').value = '$email_acc';
                        })";
                echo    "</script>";
            }
        }
    ?>