<?php 
    if(!empty($_POST)&&!empty($_FILES)) {
        $BaseURL = "../../assets/img/";
        $Name = getPost('Name');
        $Price = getPost('Price');
        $Description = getPost('Description');
        $img = $_FILES['image'];

        if(empty($Name)||empty($Price)||empty($Description)||empty($img)) {
            $msg = 'Vui lòng nhập đủ thông tin các trường';
        } else {
            if($img['type']==='image/jpeg'||$img['type']==='image/png') {
                $type = explode('/',$img['type']);
                $index = count($type)-1;
                $nameImg = random_name_photo($img['name']).'.'.$type[$index];

                $sql = "INSERT INTO thucdon VALUES(NULL,'$Name','$Price','$nameImg','$Description')";
                $result = connect($sql);
                print_r($result);
                $url = $BaseURL.$nameImg;
                move_uploaded_file($img['tmp_name'],$url);
            } else {
                $msg =  "file phải là jpg hoặc png";
            }
        }
    }

    if(isset($_POST['DELETE'])) {
        $delete = $_POST["DELETE"];
        $ID = $_POST['ID'];

        if(isset($_POST['DELETE'])) {
            $sql = "DELETE FROM thucdon WHERE Ma = $ID";
            connect($sql);
        }
    }

    if(isset($_POST['ID'])) {
        $ID = $_POST['ID'];

        echo $ID;
    }
?>
<div class="Category__right-item" id="menu" data="2">
    <div class="heading">
        <h2>Thực Đơn</h2>
        <button name="insertMenu" onclick="return Update(this)">Thêm thực đơn</button>
    </div>
    <table border="1">
        <tr>
            <th>Hình ảnh</th>
            <th>Tên</th>
            <th>Giá</th>
            <th>Mô tả</th>
        </tr>
        <?php
            $sql = "SELECT * FROM thucdon";
            $result = renderViews($sql);
            $BaseURL = "../../assets/img/";
            foreach($result as $item) {
                echo '
                    <tr class="menuJS" data='.$item['Ma'].'>
                        <td><img src="'.$BaseURL.''.$item['image'].'" alt="" width="150px"></td>
                        <td>'.$item['Ten'].'</td>
                        <td>'.$item['gia'].'</td>
                        <td>'.$item['MoTa'].'</td>
                        <td style="white-space: nowrap;">
                            <form action="" method="post">
                                <input type="text" name="ID" style="display: none;" value='.$item['Ma'].' readonly>
                                <input type="submit" style="width: 80px; display: inline-block; padding: 7px 0" name="DELETE" value="Xóa" onclick="return Click(this)">
                                <input type="button" style="width: 80px; display: inline-block; padding: 7px 0" name="insertMenu" value="Sửa" onclick="return Update(this)">
                            </form>
                        </td>
                    </tr>
                ';
            }
        ?>
    </table>

    <div class="span-line"></div>
    <form method="post" enctype="multipart/form-data" id="insertMenu" class="form3" onsubmit="return validateFrom()">
        <h2>THÊM / SỬA THỰC ĐƠN</h2>
        <div class="form-group">
            <span>Tên</span>
            <input type="text" name="Name" style="width: 500px">
        </div>
        <div class="form-group">
            <span>Giá</span>
            <input type="text" name="Price">
        </div>
        <div class="form-group">
            <span>Mô tả</span>
            <textarea name="Description" id='thucDonNode' style="width: 500px; height: 300px; padding: 20px; outline: none;"></textarea>
        </div>
        <div class="form-group" style="flex-direction: column;">
            <input type="file" name="image" id="fileMenu" style="outline: none;"><br>
            <img src="" alt="" id="imgFile" width="200px">
        </div>
        <span style="height: 20px; width: fit-content; color: red;"><?=isset($msg)?$msg:false?></span><br>
        <div class="submit-form">
            <input type="submit" value="Thêm">
        </div>
    </form>
</div>

