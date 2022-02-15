    <div class="container__option">
        <div class="story__head">
            <div class="story__head-title">Đặt bàn online</div>
            <div class="story__head-descript hotline">- Hotline 1900 0081 -</div>
        </div>
        <div class="margin-top-40"></div>

        <div class="option__content gutter-10">
            <div class="option__content-item w65pc col">
                <img src="./assets/img/order-img.jpg" alt="" class="option__content-img-order">
            </div>
            <div class="option__content-item w35pc col">

                <!-- form order -->
                <form action="./page/user/hanlde-order.php" class="form-order" id='form-order' method="POST">
                    <div class="form__wrap">
                        <div class="form__feild">
                            <div class="form__wrap-input">
                                <i class="fas fa-user form__field-icon"></i>
                                <input type="text" class="form__field-input" name="fullname" id="fullname" placeholder="Họ và Tên">
                            </div>
                            <span class="form__mess-error"></span>
                        </div>

                        <div class="form__feild">
                            <div class="form__wrap-input">
                                <i class="fas fa-phone-square-alt form__field-icon"></i>
                                <input type="text" class="form__field-input" name="phone-number" id="phone-number" placeholder="Số điện thoại">
                            </div>
                            <span class="form__mess-error"></span>
                        </div>

                        <div class="form__feild">
                            <div class="form__wrap-input">
                                <i class="far fa-calendar-alt form__field-icon"></i>
                                <input type="text" name="date" id="date" class="form__field-input" placeholder="Ngày" onfocus="this.type='date'" onblur="(this.type='text')">
                                <select name="time" id="time" class="form__select">
                                    <option value="">Giờ</option>
                                    <option value="11:00">11:00</option>
                                    <option value="11:15">11:15</option>
                                    <option value="11:30">11:30</option>
                                    <option value="11:45">11:45</option>
                                    <option value="12:00">12:00</option>
                                    <option value="12:15">12:15</option>
                                    <option value="12:30">12:30</option>
                                    <option value="12:45">12:45</option>
                                    <option value="13:00">13:00</option>
                                    <option value="11:15">11:15</option>
                                    <option value="11:30">11:30</option>
                                    <option value="11:45">11:45</option>
                                </select>
                            </div>
                            <span class="form__mess-error"></span>
                        </div>

                        <div class="form__feild">
                            <div class="form__wrap-input">
                                <i class="fas fa-search-location form__field-icon"></i>
                                <select name="location" id="location" class="form__select">
                                    <!-- get laction in db -->
                                    <option value="">Chọn địa chỉ</option>
                                    <?php
                                        $quertLocation = "SELECT * FROM coso";
                                        $data = renderViews($quertLocation);
                                        foreach($data as $row) {
                                            echo "<option value='" . $row['Ma'] ."'>" . $row['DiaChi'] . "</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                            <span class="form__mess-error"></span>
                        </div>

                        <div class="form__feild">
                            <div class="form__wrap-input num-people">
                                <i class="fas fa-user form__field-icon form__field-icon"></i>
                                <input type="text" class="form__field-input" id="num-adult" name="adult" placeholder="Người lớn">
                                <input type="text" class="form__field-input" id="num-child" name="child"  placeholder="Trẻ em">
                            </div>
                            <span class="form__mess-error"></span>
                        </div>

                        <div class="form__feild field-note">
                            <div class="form__wrap-input">
                                <i class="fas fa-pencil-alt form__field-icon"></i>
                                <textarea class="form__note" type="text" cols="40" rows="3" name="note" aria-invalid="false" placeholder="Ghi chú"></textarea>
                            </div>
                        </div>
                        <div class="form__feild-wrap-submit">
                            <input type="submit" name="btn-submit" value="Đặt Bàn" class="form-order__submit">
                        </div>
                    </div>
                </form>

            </div>
        </div>

        <div class="margin-top-40"></div>
    </div>