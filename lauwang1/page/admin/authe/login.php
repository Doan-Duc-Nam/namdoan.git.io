<?php 
    session_start();
    if(isset($_SESSION['FullName'])) {
        header("location: ../index.php");
    }
    require_once "Login_handling.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Đăng Nhập | Lẩu Ngon Cho Người Việt</title>
</head>
<body>
    <div class="app">
        <h2>Đăng Nhập</h2>
        <form method="post">
            <div class="form-group">
                <label for="User">User: </label>
                <input type="text" name="User" id="User" value="<?=isset($user)?$user:false?>">
                <span class="messeageErorr">
                    <?=isset($msErorr['user']['require'])?$msErorr['user']['require']:false?>
                </span>
            </div>
            <div class="form-group">
                <label for="password">Password: </label>
                <input type="password" name="Password" id="password">
                <span class="messeageErorr">
                    <?=isset($msErorr['password']['require'])?$msErorr['password']['require']:false?>
                </span>
            </div>
            <span><?=isset($msErorr['action']['erorr'])?$msErorr['action']['erorr']:false?></span>
            <div class="form-submit">
                <input type="submit">
            </div>
        </form>
    </div>
</body>
</html>