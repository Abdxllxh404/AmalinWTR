<?php
    require_once('connect.php');
    include('auth-all.php');

    if (empty($_SESSION["cart"])){
        echo "<script type='text/javascript'>";
        echo "window.location = 'create_order.php'; ";
        echo "</script>";
    
    }else{

    $id_acc = $_SESSION['id_acc'];

    date_default_timezone_set('Asia/Bangkok');
    $dateNow = date("d-m-Y");
    $dateNow1 = date("Y-m-d");

    // $dateD = date("Y-m-d");
    $dateM = date("Y-m");
    $dateY = date("Y");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>สั่งผลิตน้ำดื่ม - น้ำดื่มอมาลิน</title>
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
                        <li class="sidebar-item active">
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
                <div class="page-title">
                    <div class="row">
                        <div class="col-12 col-md-6 order-md-1 order-last">
                            <h3>รายละเอียด สั่งผลิตน้ำดื่ม</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">สั่งผลิตน้ำดื่ม</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">

                    <div class="card mt-3">
                        <div class="card-body">
                            <div style="clear: both"></div>
                            <h4>รายละเอียด</h4>
                            <div class="table-responsive">

                                <form method="post">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="30%">ชื่อสินค้า</th>
                                            <th width="10%">จำนวน</th>
                                            <th width="13%">ราคา</th>
                                            <th width="10%">ราคารวม</th>
                                        </tr>
                                        <?php
                                        if(!empty($_SESSION["cart"])){
                                            $total = 0;
                                            $total_size = 0;

                                            foreach ($_SESSION["cart"] as $key => $value) {
                                        ?>
                                        <tr>
                                            <td><?php echo $value["item_name"]; ?></td>
                                            <td><?php echo $value["item_quantity"]; ?></td>

                                            <td class="commaFunc"><?php echo $value["product_price"]; ?> บาท</td>
                                            <td class="commaFunc">
                                                <?php echo $value["item_quantity"] * $value["product_price"]; ?> บาท
                                            </td>

                                        </tr>
                                        <?php
                                            $total = $total + ($value["item_quantity"] * $value["product_price"]);
                                            $total_size = $total_size + ($value["item_quantity"] * $value["product_size"]);

                                        }
                                    

                                        ?>
                                        <tr>
                                            <td colspan="3" align="right">ทั้งหมด</td>
                                            <th class="commaFunc" align="right"><?php echo $total; ?> บาท</th>
                                        </tr>
                                        <?php
                                        
                                        }
                                        ?>
                                    </table>
                                    <br>
                                    <hr>
                                    <div class="card-body container">
                                        <div class="mb-3 row">
                                            <label class="col-sm-3 col-form-label">วันที่ต้องการให้ส่ง</label>
                                            <div class="col-sm-9">
                                                <input type="date" class="form-control" name="date_tsp_ord"
                                                    min="<?php echo $dateNow1; ?>" required>
                                            </div>
                                        </div>
                                        <div class="mb-3 row mb-2">
                                            <label class="col-sm-3 form-label">รายละเอียดการจัดส่ง</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" rows="3"
                                                    placeholder="ที่อยู่ จุดสังเกตุ หรือ แจ้งเพิ่มเติม"
                                                    name="detail_ord" required></textarea>
                                            </div>


                                        <input name="zoom_value" type="hidden" id="zoom_value" value="0" size="5" />


                                        <input type="hidden" name="status_ord" value="pending" required>
                                        <input type="hidden" name="all_size_ord" value="<?php echo $total_size; ?>"
                                            required>
                                        <input type="hidden" name="all_price_ord" value="<?php echo $total; ?>"
                                            required>
                                        <input type="hidden" name="date_d_ord" value="<?php echo $dateNow1; ?>" required>
                                        <input type="hidden" name="date_m_ord" value="<?php echo $dateM; ?>" required>
                                        <input type="hidden" name="date_y_ord" value="<?php echo $dateY; ?>" required>
                                        <input type="hidden" name="date_ord" value="<?php echo $dateNow; ?>" required>
                                        <input type="hidden" name="id_acc" value="<?php echo $id_acc; ?>" required>
                                    </div>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button class="btn btn-success" type="submit"
                                            name="makeOrd">สั่งผลิตน้ำดื่ม</button>
                                    </div>

                                </form>


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

    if (isset($_POST["add"])){
        if (isset($_SESSION["cart"])){
            $item_array_id = array_column($_SESSION["cart"],"product_id");
            if (!in_array($_GET["id"],$item_array_id)){
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'product_id' => $_GET["id"],
                    'item_name' => $_POST["name_pdc"],
                    'product_size' => $_POST["size_pdc"],
                    'product_price' => $_POST["price_pdc"],
                    'item_quantity' => $_POST["quantity"],
                    'item_idProduct' => $_POST["id_pdc"]

                );
                $_SESSION["cart"][$count] = $item_array;
                echo '<script>window.location="create_order.php"</script>';
            }else{
                echo "  <script>
                            Swal.fire({
                                position: 'center',
                                icon: 'error',
                                title: 'สินค้าอยู่ในตะกร้าแล้ว',
                                text: 'หากต้องการเพิ่มจำนวน กรุณาลบ แล้วเพิ่มใหม่',
                                showConfirmButton: false,
                                timer: 2500,
                                timerProgressBar: true
                                }).then((result) => {
                                    window.location.href = 'create_order.php';
                                })
                        </script>";
            }
        }else{
            $item_array = array(
                'product_id' => $_GET["id"],
                'item_name' => $_POST["name_pdc"],
                'product_size' => $_POST["size_pdc"],
                'product_price' => $_POST["price_pdc"],
                'item_quantity' => $_POST["quantity"],
                'item_idProduct' => $_POST["id_pdc"]

            );
            $_SESSION["cart"][0] = $item_array;
        }
    }



    if(isset($_POST["makeOrd"])){
        $date_tsp_ord = $_POST["date_tsp_ord"];
        $status_ord = $_POST["status_ord"];
        $detail_ord = $_POST["detail_ord"];
        $all_size_ord = $_POST["all_size_ord"];
        $all_price_ord = $_POST["all_price_ord"];
        $date_d_ord = $_POST["date_d_ord"];
        $date_m_ord = $_POST["date_m_ord"];
        $date_y_ord = $_POST["date_y_ord"];
        $date_ord = $_POST["date_ord"];
        $id_acc = $_POST["id_acc"];
        // $lat_loca = $_POST["lat_loca"];
        // $long_loca = $_POST["long_loca"];

        $sql = "INSERT INTO tbl_order (id_ord, date_tsp_ord, status_ord, detail_ord, all_size_ord, all_price_ord, date_d_ord, date_m_ord, date_y_ord, date_ord, id_acc, lat_loca , long_loca)
            VALUES (null, '$date_tsp_ord', '$status_ord', '$detail_ord', '$all_size_ord', '$all_price_ord', '$date_d_ord', '$date_m_ord', '$date_y_ord', '$date_ord', '$id_acc')";
            $result = mysqli_query($conn, $sql) or die (mysqli_error());

            if($result){

                $sqlCheckId = "SELECT id_ord FROM tbl_order ORDER BY id_ord DESC LIMIT 1";
                $resultCheckId = mysqli_query($conn, $sqlCheckId) or die(mysqli_error());
                $rowsCheckId = $resultCheckId->fetch_assoc();

                $id_ord_create = $rowsCheckId["id_ord"];



                foreach ($_SESSION["cart"] as $key => $value) {

                    $name_ord_list = $value["item_name"];
                    $qty_ord_list = $value["item_quantity"];
                    $price_ord_list = $value["product_price"];
                    $size_ord_list = $value["product_size"];
                    $id_pdc = $value["item_idProduct"];

                    

                    $sql_order_list = "INSERT INTO tbl_order_list (id_ord_list , name_ord_list, size_ord_list, price_ord_list, qty_ord_list, id_ord, id_pdc)
                    VALUES (null, '$name_ord_list', '$size_ord_list', '$price_ord_list', '$qty_ord_list', '$id_ord_create', '$id_pdc')";
                    $result_order_list = mysqli_query($conn, $sql_order_list) or die (mysqli_error());
                    
                }
                
                
                    if($result_order_list){
                        echo    "<script>";
                        echo    "Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'สร้างคำสั่งผลิตสำเร็จ',
                                    showConfirmButton: false,
                                    timer: 1200,
                                    timerProgressBar: true
                                    }).then((result) => {
                                        window.location.href = 'index.php';
                                    })";
                        echo   "</script>";

                        unset($_SESSION["cart"]);
                    }
                    else{
                        echo "<script type='text/javascript'>";
                        echo "window.location = 'index.php'; ";
                        echo "</script>";
                    }
                



            }
            else{
                echo "<script type='text/javascript'>";
                echo "window.location = 'create_order.php'; ";
                echo "</script>";
            }

//เพิ่มPOST จากตะกร้า
//insert ลงฐานข้อมูล

//เมื่อสำเร็จ ลูป insert ตาราง order list โดยดึง id ของตาราง order ก่อน
//ดึง id tbl_order ด้วยการ เช็ค ข้อมูล ตาราง ล่าสุด id อะไร   
        
        
    }

}
?>