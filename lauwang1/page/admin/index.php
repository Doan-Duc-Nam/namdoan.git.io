<?php 
    session_start();
    require_once ("../connect/views.php");
    include_once ("../unitity/handel.php");
    if(!isset($_SESSION['FullName'])) {
        header("location: ./authe/login.php");
    }

    if(isset($_GET['action'])) {
        $action = $_GET['action'];
        if(!empty($action)&&$action==='Logout') {
            unset($_SESSION['FullName']);
            header("location: ./authe/login.php");
            die();
        }
    }

    if(isset($_GET['ID'])) {
        echo $_GET['ID'];
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <base href="">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./css/Home_page.css">
    <title>Lẩu Wang | Lẩu Ngon Cho Người Việt</title>
</head>
<style>
    .form3 {
        display: block;
    }

    html,body {
        scroll-behavior: smooth !important;
    }

    .nav_Category {
        position: sticky;
        top: 50px;
        left: 0;
    }

    .smoothJS{
        width: fit-content;
        padding-right: 20px;
        display: flex;
        justify-content: flex-start;
        align-items: center;
        position: relative;
        height: 30px;
        overflow: hidden;
    }

    .smoothJS:hover {
        text-decoration: none;
    }


    .smoothJS::before
    {
        content: '';
        background-color: #fe4b09;
        position: absolute;
        padding: 10px;
        width: 0;
        left: -30px;
        height: 100%;
        z-index: -1;
        border-bottom-right-radius: 20px;
        border-top-right-radius: 20px;
        transition: all .2s ease-in;
    }
    .smoothJS:hover::before,
    .active_nav::before {
        left: 0;
        width: 100%;
    }

    .smoothJS:hover,
    .active_nav {
        color: white;
    }

    
    .span-line {
        width: 50%;
        margin: 30px auto;
        height: 1px;
        background-color: #333;
    }

    .form-group > input {
        padding-left: 10px;
        outline: none;
    }

    .order>input {
        text-align: center;
        outline: none;
        border: none;
        user-select: none;
        width: 50px;
    }


    /* :not(.node) {
        white-space: nowrap;
    } */
</style>
<body>
    <div class="app">
        <h1 style="text-align: center;">Lẩu Wang</h1>
        <div class="Category">
            <div class="Category__left">
                <ul class="nav_Category">
                    <li><a href="#order" class="smoothJS active_nav" data-scroll="0">Bàn đang chờ duyệt</a></li>
                    <li><a href="#table" class="smoothJS" data-scroll="1">Bàn đã được đặt và bàn trồng</a></li>
                    <li><a href="#menu" class="smoothJS" data-scroll="2">Thực đơn</a></li>
                    <li><a href="#news" class="smoothJS" data-scroll="3">Tin tức</a></li>
                </ul>
            </div>
            <div class="Category__right">
                <!-- hiển tên người dùng đã đăng nhập -->
                <div class="user">
                    <?php 
                        if(isset($_SESSION['FullName'])) {
                            echo '<span> Xin chào '.$_SESSION['FullName'].' <a href="?action=Logout">( Đăng xuất )</a></span>';
                        }
                    ?>
                </div>
                <!--end hiển tên người dùng đã đăng nhập -->
                
                <!-- Xử lý chờ đặt bàn -->
                <?php include_once "../admin/page-layout/order_temp/order_temp.php"?>
                <div class="span-line"></div>
                <!-- end xử lý chờ đặt bàn -->
                <?php include_once "../admin/page-layout/table/loc_ban.php"?>
                <!-- hiển thi và lọc kết quả bàn -->
                <div class="span-line"></div>
                <!-- end xử lý -->
                <!-- xử lý menu -->
                <?php include_once "../admin/page-layout/menu/menu.php"?>
                <!-- end -->
                <div class="span-line"></div>
                <!-- xử lý tin tức -->
                <?php 
                    include_once "../admin/page-layout/News/News.php";
                ?>
                <!-- end xử lý-->
            </div>
        </div>
    </div>
    <?php include_once "../admin/page-layout/script/script.php"?>
</body>
</html>