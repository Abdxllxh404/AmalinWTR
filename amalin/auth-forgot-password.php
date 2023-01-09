<?php
    require_once('connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ลืมรหัสผ่าน - น้ำดื่มอมาลิน</title>
    <?php
    include("head.php");
    ?>
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="index.php"><img src="assets/images/logo/logo.png" alt="Logo"></a>
                    </div>
                    <h1 class="auth-title">ลืมรหัสผ่าน</h1>
                    <p class="auth-subtitle mb-5">กรอกข้อมูลให้เหมือนตอนลงทะเบียน เพื่อแก้ไขรหัสผ่านใหม่</p>

                    <form method="POST" onSubmit="return checkPass(this)">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" name="tel_acc" pattern="[0-9]{10}"
                                title="กรอกเฉพาะตัวเลข 10 หลัก" placeholder="เบอร์โทร" required>
                            <div class="form-control-icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl" name="email_acc"
                                placeholder="อีเมล" required>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="pass_acc"
                                pattern=".{6,}" title="รหัสมากกว่า 6 ตัว" placeholder="รหัสผ่านใหม่" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="pass_ag_acc"
                                pattern=".{6,}" title="รหัสมากกว่า 6 ตัว" placeholder="ยืนยันรหัสผ่านใหม่" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <input class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="conf_forgotRst"
                            type="submit" value="ตกลง">
                    </form>
                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>จำรหัสผ่านได้แล้ว? <a href="auth-login.php"
                                class="font-bold">ล็อคอิน</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7 d-none d-lg-block">
                <div id="auth-right">

                </div>
            </div>
        </div>
    </div>

    <script>
    // Function เพื่อตรวจสอบรหัสผ่านว่าตรงกันหรือไม่
    function checkPass(form) {
        pass_acc = form.pass_acc.value;
        pass_ag_acc = form.pass_ag_acc.value;

        if (pass_acc != pass_ag_acc) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'รหัสผ่านไม่ตรงกัน',
                confirmButtonColor: '#F42444',
                confirmButtonText: 'กรอกรหัสผ่านใหม่',
                timer: 1500,
                timerProgressBar: true
            })
            return false;
        }
    }
    </script>

    <?php
    include("script.php");
    ?>
</body>

</html>

<?php
//ตรวจสอบการคลิกตกลง
    if(isset($_POST["conf_forgotRst"])&&!empty($_POST["conf_forgotRst"])){
        $email_acc = $_POST["email_acc"];
        $pass_acc = $_POST["pass_acc"];
        $tel_acc = $_POST["tel_acc"];
        //เข้ารหัส MD5
        $pass_accEc = md5($pass_acc);

    //ตรวจสอบหาเบอร์โทร ที่กรอกมา ไปเปรียบเทียบกับในฐานข้อมูล
        $checkRowTel = "SELECT tel_acc
        FROM tbl_acc
        WHERE tel_acc = '$tel_acc'";
        $resultCheckRowTel = mysqli_query($conn, $checkRowTel) or die(mysqli_error());
        $rowTel = mysqli_num_rows($resultCheckRowTel);



    //ตรวจสอบหาอีเมล ที่กรอกมา ไปเปรียบเทียบกับในฐานข้อมูล
        $checkRowEmail = "SELECT email_acc
        FROM tbl_acc
        WHERE email_acc = '$email_acc'";
        $resultCheckRowEmail = mysqli_query($conn, $checkRowEmail) or die(mysqli_error());
        $rowEmail = mysqli_num_rows($resultCheckRowEmail);

    //ถ้าเจอเบอร์ในฐานข้อมูล เหมือนกับที่กรอกมา
        if($rowTel > 0){
            $checkTel = "SELECT tel_acc
            FROM tbl_acc
            WHERE email_acc = '$email_acc'";
            $resultCheckTel = mysqli_query($conn, $checkTel) or die(mysqli_error());
            $rowsCheckTell = $resultCheckTel->fetch_assoc();

            $tel_accCheck = $rowsCheckTell["tel_acc"];

        //ถ้าเจอเบอร์ในฐานข้อมูล เหมือนกับที่กรอกมา
            if($rowEmail == 1){
                $checkEmail = "SELECT email_acc
                FROM tbl_acc
                WHERE email_acc = '$email_acc'";
                $resultCheckEmail = mysqli_query($conn, $checkEmail) or die(mysqli_error());
                $rowsCheckEmail = $resultCheckEmail->fetch_assoc();
                
                $email_accCheck = $rowsCheckEmail["email_acc"];

            //ตรวจสอบเปรียบเทียบเบอร์และอีเมลตรงกันหรือไม่
                if($tel_acc == $tel_accCheck && $email_acc == $email_accCheck){
                    $sqlForgotRst = "UPDATE tbl_acc 
                    SET  pass_acc = '$pass_accEc'
                    WHERE email_acc  = '$email_acc'";

                    if($conn->query($sqlForgotRst)){
                        echo    "<script>";
                        echo    "Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'เปลี่ยนรหัสใหม่สำเร็จ',
                                    confirmButtonText: 'ตกลง',
                                    timer: 2500,
                                    timerProgressBar: true
                                    }).then((result) => {
                                        window.location.href = 'auth-login.php';
                                    })";
                        echo   "</script>";
                        $conn->close();
                    }else{
                        echo "Error : ",mysqli_error($conn) ;
                        $conn->close();
                    }
                }else{
                    echo    "<script>";
                    echo    "Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'เบอร์โทรและอีเมลไม่ตรงกัน',
                                text: 'กรุณาตรวจสอบใหม่อีกครั้ง',
                                confirmButtonText: 'ตกลง',
                                timer: 2500,
                                timerProgressBar: true
                                })";
                    echo   "</script>";
                    $conn->close();
                }
            }else{
                echo    "<script>";
                echo    "Swal.fire({
                            position: 'center',
                            icon: 'error',
                            title: 'ไม่พบอีเมลนี้ในระบบ',
                            text: 'กรุณาตรวจสอบใหม่อีกครั้ง',
                            confirmButtonText: 'ตกลง',
                            timer: 2500,
                            timerProgressBar: true
                            })";
                echo   "</script>";
                $conn->close();
            }
        }else if($rowTel == 0 && $rowEmail == 0){
            echo    "<script>";
            echo    "Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'ไม่พบข้อมูลเบอร์โทรและอีเมลนี้ในระบบ',
                        text: 'กรุณาตรวจสอบใหม่อีกครั้ง',
                        confirmButtonText: 'ตกลง',
                        timer: 2500,
                        timerProgressBar: true
                        })";
            echo   "</script>";
            $conn->close();
        }else{
            echo    "<script>";
            echo    "Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'ไม่พบเบอร์นี้ในระบบ',
                        text: 'กรุณาตรวจสอบใหม่อีกครั้ง',
                        confirmButtonText: 'ตกลง',
                        timer: 2500,
                        timerProgressBar: true
                        })";
            echo   "</script>";
            $conn->close();
        }
    }
?>