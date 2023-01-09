<?php
    require_once('connect.php');
    include('auth-all.php');

    $id_acc = $_SESSION['id_acc'];

    date_default_timezone_set('Asia/Bangkok');
    $dateNow = date("Y-m-d");
    $dateD = date("d");
    $dateM = date("m");

    // if (isset($_GET["action"])){
    //     if ($_GET["action"] == "delete"){
    //         foreach ($_SESSION["cart"] as $keys => $value){
    //             if ($value["product_id"] == $_GET["id"]){
    //                 unset($_SESSION["cart"][$keys]);
    //                 echo "  <script>
    //                 Swal.fire({
    //                     position: 'center',
    //                     icon: 'success',
    //                     title: 'ลบสินค้าสำเร็จ',
    //                     showConfirmButton: false,
    //                     timer: 900,
    //                     timerProgressBar: true
    //                     }).then((result) => {
    //                         window.location.href = 'mng-create_order.php';
    //                     })
    //                         </script>";
    //                 // echo '<script>window.location="create_order.php"</script>';
    //             }
    //         }
    //     }
    // }

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
                            <h3>สั่งผลิตน้ำดื่ม</h3>
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
                            <h4>ตะกร้าสินค้า</h4>
                            <div class="table-responsive">
                                <form action="checkOut.php" method="post">
                                    <table class="table table-bordered">
                                        <tr>
                                            <th width="30%">ชื่อสินค้า</th>
                                            <th width="10%">จำนวน</th>
                                            <th width="13%">ราคา</th>
                                            <th width="10%">ราคารวม</th>
                                            <th width="17%">ลบสินค้า</th>
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

                                            <td><a
                                                    href="create_order.php?action=delete&id=<?php echo $value["product_id"]; ?>"><span
                                                        class="btn btn-danger">ลบสินค้า</span></a></td>

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
                                        
                                        }else{
                                            echo '<tr><td colspan="5" class="text-center"> ไม่มีสินค้าที่ใส่ตะกร้า </td></td>';
                                        }
                                        
                                        ?>
                                    </table>
                                    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                        <button class="btn btn-success" type="submit">สร้างคำสั่งผลิต</button>
                                    </div>

                                </form>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-body table-responsive-xxl">
                            <table class="table table-striped" id="tableProduct">
                                <thead>
                                    <tr>
                                        <th class="text-center">รูป</th>
                                        <th class="text-center">ชื่อสินค้า</th>
                                        <th class="text-center">ขนาด/ปริมาณ</th>
                                        <th class="text-center">ราคา</th>
                                        <th class="text-center">จำนวนที่สั่ง</th>
                                        <th class="text-center">ใส่ตะกร้า</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php 
                                            $sql_product = "SELECT * FROM tbl_product ORDER BY id_pdc ASC";
                                            $result_product = $conn->query($sql_product) or die("Query failed");
                                            while ($row_product = mysqli_fetch_array($result_product)) {
                                                $pic_pdc = $row_product['pic_pdc'];
                                    ?>
                                    <form method="post"
                                        action="create_order.php?action=add&id=<?php echo $row_product["id_pdc"]; ?>">
                                        <tr>
                                            <td class="text-left">
                                                <img src="assets/images/products/<?php echo $pic_pdc; ?>"
                                                    style="height: 5rem;" class="rounded" alt="<?php echo $pic_pdc; ?>">
                                            </td>
                                            <td class="text-center"><?php echo $row_product['name_pdc']; ?></td>
                                            <td class="text-center commaFunc"><?php echo $row_product['size_pdc']; ?>
                                                มิลลิลิตร</td>
                                            <td class="text-center commaFunc"><?php echo $row_product['price_pdc']; ?>
                                                บาท
                                            </td>

                                            <td class="text-center">
                                                <input class="form-control col-3" type="number" min="1" value="1"
                                                    name="quantity">
                                                <input type="hidden" name="name_pdc"
                                                    value="<?php echo $row_product["name_pdc"]; ?>">
                                                <input type="hidden" name="size_pdc"
                                                    value="<?php echo $row_product["size_pdc"]; ?>">
                                                <input type="hidden" name="price_pdc"
                                                    value="<?php echo $row_product["price_pdc"]; ?>">
                                                <input type="hidden" name="id_pdc"
                                                    value="<?php echo $row_product["id_pdc"]; ?>">
                                            </td>
                                            <td class="text-center">
                                                <input class="btn btn-primary" type="submit" value="ใส่ตะกร้า"
                                                    name="add">
                                            </td>
                                        </tr>
                                    </form>

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
            );
            $_SESSION["cart"][0] = $item_array;
        }
    }

    if (isset($_GET["action"])){
        if ($_GET["action"] == "delete"){
            foreach ($_SESSION["cart"] as $keys => $value){
                if ($value["product_id"] == $_GET["id"]){
                    unset($_SESSION["cart"][$keys]);
                    echo "  <script>
                    Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'ลบสินค้าสำเร็จ',
                        showConfirmButton: false,
                        timer: 900,
                        timerProgressBar: true
                        }).then((result) => {
                            window.location.href = 'create_order.php';
                        })
                            </script>";
                }
            }
        }
    }


//     if(isset($_POST["makeOrd"])){

// //เพิ่มPOST จากตะกร้า
// //insert ลงฐานข้อมูล

// //เมื่อสำเร็จ ลูป insert ตาราง order list โดยดึง id ของตาราง order ก่อน
// //ดึง id tbl_order ด้วยการ เช็ค ข้อมูล ตาราง ล่าสุด id อะไร  

//         $total = 0;
//         $total_size = 0;
//         foreach ($_SESSION["cart"] as $key => $value) {
//             $sql = "INSERT INTO tbl_admin (id_admin, fname_admin, lname_admin, user_admin, pass_admin, tel_admin)
//             VALUES (null, '$fname_admin', '$lname_admin', '$user_admin', '$pass_admin', '$tel_admin')";
//             $result = mysqli_query($conn, $sql) or die (mysqli_error());

//             if($result){
//                 echo    "<script>";
//                 echo    "Swal.fire({
//                             position: 'center',
//                             icon: 'success',
//                             title: 'ลงทะเบียนสำเร็จ',
//                             showConfirmButton: false,
//                             timer: 1200,
//                             timerProgressBar: true
//                             }).then((result) => {
//                                 window.location.href = 'mng-admin.php';
//                             })";
//                 echo   "</script>";
//             }
//             else{
//                 echo "<script type='text/javascript'>";
//                 echo "window.location = 'mng-admin.php'; ";
//                 echo "</script>";
//             }
//         }  
        
        
//     }
        
?>