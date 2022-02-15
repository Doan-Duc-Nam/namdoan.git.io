<?php
    require_once ('../../connect/views.php');

    if(!empty($_POST)) {
        $user = $_POST['User'];
        $pwd = $_POST['Password'];

        $msErorr = [];

        if($user === "") {
            $msErorr['user']['require'] = "Vui lòng nhập user";
        }

        if($pwd === "") {
            $msErorr['password']['require'] = 'Vui lòng nhập mật khẩu';
        }

        if(!empty($user)&&!empty($pwd)) {

            // chuyển đổi mật sang bảo mật 2 lớp
            $pwd = convertMD5($pwd);

            $sql = "SELECT * FROM NhanVien WHERE userName='$user' and MatKhau = '$pwd'";
            
            $result = renderViews ($sql,true);

            if($result != null) {
                $_SESSION['FullName'] = $result['HoTen'];
                header("location: ../index.php");
                die();    
            } else {
                $msErorr['action']['erorr'] = 'Đăng nhập thất bại';
            }
        }

    }