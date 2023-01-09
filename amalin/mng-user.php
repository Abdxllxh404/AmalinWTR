<?php
    require_once('connect.php');
    include('auth-admin.php');

    $id_admin  = $_SESSION['id_admin'];
    $fname_admin = $_SESSION['fname_admin'];
    $lname_admin= $_SESSION['lname_admin'];
    $user_admin= $_SESSION['user_admin'];
    $pass_admin= $_SESSION['p_admin'];
    $tel_admin= $_SESSION['tel_admin'];


    $sql_acc = "SELECT * FROM tbl_acc";
    $result_acc = $conn->query($sql_acc) or die("Query failed");

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
                            <h3>บัญชีผู้ใช้งานทั่วไป</h3>
                            <p class="text-subtitle text-muted">เพิ่ม ลบ แก้ไข บัญชีผู้ใช้งานทั่วไป</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="mng-page.php">หน้าแรก</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">บัญชีผู้ใช้งานทั่วไป</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header">
                            ตาราง บัญชีผู้ใช้งานทั่วไป
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="tableProduct">
                                <thead>
                                    <tr>
                                        <th class="text-center">ชื่อ</th>
                                        <th class="text-center">นามสกุล</th>
                                        <th class="text-center">อีเมล</th>
                                        <th class="text-center">เบอร์โทร</th>
                                        <th class="text-center">แก้ไข</th>
                                        <th class="text-center">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row_acc = $result_acc->fetch_assoc()) {
                                        $id_acc = $row_acc['id_acc'];
                                    ?>
                                    <tr class="text-center">
                                        <td><?php echo $row_acc['fname_acc']; ?></td>
                                        <td><?php echo $row_acc['lname_acc']; ?></td>
                                        <td><?php echo $row_acc['email_acc']; ?></td>
                                        <td><?php echo $row_acc['tel_acc']; ?></td>

                                        <td>
                                            <a class="btn btn-warning" href="mng-edit-user.php?action=edit&id_edit=<?php echo $id_acc; ?>">แก้ไข</a>
                                        </td>
                                        <td>
                                            <a class="btn btn-danger" href="mng-user.php?action=delete&id_del=<?php echo $id_acc; ?>">ลบ</a>
                                        </td>
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