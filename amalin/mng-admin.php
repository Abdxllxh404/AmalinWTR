<?php
    require_once('connect.php');
    include('auth-admin.php');


    $id_admin  = $_SESSION['id_admin'];
    $fname_admin = $_SESSION['fname_admin'];
    $lname_admin = $_SESSION['lname_admin'];
    $user_admin = $_SESSION['user_admin'];
    $pass_admin = $_SESSION['p_admin'];
    $tel_admin = $_SESSION['tel_admin'];

    $sql_admin = "SELECT * FROM tbl_admin";
    $result_admin = $conn->query($sql_admin) or die("Query failed");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>บัญชีผู้ดูแลระบบ - น้ำดื่มอมาลิน</title>
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
                                <li class="submenu-item ">
                                    <a href="mng-user.php">ผู้ใช้งานทั่วไป</a>
                                </li>
                                <li class="submenu-item active">
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
                            <h3>บัญชีผู้ดูแลระบบ</h3>
                            <p class="text-subtitle text-muted">เพิ่ม ลบ แก้ไข บัญชีผู้ดูแลระบบ</p>
                        </div>
                        <div class="col-12 col-md-6 order-md-2 order-first">
                            <nav aria-label="breadcrumb" class="breadcrumb-header float-start float-lg-end">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="mng-page.php">หน้าแรก</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">บัญชีผู้ดูแลระบบ</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>

                <section class="section">
                    <div class="card">
                        <div class="card-header d-flex bd-highlight">
                            <div class="p-2 bd-highlight">
                                ตาราง บัญชีผู้ดูแลระบบ
                            </div>
                            <div class="ms-auto p-2 bd-highlight">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#addAdminForm">
                                    สร้างบัญชี
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-striped" id="tableProduct">
                                <thead>
                                    <tr>
                                        <th class="text-center">ชื่อผู้ใช้</th>
                                        <th class="text-center">เปลี่ยนรหัสผ่าน</th>
                                        <th class="text-center">ชื่อ</th>
                                        <th class="text-center">นามสกุล</th>
                                        <th class="text-center">เบอร์โทร</th>
                                        <th class="text-center">แก้ไข</th>
                                        <th class="text-center">ลบ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while ($row_admin = $result_admin->fetch_assoc()) {
                                    ?>
                                    <tr class="text-center">
                                        <td><?php echo $row_admin['user_admin']; ?></td>
                                        <td>
                                            <!-- <a class="btn btn-warning"
                                                href="mng-admin.php?action=delete&id_del=<?php echo $row_admin['id_admin'];; ?>">เปลี่ยน</a> -->
                                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#CPassModal"
                                                data-bs-whatever="<?php echo $row_admin['id_admin']; ?>">เปลี่ยน</button>
                                        </td>
                                        <td><?php echo $row_admin['fname_admin']; ?></td>
                                        <td><?php echo $row_admin['lname_admin']; ?></td>
                                        <td><?php echo $row_admin['tel_admin']; ?></td>

                                        <td>
                                            <a class="btn btn-warning"
                                                href="mng-edit-admin.php?action=edit&id_edit=<?php echo $row_admin['id_admin']; ?>">แก้ไข</a>
                                        </td>
                                        <?php
                                        if($id_admin == $row_admin['id_admin']){
                                        ?>
                                        <td>
                                            <button type="button" class="btn btn-danger btn-close" aria-label="Close"
                                                disabled></button>
                                        </td>
                                        <?php    
                                        }else{
                                        ?>
                                        <td>
                                            <a class="btn btn-danger"
                                                href="mng-admin.php?action=delete&id_del=<?php echo $row_admin['id_admin']; ?>">ลบ</a>
                                        </td>
                                        <?php    
                                        }
                                        ?>
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

            <!--Change form Modal -->
            <div class="modal fade" id="CPassModal" tabindex="-1" aria-labelledby="CPass" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="CPass">เปลี่ยนรหัสผ่าน</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form method="POST" onSubmit="return checkPassForCPass(this)">
                            <div class="modal-body">
                                <input type="hidden" class="form-control" id="recipient-name" name="CP_id_admin">
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">รหัสผ่าน:</label>
                                    <input type="password" placeholder="รหัสผ่าน (Password)" class="form-control"
                                        name="CPass_admin" pattern=".{6,}" title="รหัสมากกว่า 6 ตัว" required>
                                </div>
                                <div class="mb-3">
                                    <label for="message-text" class="col-form-label">ยืนยันรหัสผ่าน:</label>
                                    <input type="password" placeholder="ยืนยันรหัสผ่าน (Confirm Password)"
                                        class="form-control" name="CPass_ag_admin" pattern=".{6,}"
                                        title="รหัสมากกว่า 6 ตัว" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ปิด</button>
                                <input type="submit" class="btn btn-primary" name="CPass-confirm" value="ตกลง"></input>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            
            <!--add admin account form Modal -->
            <div class="modal fade text-left" id="addAdminForm" tabindex="-1" role="dialog"
                aria-labelledby="addAdminForm" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="addAdminForm">สร้างบัญชี </h4>
                            <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                                <i data-feather="x"></i>
                            </button>
                        </div>
                        <form method="POST" onSubmit="return checkPass(this)">
                            <div class="modal-body">
                                <label>ชื่อ: </label>
                                <div class="form-group mt-2 mb-3">
                                    <input type="text" placeholder="ชื่อ" class="form-control" name="fname_admin"
                                        required>
                                </div>
                                <label>นามสกุล: </label>
                                <div class="form-group mt-2 mb-3">
                                    <input type="text" placeholder="นามสกุล" class="form-control" name="lname_admin"
                                        required>
                                </div>
                                <label>เบอร์โทร: </label>
                                <div class="form-group mt-2 mb-3">
                                    <input type="text" placeholder="เบอร์โทร" class="form-control" name="tel_admin"
                                        pattern="[0-9]{10}" title="กรอกเฉพาะตัวเลข 10 หลัก" placeholder="เบอร์โทร"
                                        required>
                                </div>
                                <label>ชื่อผู้ใช้: </label>
                                <div class="form-group mt-2 mb-3">
                                    <input type="text" placeholder="ชื่อผู้ใช้ (Username)" class="form-control"
                                        name="user_admin" required>
                                </div>
                                <label>รหัสผ่าน: </label>
                                <div class="form-group mt-2 mb-3">
                                    <input type="password" placeholder="รหัสผ่าน (Password)" class="form-control"
                                        name="pass_admin" pattern=".{6,}" title="รหัสมากกว่า 6 ตัว" required>
                                </div>
                                <label>ยืนยันรหัสผ่าน: </label>
                                <div class="form-group mt-2 mb-3">
                                    <input type="password" placeholder="ยืนยันรหัสผ่าน (Confirm Password)"
                                        class="form-control" name="pass_ag_admin" pattern=".{6,}"
                                        title="รหัสมากกว่า 6 ตัว" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light-secondary" data-bs-dismiss="modal">
                                    <span>ปิด</span>
                                </button>
                                <input type="submit" class="btn btn-success" name="conf_register" value="สร้าง">
                                <i class="bx bx-check d-block d-sm-none"></i>
                                </input>
                            </div>
                        </form>
                    </div>
                </div>
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

    <script>
    var exampleModal = document.getElementById('CPassModal')
    exampleModal.addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var recipient = button.getAttribute('data-bs-whatever')
        // If necessary, you could initiate an AJAX request here
        // and then do the updating in a callback.
        //
        // Update the modal's content.
        var modalTitle = exampleModal.querySelector('.modal-title')
        var modalBodyInput = exampleModal.querySelector('.modal-body input')

        modalBodyInput.value = recipient
    })
    </script>

    <script>
    // Function เพื่อตรวจสอบรหัสผ่านว่าตรงกันหรือไม่
    function checkPass(form) {
        pass_admin = form.pass_admin.value;
        pass_ag_admin = form.pass_ag_admin.value;

        if (pass_admin != pass_ag_admin) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'รหัสผ่านไม่ตรงกัน',
                confirmButtonColor: '#F42444',
                confirmButtonText: 'กรอกรหัสผ่านใหม่',
                timer: 1500,
                timerProgressBar: true
            })
            return false;
        }
    }
    </script>

    <script>
    // Function เพื่อตรวจสอบรหัสผ่านว่าตรงกันหรือไม่
    function checkPassForCPass(form) {
        CPass_admin = form.CPass_admin.value;
        CPass_ag_admin = form.CPass_ag_admin.value;

        if (CPass_admin != CPass_ag_admin) {
            Swal.fire({
                position: 'center',
                icon: 'error',
                title: 'รหัสผ่านไม่ตรงกัน',
                confirmButtonColor: '#F42444',
                confirmButtonText: 'กรอกรหัสผ่านใหม่',
                timer: 1500,
                timerProgressBar: true
            })
            return false;
        }
    }
    </script>

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
            timer: 800,
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
                    window.location.href = 'mng-admin.php?action=confirm-del&id_del=".$id_del."'
                }else{
                    window.location.href = 'mng-admin.php'
                }
            });";
    echo   "</script>";
}


if(isset($_GET['action'])&& $_GET['action']=='confirm-del'){
    $id_del = $_GET["id_del"];

    $sql_del ="DELETE FROM tbl_admin WHERE id_admin='$id_del' ";
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
                    window.location.href = 'mng-admin.php'
                })";
    echo   "</script>";
    mysqli_close($conn);

}


if(isset($_POST["conf_register"])&&!empty($_POST["conf_register"]))
{
    $fname_admin = $_POST["fname_admin"];
    $lname_admin = $_POST["lname_admin"];
    $user_admin = $_POST["user_admin"];
    $pass_admin = $_POST["pass_admin"];
    $tel_admin = $_POST["tel_admin"];

    $pass_adminEc = md5($pass_admin);

	$check = "SELECT user_admin
	FROM tbl_admin
	WHERE user_admin = '$user_admin'";
    $resultCheck = mysqli_query($conn, $check) or die(mysqli_error());
    $numRow = mysqli_num_rows($resultCheck);

    if($numRow > 0)
    {
    echo    "<script>";
    echo    "Swal.fire({
                position: 'center',
                icon: 'warning',
                title: 'ชื่อผู้ใช้อยู่ในระบบแล้ว!',
                text: 'กรุณาตรวจสอบใหม่อีกครั้ง',
                confirmButtonText: 'ตกลง',
                timer: 2100,
                timerProgressBar: true
                })";
    echo   "</script>";
    }else{
        $sql = "INSERT INTO tbl_admin (id_admin, fname_admin, lname_admin, user_admin, pass_admin, tel_admin)
        VALUES (null, '$fname_admin', '$lname_admin', '$user_admin', '$pass_admin', '$tel_admin')";
        $result = mysqli_query($conn, $sql) or die (mysqli_error());

        if($result){
            echo    "<script>";
            echo    "Swal.fire({
                        position: 'center',
                        icon: 'success',
                        title: 'ลงทะเบียนสำเร็จ',
                        showConfirmButton: false,
                        timer: 1200,
                        timerProgressBar: true
                        }).then((result) => {
                            window.location.href = 'mng-admin.php';
                        })";
            echo   "</script>";
        }
        else{
            echo "<script type='text/javascript'>";
            echo "window.location = 'mng-admin.php'; ";
            echo "</script>";
        }
    }
        mysqli_close($conn);
}


if(isset($_POST["CPass-confirm"])){
    $CP_id_admin = $_POST['CP_id_admin'];
    $pass_admin = $_POST["CPass_admin"];

    $pass_adminEc = md5($pass_admin);

    $query = "UPDATE tbl_admin 
    SET 
    pass_admin = '$pass_adminEc'
    WHERE id_admin = '$CP_id_admin'";

    if($conn->query($query)){
        echo "<script>
                    Swal.fire({
                    position: 'center',
                    icon: 'success',
                    title: 'เปลี่ยนรหัสผ่านสำเร็จ',
                    showConfirmButton: false,
                    timer: 900,
                    timerProgressBar: true
                    }).then((result) => {
                        window.location.href = 'mng-admin.php';
                    })
                </script>";
        $conn->close();
    }else{
        echo "Error : ",mysqli_error($conn) ;
        $conn->close();
    }
}



?>