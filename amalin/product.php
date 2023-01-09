<?php
    require_once('connect.php');
    include('auth-admin.php');

    $id_admin  = $_SESSION['id_admin'];
    $fname_admin = $_SESSION['fname_admin'];
    $lname_admin = $_SESSION['lname_admin'];
    $user_admin = $_SESSION['user_admin'];
    $pass_admin = $_SESSION['p_admin'];
    $tel_admin = $_SESSION['tel_admin'];

    
    $sql_product = "SELECT * FROM tbl_product";
    $result_product = $conn->query($sql_product) or die("Query failed");
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

                        <li class="sidebar-item ">
                            <a href="mng-page.php" class='sidebar-link'>
                                <i class="bi bi-grid-fill"></i>
                                <span>แดชบอร์ด</span>
                            </a>
                        </li>

                        <li class="sidebar-item  has-sub">
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

                        <li class="sidebar-item active">
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
                            <h3>รายละเอียดสินค้า</h3>
                            <p class="text-subtitle text-muted">เพิ่ม ลบ แก้ไข สินค้า</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="mng-page.php">หน้าแรก</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">รายละเอียดสินค้า</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-header d-flex bd-highlight">
                                <div class="p-2 bd-highlight">
                                    <h4>สินค้า</h4>
                                </div>
                                <div class="ms-auto p-2 bd-highlight">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-bs-target="#addProduct">
                                        เพิ่มสินค้า
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row row-cols-1 row-cols-md-5 g-5">
                        <?php while ($row_product = $result_product->fetch_assoc()) {
                    // $name_pdc = $row_product['name_pdc'];
                    // $size_pdc = $row_product['size_pdc'];
                    // $detail_pdc = $row_product['detail_pdc'];
                    // $price_pdc = $row_product['price_pdc'];
                    $pic_pdc = $row_product['pic_pdc'];
                ?>
                        <div class="col">
                            <div class="card h-100">
                                <img src="assets/images/products/<?php echo $pic_pdc; ?>" class="card-img-top"
                                    alt="<?php echo $pic_pdc; ?>">
                                <div class="card-body">
                                    <h5 class="card-title" id="name<?php echo $row_product['id_pdc']; ?>">
                                        <?php echo $row_product['name_pdc']; ?>
                                    </h5>
                                    <p class="card-text" id="detail<?php echo $row_product['id_pdc']; ?>">
                                        <?php echo $row_product['detail_pdc']; ?>
                                    </p>
                                </div>

                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"></li>

                                    <li class="list-group-item commaFunc"
                                        id="size<?php echo $row_product['id_pdc']; ?>">
                                        ขนาดหรือปริมาณ :
                                        <?php echo $row_product['size_pdc']; ?>
                                        มิลลิลิตร
                                    </li>

                                    <li class="list-group-item commaFunc"
                                        id="price<?php echo $row_product['id_pdc']; ?>">
                                        ราคา :
                                        <?php echo $row_product['price_pdc']; ?>
                                        บาท
                                    </li>

                                    <li class="list-group-item">
                                        <div class="d-flex justify-content-evenly">
                                            <button type="button" class="btn btn-info" data-bs-toggle="modal"
                                                data-bs-target="#editPicPdc<?php echo $row_product['id_pdc']; ?>">
                                                เปลี่ยนรูป
                                            </button>
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editPdc<?php echo $row_product['id_pdc']; ?>">
                                                แก้ไข
                                            </button>
                                            <a class="btn btn-danger"
                                                href="product.php?action=delete&id_del=<?php echo $row_product['id_pdc']; ?>">ลบ</a>

                                            <!-- Modal แก้ไขข้อมูลสินค้า -->
                                            <div class="modal fade" id="editPdc<?php echo $row_product['id_pdc']; ?>"
                                                tabindex="-1" aria-labelledby="editPdc" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editPdc">แก้ไขข้อมูลสินค้า </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <form method="POST">
                                                            <div class="modal-body">
                                                                <label>ชื่อสินค้า: </label>
                                                                <div class="form-group mt-2 mb-3">
                                                                    <input type="text" placeholder="ชื่อสินค้า"
                                                                        class="form-control" name="name_pdc" id="ename"
                                                                        required
                                                                        value="<?php echo $row_product['name_pdc']; ?>">
                                                                </div>

                                                                <label>ขนาด ปริมาณ: </label>
                                                                <div class="input-group mt-2 mb-3">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="ขนาด ปริมาณ (มิลลิลิตร)"
                                                                        aria-label="ขนาด ปริมาณ (มิลลิลิตร)"
                                                                        aria-describedby="size-addon" name="size_pdc"
                                                                        id="esize" required
                                                                        value="<?php echo $row_product['size_pdc']; ?>">
                                                                    <span class="input-group-text"
                                                                        id="size-addon">มิลลิลิตร</span>
                                                                </div>

                                                                <label>รายละเอียดสินค้า : </label>
                                                                <div class="form-group mt-2 mb-3">
                                                                    <textarea class="form-control form-control" rows="3"
                                                                        placeholder="รายละเอียดสินค้า" name="detail_pdc"
                                                                        id="edetail"
                                                                        required><?php echo $row_product['detail_pdc']; ?></textarea>
                                                                </div>

                                                                <label>ราคา: </label>
                                                                <div class="input-group mt-2 mb-3">
                                                                    <input type="text" class="form-control"
                                                                        placeholder="ราคา" aria-label="ราคา"
                                                                        aria-describedby="size-addon" name="price_pdc"
                                                                        id="eprice" required
                                                                        value="<?php echo $row_product['price_pdc']; ?>">
                                                                    <span class="input-group-text"
                                                                        id="size-addon">บาท</span>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="id_pdc"
                                                                    value="<?php echo $row_product['id_pdc']; ?>"></input>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">ปิด</button>
                                                                <input type="submit" class="btn btn-success"
                                                                    name="edit-confirm" value="บันทึกการแก้ไข"></input>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Modal แก้ไขรูปภาพสินค้า -->
                                            <div class="modal fade" id="editPicPdc<?php echo $row_product['id_pdc']; ?>"
                                                tabindex="-1" aria-labelledby="editPicPdc" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editPicPdc">เปลี่ยนรูปสินค้า
                                                            </h5>
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>

                                                        <form method="POST" enctype="multipart/form-data">
                                                            <div class="modal-body">
                                                                <label for="pic_pdc" class="form-label">รูปผลิตภัณฑ์:
                                                                </label>
                                                                <div class="form-group mt-2 mb-3">
                                                                    <input class="form-control" type="file" id="pic_pdc"
                                                                        accept=".jpg, .jpeg, .gif, .png" name="pic_pdc">
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <input type="hidden" name="id_pdc"
                                                                    value="<?php echo $row_product['id_pdc']; ?>"></input>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">ปิด</button>
                                                                <input type="submit" class="btn btn-success"
                                                                    name="editPic-confirm"
                                                                    value="บันทึกการแก้ไข"></input>
                                                            </div>
                                                        </form>

                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php
                } 
                ?>
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

    <!-- Modal เพิ่มสินค้า -->
    <div class="modal fade text-left" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="addProduct"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="addProduct">เพิ่มสินค้า </h4>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <label>ชื่อสินค้า: </label>
                        <div class="form-group mt-2 mb-3">
                            <input type="text" placeholder="ชื่อสินค้า" class="form-control" name="name_pdc" required>
                        </div>
                        <label>ขนาด ปริมาณ: </label>
                        <div class="input-group mt-2 mb-3">
                            <input type="text" class="form-control" placeholder="ขนาด ปริมาณ (มิลลิลิตร)"
                                aria-label="ขนาด ปริมาณ (มิลลิลิตร)" aria-describedby="size-addon" name="size_pdc"
                                id="size_pdc" required>
                            <span class="input-group-text" id="size-addon">มิลลิลิตร</span>
                        </div>
                        <label>รายละเอียดสินค้า : </label>
                        <div class="form-group mt-2 mb-3">
                            <textarea class="form-control form-control" rows="3" placeholder="รายละเอียดสินค้า"
                                name="detail_pdc" required></textarea>
                        </div>
                        <label>ราคา: </label>
                        <div class="input-group mt-2 mb-3">
                            <input type="text" class="form-control" placeholder="ราคา" aria-label="ราคา"
                                aria-describedby="size-addon" name="price_pdc" id="price_pdc" required>
                            <span class="input-group-text" id="size-addon">บาท</span>
                        </div>
                        <label for="pic_pdc" class="form-label">รูปผลิตภัณฑ์: </label>
                        <div class="form-group mt-2 mb-3">
                            <input class="form-control" type="file" id="pic_pdc" accept=".jpg, .jpeg, .gif, .png"
                                name="pic_pdc">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                            <span>ปิด</span>
                        </button>
                        <input type="submit" class="btn btn-success" name="conf_addProduct" value="เพิ่ม">
                        <i class="bx bx-check d-block d-sm-none"></i>
                        </input>
                    </div>
                </form>
            </div>
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
                    window.location.href = 'product.php?action=confirm-del&id_del=".$id_del."'
                }else{
                    window.location.href = 'product.php'
                }
            });";
    echo   "</script>";
}


if(isset($_GET['action'])&& $_GET['action']=='confirm-del'){
    $id_del = $_GET["id_del"];

    $sql_del ="DELETE FROM tbl_product WHERE id_pdc='$id_del' ";
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
                    window.location.href = 'product.php'
                })";
    echo   "</script>";
    mysqli_close($conn);

}


if(isset($_POST["conf_addProduct"])&& !empty($_POST["conf_addProduct"])){
    $name_pdc = $_POST['name_pdc'];
    $size_pdc = $_POST['size_pdc'];
    $detail_pdc = $_POST['detail_pdc'];
    $price_pdc = $_POST['price_pdc'];

    $CheckNameProduct = "SELECT name_pdc FROM tbl_product WHERE name_pdc = '$name_pdc'";
    
    $check_result = $conn->query($CheckNameProduct) or die("Query failed");
    $check_rows = mysqli_num_rows($check_result);


    if($check_rows > 0){
        echo    "<script>";
        echo    "Swal.fire({
                    position: 'center',
                    icon: 'error',
                    title: 'ชื่อผลิตภัณฑ์นี้ อยู่ในระบบแล้ว',
                    showConfirmButton: false,
                    timer: 1200,
                    timerProgressBar: true
                    }).then((result) => {
                        window.location.href = 'product.php';
                    })";
        echo   "</script>";
    }else{

        if($_FILES['pic_pdc']['name'] == "") {
            $pic_pdc = "noimg.jpg";

            $sql = "INSERT INTO tbl_product (id_pdc, name_pdc, size_pdc, detail_pdc, price_pdc,  pic_pdc)
                    VALUES (null, '$name_pdc', '$size_pdc', '$detail_pdc', '$price_pdc', '$pic_pdc')";
                    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn)); 
        if($result){
            echo    "<script>";
            echo    "Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'เพิ่มสินค้าสำเร็จ',
                        showConfirmButton: false,
                        timer: 900,
                        timerProgressBar: true
                        }).then((result) => {
                            window.location.href = 'product.php';
                        })";
            echo   "</script>";
        }else{
            echo "<script type='text/javascript'>";
            echo "window.location = 'product.php'; ";
            echo "</script>";
        }
        mysqli_close($conn);

        }else{
            $pdcName = "product";

            // picture
            $date = date("YmdHis");
        
            $type = strrchr($_FILES['pic_pdc']['name'],".");

            $images = $_FILES["pic_pdc"]["tmp_name"];
            $picName = $pdcName.$date.$type;
            $width=500;
            $size=GetimageSize($images);
            $height=round($width*$size[1]/$size[0]);

            // $images_orig = ImageCreateFromJPEG($images);

            if($size[2] == 1) {
                $images_orig = imagecreatefromgif($images); //resize รูปประเภท GIF
            } else if($size[2] == 2) {
                $images_orig = imagecreatefromjpeg($images); //resize รูปประเภท JPEG
            } else{
                $images_orig = imagecreatefrompng($images); //resize รูปประเภท PNG
            }

            $photoX = ImagesX($images_orig);
            $photoY = ImagesY($images_orig);
            $images_fin = ImageCreateTrueColor($width, $height);
            ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
            
            if($size[2] == 1) {
                ImageGIF($images_fin,"assets/images/products/".$picName);
            } else if($size[2] == 2) {
                ImageJPEG($images_fin,"assets/images/products/".$picName);
            } else{
                ImagePNG($images_fin,"assets/images/products/".$picName);
            }
            
            // ImageJPEG($images_fin,"images/upMeterPic/".$picName);

            ImageDestroy($images_orig);
            ImageDestroy($images_fin);

            $pic_pdc = $picName;

            $sql = "INSERT INTO tbl_product (id_pdc, name_pdc, size_pdc, detail_pdc, price_pdc,  pic_pdc)
            VALUES (null, '$name_pdc', '$size_pdc', '$detail_pdc', '$price_pdc', '$pic_pdc')";
            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn)); 

                if($result){
                    echo    "<script>";
                    echo    "Swal.fire({
                                position: 'center',
                                icon: 'success',
                                title: 'เพิ่มสินค้าสำเร็จ',
                                showConfirmButton: false,
                                timer: 900,
                                timerProgressBar: true
                                }).then((result) => {
                                    window.location.href = 'product.php';
                                })";
                    echo   "</script>";
                }else{
                    echo "<script type='text/javascript'>";
                    echo "window.location = 'product.php'; ";
                    echo "</script>";
                }
                mysqli_close($conn);

        }
        
    }
}

if(isset($_POST["edit-confirm"])){
    $id_pdc = $_POST['id_pdc'];
    $name_pdc = $_POST["name_pdc"];
    $size_pdc = $_POST["size_pdc"];
    $detail_pdc = $_POST["detail_pdc"];
    $price_pdc = $_POST["price_pdc"];


    $query = "UPDATE tbl_product 
    SET 
    name_pdc = '$name_pdc' , 
    size_pdc = '$size_pdc',
    detail_pdc = '$detail_pdc',
    price_pdc = '$price_pdc'
    WHERE id_pdc = '$id_pdc'";

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
                        window.location.href = 'product.php';
                    })
                </script>";
        $conn->close();
    }else{
        echo "Error : ",mysqli_error($conn) ;
        $conn->close();
    }
}


if(isset($_POST["editPic-confirm"])){
    $id_pdc = $_POST['id_pdc'];

    $pdcName = "productUpdate";

    // picture
    $date = date("YmdHis");

    $type = strrchr($_FILES['pic_pdc']['name'],".");

    $images = $_FILES["pic_pdc"]["tmp_name"];
    $picName = $pdcName.$date.$type;
    $width=500;
    $size=GetimageSize($images);
    $height=round($width*$size[1]/$size[0]);

    // $images_orig = ImageCreateFromJPEG($images);

    if($size[2] == 1) {
        $images_orig = imagecreatefromgif($images); //resize รูปประเภท GIF
    } else if($size[2] == 2) {
        $images_orig = imagecreatefromjpeg($images); //resize รูปประเภท JPEG
    } else{
        $images_orig = imagecreatefrompng($images); //resize รูปประเภท PNG
    }

    $photoX = ImagesX($images_orig);
    $photoY = ImagesY($images_orig);
    $images_fin = ImageCreateTrueColor($width, $height);
    ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width+1, $height+1, $photoX, $photoY);
    
    if($size[2] == 1) {
        ImageGIF($images_fin,"assets/images/products/".$picName);
    } else if($size[2] == 2) {
        ImageJPEG($images_fin,"assets/images/products/".$picName);
    } else{
        ImagePNG($images_fin,"assets/images/products/".$picName);
    }
    
    // ImageJPEG($images_fin,"images/upMeterPic/".$picName);

    ImageDestroy($images_orig);
    ImageDestroy($images_fin);

    $pic_pdc = $picName;

    $query = "UPDATE tbl_product 
    SET 
    pic_pdc = '$pic_pdc'
    WHERE id_pdc = '$id_pdc'";

        if($conn->query($query)){
            echo    "<script>";
            echo    "Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'เปลี่ยนรูปสินค้าสำเร็จ',
                        showConfirmButton: false,
                        timer: 900,
                        timerProgressBar: true
                        }).then((result) => {
                            window.location.href = 'product.php';
                        })";
            echo   "</script>";
        }else{
            echo "<script type='text/javascript'>";
            echo "window.location = 'product.php'; ";
            echo "</script>";
        }
        mysqli_close($conn);
}
?>