<div class="Category__right-item" id="news" data="3">
    <h2>Tin Tức</h2>
    <table border="1">
        <tr>
            <th>Hình ảnh đại diện</th>
            <th>Tiêu đề</th>
            <th>Người đăng</th>
            <th>Loại</th>
        </tr>
        <?php 
            $sql = "SELECT representativeImage,title,userName,endow.type FROM endow";

            $result = renderViews($sql);
            $BaseURL = "../../assets/img/";

            foreach($result as $item) {
                echo '
                <tr>
                    <td><img src="'.$BaseURL.$item['representativeImage'].'" alt="" width="150px"></td>
                    <td>'.$item['title'].'</td>
                    <td>'.$item['userName'].'</td>
                    <td>'.$item['type'].'</td>
                </tr>
                ';
            }
        ?>
    </table>
</div>