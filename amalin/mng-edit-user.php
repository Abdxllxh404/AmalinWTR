<?php

if(isset($_GET['action']) && $_GET['action']=='edit'){

    $id_edit = $_GET['id_edit'];

    require_once('connect.php');
    include('auth-admin.php');

    $id_admin  = $_SESSION['id_admin'];
    $fname_admin = $_SESSION['fname_admin'];
    $lname_admin= $_SESSION['lname_admin'];
    $user_admin= $_SESSION['user_admin'];
    $pass_admin= $_SESSION['p_admin'];
    $tel_admin= $_SESSION['tel_admin'];


    $sql_acc = "SELECT * FROM tbl_acc WHERE id_acc = '$id_edit'";
    $result_acc = $conn->query($sql_acc) or die("Query failed");
    $row_acc = $result_acc->fetch_assoc();

    $fname_acc = $row_acc['fname_acc'];
    $lname_acc = $row_acc['lname_acc'];
    $email_acc = $row_acc['email_acc'];
    $pass_acc = $row_acc['pass_acc'];
    $tel_acc = $row_acc['tel_acc'];
    // $addr_acc = $row_acc['addr_acc'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>บัญชีผู้ใช้งาน - น้ำดื่มอมาลิน</title>
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
                            <a href="mng-page.php"><img src="assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                        </div>
                        <div class="toggler">
                            <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <ul class="menu">
                        <li class="sidebar-title">เมนู ผู้ดูแลระบบ</li>

                        <li class="sidebar-item ">
                            <a href="mng-page.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>แดชบอร์ด</span>
                            </a>
                        </li>

                        <li class="sidebar-item active has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-person-lines-fill"></i>
                                <span>บัญชีผู้ใช้งาน</span>
                            </a>
                            <ul class="submenu active">
                                <li class="submenu-item ">
                                    <a href="mng-user.php">ผู้ใช้งานทั่วไป</a>
                                </li>
                                <li class="submenu-item ">
                                    <a href="mng-admin.php">ผู้ดูแลระบบ</a>
                                </li>
                            </ul>
                        </li>

                        <li class="sidebar-item">
                            <a href="product.php" class='sidebar-link'>
                                <i class="bi bi-bag-fill"></i>
                                <span>รายละเอียดสินค้า</span>
                            </a>
                        </li>
                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-ui-checks"></i>
                                <span>รายการสถานะ</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item">
                                    <a href="mng-status.php?status=pending">รอยืนยัน</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="mng-status.php?status=process">กำลังผลิต</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="mng-status.php?status=deliver">กำลังจัดส่ง</a>
                                </li>
                            </ul>
                        </li>
                        <li class="sidebar-item">
                            <a href="report.php" class='sidebar-link'>
                                <i class="bi bi-card-checklist"></i>
                                <span>รายงาน</span>
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
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>แก้ไขบัญชีผู้ใช้งาน</h3>
                            <p class="text-subtitle text-muted">แก้ไข บัญชีผู้ใช้งานทั่วไป</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="mng-page.php">หน้าแรก</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">บัญชีผู้ใช้งาน ชื่อ <?php echo $fname_acc; ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">บัญชี <?php echo $email_acc; ?></h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form method="POST">
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="first-name-column">ชื่อ</label>
                                                        <input type="text" id="first-name-column" class="form-control"
                                                            name="fname_acc" value="<?php echo $fname_acc; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="last-name-column">นามสกุล</label>
                                                        <input type="text" id="last-name-column" class="form-control"
                                                            name="lname_acc" value="<?php echo $lname_acc; ?>" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="city-column">เบอร์โทร</label>
                                                        <input type="text" id="city-column" class="form-control" pattern="[0-9]{10}" title="กรอกเฉพาะตัวเลข 10 หลัก"
                                                            name="tel_acc" value="<?php echo $tel_acc; ?>" required>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label for="addr_acc">ที่อยู่</label>
                                                        <textarea class="form-control" id="addr_acc" rows="3" name="addr_acc" required><?php echo $addr_acc; ?></textarea>
                                                    </div>
                                                </div> -->
                                                <div class="col-12 d-flex justify-content-end">
                                                    <a class="btn btn-danger me-3" href="mng-user.php">ยกเลิก</a>
                                                    <button class="btn btn-primary" type="submit" name="upd-acc">บันทึก</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
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
    fname_acc = '$fname_acc' , 
    lname_acc = '$lname_acc',
    tel_acc = '$tel_acc'
    WHERE id_acc = '$id_edit'";

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
                        window.location.href = 'mng-user.php';
                    })
                </script>";
        $conn->close();
    }else{
        echo "Error : ",mysqli_error($conn) ;
        $conn->close();
    }
}

}else{
echo "<script>";
echo "window.location = 'mng-user.php'";
echo "</script>";
}

?>