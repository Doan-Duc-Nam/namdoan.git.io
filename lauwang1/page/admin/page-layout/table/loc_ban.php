<?php 
    if(isset($_POST['DiaChi'])&&isset($_POST['chart'])) {
        $DiaChi = $_POST['DiaChi'];
        $TinhTrang = $_POST['chart'];
        if($_POST['chart']==0) {
            $check = true;
        } else {
            $check = false;
        }
    }
?>

<div class="Category__right-item" id="table" data="1">
    <h2>Bàn đã được đặt và bàn trống</h2>
    <form method="POST" class="form2">
        <div class="form-left">
            <span>Cơ sở</span>
            <select name="DiaChi" id="selectTable">
                <?php
                $select = false;
                $sql = "SELECT * FROM coso";
                $result = renderViews($sql);
                foreach ($result as $item) {
                    $element = '<option value='. $item['Ma'] .'>' . $item['DiaChi'] . '</option>';
                    if(isset($DiaChi)) {
                        $element = '<option selected value='. $item['Ma'] .'>' . $item['DiaChi'] . '</option>';
                        if($DiaChi!=$item['Ma']) {
                            $element = str_replace('selected','',$element);
                        }
                    }
                    echo $element;
                }
                ?>
            </select>

            <div class="check">
                <input type="radio" name="chart" value="0" id='emty' <?php 
                    if(isset($check)&&$check) {
                        echo 'checked';
                    }
                ?>>
                <label for="emty">Bàn trống</label>
            </div>

            <div class="check">
                <input type="radio" name="chart" value="1" id='placed' <?php
                    if(isset($check)&&!$check) {
                        echo 'checked';
                    }
                ?>>
                <label for="placed">Bàn được đặt</label>
            </div>
        </div>

        <input type="submit" value="Lọc" name="filter">
    </form>
    <table border=1>
        <tr>
            <?php
            $erorr = false;
            if (isset($TinhTrang)) {
                if ($TinhTrang == 0) {
                    echo '
                    <tr>
                        <th>Mã Bàn</th>
                        <th>Địa chỉ</th>
                        <th>Tình Trạng</th>
                    </tr>
                    ';
                    $sql = "SELECT MaBan,DiaChi, TinhTrang FROM ban, coso  WHERE ban.MaCS = coso.Ma AND TinhTrang='$TinhTrang' AND coso.Ma = '$DiaChi'";
                } else {
                    echo '
                        <tr>
                            <th>Số Bàn</th>
                            <th>Họ Tên</th>
                            <th>Số Điện thoại</th>
                            <th>Địa chỉ cơ sở</th>
                            <th>Ngày</th>
                            <th>Giờ</th>
                            <th>Số người lớn</th>
                            <th>Số trẻ em</th>
                        </tr>
                    ';
                    $sql = "SELECT khachhang.MaBan,khachhang.HoTen,khachhang.SDT,khachhang.Ngay, khachhang.Gio ,coso.DiaChi,ban.TinhTrang,num_adult,num_child 
                                            FROM khachhang, coso, ban WHERE khachhang.MaCS = coso.Ma AND ban.MaBan = khachhang.MaBan AND khachhang.MaCS ='$DiaChi'";
                }

                $result = renderViews($sql);
                if ($result == null) {
                    $erorr = true;
                } else {
                    for ($i = 0; $i < count($result); $i++) {
                        $tinhtrang = $result[$i]['TinhTrang'] == '0' ? "Bàn trống" : "Bàn đã được đặt";
                        if ($result[$i]['TinhTrang'] == 0) {
                            echo '
                            <tr>
                                <td>' . $result[$i]['MaBan'] . '</td>
                                <td>' . $result[$i]['DiaChi'] . '</td>
                                <td>' . $tinhtrang . '</td>
                            </tr>
                            ';
                        } else {
                            echo '
                                <tr>
                                    <td>' . $result[$i]['MaBan'] . '</td>
                                    <td>' . $result[$i]['HoTen'] . '</td>
                                    <td>' . $result[$i]['SDT'] . '</td>
                                    <td>' . $result[$i]['DiaChi'] . '</td>
                                    <td>' . $result[$i]['Ngay'] . '</td>
                                    <td>' . $result[$i]['Gio'] . '</td>
                                    <td>' . $result[$i]['num_adult'] . '</td>
                                    <td>' . $result[$i]['num_child'] . '</td>
                                </tr>
                            ';
                        }
                    }
                }
            }
            ?>
        </tr>
    </table>
    <span style="display: inline-block; padding-left: 29px; 
        <?php
            if ($erorr == false) {
                echo 'display: none;';
            }
        ?>
    ">
        Không tìm thấy dữ liệu.....
    </span>
</div>