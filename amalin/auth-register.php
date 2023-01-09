<?php
    require_once('connect.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ลงทะเบียน - น้ำดื่มอมาลิน</title>
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
                    <h1 class="auth-title">ลงทะเบียน</h1>
                    <p class="auth-subtitle mb-5">สร้างบัญชีของคุณเอง</p>

                    <form method="POST" onSubmit="return checkPass(this)">
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" name="fname_acc" placeholder="ชื่อ"
                                required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" name="lname_acc"
                                placeholder="นามสกุล" required>
                            <div class="form-control-icon">
                                <i class="bi bi-person"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="text" class="form-control form-control-xl" name="tel_acc" pattern="[0-9]{10}"
                                title="กรอกเฉพาะตัวเลข 10 หลัก" placeholder="เบอร์โทร" required>
                            <div class="form-control-icon">
                                <i class="bi bi-telephone"></i>
                            </div>
                        </div>
                        <!-- <div class="form-group position-relative has-icon-left mb-4" name="addr_acc">
                            <div class="form-group mb-3">
                                <textarea class="form-control form-control-xl" rows="3" placeholder="ที่อยู่" name="addr_acc"
                                    required></textarea>
                                <div class="form-control-icon">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                            </div>
                        </div> -->
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" class="form-control form-control-xl" name="email_acc"
                                placeholder="อีเมล" required>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="pass_acc"
                                pattern=".{6,}" title="รหัสมากกว่า 6 ตัว" placeholder="รหัสผ่าน" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" class="form-control form-control-xl" name="pass_ag_acc"
                                pattern=".{6,}" title="รหัสมากกว่า 6 ตัว" placeholder="ยืนยันรหัสผ่าน" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <input class="btn btn-primary btn-block btn-lg shadow-lg mt-5" name="conf_register"
                            type="submit" value="ลงทะเบียน">
                    </form>

                    <div class="text-center mt-5 text-lg fs-4">
                        <p class='text-gray-600'>หากคุณมีบัญชีอยู่แล้ว? <a href="auth-login.php"
                                class="font-bold">ล็อคอิน</a></p>
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
if(isset($_POST["conf_register"])&&!empty($_POST["conf_register"]))
{
    $fname_acc = $_POST["fname_acc"];
    $lname_acc = $_POST["lname_acc"];
    $email_acc = $_POST["email_acc"];
    $pass_acc = $_POST["pass_acc"];
    $tel_acc = $_POST["tel_acc"];
    // $addr_acc = $_POST["addr_acc"];

    $pass_accEc = md5($pass_acc);

	$check = "SELECT email_acc
	FROM tbl_acc
	WHERE email_acc = '$email_acc'";
    $resultCheck = mysqli_query($conn, $check) or die(mysqli_error());
    $numRow = mysqli_num_rows($resultCheck);

    if($numRow > 0)
    {
    echo    "<script>";
    echo    "Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'อีเมลนี้อยู่ในระบบแล้ว!',
                text: 'กรุณาตรวจสอบใหม่อีกครั้ง',
                confirmButtonText: 'ตกลง',
                timer: 2500,
                timerProgressBar: true
                })";
    echo   "</script>";
    }else{
        $sql = "INSERT INTO tbl_acc (id_acc, fname_acc, lname_acc, email_acc, pass_acc, tel_acc)
        VALUES (null, '$fname_acc', '$lname_acc', '$email_acc', '$pass_accEc', '$tel_acc')";
        $result = mysqli_query($conn, $sql) or die (mysqli_error());

        if($result){
            echo    "<script>";
            echo    "Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'ลงทะเบียนสำเร็จ',
                        showConfirmButton: false,
                        timer: 1200,
                        timerProgressBar: true
                        }).then((result) => {
                            window.location.href = 'auth-login.php';
                        })";
            echo   "</script>";
        }else{
            echo "<script type='text/javascript'>";
            echo "window.location = 'logout.php'; ";
            echo "</script>";
        }
    }
        mysqli_close($conn);

}
?>