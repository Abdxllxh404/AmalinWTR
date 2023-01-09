<?php
    require_once('connect.php');
    include('auth-admin.php');

    $id_admin  = $_SESSION['id_admin'];
    $fname_admin = $_SESSION['fname_admin'];
    $lname_admin= $_SESSION['lname_admin'];
    $user_admin= $_SESSION['user_admin'];
    $pass_admin= $_SESSION['p_admin'];
    $tel_admin= $_SESSION['tel_admin'];

    
    $status = "";
    $stats_sql = "0";
    

    if(empty($_GET['status'])){
        echo "<script type='text/javascript'>";
        echo "window.location = 'mng-page.php'; ";
        echo "</script>";
    }else if(!empty($_GET['status'] == 'pending')){
        $span_status1 = "<span class='badge bg-warning text-dark'>";
        $status = "รอยืนยัน";
        $span_status2 = "</span>";
        $stats_sql = "pending";
    }else if(!empty($_GET['status'] == 'process')){
        $span_status1 = "<span class='badge bg-primary'>";
        $status = "กำลังผลิต";
        $span_status2 = "</span>";
        $stats_sql = 'process';
    }else if(!empty($_GET['status'] == 'deliver')){
        $span_status1 = "<span class='badge bg-info'>";
        $status = "กำลังส่ง";
        $span_status2 = "</span>";
        $stats_sql = 'deliver';
    }else if(!empty($_GET['status'] == 'cancel')){
        $span_status1 = "<span class='badge bg-danger'>";
        $status = "ยกเลิก";
        $span_status2 = "</span>";
        $stats_sql = 'cancel';
    }else if(!empty($_GET['status'] == 'success')){
        // $span_status1 = "<span class='badge bg-success'>";
        // $status = "สำเร็จ";
        // $span_status2 = "</span>";

        echo "<script type='text/javascript'>";
        echo "window.location = 'report.php'; ";
        echo "</script>";

    }else{
        echo "<script type='text/javascript'>";
        echo "window.location = 'mng-page.php'; ";
        echo "</script>";
    }
    // $stats_sql = $_GET['status'];
    $sql_oder = "SELECT * FROM tbl_order WHERE status_ord = '$stats_sql' ";
    $result_oder = $conn->query($sql_oder) or die("Query failed");


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>สถานะ - น้ำดื่มอมาลิน</title>
    <?php 
include("head-main.php");
?>
    <style>
    @media print {
        body * {
            visibility: hidden;
        }

        #section-to-print,
        #section-to-print * {
            visibility: visible;
        }

        #section-to-print {
            position: absolute;
            left: 0;
            top: 0;
        }
        #non-printable {
            display: none;
        }
    }
    </style>
    <script>
// Popup window code
function newWindow(url) {
	popupWindow = window.open(
		url,
		'popUpWindow','width=100%,left=100,top=100,resizable=yes,scrollbars=yes,toolbar=yes,menubar=no,location=no,directories=no,status=yes')
}

function closeWindow()
{

      alert('That window is already closed. Open the window first and try again!');

}
</script>
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
                                <li class="submenu-item">
                                    <a href="mng-user.php">ผู้ใช้งานทั่วไป</a>
                                </li>
                                <li class="submenu-item">
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

                        <li class="sidebar-item has-sub active">
                            <a href="#" class='sidebar-link'>
                                <i class="bi bi-ui-checks"></i>
                                <span>รายการสถานะ</span>
                            </a>
                            <ul class="submenu active">
                                <?php
                                    if($_GET['status'] == 'pending'){
                                ?>
                                <li class="submenu-item active">
                                    <a href="mng-status.php?status=pending">รอยืนยัน</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="mng-status.php?status=process">กำลังผลิต</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="mng-status.php?status=deliver">กำลังจัดส่ง</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="mng-status.php?status=cancel">ยกเลิก</a>
                                </li>
                                <?php
                                    }else if($_GET['status'] == 'process'){
                                ?>
                                <li class="submenu-item">
                                    <a href="mng-status.php?status=pending">รอยืนยัน</a>
                                </li>
                                <li class="submenu-item active">
                                    <a href="mng-status.php?status=process">กำลังผลิต</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="mng-status.php?status=deliver">กำลังจัดส่ง</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="mng-status.php?status=cancel">ยกเลิก</a>
                                </li>
                                <?php   
                                    }else if($_GET['status'] == 'deliver'){
                                ?>
                                <li class="submenu-item">
                                    <a href="mng-status.php?status=pending">รอยืนยัน</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="mng-status.php?status=process">กำลังผลิต</a>
                                </li>
                                <li class="submenu-item active">
                                    <a href="mng-status.php?status=deliver">กำลังจัดส่ง</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="mng-status.php?status=cancel">ยกเลิก</a>
                                </li>
                                <?php   
                                    }else if($_GET['status'] == 'cancel'){
                                ?>
                                <li class="submenu-item">
                                    <a href="mng-status.php?status=pending">รอยืนยัน</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="mng-status.php?status=process">กำลังผลิต</a>
                                </li>
                                <li class="submenu-item">
                                    <a href="mng-status.php?status=deliver">กำลังจัดส่ง</a>
                                </li>
                                <li class="submenu-item active">
                                    <a href="mng-status.php?status=cancel">ยกเลิก</a>
                                </li>
                                <?php   
                                    }
                                ?>
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
                            <h3>รายการสถานะ <?php echo $span_status1 , $status , $span_status2; ?></h3>
                            <!-- <p class="text-subtitle text-muted">เพิ่ม ลบ แก้ไข บัญชีผู้ใช้งานทั่วไป</p> -->
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="mng-page.php">หน้าแรก</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">รายการสถานะ
                                        <?php echo $status; ?></li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
                <section class="section">
                    <div class="card">
                        <div class="card-body" id="section-to-print">
                            <div class="d-flex bd-highlight">
                                <div class="p-2 w-100 bd-highlight">
                                    <h5>รายการสถานะ <?php echo $status ; ?></h5>
                                </div>
                                <div class="p-2 flex-shrink-1 bd-highlight" id="non-printable">
                                    <?php  
                                        if($_GET['status'] == 'deliver'){
                                    ?>
                                    <!-- <a id="non-printable" href="javascript:window.print('mng-status-print.php?status=deliver')" class="btn btn-primary">
                                        <i class="fa fa-print"></i>
                                        พิมพ์
                                    </a> -->
                                    <button id="non-printable" onClick="JavaScript:newWindow('http://geehaw/amalin_project/src/mng-status-print.php?status=deliver')" class="btn btn-primary">พิมพ์
                                    </button>

                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>

                            <table class="table table-striped" id="tableProduct">
                                <thead>
                                    <tr>

                                        <?php  
                                                if($_GET['status'] == 'process' || $_GET['status'] == 'deliver'){
                                        ?>
                                        <th class="text-center">วันที่ต้องการให้ส่ง</th>
                                        <?php
                                                }else{
                                        ?>
                                        <th class="text-center">วันที่สร้างคำสั่ง</th>
                                        <?php
                                            }
                                        ?>

                                        <th class="text-center">ขนาด/ปริณมาณรวม</th>
                                        <th class="text-center">ราคารวม</th>
                                        <th class="text-center">รายละเอียด คำสั่งซื้อ</th>

                                        <?php  
                                                if($_GET['status'] == 'deliver'){
                                        ?>
                                        <th class="text-center">รายละเอียดพื้นที่จัดส่ง</th>
                                        <?php
                                                }
                                        ?>

                                        <?php  
                                                if($_GET['status'] == 'cancel'){
                                        ?>
                                        <th class="text-center">สถานะ</th>
                                        <?php
                                            }else{
                                        ?>
                                        <th class="text-center">เปลี่ยนสถานะ</th>
                                        <?php
                                            }
                                        ?>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row_order = $result_oder->fetch_assoc()) {
                                        $id_acc = $row_order['id_acc'];
                                        $id_ord = $row_order['id_ord'];
                                    ?>
                                    <tr class="text-center">
                                        
                                        <?php  
                                            if($_GET['status'] == 'process' || $_GET['status'] == 'deliver'){
                                        ?>
                                        <td><?php echo $row_order['date_tsp_ord']; ?></td>
                                        <?php
                                            }else{
                                        ?>
                                        <td><?php echo $row_order['date_ord']; ?></td>                            
                                        <?php
                                            }
                                        ?>

                                        <td><?php echo $row_order['all_size_ord']; ?> มิลลิลิตร</td>
                                        <td><?php echo $row_order['all_price_ord']; ?> บาท</td>

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

                                        <?php  
                                                if($_GET['status'] == 'deliver'){
                                        ?>
                                        <td>
                                            <?php     
                                                        $sql_oder_list = "SELECT * FROM tbl_order WHERE id_ord = '$id_ord' ";
                                                        $result_oder_list = $conn->query($sql_oder_list) or die("Query failed");
                                                        while ($row_order_list = $result_oder_list->fetch_assoc()) {
                                                        ?>
                                            <li
                                                class="list-group-item d-flex justify-content-between align-items-center rounded-3 border border-1">
                                                <?php echo $row_order_list['detail_ord']; ?>
                                                <span>พิกัด
                                                    <a target="_blank"
                                                        href="http://maps.google.com/maps?&z=15&mrt=yp&t=k&q=<?php echo $row_order_list['lat_loca']; ?>+<?php echo $row_order_list['long_loca']; ?>"
                                                        class="badge bg-primary ">คลิกดูแผนที่</a>
                                                </span>
                                            </li>
                                            <?php
                                                        }
                                                    ?>
                                        </td>
                                        <?php
                                                }
                                        ?>

                                        <td>
                                            <?php  
                                                if($_GET['status'] == 'pending'){
                                            ?>
                                            <a class="btn btn-primary m-2"
                                                href="mng-status.php?status=pending&action=setStatus&updStatus=toProcess&id_ord=<?php echo $id_ord; ?>"><i class="bi bi-gear-wide-connected"></i> กำลังผลิต</a>

                                            <a class="btn btn-info m-2"
                                                href="mng-status.php?status=pending&action=setStatus&updStatus=toDeliver&id_ord=<?php echo $id_ord; ?>"><i class="bi bi-truck"></i> กำลังจัดส่ง</a>
                                            <button class="btn btn-danger m-2"
                                                        id="btn-cancel-order<?php echo $id_ord; ?>" onclick="Swal.fire({
                                                        title: 'ยกเลิกรายการสั่งหรือไม่',
                                                        icon: 'question',
                                                        showCancelButton: true,
                                                        confirmButtonColor: '#d33',
                                                        cancelButtonColor: '#3085d6',
                                                        confirmButtonText: 'ลบรายการ',
                                                        cancelButtonText: 'ยกเลิก'
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            location =
                                                                'mng-status.php?status=pending&action=setStatus&updStatus=toCancel&id_ord=<?php echo $id_ord; ?>';
                                                        }
                                                    })">
                                                ยกเลิก
                                            </button>
                                            <?php
                                                }else if($_GET['status'] == 'process'){
                                            ?>
                                            <a class="btn btn-info m-2"
                                                href="mng-status.php?status=process&action=setStatus&updStatus=toDeliver&id_ord=<?php echo $id_ord; ?>"><i class="bi bi-truck"></i> กำลังจัดส่ง</a>
                                            <?php
                                                }else if($_GET['status'] == 'deliver'){
                                            ?>
                                            <a class="btn btn-success m-2"
                                                href="mng-status.php?status=deliver&action=setStatus&updStatus=toSuccess&id_ord=<?php echo $id_ord; ?>"><i class="bi bi-check-all"></i> สำเร็จ</a>
                                            <?php
                                                }else if($_GET['status'] == 'cancel'){
                                                echo 'ยกเลิก';
                                                }
                                            ?>
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


//เปลี่ยนสถานะ
if(isset($_GET['action'])&& $_GET['action']=='setStatus'){

    $id_ord = $_GET['id_ord'];
    $updStatus = $_GET['updStatus'];

switch ($updStatus) {
  case "toProcess":

    $query = "UPDATE tbl_order 
    SET 
    status_ord = 'process' , 
    id_admin = '$id_admin'
    WHERE id_ord = '$id_ord'";

    if($conn->query($query)){
        echo    "<script>";
        echo    "Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'เปลี่ยนสถานะ คำสั่งซื้อ #$id_ord เป็น กำลังผลิต สำเร็จ',
                    showConfirmButton: false,
                    timer: 900,
                    timerProgressBar: true
                    }).then((result) => {
                        window.location.href = 'mng-status.php?status=$stats_sql'
                    })";
        echo   "</script>";
        $conn->close();
    }else{
        echo "Error : ",mysqli_error($conn) ;
        $conn->close();
    }

    break;

  case "toDeliver":

    $query = "UPDATE tbl_order 
    SET 
    status_ord = 'deliver' , 
    id_admin = '$id_admin'
    WHERE id_ord = '$id_ord'";

    if($conn->query($query)){
        echo    "<script>";
        echo    "Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'เปลี่ยนสถานะ คำสั่งซื้อ #$id_ord เป็น กำลังจัดส่ง สำเร็จ',
                    showConfirmButton: false,
                    timer: 900,
                    timerProgressBar: true
                    }).then((result) => {
                        window.location.href = 'mng-status.php?status=$stats_sql'
                    })";
        echo   "</script>";
        $conn->close();
    }else{
        echo "Error : ",mysqli_error($conn) ;
        $conn->close();
    }

    break;
  case "toSuccess":
    
    $query = "UPDATE tbl_order 
    SET 
    status_ord = 'success' , 
    id_admin = '$id_admin'
    WHERE id_ord = '$id_ord'";

    if($conn->query($query)){
        echo    "<script>";
        echo    "Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'เปลี่ยนสถานะ คำสั่งซื้อ #$id_ord เป็น สำเร็จ',
                    showConfirmButton: false,
                    timer: 900,
                    timerProgressBar: true
                    }).then((result) => {
                        window.location.href = 'mng-status.php?status=$stats_sql'
                    })";
        echo   "</script>";
        $conn->close();
    }else{
        echo "Error : ",mysqli_error($conn) ;
        $conn->close();
    }

    break;
}
}

if(isset($_GET['action'])&& $_GET['action']=='setStatus'&& $_GET['updStatus']=='toCancel'){

    $id_ord = $_GET['id_ord'];

    $query = "UPDATE tbl_order
    SET 
    status_ord = 'cancel',
    id_admin = '$id_admin'

    WHERE id_ord = '$id_ord'";

    if($conn->query($query)){
        echo    "<script>";
        echo    "Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'ยกเลิกคำสั่งผลิต สำเร็จ',
                    showConfirmButton: false,
                    timer: 900,
                    timerProgressBar: true
                    }).then((result) => {
                        window.location.href = 'mng-status.php?status=pending'
                    })";
        echo   "</script>";
        $conn->close();
    }else{
        echo "Error : ",mysqli_error($conn) ;
        $conn->close();
    }
}
?>