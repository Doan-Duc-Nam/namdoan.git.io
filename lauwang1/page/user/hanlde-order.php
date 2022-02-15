<?php
    require "../connect/views.php";
    if(!empty($_POST)) {
        $fullName = $_POST['fullname'];
        $phoneNumber = $_POST['phone-number'];
        $date = $_POST['date'];
        $time = $_POST['time'];
        $location = $_POST['location'];
        $numAdult = $_POST['adult'];
        $numChild = $_POST['child'];
        $note = $_POST['note'];

        // check xem bài full ko

        // thêm dữ liệu
        $stringInsertOrderTemp = "INSERT INTO order_temp VALUES(NULL,'$fullName', '$phoneNumber', '$date', '$time', '$location', '$numAdult', '$numChild', '$note')";
        $result = connect($stringInsertOrderTemp);

        if($result==true) {
            echo "Đặt bàn thành công ";
        } else {
            echo "Có lỗi khi đặt bàn, LH: 098123";
        }
    }
?>
<br>
<a href="../../index.php">Quay về trang chủ</a>