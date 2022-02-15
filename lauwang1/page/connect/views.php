<?php 
    require_once ('config.php');

    function connect ($sql) {
        $conn = new mysqli(Server,User,Password,Database);

        mysqli_set_charset($conn,'utf-8');

        if($conn->connect_error) {
            die("Kết nối cơ sở dữ liệu thất bại");
        }
        $result =  $conn->query($sql);
        if($result == true) {
            $susses = true;
        } else {
            $susses = false;
        }

        $conn->close();
        
        return $susses;
    }

    function renderViews ($sql, $isSingle=false) {
        $conn = new mysqli(Server,User,Password,Database);
        $data = null;
        mysqli_set_charset($conn,'utf-8');

        if($conn->connect_error) {
            die();
        }

        $result = $conn->query($sql);
        if($isSingle) {
            $data = mysqli_fetch_array($result,1);
        } else {
            $data = [];
            foreach($result as $item) {
                $data[] = $item;
            }
        }

        $conn->close();

        return $data;
    }




    // // chuyển đổi mật khẩu
    function convertMD5 ($pwd) {
        return md5(md5($pwd).key);
    }
    

