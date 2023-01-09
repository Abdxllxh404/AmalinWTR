<?php
    require_once('connect.php');
    include('auth-admin.php');

    $id_admin  = $_SESSION['id_admin'];
    $fname_admin = $_SESSION['fname_admin'];
    $lname_admin= $_SESSION['lname_admin'];
    $user_admin= $_SESSION['user_admin'];
    $pass_admin= $_SESSION['p_admin'];
    $tel_admin= $_SESSION['tel_admin'];

    date_default_timezone_set('Asia/Bangkok');
    $dateNow = date("Y-m-d");
    $dateNowThai = date("d-m-Y");

    $sql_status1 = "SELECT * FROM tbl_order WHERE status_ord = 'pending'";
    $result_status1 = $conn->query($sql_status1) or die("Query failed");
    // $row_status1 = $result_status1->fetch_assoc();
    $row_num_status1 = mysqli_num_rows($result_status1); 

    $sql_status2 = "SELECT * FROM tbl_order WHERE status_ord = 'process'";
    $result_status2 = $conn->query($sql_status2) or die("Query failed");
    // $row_status1 = $result_status1->fetch_assoc();
    $row_num_status2 = mysqli_num_rows($result_status2);

    $sql_status3 = "SELECT * FROM tbl_order WHERE status_ord = 'deliver'";
    $result_status3 = $conn->query($sql_status3) or die("Query failed");
    // $row_status1 = $result_status1->fetch_assoc();
    $row_num_status3 = mysqli_num_rows($result_status3);


    $sql_status4 = "SELECT * FROM tbl_order WHERE status_ord = 'success' AND date_tsp_ord = '$dateNow'";
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

                        <li class="sidebar-item active ">
                            <a href="mng-page.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>แดชบอร์ด</span>
                            </a>
                        </li>

                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-person-lines-fill"></i>
                                <span>บัญชีผู้ใช้งาน</span>
                            </a>
                            <ul class="submenu ">
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
                <h3>หน้าแรก</h3>
            </div>
            <div class="page-content">
                <section class="row">
                    <div class="col-12 col-lg-9">
                        <div class="row">
                            <div class="col-12 col-lg-12">
                                <div class="card">
                                    <div class="card-body py-4 px-5">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar avatar-xl">
                                                <img src="assets/images/faces/2.jpg" alt="Face 2">
                                            </div>
                                            <div class="ms-3 name">
                                                <h5 class="font-bold">ชื่อ :
                                                    <?php echo $fname_admin ," ", $lname_admin; ?>
                                                </h5>
                                                <h6 class="text-muted mb-0">ชื่อผู้ใช้ : <?php echo $user_admin; ?></h6>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-lg-3">
                        <div class="card">
                            <div class="card-content pt-2 pb-4">
                                <div class="px-4">
                                    <button
                                        class="btn btn-block btn-xl btn-danger font-bold mt-3 btn-logout">ออกจากระบบ</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6 col-lg-12">
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
                                            <div class="col-md-6 text-center mb-4">
                                                <h6 class="text-muted font-semibold">รอยืนยัน</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $row_num_status1; ?></h6>
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <a href="mng-status.php?status=pending"
                                                    class="btn btn-warning">จัดการ</a>
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
                                            <div class="col-md-6 text-center mb-4">
                                                <h6 class="text-muted font-semibold">กำลังผลิต</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $row_num_status2; ?></h6>
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <a href="mng-status.php?status=process"
                                                    class="btn btn-primary">จัดการ</a>
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
                                            <div class="col-md-6 text-center mb-4">
                                                <h6 class="text-muted font-semibold">กำลังส่ง</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $row_num_status3; ?></h6>
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <a href="mng-status.php?status=deliver" class="btn btn-info">จัดการ</a>
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
                                            <div class="col-md-6 text-center mb-4">
                                                <h6 class="text-muted font-semibold">สำเร็จ (วันนี้
                                                    <?php echo $dateNowThai; ?>)</h6>
                                                <h6 class="font-extrabold mb-0"><?php echo $row_num_status4; ?></h6>
                                            </div>
                                            <div class="col-md-2 text-center">
                                                <a href="report.php" class="btn btn-success">ดูรายงาน</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="card p-2">
                                <div class="card-header">
                                    <h4>ยอดขายสินค้า</h4>
                                </div>
                                <div class="card-body">
                                    <div>
                                        <div class="table-responsive">
                                            <table class="table mb-0 table-lg">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">ชื่อสินค้า</th>
                                                        <th class="text-center">จำนวนยอดขายรวม (รายการ)</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                        $sql_sales = "SELECT * FROM tbl_order_list GROUP BY name_ord_list";
                                                        $result_sales = $conn->query($sql_sales) or die("Query failed");


                                                        while ($row_sales = $result_sales->fetch_assoc()) {
                                                            $name_sales = $row_sales['name_ord_list'];

                                                            $sql_rowsales = "SELECT * FROM tbl_order_list WHERE name_ord_list = '$name_sales'";
                                                            $result_rowsales = $conn->query($sql_rowsales) or die("Query failed");
                                                            $row_num_rowsales = mysqli_num_rows($result_rowsales);
                                                    ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo $row_sales['name_ord_list'];  ?></td>
                                                        <td class="text-center"><?php echo $row_num_rowsales;  ?> รายการ</td>
                                                    </tr>
                                                    <?php
                                                        }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
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

    $(".btn-logout").click(function() {
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