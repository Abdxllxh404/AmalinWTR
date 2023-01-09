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
</head>

<body>
    <div id="app">
        <div class="m-1">
            <div class="page-heading">
                <section class="section">
                    <div class="card">
                        <div class="card-body" id="section-to-print">
                            <div class="d-flex bd-highlight">
                                <div class="p-2 w-100 bd-highlight">
                                    <h5>รายการสถานะ <?php echo $status ; ?></h5>
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

                                        <th class="text-center">เช็ค</th>
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
                                            </li>
                                            <?php
                                                        }
                                                    ?>
                                        </td>
                                        <?php
                                                }
                                        ?>

                                        <td>                          </td>

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
            <center>
                <a id="non-printable" href="javascript:window.print('mng-status-print.php?status=deliver')"
                    class="btn btn-primary">
                    <i class="fa fa-print"></i>
                    พิมพ์
                </a>

                <button id="non-printable" onclick="self.close()" class="btn btn-danger ms-3">ปิด</button>



            </center>

        </div>
    </div>

    <?php
    include("script.php");
    ?>

</body>

</html>