<?php
    require_once('connect.php');
    include('auth-all.php');

    $id_acc = $_SESSION['id_acc'];

    $sql_acc = "SELECT * FROM tbl_acc WHERE id_acc = '$id_acc'";
    $result_acc = $conn->query($sql_acc) or die("Query failed");
    $row_acc = $result_acc->fetch_assoc();

    $fname_acc = $row_acc['fname_acc'];
    $lname_acc = $row_acc['lname_acc'];
    $email_acc = $row_acc['email_acc'];
    $pass_acc = $row_acc['pass_acc'];
    $tel_acc = $row_acc['tel_acc'];    


    $sql_status1 = "SELECT * FROM tbl_order WHERE id_acc = '$id_acc' AND status_ord = 'pending'";
    $result_status1 = $conn->query($sql_status1) or die("Query failed");
    // $row_status1 = $result_status1->fetch_assoc();
    $row_num_status1 = mysqli_num_rows($result_status1); 

    $sql_status2 = "SELECT * FROM tbl_order WHERE id_acc = '$id_acc' AND status_ord = 'process'";
    $result_status2 = $conn->query($sql_status2) or die("Query failed");
    // $row_status1 = $result_status1->fetch_assoc();
    $row_num_status2 = mysqli_num_rows($result_status2);

    $sql_status3 = "SELECT * FROM tbl_order WHERE id_acc = '$id_acc' AND status_ord = 'deliver'";
    $result_status3 = $conn->query($sql_status3) or die("Query failed");
    // $row_status1 = $result_status1->fetch_assoc();
    $row_num_status3 = mysqli_num_rows($result_status3);


    $sql_status4 = "SELECT * FROM tbl_order WHERE id_acc = '$id_acc' AND status_ord = 'success'";
    $result_status4 = $conn->query($sql_status4) or die("Query failed");
    // $row_status1 = $result_status1->fetch_assoc();
    $row_num_status4 = mysqli_num_rows($result_status4);




?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>หน้าแรก - น้ำดื่มอมาลิน</title>
    <?php 
include("head-main.php");
?>
</head>

<body>
    <div id="app">
        <div id="sidebar" class="active">
            <div class="sidebar-wrapper active">
                <div class="sidebar-header">
                    <div class="d-flex justify-content-between">
                        <div class="logo">
                            <a href="index.php"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">

                        <li class="sidebar-item active">
                            <a href="index.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>แดชบอร์ด</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="create_order.php" class='sidebar-link'>
                                <i class="bi bi-basket3-fill"></i>
                                <span>สั่งผลิตน้ำดื่ม</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="product_list.php" class='sidebar-link'>
                                <i class="bi bi-bag-fill"></i>
                                <span>รายละเอียดสินค้า</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <a href="status_order.php" class='sidebar-link'>
                                <i class="bi bi-box-seam"></i>
                                <span>ติดตามสถานะ</span>
                            </a>
                        </li>
                        <li class="sidebar-item">
                            <button class="btn btn-block sidebar-link text-danger border border-danger" id="btn-logout">
                                <i class="bi bi-power text-danger"></i>
                                <span>ออกจากระบบ</span>
                            </button>
                        </li>
                    </ul>
                </div>
                <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
            </div>
        </div>
        <div id="main">
            <header class="mb-3">
                <a href="#" class="burger-btn d-block d-xl-none">
                    <i class="bi bi-justify fs-3"></i>
                </a>
            </header>

            <div class="page-heading">
                <h3>หน้าแรก</h3>
            </div>

            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-12">
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body py-4 px-5 d-flex justify-content-between">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-xl">
                                                <img src="assets/images/faces/1.jpg" alt="Face 1">
                                            </div>
                                            <div class="ms-3 name">
                                                <h5 class="font-bold">ชื่อ : <?php echo $fname_acc ," ", $lname_acc; ?>
                                                </h5>
                                                <h6 class="text-muted mb-0">อีเมล : <?php echo $email_acc; ?></h6>
                                            </div>
                                        </div>
                                        <div class="card-content pt-2 pb-4">
                                            <div class="px-4">
                                                <button type="button" class="btn btn-warning mt-2 me-2"
                                                    data-bs-toggle="modal"
                                                    data-bs-target="#editSelfPass">เปลี่ยนรหัส</button>
                                                <button type="button" class="btn btn-warning mt-2"
                                                    data-bs-toggle="modal" data-bs-target="#editSelf">
                                                    แก้ไข
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                    <div class="col-12 col-md-6 col-lg-9">
                        <div class="row">
                            <div class="col-6 col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon bg-warning">
                                                    <i class="bi bi-hourglass-split"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">รอยืนยัน</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $row_num_status1; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon bg-primary">
                                                    <i class="bi bi-gear-wide-connected"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">กำลังผลิต</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $row_num_status2; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon bg-info">
                                                    <i class="bi bi-truck"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">กำลังส่ง</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $row_num_status3; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 col-lg-6 col-md-12">
                                <div class="card">
                                    <div class="card-body px-3 py-4-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="stats-icon bg-success">
                                                    <i class="bi bi-check-all"></i>
                                                </div>
                                            </div>
                                            <div class="col-md-8">
                                                <h6 class="text-muted font-semibold">สำเร็จ</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $row_num_status4; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6 col-lg-3">
                        <div class="card">
                            <div class="card-content pt-2 pb-4">
                                <div class="px-4">
                                    <a href="create_order.php" class="btn btn-block btn-xl btn-success font-bold mt-3"><i class="bi bi-basket3-fill"></i>   สั่งผลิตน้ำดื่ม</a>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-content pt-2 pb-4">
                                <div class="px-4">
                                    <a href="status_order.php" class="btn btn-block btn-xl btn-warning font-bold mt-3 text-dark"><i class="bi bi-box-seam"></i>   ติดตามสถานะ</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <footer>
                <div class="footer clearfix mb-0 text-muted">
                    <div class="float-start">
                        <p>2021 &copy; Amalin Water</p>
                    </div>
                    <div class="float-end">
                        <p>GNC</p>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- Modal Edit Self Information -->
    <div class="modal fade" id="editSelf" tabindex="-1" aria-labelledby="editSelfLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSelfLabel">แก้ไขข้อมูลส่วนตัว</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST">
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="first-name-column">ชื่อ</label>
                                    <input type="text" id="first-name-column" class="form-control" name="fname_acc"
                                        value="<?php echo $fname_acc; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="last-name-column">นามสกุล</label>
                                    <input type="text" id="last-name-column" class="form-control" name="lname_acc"
                                        value="<?php echo $lname_acc; ?>" required>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="form-group">
                                    <label for="city-column">เบอร์โทร</label>
                                    <input type="text" id="city-column" class="form-control" pattern="[0-9]{10}"
                                        title="กรอกเฉพาะตัวเลข 10 หลัก" name="tel_acc" value="<?php echo $tel_acc; ?>"
                                        required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                        <button class="btn btn-success" type="submit" name="upd-acc">บันทึก</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Edit password -->
    <div class="modal fade" id="editSelfPass" tabindex="-1" aria-labelledby="editSelfPassModal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editSelfPassModal">เปลี่ยนรหัสผ่าน</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form method="POST" onSubmit="return checkPassForCPass(this)">
                    <div class="modal-body">
                        <input type="hidden" class="form-control" name="CP_id_admin" value="<?php echo $id_acc; ?>">
                        <input type="hidden" class="form-control" name="checkmdpass" value="<?php echo $pass_acc; ?>">
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">รหัสผ่านเดิม:</label>
                            <input type="password" placeholder="รหัสผ่านเดิม (Old Password)" class="form-control"
                                name="CPass_old_admin" pattern=".{6,}" title="รหัสมากกว่า 6 ตัว" required>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">รหัสผ่าน:</label>
                            <input type="password" placeholder="รหัสผ่าน (Password)" class="form-control"
                                name="CPass_admin" pattern=".{6,}" title="รหัสมากกว่า 6 ตัว" required>
                        </div>
                        <div class="mb-3">
                            <label for="message-text" class="col-form-label">ยืนยันรหัสผ่าน:</label>
                            <input type="password" placeholder="ยืนยันรหัสผ่าน (Confirm Password)" class="form-control"
                                name="CPass_ag_admin" pattern=".{6,}" title="รหัสมากกว่า 6 ตัว" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">ยกเลิก</button>
                        <input type="submit" class="btn btn-success" name="CPass-confirm" value="ยืนยัน"></input>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    include("script.php");
    ?>

    <script>
    $("#btn-logout").click(function() {
        Swal.fire({
            title: 'ออกจากระบบหรือไม่',
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'ยืนยันออกจากระบบ',
            cancelButtonText: 'ยกเลิก'
        }).then((result) => {
            if (result.isConfirmed) {
                location = 'auth-logout.php';
            }
        })
    });
    </script>

    <script>
    // Function เพื่อตรวจสอบรหัสผ่านว่าตรงกันหรือไม่
    function checkPassForCPass(form) {
        CPass_admin = form.CPass_admin.value;
        CPass_ag_admin = form.CPass_ag_admin.value;

        if (CPass_admin != CPass_ag_admin) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'รหัสผ่านไม่ตรงกัน',
                confirmButtonText: 'ตกลง',
                confirmButtonColor: '#F42444',
                timer: 1500,
                timerProgressBar: true
            })
            return false;
        }
    }
    </script>

</body>

</html>


<?php
if(isset($_POST["upd-acc"])){
    $fname_acc = $_POST['fname_acc'];
    $lname_acc = $_POST["lname_acc"];
    $tel_acc = $_POST["tel_acc"];
    // $addr_acc = $_POST["addr_acc"];

    $query = "UPDATE tbl_acc 
    SET 
    fname_acc = '$fname_acc', 
    lname_acc = '$lname_acc',
    tel_acc = '$tel_acc'
    WHERE id_acc = '$id_acc'";

    if($conn->query($query)){
        echo "<script>
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'เปลี่ยนแปลงข้อมูลสำเร็จ',
                    showConfirmButton: false,
                    timer: 900,
                    timerProgressBar: true
                    }).then((result) => {
                        window.location.href = 'index.php';
                    })
                </script>";
        $conn->close();
    }else{
        echo "Error : ",mysqli_error($conn) ;
        $conn->close();
    }
}


if(isset($_POST["CPass-confirm"])){
    $checkmdpass = $_POST['checkmdpass'];
    $CPass_old_admin = $_POST['CPass_old_admin'];

    $CPass_old_adminEc = md5($CPass_old_admin);
    
    $CP_id_admin = $_POST['CP_id_admin'];
    $pass_admin = $_POST["CPass_admin"];

    $pass_adminEc = md5($pass_admin);

    if($checkmdpass == $CPass_old_adminEc){

        $query = "UPDATE tbl_acc 
        SET 
        pass_acc = '$pass_adminEc'
        WHERE id_acc = '$id_acc'";

        if($conn->query($query)){
            echo "<script>
                        Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'เปลี่ยนรหัสผ่านสำเร็จ',
                        showConfirmButton: false,
                        timer: 900,
                        timerProgressBar: true
                        }).then((result) => {
                            window.location.href = 'index.php';
                        })
                    </script>";
            $conn->close();
        }else{
            echo "Error : ",mysqli_error($conn) ;
            $conn->close();
        }
    }else{
        echo "  <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'error',
                        title: 'รหัสผ่านเดิมไม่ถูกต้อง',
                        confirmButtonText: 'ตกลง',
                        confirmButtonColor: '#F42444',
                        timer: 1500,
                        timerProgressBar: true
                    })
                </script>";
            $conn->close();
    }
}
?>