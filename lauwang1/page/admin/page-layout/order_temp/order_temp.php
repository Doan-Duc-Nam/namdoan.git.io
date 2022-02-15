<?php
    if(isset($_POST['add'])||isset($_POST['delete'])) {
        if(isset($_POST['Order'])) {
            $Order = $_POST['Order'];
            if(isset($_POST['table'])) {
                $table = $_POST['table'];
                // lấy ra bảng order
                $sql = "SELECT * FROM order_temp WHERE ma=$Order";
                $result = renderViews($sql,true);
                if(isset($_POST['add'])) {
                    if($result !=null) {
                        // lấy dữ liệu từ bảng order_temp
                        $HoTen = $result['ho_ten'];
                        $SDT = $result['sdt'];
                        $ngay = $result['ngay'];
                        $gio = $result['gio'];
                        $Dia_chi = $result['dia_chi'];
                        $num_adult = $result['num_adult'];
                        $num_child = $result['num_child'];
                        $note = $result['note'];
        
                        // thêm dữ liệu vào bảng Khách Hàng
                        $sql = "INSERT INTO khachhang VALUES(NULL,'$HoTen','$SDT','$note','$ngay','$gio',$num_adult,$num_child,$Dia_chi,$table)";
                        connect($sql);
        
                        // UPDATE Trạng thái của bàn
                        $sql = "UPDATE `ban` SET `TinhTrang` = '1' WHERE `ban`.`MaBan` = $table";
                        connect($sql);
                    }
                }
            }
            // xóa khỏi bảng order_temp
            $sql = "DELETE FROM order_temp WHERE ma= $Order";
            connect($sql);
        }

    }
?>

<div class="check-order Category__right-item" data="0" id="order">
    <h2>Bàn đang chờ duyệt</h2>
    <form method="post">
        <table id="contain-data" border=1>
            <tr>
                <th>Mã</th>
                <th>Họ tên</th>
                <th>Số điện thoại</th>
                <th>Ngày</th>
                <th>Giờ</th>
                <th>Cơ Sở</th>
                <th>Số người lớn</th>
                <th>Số trẻ em</th>
                <th>Chi chú</th>
                <th>Nhập mã bàn</th>
            </tr>
            <?php
                $sql = "SELECT * FROM coso JOIN order_temp ON coso.Ma = order_temp.dia_chi";
                $result = renderViews($sql);

                if ($result != null) {

                    $tempIndex = 0;

                    foreach($result as $item) {
                        $table = '';
                        $maCoSo = $item['dia_chi']; //dia_chi ở đây là mã địa chỉ
                        $selectIdTable = "SELECT MaBan
                                        FROM coso JOIN ban ON coso.Ma = ban.MaCS
                                        WHERE MaCS = $maCoSo AND TinhTrang = 0";

                        $idTableByIdCS = renderViews($selectIdTable);

                        foreach($idTableByIdCS as $itemTable) {
                            $table .= "<option value='" . $itemTable['MaBan'] . "'>" . $itemTable['MaBan'] . "</option>";
                        }

                        echo "
                            <tr>
                                <td class='order'>
                                    <input  type='text' value='".$item['ma']."' name='Order' readonly>
                                </td>
                                <td>" . $item['ho_ten'] . "</td>
                                <td>" . $item['sdt'] . "</td>
                                <td>" . $item['ngay'] . "</td>
                                <td>" . $item['gio'] . "</td>
                                <td value='$maCoSo'>" . $item['DiaChi'] . "</td>
                                <td>" . $item['num_adult'] . "</td>
                                <td>" . $item['num_child'] . "</td>
                                <td>" . $item['note'] . "</td>
                                <td>
                                    <select name='table'>
                                        $table
                                    </select>
                                </td>
                                <td>
                                    <input type='submit' id='btn-add' style='width: 80px; display: inline-block; padding: 7px 0' value='Duyệt' name='add' onclick='return Click(this)'>
                                    <input type='submit' id='btn-delete' style='width: 80px; display: inline-block; padding: 7px 0; margin-top: 8px' value='Huỷ' name='delete' onclick='return Click(this)'>
                                </td>
                            </tr>
                        ";
                    }
                }
            ?>
        </table>
    </form>
</div>