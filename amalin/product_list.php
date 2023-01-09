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
    <title>สินค้า - น้ำดื่มอมาลิน</title>
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
                        <li class="sidebar-item active">
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
                            <h3>รายละเอียดสินค้า</h3>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="index.php">หน้าแรก</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">รายละเอียดสินค้า</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="row row-cols-1 row-cols-md-5 g-5 mt-3">
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
                                        <span class="badge bg-primary"><?php echo $row_product['size_pdc']; ?></span>
                                        มิลลิลิตร
                                    </li>

                                    <li class="list-group-item commaFunc"
                                        id="price<?php echo $row_product['id_pdc']; ?>">
                                        ราคา :
                                        <span class="badge bg-success"><?php echo $row_product['price_pdc']; ?></span>
                                        บาท
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