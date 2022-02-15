<?php
require_once "./page/unitity/handel.php";

if (empty($_GET['action'])) :
    $action = 'home';
else :
    $action = getGet('action');
endif;

switch ($action):
    case 'introduce':
        $title = 'Giới thiệu - Lẩu Wang - Vua Buffet Lẩu - Chuỗi Nhà Hàng Buffet';
        break;
    case 'menu':
        $title = 'Thực đơn - Lẩu Wang';
        break;
    case 'put_table':
        $title = 'Đặt bàn - Lẩu Wang';
        break;
    case 'endow':
        $title = 'Ưu đãi - Chương Trình Khuyến Mại tại Lẩu Wang - Vua Buffet Lẩu';
        break;
    case 'blog':
        $title = 'Blog - Lẩu Wang';
        break;
    default:
        $title = 'Lẩu Wang - Vua Buffet Lẩu - Hệ Thống Chuỗi Nhà Hàng Buffet Hà Nội';
endswitch;

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <base href="http://localhost/Lauwang1/" />
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" href="./assets/css/app.css">
    <link rel="icon" href="https://lauwang.vn/wp-content/uploads/2020/07/cropped-gg-192x192.png" sizes="192x192">
    <title><?php echo isset($title) ? $title : 'Lẩu Wang - Vua Buffet Lẩu - Hệ Thống Chuỗi Nhà Hàng Buffet Hà Nội' ?></title>
</head>

<body>
    <!-- connect database -->
    <?php
    require "./page/connect/views.php";
    ?>
    <!-- header -->
    <div class="header">
        <div class="container header__content">
            <div class="header_left">
                <a href="">
                    <img src="https://lauwang.vn/wp-content/uploads/2020/08/logo-Lẩu-Wang-01.png" alt="" style="width:150px">
                </a>
            </div>
            <div class="header_center">
                <ul class="header__menu">
                    <li class="header__menu-item"><a href="">Trang Chủ</a></li>
                    <li class="header__menu-item"><a href="gioi-thieu/">Giới Thiệu</a></li>
                    <li class="header__menu-item"><a href="thuc-don/">Thực Đơn</a></li>
                    <li class="header__menu-item"><a href="uu-dai/">Ưu Đãi</a></li>
                    <li class="header__menu-item"><a href="dat-ban/">Đặt Bàn</a></li>
                    <li class="header__menu-item"><a href="blog/">Blog</a></li>
                </ul>
            </div>
            <div class="header_right">
                <div class="header-icon">
                    <a href="https://www.facebook.com/buffetlauwang" target="_blank">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a href="https://www.instagram.com/lauwang.buffet/" target="_blank">
                        <i class="fab fa-instagram"></i>
                    </a>
                    <a href="https://www.youtube.com/channel/UCFgIrScG4krCGh7eCPz8DnA/videos" target="_blank">
                        <i class="fab fa-youtube"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <!-- end header -->

    <!-- container -->
    <!-- Xử lý chuyển trang -->
    <?php
    switch ($action):
        case 'introduce':
            $title = 'Giới thiệu - Lẩu Wang - Vua Buffet Lẩu - Chuỗi Nhà Hàng Buffet';
            echo '<div class="margin-top-180"></div>';
            require_once "./modules/introduce/introduce.php";
            break;
        case 'menu':
            echo '<div class="margin-top-180"></div>';
            require_once "./modules/menu/menu.php";
            break;
        case 'put_table':
            echo '<div class="margin-top-180"></div>';
            require_once "./modules/put_table/put_table.php";
            echo '<div class="margin-top-60"></div>';
            $title = 'Đặt bàn - Lẩu Wang';
            break;
        case 'endow':
            require_once "./modules/endow/endow.php";
            $title = 'Đặt bàn - Lẩu Wang';
            break;
        case 'blog':
            require_once "./modules/blog/blog.php";
            break;
        default:
            $title = 'Lẩu Wang - Vua Buffet Lẩu - Hệ Thống Chuỗi Nhà Hàng Buffet Hà Nội';
            require_once "./modules/homepage/home.php";
            echo '<div class="margin-top-180"></div>';
    endswitch;
    ?>
    <!-- kết thúc xử lý -->
    <!-- end container -->

    <!-- phần footer -->
    <footer class="footer">
        <div class="grid">
            <div class="gird__now-footer">
                <div>
                    <h3 class="footer_heading">Lẩu Wang – Vua Buffet Lẩu</h3>
                    <ul class="footer_list">
                        <li class="footer-item">
                            <span class="footer-item-link"><strong>Hotline</strong>: 1900 0081</span>
                        </li>
                        <li class="footer-item">
                            <span class="footer-item-link">Lẩu Wang là hệ thống chuỗi nhà hàng buffet lẩu tại Hà Nội được đánh giá cao về chất lượng và giá cả. Buffet tại Lẩu Wang gồm: 119K – 159K – 189K, khách hàng sẽ được thưởng thức tới gần 50 món ăn từ ba chỉ bò Mỹ, hải sản tổng hợp, khai vị hấp dẫn với Cá chiên hoàng bào, Ghẹ sữa rang muối, Ngao xào sốt Thái cùng vô vàn những món ăn, thức uống hấp dẫn khác…</span>
                        </li>
                    </ul>
                </div>

                <div>
                    <h3 class="footer_heading">Hệ thống cơ sở Lẩu Wang</h3>
                    <ul class="footer_list">
                        <li class="footer-item">
                            <i class="fas fa-map-marker-alt iconAdress"></i>
                            <span class="footer-item-link"><strong>Cơ sở 1</strong>: 134 Trần Đại Nghĩa, HBT, Hà Nội </span>
                        </li>
                        <li class="footer-item">
                            <i class="fas fa-map-marker-alt iconAdress"></i>
                            <span class="footer-item-link"><strong>Cơ sở 3</strong>: Số 21 đường 19/5, Hà Đông, Hà Nội</span>
                        </li>
                        <li class="footer-item">
                            <i class="fas fa-map-marker-alt iconAdress"></i>
                            <span class="footer-item-link"><strong>Cơ sở 4</strong>: 17 Tam Khương, Đống Đa, Hà Nội</span>

                        </li>
                        <li class="footer-item">
                            <i class="fas fa-map-marker-alt iconAdress"></i>
                            <span class="footer-item-link"><strong>Cơ sở 5</strong>: 81B Nguyễn Khang, Cầu Giấy, Hà Nội</span>
                        </li>
                        <li class="footer-item">
                            <i class="fas fa-map-marker-alt iconAdress"></i>
                            <span class="footer-item-link"> <strong>Cơ sở 7</strong>: 51A Hồ Tùng Mậu, Cầu Giấy, Hà Nội</span>
                        </li>
                        <li class="footer-item">
                            <i class="fas fa-map-marker-alt iconAdress"></i>
                            <span class="footer-item-link"> <strong>Cơ sở 8</strong>: 143 Trâu Quỳ, Gia Lâm, Hà Nội</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h3 class="footer_heading">Theo dõi chúng tôi</h3>
                    <ul class="footer_list">
                        <li class="footer-item">
                            <span class="footer-item-link"> Theo dõi chúng tôi tại các trang thông tin</span>
                        </li>
                        <div class="footer_list-contact">
                            <li class="footer-item-contact">
                                <a href="https://www.facebook.com/buffetlauwang" target="_blank" class="footer-item-links">
                                    <i class="footer-item-icon fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li class="footer-item-contact">
                                <a href="https://www.instagram.com/lauwang.buffet/" target="_blank" class="footer-item-links">
                                    <i class="footer-item-icon fab fa-instagram"></i>
                                </a>
                            </li>
                            <li class="footer-item-contact">
                                <a href="https://www.youtube.com/channel/UCFgIrScG4krCGh7eCPz8DnA/videos" target="_blank" class="footer-item-links">
                                    <i class="footer-item-icon fab fa-youtube"></i>
                                </a>
                            </li>
                        </div>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer_bottom">
            <div class="grid_footer">
                <span class=""> <a href="dat-ban/" class=" grid__row-from ">Đặt Bàn</a> </span>
                <span class="."> <a href="tuyen-dung/" class=" grid__row-from ">Tuyển Dụng</a> </span>
                <span class="."> <a class=" grid__row-from ">Liên Hệ</a> </span>
            </div>
        </div>
    </footer>
    <!-- end footer -->
    <!-- script -->
    <script src="./assets/js/validate.js"></script>
    <script src="./assets/js/handelEvent.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        Validator({
            form: '#form-order',
            rules: [
                Validator.isRequired('#fullname'),
                Validator.isRequired('#num-adult', "Số lượng người lớn là bắt buộc"),
                Validator.isPhoneNumber('#phone-number'),
                Validator.isRequired('#location', 'Vui lòng chọn địa chỉ'),
                Validator.isRequired('#date', 'Vui lòng chọn đủ ngày và giờ'),
                Validator.isRequired('#time', 'Vui lòng chọn đủ ngày và giờ')
            ]
        })

        // const $$ = document.querySelectorAll.bind(document);


        // jQuery('.feedback__list').slick({
        //     dots: true,
        //     infinite: true,
        //     slidesToShow: 3,
        //     slidesToScroll: 1,
        //     dots: true,
        //     autoplay: true,
        //     autoplaySpeed: 2000,
        //     arrows: false,
        // });

    </script>
</body>

</html>