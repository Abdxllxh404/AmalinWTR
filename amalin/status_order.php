<?php
    require_once('connect.php');
    include('auth-all.php');

    $id_acc = $_SESSION['id_acc'];

    $sql_product = "SELECT * FROM tbl_product";
    $result_product = $conn->query($sql_product) or die("Query failed");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>ติดตามสถานะ - น้ำดื่มอมาลิน</title>
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

                        <li class="sidebar-item ">
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
                        <li class="sidebar-item active">
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
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>ติดตามสถานะ</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">ติดตามสถานะ</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card mt-4">
                        <div class="card-body">
                            <nav>
                                <div class="nav nav-tabs row" id="nav-tab" role="tablist">
                                    <button class="nav-link col active" id="nav-pending-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-pending" type="button" role="tab"
                                        aria-controls="nav-pending" aria-selected="true"><i class="bi bi-hourglass-split"></i>  รอยืนยัน</button>

                                    <button class="nav-link col" id="nav-process-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-process" type="button" role="tab"
                                        aria-controls="nav-process" aria-selected="false"><i class="bi bi-gear-wide-connected"></i>  กำลังผลิต</button>

                                    <button class="nav-link col" id="nav-deliver-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-deliver" type="button" role="tab"
                                        aria-controls="nav-deliver" aria-selected="false"><i class="bi bi-truck"></i>  กำลังส่ง</button>

                                    <button class="nav-link col" id="nav-success-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-success" type="button" role="tab"
                                        aria-controls="nav-success" aria-selected="false"><i class="bi bi-check-all"></i>  สำเร็จ</button>
                                    
                                    <button class="nav-link col" id="nav-cancel-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-cancel" type="button" role="tab" aria-controls="nav-cancel"
                                        aria-selected="false"><i class="bi bi-x-circle"></i>  ยกเลิก</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-pending" role="tabpanel"
                                    aria-labelledby="nav-pending-tab">
                                    <h5 class="mt-5 mb-3">สถานะ "รอยืนยัน"</h5>
                                    <table class="table mt-4" id="tableOrderPending">
                                        <thead>
                                            <tr>
                                                <th class="text-center">วันที่ต้องการให้ส่ง</th>
                                                <th class="text-center">ราคารวม</th>
                                                <th class="text-center">รายละเอียด คำสั่งซื้อ</th>
                                                <th class="text-center">รายละเอียดพื้นที่จัดส่ง</th>
                                                <th class="text-center">ยกเลิก</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                $sql_pending = "SELECT * FROM tbl_order WHERE id_acc = '$id_acc' AND status_ord = 'pending' ";
                                                $result_pending = $conn->query($sql_pending) or die("Query failed");
                                                while ($row_pending = $result_pending->fetch_assoc()) {
                                                    $id_ord_pending = $row_pending['id_ord'];
                                            
                                                ?>
                                            <tr>
                                                <td class="text-center"><?php echo $row_pending['date_tsp_ord']; ?></td>
                                                <td class="text-center"><?php echo $row_pending['all_price_ord']; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php     
                                                        $sql_oder_pending = "SELECT * FROM tbl_order_list WHERE id_ord = '$id_ord_pending' ";
                                                        $result_oder_pending = $conn->query($sql_oder_pending) or die("Query failed");
                                                        while ($row_order_pending = $result_oder_pending->fetch_assoc()) {
                                                        ?>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center rounded-3 border border-1">
                                                        <?php echo $row_order_pending['name_ord_list']; ?>
                                                        <span>
                                                            จำนวน
                                                            <span
                                                                class="badge bg-primary rounded-pill"><?php echo $row_order_pending['qty_ord_list']; ?></span>
                                                            หน่วย
                                                        </span>
                                                    </li>
                                                    <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row_pending['detail_ord']; ?>
                                                    <span>พิกัด
                                                        <a target="_blank"
                                                            href="http://maps.google.com/maps?&z=15&mrt=yp&t=k&q=<?php echo $row_pending['lat_loca']; ?>+<?php echo $row_pending['long_loca']; ?>"
                                                            class="badge bg-primary ">คลิกดูแผนที่</a>
                                                    </span>
                                                </td>
                                                <td class="text-center">
                                                    <button class="btn btn-danger m-2"
                                                        id="btn-cancel-order<?php echo $id_ord_pending; ?>" onclick="Swal.fire({
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
                                                                'status_order.php?status=cancel&action=setStatus&updStatus=toCancel&id_ord=<?php echo $id_ord_pending; ?>';
                                                        }
                                                    })">ยกเลิก</button>
                                                </td>
                                            </tr>


                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="nav-process" role="tabpanel"
                                    aria-labelledby="nav-process-tab">
                                    <h5 class="mt-5 mb-3">สถานะ "กำลังผลิต"</h5>
                                    <table class="table mt-4" id="tableOrderProcess">
                                        <thead>
                                            <tr>
                                                <th class="text-center">วันที่ต้องการให้ส่ง</th>
                                                <th class="text-center">ราคารวม</th>
                                                <th class="text-center">รายละเอียด คำสั่งซื้อ</th>
                                                <th class="text-center">รายละเอียดพื้นที่จัดส่ง</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                 $sql_process = "SELECT * FROM tbl_order WHERE id_acc = '$id_acc' AND status_ord = 'process' ";
                                                 $result_process = $conn->query($sql_process) or die("Query failed");
                                                 while ($row_process = $result_process->fetch_assoc()) {
                                                    $id_ord_process = $row_process['id_ord'];
                                             
                                                ?>
                                            <tr>
                                                <td class="text-center"><?php echo $row_process['date_tsp_ord']; ?></td>
                                                <td class="text-center"><?php echo $row_process['all_price_ord']; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php     
                                                        $sql_oder_process = "SELECT * FROM tbl_order_list WHERE id_ord = '$id_ord_process' ";
                                                        $result_oder_process = $conn->query($sql_oder_process) or die("Query failed");
                                                        while ($row_order_process = $result_oder_process->fetch_assoc()) {
                                                        ?>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center rounded-3 border border-1">
                                                        <?php echo $row_order_process['name_ord_list']; ?>
                                                        <span>
                                                            จำนวน
                                                            <span
                                                                class="badge bg-primary rounded-pill"><?php echo $row_order_process['qty_ord_list']; ?></span>
                                                            หน่วย
                                                        </span>
                                                    </li>
                                                    <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row_process['detail_ord']; ?>
                                                    <span>พิกัด
                                                        <a target="_blank"
                                                            href="http://maps.google.com/maps?&z=15&mrt=yp&t=k&q=<?php echo $row_process['lat_loca']; ?>+<?php echo $row_process['long_loca']; ?>"
                                                            class="badge bg-primary ">คลิกดูแผนที่</a>
                                                    </span>
                                                </td>
                                            </tr>
                                            <?php
                                                        }
                                                    ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="nav-deliver" role="tabpanel"
                                    aria-labelledby="nav-deliver-tab">
                                    <h5 class="mt-5 mb-3">สถานะ "กำลังจัดส่ง"</h5>
                                    <table class="table mt-4" id="tableOrderDeliver">
                                        <thead>
                                            <tr>
                                                <th class="text-center">วันที่ต้องการให้ส่ง</th>
                                                <th class="text-center">ราคารวม</th>
                                                <th class="text-center">รายละเอียด คำสั่งซื้อ</th>
                                                <th class="text-center">รายละเอียดพื้นที่จัดส่ง</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                 $sql_deliver = "SELECT * FROM tbl_order WHERE id_acc = '$id_acc' AND status_ord = 'deliver' ";
                                                 $result_deliver = $conn->query($sql_deliver) or die("Query failed");
                                                 while ($row_deliver = $result_deliver->fetch_assoc()) {
                                                    $id_ord_deliver = $row_deliver['id_ord'];
                                             
                                                ?>
                                            <tr>
                                                <td class="text-center"><?php echo $row_deliver['date_tsp_ord']; ?></td>
                                                <td class="text-center"><?php echo $row_deliver['all_price_ord']; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php     
                                                        $sql_oder_deliver = "SELECT * FROM tbl_order_list WHERE id_ord = '$id_ord_deliver' ";
                                                        $result_oder_deliver = $conn->query($sql_oder_deliver) or die("Query failed");
                                                        while ($row_order_deliver = $result_oder_deliver->fetch_assoc()) {
                                                        ?>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center rounded-3 border border-1">
                                                        <?php echo $row_order_deliver['name_ord_list']; ?>
                                                        <span>
                                                            จำนวน
                                                            <span
                                                                class="badge bg-primary rounded-pill"><?php echo $row_order_deliver['qty_ord_list']; ?></span>
                                                            หน่วย
                                                        </span>
                                                    </li>
                                                    <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row_deliver['detail_ord']; ?>
                                                    <span>พิกัด
                                                        <a target="_blank"
                                                            href="http://maps.google.com/maps?&z=15&mrt=yp&t=k&q=<?php echo $row_deliver['lat_loca']; ?>+<?php echo $row_deliver['long_loca']; ?>"
                                                            class="badge bg-primary ">คลิกดูแผนที่</a>
                                                    </span>
                                                </td>
                                            </tr>
                                            <?php
                                                        }
                                                    ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="nav-success" role="tabpanel"
                                    aria-labelledby="nav-success-tab">
                                    <h5 class="mt-5 mb-3">สถานะ "สำเร็จ"</h5>
                                    <table class="table mt-4" id="tableOrderSuccess">
                                        <thead>
                                            <tr>
                                                <th class="text-center">วันที่ต้องการให้ส่ง</th>
                                                <th class="text-center">ราคารวม</th>
                                                <th class="text-center">รายละเอียด คำสั่งซื้อ</th>
                                                <th class="text-center">รายละเอียดพื้นที่จัดส่ง</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                 $sql_success = "SELECT * FROM tbl_order WHERE id_acc = '$id_acc' AND status_ord = 'success' ";
                                                 $result_success = $conn->query($sql_success) or die("Query failed");
                                                 while ($row_success = $result_success->fetch_assoc()) {
                                                    $id_ord_success = $row_success['id_ord'];
                                             
                                                ?>
                                            <tr>
                                                <td class="text-center"><?php echo $row_success['date_tsp_ord']; ?></td>
                                                <td class="text-center"><?php echo $row_success['all_price_ord']; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php     
                                                        $sql_oder_success = "SELECT * FROM tbl_order_list WHERE id_ord = '$id_ord_success' ";
                                                        $result_oder_success = $conn->query($sql_oder_success) or die("Query failed");
                                                        while ($row_order_success = $result_oder_success->fetch_assoc()) {
                                                        ?>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center rounded-3 border border-1">
                                                        <?php echo $row_order_success['name_ord_list']; ?>
                                                        <span>
                                                            จำนวน
                                                            <span
                                                                class="badge bg-primary rounded-pill"><?php echo $row_order_success['qty_ord_list']; ?></span>
                                                            หน่วย
                                                        </span>
                                                    </li>
                                                    <?php
                                                        }
                                                    ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php echo $row_success['detail_ord']; ?>
                                                    <span>พิกัด
                                                        <a target="_blank"
                                                            href="http://maps.google.com/maps?&z=15&mrt=yp&t=k&q=<?php echo $row_success['lat_loca']; ?>+<?php echo $row_success['long_loca']; ?>"
                                                            class="badge bg-primary ">คลิกดูแผนที่</a>
                                                    </span>
                                                </td>
                                            </tr>
                                            <?php
                                                        }
                                                    ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="tab-pane fade" id="nav-cancel" role="tabpanel"
                                    aria-labelledby="nav-cancel-tab">
                                    <h5 class="mt-5 mb-3">สถานะ "ยกเลิก"</h5>
                                    <table class="table mt-4" id="tableOrderCancel">
                                        <thead>
                                            <tr>
                                                <th class="text-center">วันที่ต้องการให้ส่ง</th>
                                                <th class="text-center">ราคารวม</th>
                                                <th class="text-center">รายละเอียด คำสั่งซื้อ</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 
                                                 $sql_cancel = "SELECT * FROM tbl_order WHERE id_acc = '$id_acc' AND status_ord = 'cancel' ";
                                                 $result_cancel = $conn->query($sql_cancel) or die("Query failed");
                                                 while ($row_cancel = $result_cancel->fetch_assoc()) {
                                                    $id_ord_cancel = $row_cancel['id_ord'];
                                             
                                                ?>
                                            <tr>
                                                <td class="text-center"><?php echo $row_cancel['date_tsp_ord']; ?></td>
                                                <td class="text-center"><?php echo $row_cancel['all_price_ord']; ?>
                                                </td>
                                                <td class="text-center">
                                                    <?php     
                                                        $sql_oder_cancel = "SELECT * FROM tbl_order_list WHERE id_ord = '$id_ord_cancel' ";
                                                        $result_oder_cancel = $conn->query($sql_oder_cancel) or die("Query failed");
                                                        while ($row_order_cancel = $result_oder_cancel->fetch_assoc()) {
                                                        ?>
                                                    <li
                                                        class="list-group-item d-flex justify-content-between align-items-center rounded-3 border border-1">
                                                        <?php echo $row_order_cancel['name_ord_list']; ?>
                                                        <span>
                                                            จำนวน
                                                            <span
                                                                class="badge bg-primary rounded-pill"><?php echo $row_order_cancel['qty_ord_list']; ?></span>
                                                            หน่วย
                                                        </span>
                                                    </li>
                                                    <?php
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
<?php  include("script.php"); ?>

    <script>
    // tableOrderPending Datatable
        let tableOrderPending = document.querySelector('#tableOrderPending');
        let dataTablePending = new simpleDatatables.DataTable(tableOrderPending);
    </script>

    <script>
    // tableOrderProcess Datatable
        let tableOrderProcess = document.querySelector('#tableOrderProcess');
        let dataTableProcess = new simpleDatatables.DataTable(tableOrderProcess);
    </script>

    <script>
    // tableOrderDeliver Datatable
        let tableOrderDeliver = document.querySelector('#tableOrderDeliver');
        let dataTableDeliver = new simpleDatatables.DataTable(tableOrderDeliver);
    </script>

    <script>
    // tableOrderSuccess Datatable
        let tableOrderSuccess = document.querySelector('#tableOrderSuccess');
        let dataTableSuccess = new simpleDatatables.DataTable(tableOrderSuccess);
    </script>

    <script>
    // tableOrderCancel Datatable
        let tableOrderCancel = document.querySelector('#tableOrderCancel');
        let dataTableCancel = new simpleDatatables.DataTable(tableOrderCancel);
    </script>


    <script>
    function numberWithCommas(x) {
        return x.toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");
    }

    $('.commaFunc').each(function() {
        var v_pound = $(this).html();
        v_pound = numberWithCommas(v_pound);

        $(this).html(v_pound)

    })
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
if(isset($_GET['action'])&& $_GET['action']=='setStatus'&& $_GET['updStatus']=='toCancel'){

    $id_ord = $_GET['id_ord'];

    $query = "UPDATE tbl_order 
    SET 
    status_ord = 'cancel'
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
                        window.location.href = 'status_order.php'
                    })";
        echo   "</script>";
        $conn->close();
    }else{
        echo "Error : ",mysqli_error($conn) ;
        $conn->close();
    }
}
?>