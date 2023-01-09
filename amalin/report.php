<?php
    require_once('connect.php');
    include('auth-admin.php');

    $id_admin  = $_SESSION['id_admin'];
    $fname_admin = $_SESSION['fname_admin'];
    $lname_admin= $_SESSION['lname_admin'];
    $user_admin= $_SESSION['user_admin'];
    $pass_admin= $_SESSION['p_admin'];
    $tel_admin= $_SESSION['tel_admin'];

if(empty($_GET['searchByDay']) && empty($_GET['searchByMonth'])){
    $sql_order = "SELECT * FROM tbl_order";
    $result_order = $conn->query($sql_order) or die("Query failed");
}



if(isset($_GET['searchByDay'])){
    $dateSearch = $_GET['dateSearch'];

    $sql_order = "SELECT * FROM tbl_order WHERE date_d_ord = '$dateSearch' AND status_ord = 'success'";
    $result_order = $conn->query($sql_order) or die("Query failed");

    // echo    "<script>";
    // echo    "Swal.fire({
    //             position: 'center',
    //             icon: 'success',
    //             title: '$item1',
    //             showConfirmButton: false,
    //             timer: 6000,
    //             timerProgressBar: true
    //             })";
    // echo   "</script>";
}

if(isset($_GET['searchByMonth'])){
    $dateSearch = $_GET['dateSearch'];

    $sql_order = "SELECT * FROM tbl_order WHERE date_m_ord = '$dateSearch' AND status_ord = 'success'";
    $result_order = $conn->query($sql_order) or die("Query failed");

    // echo    "<script>";
    // echo    "Swal.fire({
    //             position: 'center',
    //             icon: 'success',
    //             title: '$item1',
    //             showConfirmButton: false,
    //             timer: 6000,
    //             timerProgressBar: true
    //             })";
    // echo   "</script>";
}
    
    date_default_timezone_set('Asia/Bangkok');


?>

<!DOCTYPE html>
<html lang="th_TH">

<head>
    <title>รายงาน - น้ำดื่มอมาลิน</title>
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

                        <li class="sidebar-item has-sub">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-person-lines-fill"></i>
                                <span>บัญชีผู้ใช้งาน</span>
                            </a>
                            <ul class="submenu">
                                <li class="submenu-item active">
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
                        <li class="sidebar-item active">
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
                            <h3>รายงาน</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="mng-page.php">หน้าแรก</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">รายงาน</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            ตารางรายงาน (แสดงเฉพาะรายการที่มีสถานะเป็น <span class="badge bg-success">"สำเร็จ"</span>)
                        </div>
                        <div class="card-body">
                            <div class="card-body">
                                <h5 class="card-herder mb-3">
                                    ค้นหา รายงาน
                                </h5>
                                <nav class="row">
                                    <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                        <button class="nav-link active col-6" id="nav-home-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-day" type="button" role="tab" aria-controls="nav-home"
                                            aria-selected="true">
                                            รายวัน
                                        </button>

                                        <button class="nav-link col-6" id="nav-profile-tab" data-bs-toggle="tab"
                                            data-bs-target="#nav-month" type="button" role="tab"
                                            aria-controls="nav-profile" aria-selected="false">
                                            รายเดือน
                                        </button>
                                    </div>
                                </nav>
                                <!-- แท็บค้นรายวัน -->
                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-day" role="tabpanel"
                                        aria-labelledby="nav-home-tab">
                                        <form method="GET">
                                            <div class="row">
                                                <div class="col-9 mt-3">
                                                    <input class="form-control" type="date" name="dateSearch" required>
                                                </div>
                                                <div class="col-3">
                                                    <button type="submit" class="btn btn-primary mt-3 col-12"
                                                        name="searchByDay">ค้นหา</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- แท็บค้นรายวัน -->

                                    <!-- แท็บค้นรายเดือน -->
                                    <div class="tab-pane fade" id="nav-month" role="tabpanel"
                                        aria-labelledby="nav-profile-tab">
                                        <form method="GET">
                                            <div class="row">
                                                <div class="col-9 mt-3">
                                                    <input class="form-control" type="month" name="dateSearch" required>
                                                </div>
                                                <div class="col-3">
                                                    <button type="submit" class="btn btn-primary mt-3 col-12"
                                                        name="searchByMonth">ค้นหา</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <!-- แท็บค้นรายเดือน -->

                                </div>
                            </div>

                            <table class="table table-striped" id="tableProduct">
                                <thead>
                                    <tr>
                                        <th class="text-center">รหัสคำสั่งซื้อ</th>
                                        <th class="text-center">ลูกค้า</th>
                                        <th class="text-center">สินค้า</th>
                                        <th class="text-center">ราคารวม</th>
                                        <th class="text-center">วันที่สร้างคำสั่ง</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row_order = $result_order->fetch_assoc()) {
                                        $id_acc = $row_order['id_acc'];
                                        $id_ord = $row_order['id_ord'];

                                    ?>
                                    <tr class="text-center">
                                        <td><?php echo $id_ord; ?></td>
                                        <td>
                                            <?php     
                                                $sql_acc_list = "SELECT * FROM tbl_acc WHERE id_acc = '$id_acc' ";
                                                $result_acc_list = $conn->query($sql_acc_list) or die("Query failed");
                                                while ($row_acc_list = $result_acc_list->fetch_assoc()) {
                                            ?>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center rounded-3 border border-1">
                                                <span><?php echo $row_acc_list['fname_acc'] ," ", $row_acc_list['lname_acc']; ?>
                                                </span>
                                            </li>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                        <td>
                                            <?php     
                                                        $sql_oder_list = "SELECT * FROM tbl_order_list WHERE id_ord = '$id_ord' ";
                                                        $result_oder_list = $conn->query($sql_oder_list) or die("Query failed");
                                                        while ($row_order_list = $result_oder_list->fetch_assoc()) {
                                                            // echo $row_order_list['name_ord_list'];
                                                            // echo $row_order_list['qty_ord_list'];
                                                            // echo $row_order_list['price_ord_list'];
                                                        ?>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center rounded-3 border border-1">
                                                <?php echo $row_order_list['name_ord_list']; ?>
                                                <span>จำนวน <span
                                                        class="badge bg-primary rounded-pill"><?php echo $row_order_list['qty_ord_list']; ?></span>
                                                    หน่วย</span>
                                            </li>
                                            <?php
                                                        }
                                                    ?>
                                        </td>
                                        <td><?php echo $row_order['all_price_ord']; ?></td>
                                        <td><?php echo $row_order['date_ord']; ?></td>
                                    </tr>
                                    <?php
                                    } 
                                    ?>
                                </tbody>
                            </table>
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
    // Simple Datatable
    let tableProduct = document.querySelector('#tableProduct');
    let dataTable = new simpleDatatables.DataTable(tableProduct);
    </script>

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
if(isset($_GET['action'])&& $_GET['action']=='delete'){
    $id_del = $_GET["id_del"];
    echo    "<script>";
    echo    "Swal.fire({
                title: 'ต้องการลบรายการนี้หรือไม่',
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'ยืนยันการลบ',
                cancelButtonText: 'ยกเลิก'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'mng-user.php?action=confirm-del&id_del=".$id_del."'
                }else{
                    window.location.href = 'mng-user.php'
                }
            });";
    echo   "</script>";
}


if(isset($_GET['action'])&& $_GET['action']=='confirm-del'){
    $id_del = $_GET["id_del"];

    $sql_del ="DELETE FROM tbl_acc WHERE id_acc='$id_del' ";
    $result_del = $conn->query($sql_del);

    echo    "<script>";
    echo    "Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'ลบสำเร็จ',
                showConfirmButton: false,
                timer: 600,
                timerProgressBar: true
                }).then((result) => {
                    window.location.href = 'mng-user.php'
                })";
    echo   "</script>";
}

?>